import markdown from "markdown-in-js";

import { Code, InlineCode } from "../../components/code";
import withMd, { components } from "../../lib/with-md";

export default withMd({
  title: "Pitstop with the Elixir GenEvent Module",
  date: "2015-08-16",
  tags: ["elixir", "functional programming", "genevent"],
  image: "whitewater.jpeg",
  description:
    "Take a break with me as I make a pitstop the Elixir GenEvent module, seeing what it can offer in a real life project.",
})(markdown(components)`

Wanting to learn more about WebSockets, I decided to create an easy to use, drop-in tool for Elixir's Plug library that adds WebSocket support for those using Plug and Cowboy ([plug-web-socket][1]), the only officially supported web server. One important piece of the puzzle I needed to align required an interface for users to broadcast and subscribe to events. What's the point of a WebSocket connection anyways of the server can't react to events on the client or even elsewhere on the server?

For that task, my first thoughts went to GenServers. I probably could have made a GenServer to do the necessary work, however I found that GenEvent provided a more focused abstraction around what I wanted accomplished. Let's walk through a basic usage of Elixir's GenEvent module, stepping through the end result of [my library's event notification layer][2].

> **Note:** I'm going to be commenting through the module I created similar to that of a literate program, talking to parts of the module as it's laid out.

## Getting Started

Here's the easy bit. I've created the module and used the Elixir ${(
  <InlineCode>{`GenEvent`}</InlineCode>
)} module, creating a set of base case ${(
  <InlineCode>{`:gen_event`}</InlineCode>
)} callback functions.

${(
  <Code syntax="elixir">{`
defmodule WebSocket.Events do
  use GenEvent
`}</Code>
)}

Now, I only need to implement the callback functions that I need. Hooray for removal of extra boilerplate code!

## Starting the Process

Next up, I define a ${(
  <InlineCode>{`start_link/1`}</InlineCode>
)} function, useful for adding the ${(
  <InlineCode>{`WebSocket.Events`}</InlineCode>
)} module to a supervisor as a worker child. The ${(
  <InlineCode>{`ref`}</InlineCode>
)} is an atom-based name that will be used throughout the application, and for now, this is the function atom used in the project's routing macro. I know there are some issues here, but the project as a whole mess of improvements to be made.

${(
  <Code syntax="elixir">{`
  def start_link(ref) do
    case GenEvent.start_link(name: ref) do
      {:ok, pid} ->
        GenEvent.add_handler(ref, __MODULE__, [])
        {:ok, pid}
      {:error, {:already_started, pid}} ->
        {:ok, pid}
      otherwise ->
        otherwise
    end
  end
`}</Code>
)}

One line that I want to touch on is the following:

${(
  <Code syntax="elixir">{`
        GenEvent.add_handler(ref, __MODULE__, [])
`}</Code>
)}

The normal route for ${(
  <InlineCode>{`GenEvent`}</InlineCode>
)} is to have a set of handler modules that are added and removed from an event manager. Here, I'm creating the event manager with ${(
  <InlineCode>{`GenEvent.start_link/1`}</InlineCode>
)} and immediately adding the ${(
  <InlineCode>{`WebSocket.Events`}</InlineCode>
)} module as a handler. Since a module can only be added as a ${(
  <InlineCode>{`GenEvent`}</InlineCode>
)} handler once per manager ${(
  <InlineCode>{`ref`}</InlineCode>
)}, the above line is only included in the case where the manager is started and not when the manager is already running. One of my goals is to find a nice workaround for this limitation in order to remove the need to manage my own set of PIDs later on in the module.

${<InlineCode>{`start_link/1`}</InlineCode>} is called in the [${(
  <InlineCode>{`init/3`}</InlineCode>
)} callback of my Cowboy WebSocket handler][3] which itself is called when a client connects to a WebSocket endpoint for the first time to upgrade its connection. The hit of starting the process is only on the first client to a specific endpoint, so the ${(
  <InlineCode>{`GenEvent`}</InlineCode>
)} manager process is only running when a endpoint is actually used.

## The Public API

Next up is the public API for the module. These are the bits a developer would use when developing her own application. In these functions, we continue to expect a ${(
  <InlineCode>{`ref`}</InlineCode>
)} to be passed in order to notify the correct ${(
  <InlineCode>{`GenEvent`}</InlineCode>
)} manager, which in turn notifies the correct ${(
  <InlineCode>{`WebSocket.Events`}</InlineCode>
)} handler. A developer always has the option of passing a PID here, but it's often easier to pass an atom since this removes the need to maintain the manager's PID somewhere in state.

${(
  <Code syntax="elixir">{`
  def join(ref, pid) do
    GenEvent.notify(ref, {:add_client, pid})
  end

  def leave(ref, pid) do
    GenEvent.notify(ref, {:remove_client, pid})
  end

  def broadcast(ref, event, originator) do
    GenEvent.notify(ref, {:send, event, originator})
  end

  def broadcast!(ref, event) do
    broadcast(ref, event, nil)
  end

  def stop(ref) do
    GenEvent.stop(ref)
  end
`}</Code>
)}

One improvement that should be able to be made here is making the ${(
  <InlineCode>{`pid`}</InlineCode>
)} and ${(
  <InlineCode>{`originator`}</InlineCode>
)} arguments optional. More often than not, these will be called from/in the subscribing/subscribed process itself, so it should be able to default to ${(
  <InlineCode>{`self`}</InlineCode>
)} since ${(
  <InlineCode>{`GenEvent.notify/2`}</InlineCode>
)} will do the actual message passing to the handler.

## ${<InlineCode>{`GenEvent`}</InlineCode>} Callbacks

The real meat and potatoes of this module are the ${(
  <InlineCode>{`GenEvent`}</InlineCode>
)} callback functions. These manage subscribers for the handler and propagate the event across the list of subscribers.

${(
  <Code syntax="elixir">{`
  def handle_event({:add_client, pid}, clients) do
    {:ok, [pid|clients]}
  end

  def handle_event({:remove_client, pid}, clients) do
    {:ok, clients |> Enum.filter(&(&1 != pid))}
  end

  def handle_event({:send, event, originator}, clients) do
    spawn fn ->
      clients |> Enum.map(&(maybe_send(&1, originator, event)))
    end
    {:ok, clients}
  end

  defp maybe_send(client, originator, event) do
    unless client == originator do
      send client, event
    end
  end
end
`}</Code>
)}

This concludes the actual contents of the ${(
  <InlineCode>{`WebSocket.Events`}</InlineCode>
)} module.

If I can find a nice work around for the limitation above, most of this would be simplified. The state (${(
  <InlineCode>{`clients`}</InlineCode>
)}) would then be a single client, and there would only be a need for the last definition of ${(
  <InlineCode>{`handle_event/2`}</InlineCode>
)} with some modifications:

${(
  <Code syntax="elixir">{`
  def handle_event({:send, _event, client}, client}, do: {:ok, client}
  def handle_event({:send, event, _originator}, client} do
    send client, event
  end
`}</Code>
)}

Wouldn't that be nice? I think so!

[1]: https://github.com/slogsdon/plug-web-socket
[2]: https://github.com/slogsdon/plug-web-socket/blob/master/lib/web_socket/events.ex
[3]: https://github.com/slogsdon/plug-web-socket/blob/master/lib/web_socket/cowboy/handler.ex#L33-L36
`);

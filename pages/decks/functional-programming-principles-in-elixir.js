import markdown from "markdown-in-js";

import { Code, InlineCode } from "../../components/code";
import withMd, { components } from "../../lib/with-md";

export default withMd({
  title: "Functional Programming Principles in Elixir",
  date: "2015-09-08",
  location: "Louisville Elixir Meetup (Louisville, KY)",
  tags: ["elixir", "functional programming", "talk"],
})(markdown(components)`

From the meetup description:

> Join us as we discuss core functional programming principles, focusing on Elixir's usage/implementation of them, and comparing these principles against an object-oriented programming language. We'll be covering first-class functions, pure vs. impure functions, iteration, type systems (briefly), and the many uses of lists along the way.

${(
  <iframe
    width="560"
    height="315"
    src="https://www.youtube.com/embed/Zee4bbsDvrA"
    frameborder="0"
    allowfullscreen
  />
)}

* [Meetup](http://www.meetup.com/Elixir-Louisville/events/224878333/)
`);

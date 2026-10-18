---
title: 'Your First Gate'
layout: 'partials::layouts/loop-and-gate-guide'
date: 2026-10-13
slug: your-first-gate
image: your-first-gate-og.png
heroImage: your-first-gate-hero.png
description: >-
  Set up the Loop & Gate Foundation, teach it how you write, and run one real
  session that stops and asks you something.
draft: true
---

## The pause is the point

You give your agent a task in one sentence. 40 minutes later it has read through your project, written a plan, and it's about to start building. Then it stops, because it wants to know whether the approach it picked is the one you meant, and it isn't going to guess.

That pause is what Loop & Gate is for. This page walks you from nothing to that first pause, on your own machine and your own project. The [hub page](/loop-and-gate/) has the full stack and a suggested order. This is the hands-on version of its first step.

## What you need

A Mac or Windows machine and a paid Claude plan: Pro, Max, Team, or Enterprise. The free plan doesn't include Claude Code, and that's the thing almost everyone hits first, so check it before anything else.

You also need the Claude desktop app open on its **Code** tab. If you don't have it, get the installer from [code.claude.com/docs](https://code.claude.com/docs), sign in, and click **Code**. On Windows, Git for Windows is recommended, and the app may prompt you to install it. Say yes, since the Foundation's memory loader is a small shell script.

## Step 1: get the Foundation folder

The Foundation is a folder you open and work inside. The skills live in it, and the memory loader turns on every time you open it.

Go to [github.com/slogsdon/loop-and-gate-foundation](https://github.com/slogsdon/loop-and-gate-foundation), click the green **Code** button, then **Download ZIP**. Unzip it somewhere you'll find again. In the Claude app, use **File → Open folder** and pick the unzipped folder.

If you're comfortable in a terminal, `git clone` gets you the same folder and makes updates easier.

**A faster alternative.** You can also install the Foundation as a plugin now. In the Code chat box, type `/plugin marketplace add slogsdon/loop-and-gate-foundation`, press Enter, and click **Install**. It's quicker, and it works in every session rather than in one folder. The same command also lists the kits, so it's the only one you need. The tradeoff is that a plugin lives in a versioned cache that's replaced on every update. The agent still improves its memory, but any edits it makes to its own skills won't survive the next plugin update, and that self-improvement is half of what makes the loop interesting over months. Start with the folder if you can.

## Step 2: give it somewhere to remember

In the chat, ask for this in plain words:

> Set up my vault.

The agent asks where the vault should live and creates it. On a Mac it suggests iCloud, which is worth taking, because the same notes then show up in Obsidian on your phone.

The vault is a folder of Markdown files. `MEMORY.md` is the index the agent reads first, `Daily/` is what happened, `Knowledge/` is what it learned, and `Reflections/` is where it grades itself. You can open any of it in a text editor and read exactly what your agent believes about you. If that ever stops being true, something has gone wrong.

You do this once.

## Step 3: teach it how you write and judge

Next, ask:

> Build my voice profile.

This runs the profile interview. The agent asks you one question at a time about how you write, pushes on vague answers, and asks for real examples. You choose a quick pass (around 15 questions) or a full one, and you can stop whenever you want. It writes what it learns to a voice profile in your vault. Run it again later for your taste profile, which covers design and product judgment.

This step matters more than it looks. The kits read these profiles at their gates: the Grow kit's copy gate reads your voice, and its design gate reads your taste. A partial profile still beats none.

## Step 4: run a session that has to stop

Now give it something real. Not a demo task, an actual thing you want done in an actual project of yours.

> Get to know me: ask about my current project and preferences, then save what you learn.

Watch what happens without you asking. The session opens by loading memory. The agent asks you questions and writes the answers into notes it can read back next week. When you wrap up, it logs what happened and one honest lesson about how the session went, in a file you can go read.

Somewhere in there it stops and asks you something it could have guessed at. That's your first gate. Notice how it feels. An agent that guesses is faster right up until it's confidently wrong, and by then it has written half a day of work on top of the mistake.

Come back tomorrow and start a new session. It'll already know what you told it.

## Step 5: add a kit when you're ready

The Foundation gives you memory and a loop that pauses. It doesn't give you the full map of *where* a build should pause. That's what the kits are for, and the hub describes each one.

When you want them, ask:

> Install the rest of the Loop & Gate stack.

You get a list, you pick what you want, and nothing installs unless you choose it. Start with the Foundation and one real session first. The kits mean more once you've felt the base loop work.

## If something isn't working

On Windows, if memory isn't loading, check that Git for Windows is installed before anything else. The memory loader is a shell script.

If the agent's improvements to its own skills disappear after an update, you're probably on the plugin. That's expected. Switch to the folder if you want the full loop.

## Where it stops is the product

The tools underneath change every quarter, and you should expect to swap them. The gates don't, because they aren't about tools. They mark the places your agent can't judge on its own. It can't tell a real problem from a loud one, it can't feel when an architecture will hurt you in six months, and it can't tell a test from a demo. Where it's strong you let it run. Where it can't judge, you stop and decide.

Open the folder. Give it one real goal. See where it stops.

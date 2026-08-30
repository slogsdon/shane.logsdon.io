---
title: 'From Shopping Carts to Custom Builds: How to Set Up Online Payments with AI'
seoTitle: 'AI Payments: From Shopping Carts to Custom Builds'
date: 2025-10-15
layout: 'partials::layouts/writing-post'
slug: from-shopping-carts-to-custom-builds
image: speaking/from-shopping-carts-to-custom-builds.jpg
---

## Introduction

Hello everyone, and welcome to today's webinar presented by Global Payments. "From Shopping Carts to Custom Builds: How to Set Up Online Payments Using AI" — AI can help you build your payment systems in minutes, not months.

For today's takeaways, we'll show you how AI can help enable a payment plugin for your shopping cart, how to build a checkout from scratch on your custom site with the help of AI, and how to use two different tools — and we're not a sponsor of either one — so you can choose what works best for you. And the best part: zero technical experience required.

For your experts, I'm pleased to welcome Shane Logsdon, Senior Director of Product Management, and Eric Lee, Product Advocate.

## The Old Reality of Custom Development

To kick things off, we're going to help set the stage by talking about the old reality of creating a custom website or a custom SaaS app, and what that really meant for you. Starting off, you were looking at roughly a $15,000 minimum investment for actually building out your solution — working through a development firm or a contractor to do the initial build, and then also working through maintenance and anything that came up in terms of bugs.

Second, you'd be working through a minimum two-to-three month window because developers are often working through multiple projects. It's not just you — and that can prevent you from hitting the market at the right time, which can often mean losing business for your company.

And lastly, a lot of these solutions require really complex development — new APIs, webhooks — and that added complexity usually adds time and cost to your build out. At the end of the day, there are also a lot of hidden costs: your development costs can go up, there's the opportunity cost of multiple months of build time that prevents customers from accessing your site sooner and you lose out on that revenue potential, and then there's the ongoing dependency on a development firm to help make updates when your users have feature requests.

So to combat that, we're going to walk through a few different scenarios as alternatives to get to market quicker.

## Demo 1: Adding Payments to WooCommerce with ChatGPT

Starting with a demo using a WooCommerce site, we'll capture the power of ChatGPT to help figure out how to install a plugin for Global Payments and enable payments in that store — allowing quick, easy transactions for you and your customers.

All right, let's jump into the actual demo. So I mentioned we have a WooCommerce store to base off of — this is my simple store. We have a little shop here with one item. If we add it to the cart and proceed to checkout, we have no payments available. So this is what we're going to work through today.

I'm going to switch over to ChatGPT. Now, I prepped ahead of time and grabbed a really awesome starting point for a prompt. What I want to call out here is that even though I have this ready, you can often just type as you think — think like you're talking to someone and working through a problem with your best friend. You say, "I have this, this is what I'm trying to do — how can I do this?" If you're really interested, a lot of these chat solutions also have a speech-to-text option where you can enable your microphone and actually talk to the chat window and it'll transcribe what you speak.

So now ChatGPT has gotten back to us with a process and guide to get started with our WooCommerce store. Looking through this, we're going to install a plugin for Global Payments, create and locate our API credentials — and it also walks you through how to grab those from our developer portal — then configure and enable the payment method.

Let's give this a try. I'm already logged into the admin section. It said to go into Plugins and add a plugin. I'm going to look for "Global" — and there's the plugin. That's the right one. I'm going to hit install and then Activate. Looks like it was activated successfully — great.

Now I'll switch back to ChatGPT to confirm. I have my credentials already, and it's saying to go into Settings under WooCommerce and then Payments. I can see a lot of options — there's the Unified Payments option it was talking about. I'll hit Manage, enter my App ID and App Key from my Sandbox account. I'm in the US so I don't need to worry about 3D Secure at the moment, but if you're in a locale like Europe where Strong Customer Authentication is required, be sure to select that. I'm going to allow card saving so my customers can come back easily. Save changes — that looks good.

I'm going to refresh the checkout screen and see if the payment method is available. There it is! This red box is only here because we're using test credentials. Otherwise, I've got my card fields. I'm going to use a test card to run a little test transaction in the Global Payment Sandbox — submit — and after a few seconds we'll see a confirmation screen. And there we have it: a successful payment and order submitted through our WooCommerce store.

One thing I like to call out: a lot of this is straightforward to me because I'm in this every day. But what if you weren't really sure how to find the right configuration setting, or what 3D Secure means? We can ask follow-up questions in the same chat thread — like "In the US, do I need 3D Secure?" — and ChatGPT also says if you're in the US you probably don't need it because there's no regulatory requirement like there is in Europe.

If you're still stuck or want clarity, our support teams at Global Payments can work through those problems as soon as you call in — they're ready and available to help through those situations.

## Demo 2: Building a Custom Checkout with Claude Code

For our second demo, we're talking about creating a really custom payment form. We're going to use a combination of tools: Visual Studio Code, starting from an empty project, and Claude Code inside VS Code to work through our chat. In this case we're using Claude instead of ChatGPT — same process, a lot of different tools for different workflows. Claude Code is more of a ready-to-use coding solution that creates the code and writes it directly into your project.

Before we start the coding side, a lot of the power comes from the imagination of these AI tools. We can use other tools like Lovable or Bolt with a simple prompt to create really awesome interactive websites. I said, "I'm an artist, I want people to be able to buy my art," and it created a gallery for me with purchase buttons. Then we can continue iterating with those tools — or with Claude. This gives you a place to start from zero and build out an awesome solution for your business.

To jump in — thanks, Shane — going over the difference: ChatGPT is more of a chat interface. Claude Code is a command-line interface that you work alongside VS Code. And then additional options like Lovable and Bolt are helpful for prototyping and visualizing a design. They can be paired with any of these other combinations.

Let's continue down the custom development demo. I have a basic prompt to start from — I'm going to create a simple payment page in PHP, because I know my web host uses PHP, and I want to use the Global Payments SDK.

Claude is going to process in a similar way to ChatGPT, but it does web searches, creates a checklist of things that need to be done, and you can see in-depth details of what's going on behind the scenes. With it, you can adapt as it goes — you can queue another message, add thoughts, and it'll be working alongside creating code.

The crazy thing: if you watch some of these verbs — right now it's on "scheming and calculating," but before it said "vibing." So you might have heard the phrase "vibe coding," and that's kind of what we're doing here: just sending a message into the chat and letting it do its thing. It's created that to-do list and is working through it, writing files and making tool calls — like web searches or running commands.

Oftentimes you want to be there and watch what it's doing. If you're unsure, you can learn a little bit, and you can also manage it to make sure it's not doing anything unexpected. I'm letting it write the files automatically, but when it comes to running tools or commands, I like to be the person in the middle — manually reviewing to make sure it's doing the right thing.

*Yeah, Shane, what you said was great about middle-manning. Not only is it great to watch what tasks are being done, but even for me — I've been doing engineering for quite some time — when I watch Claude write things out, I get to learn and improve on my skills, seeing how Claude approaches it, whether it's tools that are called or command-line commands that are made. I feel like I learn a lot when I watch Claude work.*

We can see what it's done here: it's listing out the files it's created and explaining what each one is used for — a configuration file, here's where our payment form lives, here's where our payment processing logic lives, and so forth. It can also guide us to the next step. But me being me, I don't really know where to run this command, so I'm going to ask Claude to help me install the dependencies.

It's prompting us for permission. I like to make sure I'm clicking yes on these, or if I don't feel comfortable I can click no. Or there's a third option: you can edit what it's trying to do and say, "Hey, don't do that, try this instead." But in this case, yes.

Our dependencies are going to install — and it found a problem in the code it generated, edited that, and is working to fix the problem. That's another great thing to call out: the first time is often best approached with the mindset that there might be issues along the way. But if you're persistent, you can work with the chat window and figure out how to get around that particular problem. Claude ran into some versioning issues, fixed them, reran the command, and it was successful.

Now I'm asking Claude to create the environment file for me. It's going to copy that into our directory. I'll enter my App ID and App Key, save the file, and come back into Claude. Let's ask it to help test this — hopefully it's going to start our server and let us actually interact with the site it generated for us.

I'll bounce over to Chrome and load up localhost. We load up our payment form — this is what Claude generated for us: an amount field, cardholder name, card number, expiration, and some billing information. Let's try running through it. We ran into an error — which is the nature of the beast. But we don't have to know how to fix it on our end. We can just copy and paste the error into Claude, without even giving it any other information or context, and it's going to be smart enough to work through those issues.

It's going to make some edits to our files. It says we should be able to process successfully now. Let's refresh and try again. It says "captured," which is what we should expect, but there's a red error message. So we're going to take a screenshot of our error and paste that into Claude — it's going to view our image, parse out the information, figure out where that message exists in our code, and help make that change.

*This is great, Shane. For this demo, we get to see things happen live. One of the most important things with vibe coding is being able to iterate: going step by step through different changes. If we see something that doesn't look right, we capture some aspect of the context — like a screenshot or error messages — and we're able to see live changes as they happen.*

Let's try again — and it says we have a green success message. Let's see if that's the case. We got an error again — nature of the beast, sometimes things don't work out. These AI tools aren't always perfect; they're going to try one way and maybe have to go through and try another. This is a great scenario where if you have questions you can't get resolved, our support teams at Global Payments are really awesome. They're at the ready to help with these kinds of questions, especially when it comes to interacting with our payment services.

If you want the best of both worlds — experts you can rely on, but also the ability to do this on your own — the combination of these AI tools and our teams here at Global will be that power couple for you.

We've got another successful run through from Claude's perspective. We're going to give it one more shot to verify. We come back, refresh again — and boom. We have exactly what we want: a successful test transaction in the Global Payments sandbox environment. We've got a success message from our app and a transaction ID from the Global Payments API, which we can use in further changes or to provide an admin area to manage those payments.

## Closing

Today we've walked through a couple of demos — using WooCommerce and a custom form that we built — and got successful responses for both after a couple of iterations. And we didn't have to touch a single line of code along the way.

And I think that wraps us up for today. If you're ready to get started with Global Payments in your favorite AI tool, feel free to scan the QR code on screen for one of our informative pages on our website to get started with online payments at Global Payments.

And if you want to chat more about Global, or AI, or the combination of both with Eric or myself, feel free to reach out to us on LinkedIn. We'd be glad to chat with you. Appreciate it.

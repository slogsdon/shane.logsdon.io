---
title: Token Routing Is Least-Cost Routing
date: 2026-10-21
layout: partials::layouts/writing-post
slug: token-routing-is-least-cost-routing
description: Routing AI requests across model providers is the same problem payments
  solved with least-cost routing. Why Stripe's pending OpenRouter deal reads like
  a payments company buying a router, and where the analogy breaks.
faqs:
- q: What is least-cost routing in payments?
  a: When a customer pays with a debit card that can run over more than one network,
    the merchant may send the transaction over the network that costs the least to
    accept. In the US, Regulation II requires issuers to enable at least two unaffiliated
    networks on every debit card, and since July 2023 that covers online payments
    too.
- q: How does OpenRouter decide which provider gets a request?
  a: By default it load balances across providers, prioritizing price. It filters
    for providers that can handle the request, favors providers without significant
    outages in the last 30 seconds, picks among the lowest-cost candidates weighted
    by the inverse square of the price, and keeps the rest as fallbacks.
- q: Where does the analogy between token routing and payment routing break?
  a: Tokens are not interchangeable the way dollars are, because providers serving
    the same model differ in quality, uptime, and latency. Debit routing is a legal
    right under Regulation II, while model routing is a product feature you get by
    contract. OpenRouter's default makes the cheapest provider the most likely pick,
    not a guaranteed one. And the router also sends the invoice.
- q: Why would Stripe buy an AI model gateway?
  a: The author's read, not a statement from either company, is that the deal does
    double duty. Stripe gets routing logic it already understands from choosing paths
    for money based on cost and success rates, and it gets infrastructure for its
    own AI-native development.
- q: Has Stripe's acquisition of OpenRouter closed?
  a: Not at the time of writing. The deal was announced August 19 and is still under
    regulatory review. Australia's competition regulator, the ACCC, has a Phase 1
    decision due by November 16. Neither company disclosed a price.
---

Routing AI requests across model providers is the same core problem payments has been solving for decades with least-cost routing. You pick the cheapest path that's eligible to carry the transaction, and you watch uptime and latency so cheap doesn't turn into broken. That's why Stripe's pending acquisition of OpenRouter, an AI model gateway, reads to me less like an AI story and more like a payments company buying a router for a new unit of settlement. My read is that the deal does double duty. Stripe gets routing logic it already understands, and it gets infrastructure for its own AI-native development.

I've spent my career in payments, and I build with models on the side, so I'll explain the jargon from both directions as I go.

## Two kinds of merchants

In my experience, merchants sort themselves into two buckets on pricing.

The first bucket wants a predictable bill. They pay a flat rate per transaction and stop thinking about it. Stripe's published US rate for domestic cards is the familiar one, 2.9% + 30¢ per successful charge. Every card costs the same to accept, the math fits in a spreadsheet cell, and nobody on staff needs to understand how the card networks price things underneath.

The second bucket wants the lowest possible cost and is willing to deal with complexity to get it. They pay interchange-plus. Interchange is the fee the card-issuing bank collects on each transaction, and it varies by card type, network, and how the card was presented. The payment service provider (PSP, the company that processes payments for the merchant) passes interchange through at cost and adds its own margin on top, usually quoted in basis points (hundredths of a percent). Global Payments, where I worked, prices this way for a lot of its merchants, and so do most processors serving larger businesses.

The second bucket is where routing starts. Once you can see the real cost of each transaction, you notice the cost isn't fixed. It depends on the path.

## Least-cost routing, briefly

Many US debit cards can run over more than one network. Regulation II requires issuers to enable at least two unaffiliated networks on every debit card, and it bars issuers and networks from inhibiting a merchant's ability to direct a transaction over any of them. Since July 2023 that applies to card-not-present transactions too, which means online payments. Australia's central bank has the clearest plain-language definition: when a customer pays with a dual-network debit card, the merchant may send it over the network that costs the least to accept, which is "least-cost routing." If the merchant doesn't choose, the transaction goes to a default network.

As merchants in the interchange-plus bucket grow and expand into new regions, they often move to payment orchestration. That means a layer that sits above several PSPs and decides, per transaction, which one gets it. Cost is usually the reason they start. It isn't the only thing they end up routing on. Once you have more than one provider, you can steer around one that's down or slow, so uptime and latency become routing inputs too.

Orchestration also changes what a failure means. When a transaction fails on one provider, the orchestrator retries it on another. In my experience most PSPs hover around a mid-90% approval rate, depending on the merchant and its customers' card mix, so a few percent of attempts are worth a second try somewhere else. OpenRouter does the model-side version of this. When a provider is unavailable, it falls back to the next one on its list.

## The same machine, pointed at tokens

For the payments readers: a token here is a chunk of text a language model reads or writes, and model providers bill per token. The same open-weight model is often served by several hosting providers at different prices, and a gateway like OpenRouter sits in front of all of them behind one API.

OpenRouter's own docs describe its default behavior as load balancing across providers, "prioritizing price." It favors providers that haven't seen significant outages in the last 30 seconds. Among those stable providers it picks one of the lowest-cost candidates, weighted by the inverse square of the price, and keeps the rest as fallbacks. It filters for eligibility before any of that. If your request asks for a long response, it only routes to providers that support that length, and if it uses tools, it makes a best effort to route to providers known to support them. You can also sort by price, throughput, or latency, set a maximum price, or pin and exclude specific providers.

Line that up against the payments side. Eligibility comes first, which is the issuer enabling a network for that card, then the cheapest eligible path, a default when nobody chooses, explicit overrides when the merchant does, and outage avoidance on top. That's least-cost routing plus the orchestration layer, with a different unit going through it.

Stripe's announcement uses close to the same language. It describes OpenRouter routing work "to the optimal model based on task complexity, price, speed, and reliability," and it points out that Stripe already optimizes across payment methods and authorization rates for its users.

## Where the analogy breaks

Tokens are tokens in the sense that you pay for them by the unit, but the unit isn't interchangeable the way a dollar is. Two debit networks move the same dollars, and the outcome is identical either way. Two providers serving the same model can differ in quality, uptime, and latency, and across different models the output itself is different. That makes quality, uptime, and latency the secondary metrics you route against, which maps closely to the orchestration move I described above. When I wrote about this on LinkedIn I put it this way: price and latency are trivially measurable, and correctness isn't. Card payments have an authorization rate, and tokens have no equivalent, though error and reject rates are one way to measure something similar. Evaluation loops can get you closer to a correctness rate for each provider, but that's typically a separate service from the router, so routers optimize the variables that are cheap to observe.

The right to route is also different. In the US, a merchant's ability to choose the debit network is a legal right under Regulation II, held against issuers and networks. OpenRouter's routing controls are product features you get by contract. No regulator guarantees an AI builder two unaffiliated providers for a model.

The weighting is different too. OpenRouter's default makes the cheapest provider the most likely pick, not a guaranteed one. Its docs give the example of three providers at $1, $2, and $3, where the first is nine times more likely than the third to be tried first. A merchant's routing rule is usually deterministic.

And the router also bills. In payments, the company doing the routing often gets paid differently depending on the path, and merchants know to ask about it. OpenRouter's pitch has been neutrality, and it said, in its own post and in its CEO's quote in Stripe's announcement, that this continues. That's a stated commitment, and I'll be watching how it reads once the gateway and the invoice come from the same place.

## Why Stripe, and why now

Here's my read, and it's a read, not something either company has said. The first half of the deal is the routing logic. Stripe has spent years building systems that choose paths for money based on cost and success rates, and OpenRouter does the same job for model traffic. The second half is that Stripe builds software like everyone else now, with models in the loop, and owning the gateway those models sit behind supports its own AI-native development practices as much as it supports customers.

The deal was announced August 19, and it hasn't closed. It's still under regulatory review, and Australia's competition regulator, the ACCC, has a Phase 1 decision due by November 16. Neither side disclosed a price. Press reports put it at more than $7 billion (Bloomberg), $7.5 billion (The New York Times), and more than $8 billion (Reuters).

If you've spent time in payments, you already know how this machine works. The new part is deciding what a good transaction looks like when the thing being routed is an answer.

*Disclaimer: I worked for Global Payments. These thoughts are my own.*

<?php
$this->layout('partials::layouts/main', [
    'title' => 'How I work',
    'description' => 'Shane Logsdon’s product and engineering principles: developer experience, business outcomes, focused delivery, verification, and working with teams.',
    'url' => '/how-i-work/',
]);

// C · Sheet, Q3: these working practices evolve, so readers need a revision
// and date. No figure is needed to explain them. See DESIGN.md.
?>

<div class="mx-auto max-w-editorial px-6 pt-10 pb-16">
  <div class="sheet">
    <div class="sheet__field">
      <p class="smallcaps-lg">
        product and engineering
      </p>
      <h1 class="mt-6 font-display font-normal text-foreground"
          style="font-size: clamp(2rem, 4.4vw, 3.5rem); line-height: 1.05; letter-spacing: -0.018em;">How I work</h1>
      <p class="mt-6 font-display text-2xl leading-snug text-foreground">
        Product judgment. Engineering discipline.
      </p>
      <div class="mt-6 max-w-prose space-y-4">
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              I&#x27;ve been the developer writing the SDK, the architect helping a partner
              integrate, and the product leader deciding what the platform should make possible.
              Moving between those jobs taught me to follow a decision all the way through: from the
              problem someone has to the software they use and the result it produces.
            </p>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              My experience spans payment platforms, developer tools, and building LeadSurface.
              These are the principles I bring to that work, the practices behind them, and what you
              can expect when we work together. They evolve as I learn.
            </p>
      </div>
      <nav class="mt-8 flex flex-wrap gap-x-6 gap-y-3 text-sm" aria-label="On this page">
        <a class="link-quiet" href="#principles">Principles</a>
        <a class="link-quiet" href="#product-practice">Product practice</a>
        <a class="link-quiet" href="#engineering-practice">Engineering practice</a>
        <a class="link-quiet" href="#working-together">Working together</a>
      </nav>

      <section id="principles" aria-labelledby="principles-heading" class="mt-16 scroll-mt-24 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 sm:grid-cols-[3fr_9fr]">
        <h2 id="principles-heading" class="smallcaps-lg leading-relaxed">Principles</h2>
        <div class="max-w-prose space-y-8">
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Start with the problem worth solving</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              Before choosing an approach, I want to know who&#x27;s struggling, what they&#x27;re
              trying to accomplish, and how they&#x27;re getting around the problem today. A request
              is useful evidence, but it still needs interpretation. Sometimes the right response is
              a smaller change. Sometimes it&#x27;s a different problem. Being able to build
              something well is a reason to be more careful about whether it deserves to exist.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">The interface someone builds against is the product</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              For a developer platform, the API, SDK, documentation, examples, and support all shape
              the experience. A capability isn&#x27;t useful just because the backend supports it.
              Someone has to understand it, integrate it, recover when it fails, and trust it in
              production. I treat that whole journey as product work.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Measure whether the work changed anything</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              I want to connect what we shipped to what someone can now do. Integration completion,
              production use, recurring support problems, and commercial results answer different
              questions. The useful measure depends on the decision we&#x27;re making. An activity
              count needs a clear connection to the outcome before it earns a place in that
              conversation.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Build the smallest thing that delivers real value</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              I prefer a narrow solution that works through the full user journey. Reducing scope
              should make it easier to learn and change direction while preserving the soundness of
              what ships. Early work can be manual and the finish can improve later. Data integrity,
              understandable failure, and the ability to use the product still matter.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Let the stakes set the process</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              A copy change and a payment flow deserve different levels of scrutiny. I scale
              planning, review, testing, and rollout to the consequences of being wrong and how
              easily we can recover. Reversible decisions should move quickly. Decisions involving
              money, access, or customer data need more evidence before they reach users.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Keep judgment with the person accountable</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              AI is part of how I build. I use it to carry context and execute repeatable work, with
              explicit points where I review the direction, architecture, evidence, cost, and
              remaining risk. Those decisions stay mine. Faster implementation makes a clear problem
              statement and a credible verification process more valuable.
            </p>
          </div>
        </div>
      </section>

      <section id="product-practice" aria-labelledby="product-practice-heading" class="mt-16 scroll-mt-24 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 sm:grid-cols-[3fr_9fr]">
        <h2 id="product-practice-heading" class="smallcaps-lg leading-relaxed">Product practice</h2>
        <div class="max-w-prose space-y-8">
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Make the outcome clear before prescribing the solution</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              I write down who the work serves, the problem, the constraints, and what success would
              look like. That gives product and engineering something concrete to challenge and
              improve together. It also leaves room for someone closer to the implementation to find
              a better approach.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Follow the adoption journey into production</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              In payments, a successful sample request is an early milestone. I care about what
              happens between that moment and a working integration: confusing contracts,
              environment setup, edge cases, support handoffs, and the confidence to go live. My
              work at Global Payments included SDKs, sample projects, sandbox experiences, and
              support practices because each affects whether the platform gets used.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Bring support and customer evidence into prioritization</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              A recurring integration issue can reveal a product gap, a documentation problem, or an
              abstraction that asks too much of its users. I want those signals visible alongside
              usage and business results. At Global Payments, I brought support, product, and
              community signals into reporting that connected developer pain to roadmap decisions.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Stay close enough to learn</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              Building LeadSurface keeps the distance between a customer conversation and an
              implementation decision short. I want that contact to change what I build. When the
              problem is still uncertain, direct involvement is valuable; automating the interaction
              too early can remove the part that teaches me what matters.
            </p>
          </div>
        </div>
      </section>

      <section id="engineering-practice" aria-labelledby="engineering-practice-heading" class="mt-16 scroll-mt-24 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 sm:grid-cols-[3fr_9fr]">
        <h2 id="engineering-practice-heading" class="smallcaps-lg leading-relaxed">Engineering practice</h2>
        <div class="max-w-prose space-y-8">
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Make contracts clear and failures useful</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              Working across SDKs in multiple languages made consistency a practical concern. Names,
              defaults, errors, and examples should help developers form an accurate mental model. I
              pay particular attention to where a payment or integration behaves differently from
              the happy path, because those are the places people need the most help understanding
              what happened and what to do next.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Keep changes small enough to understand</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              I prefer existing patterns and platform capabilities before adding another layer.
              Changes should be focused enough to review and leave the next person able to
              understand the reasoning. Additional machinery needs a present problem to justify its
              maintenance cost.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Match the evidence to the claim</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              A passing unit test, a browser check, and a production observation each prove
              something different. I want to know which behavior was exercised, what would catch a
              regression, and what remains unverified. “Done” includes a result the next person can
              use and an explanation they can act on.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Treat operation as part of delivery</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              The work includes how we diagnose failures, support the integration, and recover when
              something goes wrong. My experience with technical escalations and developer support
              informs what I ask for during design: useful errors, repeatable diagnostics, and
              documentation that survives the handoff.
            </p>
          </div>
          <div class="space-y-3">
            <h3 class="font-display text-xl font-medium leading-snug text-foreground">Automate repeatable work with explicit boundaries</h3>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              My Loop &amp; Gate workflow separates execution from the decisions that require my
              judgment. Written context carries across sessions; focused verification checks the
              result. The amount of process still depends on the change. A workflow earns its keep
              when it helps deliver the right thing reliably.
            </p>
          </div>
        </div>
      </section>

      <section id="working-together" aria-labelledby="working-together-heading" class="mt-16 scroll-mt-24 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 sm:grid-cols-[3fr_9fr]">
        <h2 id="working-together-heading" class="smallcaps-lg leading-relaxed">Working together</h2>
        <div class="max-w-prose space-y-8">
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              I default to written context and asynchronous communication. A complete message helps
              people respond with the whole situation in view; a meeting should have a clear
              decision to make. When we decide something together, I want the reasoning recorded so
              the next conversation can build on it.
            </p>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              Once the goal and constraints are clear, I value autonomy over the approach. I&#x27;ll
              challenge scope and assumptions, and I want people working with me to do the same. A
              specific concern or counterproposal gives us something we can resolve. A better
              argument should change the direction, including when the original idea was mine.
            </p>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              Feedback works best when it&#x27;s direct, timely, and specific about the impact. If
              something is blocked or the assumptions changed, I&#x27;d rather hear early while we
              can still adjust.
            </p>
            <p class="max-w-prose text-base leading-relaxed text-ink-soft">
              I&#x27;m still working on staying in validation longer before switching into build
              mode, and on delegating work that I could finish faster myself. Being able to solve
              the immediate problem is useful; helping someone else build that capability matters
              too.
            </p>
        </div>
      </section>

      <section id="supporting-work" aria-labelledby="supporting-work-heading" class="mt-16 scroll-mt-24 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 sm:grid-cols-[3fr_9fr]">
        <h2 id="supporting-work-heading" class="smallcaps-lg leading-relaxed">See the work behind it</h2>
        <div class="max-w-prose space-y-8">
          <ul class="space-y-3 text-base leading-relaxed">
            <li><a class="link-quiet" href="/resume/">Experience and responsibilities</a></li>
            <li><a class="link-quiet" href="/work/">Selected projects</a></li>
            <li><a class="link-quiet" href="/articles/strategic-insights/building-on-the-margins/">Building on the Margins</a></li>
            <li><a class="link-quiet" href="/articles/strategic-insights/what-do-we-measure/">What Do We Measure When AI Answers the Questions?</a></li>
            <li><a class="link-quiet" href="/articles/leadership-and-management/the-25-percent-that-ai-cant-do/">The 25% That AI Can&#x27;t Do</a></li>
          </ul>
        </div>
      </section>

    </div>
    <?php $this->insert('partials::components/title-block', [
        'sheetNo' => 'A-05',
        'sheetFile' => 'pages/how-i-work.php',
        'sheetTitle' => 'shane logsdon &middot; principles and practices',
        'sheetMeta' => '<a class="link-quiet" href="/about/">about</a> &middot; <a class="link-quiet" href="/resume/">experience</a>',
        'sheetRevFallback' => '1',
        'sheetDateFallback' => '2026-11-26',
    ]); ?>
  </div>
</div>

<?php
$this->layout('partials::layouts/main', [
    'title' => 'About',
    'description' => 'Technical product leader with 15+ years at the intersection of fintech and developer tooling. Leads developer advocacy at Global Payments. Also builds web presence systems for local businesses.',
    'url' => '/about/',
]);
$settings = require('resources/settings.php');
require_once 'resources/git.php';
// Honest freshness: last real content change from git, not build time. Returns
// null on a shallow clone, where git would report the deploy date for every
// file and this would claim the page changed when it did not.
$aboutModified = git_last_modified('pages/about.php', '%cI') ?? '2026-07-18T00:00:00-04:00';

// C · Sheet, by Q3: this page has a current state that can go stale, so it has
// to say when it last changed. The title block at the foot of the sheet does
// that, and its values are read from git rather than typed whenever git can
// answer honestly. On a history-less clone it falls back to the values passed
// below instead of reporting a wrong revision. See resources/git.php.

$expertise = [
    ['num' => '01', 'title' => 'Payment systems',     'body' => 'Designing scalable payment processing infrastructure with reliability, security, and compliance as first-class concerns.'],
    ['num' => '02', 'title' => 'Developer platforms', 'body' => 'Building APIs and SDKs that prioritize developer experience: clear contracts, honest errors, and short paths to first success.'],
    ['num' => '03', 'title' => 'Product leadership',  'body' => 'Translating complex financial capabilities into developer platforms that drive adoption and durable revenue.'],
    ['num' => '04', 'title' => 'Technical leadership','body' => 'Leading engineering teams, setting architecture direction, and bridging business strategy with implementation.'],
];

// Figure data. Record chart, so it reconciles to a file: counted live from
// articles-list.json at build time rather than transcribed, which means the
// drawing cannot drift away from the list it describes.
$allPosts = (array) json_decode(file_get_contents('resources/data/articles-list.json'));
$categoryLabels = json_decode(file_get_contents('resources/data/categories.json'), true);
$categoryCounts = [];
foreach ($allPosts as $post) {
    $key = $post->category ?? 'uncategorized';
    $categoryCounts[$key] = ($categoryCounts[$key] ?? 0) + 1;
}
arsort($categoryCounts);
$postTotal = array_sum($categoryCounts);
$countMax  = max($categoryCounts);
$barMax    = 276; // px at the chart's own scale
?>

<div class="mx-auto max-w-editorial px-6 pt-10 pb-16">
<div class="sheet">
  <div class="sheet__field">

    <h1 class="max-w-[22ch] font-display font-normal text-foreground"
        style="font-size: clamp(2rem, 4.4vw, 3.5rem); line-height: 1.05; letter-spacing: -0.018em;">
        A technical product leader writing <span class="t-accent">developer-first</span> software for the payments stack.
    </h1>

    <p class="mt-6 max-w-prose text-[1.0625rem] leading-[1.6] text-ink-soft">
        For more than a decade I&rsquo;ve worked at the intersection of financial technology and
        developer tooling, helping companies build and scale the payment infrastructure that quietly
        moves billions of dollars. The through-line is the same everywhere: the interface someone
        else has to build against is the product.
    </p>

    <!-- Field, two columns. The expertise rows carry the argument; the chart is
         the sheet's one figure. C · Sheet allows at most one. -->
    <div class="mt-12 grid grid-cols-1 gap-x-10 gap-y-12 border-t border-rule pt-10 lg:grid-cols-[7fr_5fr]">

      <div>
        <p class="smallcaps-lg">areas of expertise</p>
        <ul class="mt-6">
          <?php foreach ($expertise as $item): ?>
          <li class="grid grid-cols-[3.5rem_1fr] gap-4 border-b border-rule py-5">
            <span class="folio"><span class="pos"><?= $item['num'] ?></span></span>
            <div>
              <h2 class="font-display text-lg font-medium leading-snug text-foreground"><?= htmlspecialchars($item['title']) ?></h2>
              <p class="mt-1 max-w-prose text-[0.9375rem] leading-relaxed text-muted-foreground"><?= htmlspecialchars($item['body']) ?></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div>
        <figure>
          <div class="figure-plate">
          <svg width="420" height="200" viewBox="0 0 420 200" role="img"
               aria-label="Published articles by category. <?= implode(', ', array_map(function ($k, $v) use ($categoryLabels) {
                   return ($categoryLabels[$k] ?? $k) . ': ' . $v;
               }, array_keys($categoryCounts), $categoryCounts)) ?>. <?= $postTotal ?> total.">
            <text x="0" y="12" class="t-mono f-3">WHERE THE WRITING CONCENTRATES</text>
            <line x1="0" y1="26" x2="420" y2="26" class="s-ink"/>
            <?php
            $rowY = 52;
            $fade = [1, 0.55, 0.35, 0.2];
            foreach (array_keys($categoryCounts) as $i => $key):
                $count = $categoryCounts[$key];
                $barW  = (int) round($count / $countMax * $barMax);
                $label = $categoryLabels[$key] ?? $key;
            ?>
            <text x="0" y="<?= $rowY ?>" class="t-sans f-soft"><?= htmlspecialchars(strtolower($label)) ?></text>
            <rect x="0" y="<?= $rowY + 8 ?>" width="<?= $barW ?>" height="12" class="f-ink" opacity="<?= $fade[$i] ?? 0.2 ?>"/>
            <text x="<?= $barW + 8 ?>" y="<?= $rowY + 18 ?>" class="t-mono f-3"><?= $count ?></text>
            <?php $rowY += 48; endforeach; ?>
            <line x1="0" y1="184" x2="420" y2="184" class="s-rule"/>
            <text x="0" y="197" class="t-mono f-mark"><?= $postTotal ?> total on file</text>
          </svg>
          </div>
          <figcaption class="figcaption">
            <b>Fig. 01</b> Category share. Source <b>resources/data/articles-list.json</b>,
            counted at build time, <?= date('Y.m.d') ?>. Bar length is share of the largest category.
          </figcaption>
        </figure>

        <p class="mt-8 max-w-prose text-[0.9375rem] leading-relaxed text-muted-foreground">
            I also run a small <a class="link-quiet" href="/services/">web presence practice</a> for
            <a class="link-quiet" href="/local-businesses/">local business owners</a>, which is where
            most of what I know about being found gets tested against someone else&rsquo;s revenue.
        </p>
      </div>
    </div>

    <!-- Currently -->
    <div class="mt-16 grid grid-cols-1 gap-x-10 gap-y-6 border-t border-rule pt-10 pb-12 sm:grid-cols-[3fr_9fr]">
      <div>
        <p class="smallcaps-lg">currently</p>
      </div>
      <div class="space-y-4">
        <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
            Building, advising, and writing about developer-first payment products. Most days
            that means thinking about API ergonomics, integration journeys, and what it takes to
            make complex financial primitives feel inevitable to the engineers using them.
        </p>
        <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
            On the side I build tools in the open. Two recent ones are
            <a class="link-quiet" href="/loop-and-gate/">Loop &amp; Gate</a>,
            an agentic build system, and
            <a class="link-quiet" href="/hermes-dispatch/">Hermes Dispatch</a>,
            a local-first agent dispatcher. I&rsquo;m using that same Loop &amp; Gate workflow to build
            <a class="link-quiet" href="/articles/strategic-insights/building-on-the-margins/">LeadSurface</a>,
            with a few older projects collected in
            <a class="link-quiet" href="/work/">Work</a>.
        </p>
        <p class="max-w-prose text-[1.0625rem] leading-relaxed text-muted-foreground">
            I keep a small but steady stream of writing in
            <a class="link-quiet" href="/articles/">Articles</a>
            and notes from talks in
            <a class="link-quiet" href="/speaking/">Speaking</a>.
        </p>
      </div>
    </div>

  </div>

  <?php $this->insert('partials::components/title-block', [
      'sheetNo'    => 'A-01',
      'sheetFile'  => 'pages/about.php',
      'sheetTitle' => 'shane logsdon &middot; payments and developer platforms',
      'sheetMeta'  => 'Louisville, Kentucky &middot; <a class="link-quiet" href="/contact/">get in touch</a> &middot; <a class="link-quiet" href="/articles/">' . $postTotal . ' pieces on file</a>',
      'sheetRevFallback'  => '21',
      'sheetDateFallback' => '2026-07-29',
  ]); ?>
</div>
</div>

<?php $this->insert('partials::components/contact-cta', [
    'ctaEyebrow' => 'Let\'s talk',
    'ctaTitle'   => 'Open to conversations on payments, platforms, product, and local web presence.',
    'ctaBody'    => 'I enjoy comparing notes with operators building serious developer products. The best place to start a conversation is LinkedIn.',
]); ?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfilePage",
  "dateCreated": "2024-12-19",
  "dateModified": "<?= $aboutModified ?>",
  "mainEntity": { "@id": "https://shane.logsdon.io/#Person" }
}
</script>

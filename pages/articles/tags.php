<?php
$title = 'Article Tags';
$tags = json_decode(file_get_contents('resources/data/tags.json'));
$posts = (array)json_decode(file_get_contents("resources/data/articles-list.json"));
$countsByTag = array_reduce($posts, function ($result, $post) use ($tags) {
    if (!empty($post->archived)) {
        return $result;
    }

    foreach ($tags as $tag => $label) {
        if (!isset($result[$tag])) {
            $result[$tag] = 0;
        }

        if (is_array($post->tags) && in_array($tag, $post->tags)) {
            $result[$tag] += 1;
        }
    }
    return $result;
}, []);
$this->layout('partials::layouts/main', [
    'title' => $title,
    'description' => 'Browse Shane Logsdon\'s writing by topic, from payment systems and developer tooling to fintech, engineering leadership, and system architecture.',
    'url' => '/articles/tags/',
]);
?>

<section class="mx-auto max-w-editorial px-6 pt-20 pb-12">
    <div class="running-head" aria-hidden="true">
        <span>shane logsdon &middot; writing</span>
        <span><?= date('Y.m.d') ?></span>
    </div>
    <h1 class="mt-12 max-w-[20ch] font-display font-normal text-foreground"
        style="font-size: clamp(2.5rem, 6vw, 5rem); line-height: 1.05; letter-spacing: -0.02em;">
        Browse by <span class="t-accent">tag</span>.
    </h1>
</section>

<section class="mx-auto max-w-editorial px-6 pb-16">
    <div class="flex flex-wrap items-baseline justify-between gap-x-6 gap-y-3 border-y border-rule py-4">
        <p class="folio">
            <span class="pos"><?= str_pad((string) count((array) $tags), 3, '0', STR_PAD_LEFT) ?></span>
            <span>tags</span>
        </p>
        <a class="filter-tab" href="/articles/">&larr; all entries</a>
    </div>

    <ul class="mt-8 flex flex-wrap gap-3">
        <?php foreach ($tags as $tag => $label): ?>
        <li>
            <a class="filter-tab border border-rule px-4 hover:border-foreground"
               href="/articles/tags/<?= htmlspecialchars($tag) ?>/">
                <span><?= htmlspecialchars($label) ?></span>
                <span class="folio ml-2"><?= $countsByTag[$tag] ?></span>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php $this->insert('partials::components/contact-cta'); ?>
<?php $this->layout('partials::layouts/master', [
    'title' => !empty($title) ? $title : null,
    'description' => !empty($description) ? $description : null,
    'url' => !empty($url) ? $url : null,
]); ?>

<a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:rounded focus:bg-foreground focus:px-4 focus:py-2 focus:text-sm focus:text-background">
    Skip to content
</a>

<header id="site-header" class="sticky top-0 z-50 border-b border-transparent bg-background/80 backdrop-blur transition-all">
    <div class="mx-auto flex h-14 max-w-editorial items-center justify-between px-6">
        <a href="/" aria-label="Shane Logsdon — home" class="flex items-center gap-2">
            <span class="font-mono text-[0.72rem] uppercase tracking-[0.22em] text-muted-foreground">SL</span>
            <span class="hidden h-3 w-px bg-rule sm:block" aria-hidden="true"></span>
            <span class="hidden font-display text-[0.95rem] font-medium text-foreground sm:block">Shane Logsdon</span>
        </a>

        <nav aria-label="Primary">
            <?php $this->insert('partials::components/site-menu'); ?>
        </nav>
    </div>
</header>

<main id="main-content">
    <?= $this->section('content'); ?>
</main>

<?php $this->insert('partials::components/footer'); ?>

<script>
(function () {
    var header = document.getElementById('site-header');
    function onScroll() {
        if (window.scrollY > 8) {
            header.classList.add('border-rule');
            header.classList.remove('border-transparent');
        } else {
            header.classList.remove('border-rule');
            header.classList.add('border-transparent');
        }
    }
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
})();
</script>

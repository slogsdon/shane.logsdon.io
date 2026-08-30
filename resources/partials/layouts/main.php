<?php $this->layout('partials::layouts/master', [
    'title' => !empty($title) ? $title : null,
    'seoTitle' => !empty($seoTitle) ? $seoTitle : null,
    'description' => !empty($description) ? $description : null,
    'url' => !empty($url) ? $url : null,
    'image' => !empty($image) ? $image : null,
    'imageAlt' => !empty($imageAlt) ? $imageAlt : null,
    'ogType' => !empty($ogType) ? $ogType : null,
    'publishedTime' => !empty($publishedTime) ? $publishedTime : null,
    'modifiedTime' => !empty($modifiedTime) ? $modifiedTime : null,
    'markdownUrl' => !empty($markdownUrl) ? $markdownUrl : null,
    'noindex' => !empty($noindex) ? $noindex : false,
]); ?>

<a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:rounded focus:bg-foreground focus:px-4 focus:py-2 focus:text-sm focus:text-background">
    Skip to content
</a>

<header id="site-header" class="sticky top-0 z-50 border-b border-transparent bg-background transition-colors" style="padding-top: env(safe-area-inset-top);">
    <div class="mx-auto flex h-14 max-w-editorial items-center justify-between px-6">
        <a href="/" aria-label="Shane Logsdon" class="hover:no-underline">
            <span class="wordmark wordmark--sm sm:!text-[1.05rem]">Shane Logsdon</span>
        </a>

        <nav aria-label="Primary">
            <?php $this->insert('partials::components/site-menu'); ?>
        </nav>
    </div>
</header>

<main id="main-content" class="bg-background">
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

    var path = window.location.pathname;
    document.querySelectorAll('#site-nav a').forEach(function (a) {
        var href = a.getAttribute('href');
        if (href !== '/' && path.startsWith(href)) {
            a.setAttribute('aria-current', 'page');
            a.classList.add('text-foreground');
            var underline = a.querySelector('span[aria-hidden="true"]');
            if (underline) {
                underline.classList.remove('scale-x-0');
                underline.classList.add('scale-x-100');
            }
        }
    });
})();
</script>

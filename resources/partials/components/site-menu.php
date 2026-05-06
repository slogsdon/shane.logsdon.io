<?php
$navItems = [
    ['href' => '/about/', 'label' => 'About'],
    ['href' => '/articles/', 'label' => 'Articles'],
    ['href' => '/speaking/', 'label' => 'Speaking'],
    ['href' => '/services/', 'label' => 'Services'],
    ['href' => '/resume/', 'label' => 'Resume'],
];
?>
<ul class="flex items-baseline gap-4 sm:gap-6" id="site-nav">
    <?php foreach ($navItems as $item): ?>
    <li>
        <a href="<?= $item['href'] ?>"
           class="smallcaps inline-flex h-9 items-center transition-colors hover:!text-foreground hover:no-underline">
            <span class="relative">
                <?= strtolower($item['label']) ?>
                <span aria-hidden="true" class="absolute -bottom-1 left-0 h-px w-full origin-left bg-foreground transition-transform scale-x-0"></span>
            </span>
        </a>
    </li>
    <?php endforeach; ?>
</ul>

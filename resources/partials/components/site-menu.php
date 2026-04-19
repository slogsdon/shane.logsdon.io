<?php
$navItems = [
    ['href' => '/about/', 'label' => 'About'],
    ['href' => '/articles/', 'label' => 'Articles'],
    ['href' => '/speaking/', 'label' => 'Speaking'],
];
?>
<ul class="flex items-center gap-1 sm:gap-2" id="site-nav">
    <?php foreach ($navItems as $item): ?>
    <li>
        <a href="<?= $item['href'] ?>"
           class="inline-flex h-9 items-center px-2 text-sm transition-colors text-muted-foreground hover:text-foreground sm:px-3">
            <span class="relative">
                <?= $item['label'] ?>
                <span aria-hidden="true" class="absolute -bottom-1 left-0 h-px w-full origin-left bg-foreground transition-transform scale-x-0"></span>
            </span>
        </a>
    </li>
    <?php endforeach; ?>
</ul>

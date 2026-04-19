<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$navItems = [
    ['href' => '/about/', 'label' => 'About'],
    ['href' => '/articles/', 'label' => 'Articles'],
    ['href' => '/speaking/', 'label' => 'Speaking'],
];
?>
<ul class="flex items-center gap-1 sm:gap-2">
    <?php foreach ($navItems as $item):
        $isActive = strpos($currentPath, $item['href']) === 0;
    ?>
    <li>
        <a href="<?= $item['href'] ?>"
           class="inline-flex h-9 items-center px-2 text-sm transition-colors sm:px-3 <?= $isActive ? 'text-foreground' : 'text-muted-foreground hover:text-foreground' ?>">
            <span class="relative">
                <?= $item['label'] ?>
                <span aria-hidden="true" class="absolute -bottom-1 left-0 h-px w-full origin-left bg-foreground transition-transform <?= $isActive ? 'scale-x-100' : 'scale-x-0' ?>"></span>
            </span>
        </a>
    </li>
    <?php endforeach; ?>
</ul>

<?php declare(strict_types=1);

$root = getcwd();
$dist = "$root/dist";
$site = 'https://shane.logsdon.io';

$loadPosts = static function (string $path): array {
    $posts = json_decode((string) file_get_contents($path), true);
    if (!is_array($posts)) {
        fwrite(STDERR, "generate-sitemap: could not read $path\n");
        exit(1);
    }
    return $posts;
};

$articles = $loadPosts("$root/resources/data/articles-list.json");
$speaking = $loadPosts("$root/resources/data/speaking-list.json");
$categoryLabels = $loadPosts("$root/resources/data/categories.json");
$categorySlugs = array_keys($categoryLabels);

$buildTopicCounts = static function (array $posts): array {
    $categories = [];
    $tags = [];

    foreach ($posts as $post) {
        if (!is_array($post) || !empty($post['archived'])) {
            continue;
        }

        if (!empty($post['category'])) {
            $categories[$post['category']] = ($categories[$post['category']] ?? 0) + 1;
        }

        foreach (($post['tags'] ?? []) as $tag) {
            $tags[$tag] = ($tags[$tag] ?? 0) + 1;
        }
    }

    return [$categories, $tags];
};

[$articleCategories, $articleTags] = $buildTopicCounts($articles);
[$speakingCategories, $speakingTags] = $buildTopicCounts($speaking);

$formatDate = static function ($date): ?string {
    return is_string($date) && preg_match('/^\d{4}-\d{2}-\d{2}$/D', $date) === 1
        ? $date
        : null;
};

$lastModifiedByPath = [];
foreach (['articles' => $articles, 'speaking' => $speaking] as $type => $posts) {
    foreach ($posts as $slug => $post) {
        if (!is_array($post)) {
            continue;
        }

        $date = $formatDate($post['modified'] ?? $post['date'] ?? null);
        if ($date === null) {
            continue;
        }

        if (!empty($post['archived'])) {
            $year = substr($date, 0, 4);
            $path = "/archive/$year/$slug/";
        } elseif (!empty($post['category'])) {
            $path = "/$type/{$post['category']}/$slug/";
        } else {
            continue;
        }

        $lastModifiedByPath[$path] = $date;
    }
}

$shouldInclude = static function (string $path) use (
    $articleCategories,
    $articleTags,
    $speakingCategories,
    $speakingTags,
    $categorySlugs
): bool {
    if ($path === '/404/' || preg_match('#^/(?:google[^/]*|thanks|components)(?:/|$)#i', $path) === 1) {
        return false;
    }

    $parts = array_values(array_filter(explode('/', trim($path, '/')), 'strlen'));
    if (count($parts) === 3 && $parts[1] === 'tags') {
        $counts = $parts[0] === 'articles' ? $articleTags : ($parts[0] === 'speaking' ? $speakingTags : []);
        return ($counts[$parts[2]] ?? 0) > 0;
    }

    if (count($parts) === 2 && in_array($parts[1], $categorySlugs, true)) {
        $counts = $parts[0] === 'articles' ? $articleCategories : ($parts[0] === 'speaking' ? $speakingCategories : []);
        return ($counts[$parts[1]] ?? 0) > 0;
    }

    return true;
};

$paths = [];
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($dist, FilesystemIterator::SKIP_DOTS)
);
foreach ($iterator as $file) {
    if (!$file->isFile() || $file->getFilename() !== 'index.html') {
        continue;
    }

    $relative = substr($file->getPathname(), strlen($dist) + 1);
    $directory = dirname($relative);
    $path = $directory === '.' ? '/' : '/' . str_replace(DIRECTORY_SEPARATOR, '/', $directory) . '/';
    if ($shouldInclude($path)) {
        $paths[] = $path;
    }
}

sort($paths);
$xml = [
    '<?xml version="1.0" encoding="UTF-8"?>',
    '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">',
];
foreach ($paths as $path) {
    $xml[] = '  <url>';
    $xml[] = '    <loc>' . htmlspecialchars($site . $path, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>';
    if (isset($lastModifiedByPath[$path])) {
        $xml[] = '    <lastmod>' . $lastModifiedByPath[$path] . '</lastmod>';
    }
    $xml[] = '  </url>';
}
$xml[] = '</urlset>';

file_put_contents("$dist/sitemap.xml", implode("\n", $xml) . "\n");
fwrite(STDERR, 'generate-sitemap: wrote ' . count($paths) . " URLs\n");

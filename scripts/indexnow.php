<?php declare(strict_types=1);
// Post-build step: ping IndexNow (Bing, Yandex, Seznam, Naver) with the site's
// URLs so they recrawl on deploy instead of waiting for a scheduled crawl.
// Runs after `composer build`, against the generated dist/.
//
// Dormant until INDEXNOW_KEY is set, and only submits on Netlify production
// deploys. When the key is set it also writes the verification file
// dist/<key>.txt so the key never has to live in git.

$key = trim((string) getenv('INDEXNOW_KEY'));
if ($key === '') {
    fwrite(STDERR, "indexnow: INDEXNOW_KEY not set, skipping\n");
    exit(0);
}
if (!preg_match('/^[a-f0-9]{8,128}$/i', $key)) {
    fwrite(STDERR, "indexnow: INDEXNOW_KEY must be 8-128 hex chars, skipping\n");
    exit(0);
}

$root = getcwd();
$dist = "$root/dist";
$host = 'shane.logsdon.io';
$site = "https://$host";

if (!is_dir($dist)) {
    fwrite(STDERR, "indexnow: dist/ not found\n");
    exit(1);
}

// Verification file at the domain root: publicly readable, key only, no newline.
file_put_contents("$dist/$key.txt", $key);

// Only notify search engines on production deploys. Previews/branch deploys
// live on other hostnames, so their URLs would be wrong anyway.
if (getenv('CONTEXT') !== 'production') {
    fwrite(STDERR, "indexnow: wrote key file; not production, skipping submit\n");
    exit(0);
}

// Mirror the sitemap plugin's exclusions (see netlify.toml).
$excludedDirs = ['thanks'];
$excludedFiles = ['404.html'];

$urls = [];
$it = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($dist, FilesystemIterator::SKIP_DOTS)
);
foreach ($it as $file) {
    if ($file->getExtension() !== 'html') {
        continue;
    }
    $rel = substr($file->getPathname(), strlen($dist) + 1); // e.g. about/index.html
    $segments = explode('/', $rel);
    if (in_array($segments[0], $excludedDirs, true)) {
        continue;
    }
    $base = basename($rel);
    if (in_array($base, $excludedFiles, true) || str_starts_with($base, 'google')) {
        continue;
    }
    // prettyURLs + trailingSlash: /about/index.html -> /about/, /index.html -> /
    if ($base === 'index.html') {
        $path = substr($rel, 0, -strlen('index.html'));
    } else {
        $path = substr($rel, 0, -strlen('.html')) . '/';
    }
    $urls[] = $site . '/' . ltrim($path, '/');
}

$urls = array_values(array_unique($urls));
sort($urls);
if ($urls === []) {
    fwrite(STDERR, "indexnow: no URLs found\n");
    exit(0);
}

$keyLocation = "$site/$key.txt";
$endpoint = 'https://api.indexnow.org/indexnow';

// IndexNow caps at 10,000 URLs per request; batch to be safe.
foreach (array_chunk($urls, 10000) as $batch) {
    $payload = json_encode([
        'host' => $host,
        'key' => $key,
        'keyLocation' => $keyLocation,
        'urlList' => $batch,
    ], JSON_UNESCAPED_SLASHES);

    $ctx = stream_context_create(['http' => [
        'method' => 'POST',
        'header' => "Content-Type: application/json\r\nAccept: application/json\r\n",
        'content' => $payload,
        'timeout' => 15,
        'ignore_errors' => true,
    ]]);
    $resp = @file_get_contents($endpoint, false, $ctx);
    if ($resp === false) {
        fprintf(STDERR, "indexnow: submit of %d URLs failed (non-fatal)\n", count($batch));
    } else {
        fprintf(STDERR, "indexnow: submitted %d URLs\n", count($batch));
    }
}

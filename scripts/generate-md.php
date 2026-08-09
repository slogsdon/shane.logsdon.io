<?php declare(strict_types=1);
// Post-build step: emit per-article markdown alternates (/articles/<cat>/<slug>.md)
// and a full-text corpus (/llms-full.txt) for LLM ingestion. Run after
// `composer build`, against the generated dist/.

$root = getcwd();
$dist = "$root/dist";
$site = 'https://shane.logsdon.io';

$posts = json_decode((string) file_get_contents("$root/resources/data/articles-list.json"), true);
if (!is_array($posts)) {
    fwrite(STDERR, "generate-md: could not read articles-list.json\n");
    exit(1);
}

$stripFrontmatter = static function (string $md): string {
    if (str_starts_with($md, '---')) {
        $parts = preg_split('/^---\s*$/m', $md, 3);
        return isset($parts[2]) ? ltrim($parts[2]) : $md;
    }
    return $md;
};

$corpus = "# Shane Logsdon — Full Article Corpus\n\n"
    . "> Full text of the published articles on $site, for LLM ingestion.\n";
$count = 0;

foreach ($posts as $slug => $post) {
    if (!empty($post['archived'])) {
        continue;
    }
    $category = $post['category'] ?? '';
    $src = "$root/pages/articles/$category/$slug.md";
    if (!is_file($src)) {
        continue;
    }

    $body = $stripFrontmatter((string) file_get_contents($src));
    $url = "$site/articles/$category/$slug/";
    $header = "# {$post['title']}\n\n<$url>\n\n"
        . (isset($post['date'])
            ? '_Published ' . $post['date']
                . (isset($post['modified']) && $post['modified'] !== $post['date']
                    ? ', updated ' . $post['modified']
                    : '')
                . "_\n\n"
            : '');
    $markdown = $header . $body . "\n";

    $destDir = "$dist/articles/$category";
    if (!is_dir($destDir)) {
        mkdir($destDir, 0777, true);
    }
    file_put_contents("$destDir/$slug.md", $markdown);

    $corpus .= "\n\n---\n\n" . $markdown;
    $count++;
}

file_put_contents("$dist/llms-full.txt", $corpus);
fwrite(STDERR, "generate-md: wrote $count markdown alternates + llms-full.txt\n");

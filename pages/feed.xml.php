<?php
// Atom feed generated at build time from the article index.
// Slug `feed.xml` → written to dist/feed.xml by the flat-file build.
$site = 'https://shane.logsdon.io';
$posts = (array) json_decode(file_get_contents('resources/data/articles-list.json'), true);
$posts = array_filter($posts, fn($p) => empty($p['archived']));
uasort($posts, fn($a, $b) => strcmp($b['date'] ?? '', $a['date'] ?? ''));
$updated = '';
foreach ($posts as $p) {
    $updated = ($p['date'] ?? '') . 'T00:00:00Z';
    break;
}
$esc = fn($s) => htmlspecialchars((string) $s, ENT_XML1 | ENT_QUOTES, 'UTF-8');
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title>Shane Logsdon</title>
  <subtitle>Writing on developer platforms, payments, and AI tooling.</subtitle>
  <link href="<?= $site ?>/feed.xml" rel="self" type="application/atom+xml"/>
  <link href="<?= $site ?>/" rel="alternate" type="text/html"/>
  <id><?= $site ?>/</id>
  <updated><?= $updated ?></updated>
  <author>
    <name>Shane Logsdon</name>
    <uri><?= $site ?>/about/</uri>
  </author>
<?php foreach ($posts as $slug => $post):
    $url = sprintf('%s/articles/%s/%s/', $site, $post['category'] ?? '', $slug);
    $date = ($post['date'] ?? '') . 'T00:00:00Z';
?>
  <entry>
    <title><?= $esc($post['title'] ?? $slug) ?></title>
    <link href="<?= $url ?>" rel="alternate" type="text/html"/>
    <id><?= $url ?></id>
    <published><?= $date ?></published>
    <updated><?= $date ?></updated>
    <summary><?= $esc($post['description'] ?? '') ?></summary>
<?php foreach (($post['tags'] ?? []) as $tag): ?>
    <category term="<?= $esc($tag) ?>"/>
<?php endforeach; ?>
  </entry>
<?php endforeach; ?>
</feed>

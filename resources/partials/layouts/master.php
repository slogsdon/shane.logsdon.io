<!DOCTYPE html>
<?php $settings = require('resources/settings.php'); ?>

<html lang="en">
<meta charset="utf-8">
<title><?= $this->e(!empty($title) ? $title . ' · ' . $settings->title : $settings->title . ' · ' . $settings->subtitle); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1.0,viewport-fit=cover">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="manifest" href="/manifest.webmanifest">
<meta name="theme-color" content="#fbfaf9">
<meta name="description" content="<?= $this->e(!empty($description) ? $description : $settings->description); ?>">
<?php if (!empty($url)): ?>
  <link rel="canonical" href="https://shane.logsdon.io<?= $this->e($url); ?>">
<?php endif; ?>
<link rel="me" href="https://bsky.app/profile/shane.logsdon.io">
<link rel="me" href="https://twitter.com/shanelogsdon">
<link rel="me" href="https://www.linkedin.com/in/shanelogsdon">
<link rel="me" href="https://github.com/slogsdon">

<meta property="og:site_name" content="Shane Logsdon">
<meta property="og:type" content="<?= !empty($ogType) ? $this->e($ogType) : 'website' ?>">
<meta property="og:title" content="<?= $this->e(!empty($title) ? $title : $settings->title) ?>">
<meta property="og:description" content="<?= $this->e(!empty($description) ? $description : $settings->description) ?>">
<?php if (!empty($url)): ?>
<meta property="og:url" content="https://shane.logsdon.io<?= $this->e($url) ?>">
<?php endif; ?>
<?php if (!empty($image)): ?>
<meta property="og:image" content="https://shane.logsdon.io/images/<?= $this->e($image) ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<?php if (!empty($imageAlt)): ?>
<meta property="og:image:alt" content="<?= $this->e($imageAlt) ?>">
<?php endif; ?>
<?php endif; ?>
<meta name="author" content="Shane Logsdon">
<?php if (!empty($ogType) && $ogType === 'article'): ?>
<meta property="article:author" content="Shane Logsdon">
<meta property="article:publisher" content="https://shane.logsdon.io">
<?php if (!empty($publishedTime)): ?>
<meta property="article:published_time" content="<?= $this->e($publishedTime) ?>">
<?php endif; ?>
<?php if (!empty($modifiedTime)): ?>
<meta property="article:modified_time" content="<?= $this->e($modifiedTime) ?>">
<?php endif; ?>
<?php endif; ?>
<meta name="twitter:card" content="<?= !empty($image) ? 'summary_large_image' : 'summary' ?>">
<meta name="twitter:site" content="@shanelogsdon">
<meta name="twitter:creator" content="@shanelogsdon">
<?php if (!empty($image)): ?>
<meta name="twitter:image" content="https://shane.logsdon.io/images/<?= $this->e($image) ?>">
<?php endif; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap">

<style id="site"><?= file_get_contents('public/_/site.css') ?></style>
<style id="hljs-atom-one"><?= file_get_contents('public/_/hljs-atom-one.css') ?></style>

<?php if (!isset($_SERVER['SERVER_NAME']) || $_SERVER['SERVER_NAME'] !== 'localhost'): ?>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-9Y89SVEQW9"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-9Y89SVEQW9');
  </script>
<?php endif; ?>

<body>
<?= $this->section('content'); ?>

<script>
  ('serviceWorker' in navigator)
    && navigator.serviceWorker
      .register('/sw.js')
      .catch(() => {});
</script>
<script>
(function() {
  var header = document.getElementById('site-header');
  if (!header) return;
  function update() {
    header.classList.toggle('at-top', window.scrollY < header.offsetHeight + 5);
  }
  window.addEventListener('scroll', update, { passive: true });
  update();
})();
</script>
</body>

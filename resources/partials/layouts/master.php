<!DOCTYPE html>
<?php $settings = require('resources/settings.php'); ?>

<html lang="en">
<head>
<meta charset="utf-8">
<title><?= $this->e(!empty($title) ? $title . ' · ' . $settings->title : $settings->title . ' · ' . $settings->subtitle); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1.0,viewport-fit=cover">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="manifest" href="/manifest.webmanifest">
<meta name="theme-color" content="#fbfaf9">
<meta name="color-scheme" content="light">
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" type="image/png" sizes="192x192" href="/images/icons/icon-192x192.png">
<link rel="icon" type="image/png" sizes="512x512" href="/images/icons/icon-512x512.png">
<link rel="apple-touch-icon" href="/images/icons/icon-192x192.png">
<link rel="alternate" type="application/atom+xml" title="Shane Logsdon Atom feed" href="/feed.xml">
<?php if (!empty($markdownUrl)): ?>
<link rel="alternate" type="text/markdown" href="<?= $this->e($markdownUrl) ?>">
<?php endif; ?>
<meta name="description" content="<?= $this->e(!empty($description) ? $description : $settings->description); ?>">
<?php if (!empty($url)): ?>
  <link rel="canonical" href="https://shane.logsdon.io<?= $this->e($url); ?>">
<?php endif; ?>
<link rel="me" href="https://bsky.app/profile/shane.logsdon.io">
<link rel="me" href="https://www.linkedin.com/in/shanelogsdon">
<link rel="me" href="https://github.com/slogsdon">

<meta property="og:site_name" content="Shane Logsdon">
<meta property="og:type" content="<?= !empty($ogType) ? $this->e($ogType) : 'website' ?>">
<meta property="og:title" content="<?= $this->e(!empty($title) ? $title : $settings->title) ?>">
<meta property="og:description" content="<?= $this->e(!empty($ogSummary) ? $ogSummary : (!empty($description) ? $description : $settings->description)) ?>">
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
<?php if (!empty($noindex)): ?>
<meta name="robots" content="noindex">
<?php endif; ?>
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
<?php if (!empty($image)): ?>
<meta name="twitter:image" content="https://shane.logsdon.io/images/<?= $this->e($image) ?>">
<?php endif; ?>

<link rel="preload" href="/_/fonts/fraunces-var.woff2" as="font" type="font/woff2" crossorigin>

<style id="site"><?= file_get_contents('public/_/site.css') ?></style>
<style id="hljs-atom-one"><?= file_get_contents('public/_/hljs-atom-one.css') ?></style>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "@id": "https://shane.logsdon.io/#WebSite",
  "url": "https://shane.logsdon.io/",
  "name": <?= json_encode($settings->title) ?>,
  "description": <?= json_encode($settings->description) ?>,
  "inLanguage": "en",
  "publisher": { "@id": "https://shane.logsdon.io/#Person" }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "@id": "https://shane.logsdon.io/#Person",
  "name": "Shane Logsdon",
  "alternateName": "slogsdon",
  "url": "https://shane.logsdon.io/about/",
  "jobTitle": "Senior Director, Product Management – Developer Advocacy",
  "worksFor": { "@type": "Organization", "name": "Global Payments Inc." },
  "image": "https://shane.logsdon.io/images/headshot.jpeg",
  "description": <?= json_encode($settings->author->shane->description) ?>,
  "knowsAbout": ["Developer Advocacy", "Payment APIs", "SDK Design", "AEO", "Web Presence Management", "Fintech"],
  "sameAs": [
    "https://github.com/slogsdon",
    "https://www.linkedin.com/in/shanelogsdon",
    "https://bsky.app/profile/shane.logsdon.io",
    "https://gitlab.com/slogsdon",
    "https://speakerdeck.com/slogsdon"
  ]
}
</script>

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

</head>

<body>
<?= $this->section('content'); ?>

<script>
  ('serviceWorker' in navigator)
    && navigator.serviceWorker
      .register('/sw.js')
      .catch(() => {});
</script>
</body>

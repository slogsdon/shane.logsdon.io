<!DOCTYPE html>
<?php $settings = require('resources/settings.php'); ?>

<html lang="en">
<meta charset="utf-8">
<title><?= $this->e(!empty($title) ? $title . ' — ' . $settings->title : $settings->title . ' — ' . $settings->subtitle); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="manifest" href="/manifest.webmanifest">
<meta name="theme-color" content="#1a1c1f">
<meta name="description" content="<?= $this->e(!empty($description) ? $description : $settings->description); ?>">
<?php if (!empty($url)): ?>
  <link rel="canonical" href="https://shane.logsdon.io<?= $this->e($url); ?>">
<?php endif; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap">

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
</body>

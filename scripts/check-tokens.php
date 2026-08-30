<?php

declare(strict_types=1);

$tokenFiles = [
    'design/shane-personal-v2/tokens.css',
    'public/_/input.css',
];

function readRawTokens(string $path): array
{
    $contents = file_get_contents($path);
    if ($contents === false) {
        fwrite(STDERR, "Unable to read {$path}\n");
        exit(1);
    }

    if (!preg_match('/:root\s*\{([^}]*)\}/s', $contents, $rootMatch)) {
        fwrite(STDERR, "Unable to find :root token block in {$path}\n");
        exit(1);
    }

    preg_match_all(
        '/^\s*(--(?:color-[a-z0-9-]+|r-full))\s*:\s*([^;\/]+);/mi',
        $rootMatch[1],
        $matches,
        PREG_SET_ORDER
    );

    $tokens = [];
    foreach ($matches as $match) {
        $tokens[$match[1]] = strtolower(trim($match[2]));
    }

    return $tokens;
}

$tokensByFile = array_combine($tokenFiles, array_map('readRawTokens', $tokenFiles));
$referenceFile = $tokenFiles[0];
$referenceTokens = $tokensByFile[$referenceFile];
$errors = [];

foreach ($tokenFiles as $path) {
    $missing = array_diff_key($referenceTokens, $tokensByFile[$path]);
    $unexpected = array_diff_key($tokensByFile[$path], $referenceTokens);

    foreach ($missing as $name => $value) {
        $errors[] = "{$path}: missing {$name} (expected {$value})";
    }
    foreach ($unexpected as $name => $value) {
        $errors[] = "{$path}: unexpected {$name} ({$value})";
    }
}

foreach ($referenceTokens as $name => $expected) {
    foreach ($tokenFiles as $path) {
        $actual = $tokensByFile[$path][$name] ?? null;
        if ($actual !== null && $actual !== $expected) {
            $errors[] = "{$name}: {$referenceFile}={$expected}; {$path}={$actual}";
        }
    }
}

if ($errors !== []) {
    fwrite(STDERR, "Token drift detected:\n" . implode("\n", array_unique($errors)) . "\n");
    exit(1);
}

echo sprintf("Token parity OK (%d declarations)\n", count($referenceTokens));

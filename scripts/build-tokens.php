<?php

declare(strict_types=1);

$sourcePath = __DIR__ . '/../design/shane-personal-v2/tokens.css';
$inputPath = __DIR__ . '/../public/_/input.css';
$checkOnly = ($argv[1] ?? null) === '--check';

if (($argv[1] ?? null) !== null && !$checkOnly) {
    fwrite(STDERR, "Usage: php scripts/build-tokens.php [--check]\n");
    exit(1);
}

function failBuild(string $message): never
{
    fwrite(STDERR, "Token build failed: {$message}\n");
    exit(1);
}

function readRoot(string $path): string
{
    $contents = file_get_contents($path);
    if ($contents === false) {
        failBuild("unable to read {$path}");
    }

    if (!preg_match('/:root\s*\{([^}]*)\}/s', $contents, $rootMatch)) {
        failBuild("unable to find :root token block in {$path}");
    }

    if (trim($rootMatch[1]) === '') {
        failBuild(":root token block is empty in {$path}");
    }

    return $rootMatch[1];
}

/** @return array<string, string> */
function parseTokens(string $root): array
{
    preg_match_all(
        '/^\s*(--(?:color-[a-z0-9-]+|r-full))\s*:\s*([^;\/]+);/mi',
        $root,
        $matches,
        PREG_SET_ORDER
    );

    $tokens = [];
    foreach ($matches as $match) {
        $tokens[$match[1]] = strtolower(trim($match[2]));
    }

    return $tokens;
}

/** @return list<string> */
function parseDeclarationLines(string $root): array
{
    preg_match_all(
        '/^\s*--(?:color-[a-z0-9-]+|r-full)\s*:[^;\r\n]*;/mi',
        $root,
        $matches
    );

    return array_map(static fn (string $line): string => trim($line), $matches[0]);
}

function hexToHsl(string $hex): string
{
    if (!preg_match('/^#([0-9a-f]{6})$/i', $hex, $match)) {
        failBuild("expected a six-digit hex value, got {$hex}");
    }

    $red = hexdec(substr($match[1], 0, 2)) / 255;
    $green = hexdec(substr($match[1], 2, 2)) / 255;
    $blue = hexdec(substr($match[1], 4, 2)) / 255;
    $max = max($red, $green, $blue);
    $min = min($red, $green, $blue);
    $lightness = ($max + $min) / 2;
    $delta = $max - $min;

    if ($delta === 0.0) {
        $hue = 0.0;
        $saturation = 0.0;
    } else {
        $saturation = $delta / (1 - abs(2 * $lightness - 1));
        if ($max === $red) {
            $hue = 60 * fmod((($green - $blue) / $delta), 6);
        } elseif ($max === $green) {
            $hue = 60 * ((($blue - $red) / $delta) + 2);
        } else {
            $hue = 60 * ((($red - $green) / $delta) + 4);
        }
        if ($hue < 0) {
            $hue += 360;
        }
    }

    return sprintf('%d %d%% %d%%', round($hue), round($saturation * 100), round($lightness * 100));
}

$sourceRoot = readRoot($sourcePath);
$sourceTokens = parseTokens($sourceRoot);
$sourceDeclarations = parseDeclarationLines($sourceRoot);
if ($sourceTokens === [] || $sourceDeclarations === []) {
    failBuild("no color tokens found in {$sourcePath}");
}

$bridgeMap = [
    '--background' => '--color-surface',
    '--foreground' => '--color-ink',
    '--muted' => '--color-surface-feature',
    '--muted-foreground' => '--color-ink-3',
    '--accent' => '--color-accent',
    '--accent-foreground' => '--color-ink',
    '--border' => '--color-border',
    '--rule' => '--color-rule',
    '--rule-strong' => '--color-rule-strong',
    '--grid' => '--color-grid',
    '--ink-soft' => '--color-ink-soft',
];

$bridgeLines = [];
foreach ($bridgeMap as $bridgeName => $sourceName) {
    if (!array_key_exists($sourceName, $sourceTokens)) {
        failBuild("source token {$sourceName} is missing from {$sourcePath}");
    }
    $bridgeLines[] = "    {$bridgeName}: " . hexToHsl($sourceTokens[$sourceName]) . ';';
}

if (!array_key_exists('--r-full', $sourceTokens)) {
    failBuild("source token --r-full is missing from {$sourcePath}");
}

$hexLines = array_map(static fn (string $line): string => '    ' . $line, $sourceDeclarations);
$generatedRegion = implode("\n", [
    '    /* GENERATED:TOKENS:BEGIN — scripts/build-tokens.php. Do not edit.',
    '       Source: design/shane-personal-v2/tokens.css. Run: npm run build:tokens */',
    ...$hexLines,
    ...$bridgeLines,
    '    /* GENERATED:TOKENS:END */',
]);

$inputContents = file_get_contents($inputPath);
if ($inputContents === false) {
    failBuild("unable to read {$inputPath}");
}

$sentinelPattern = '/^[ \t]*\/\* GENERATED:TOKENS:BEGIN[^\r\n]*\r?\n.*?^[ \t]*\/\* GENERATED:TOKENS:END \*\/[ \t]*$/ms';
if (preg_match($sentinelPattern, $inputContents, $sentinelMatch) !== 1) {
    failBuild("generated token sentinels are missing from {$inputPath}");
}

$expectedContents = preg_replace($sentinelPattern, $generatedRegion, $inputContents, 1, $replacementCount);
if ($replacementCount !== 1 || $expectedContents === null) {
    failBuild("unable to rewrite generated token region in {$inputPath}");
}

if ($checkOnly) {
    if ($expectedContents !== $inputContents) {
        $currentRegion = trim($sentinelMatch[0]);
        $expectedTokens = parseTokens($generatedRegion);
        $currentTokens = parseTokens($currentRegion);
        $drifted = [];
        foreach ($expectedTokens as $name => $value) {
            if (($currentTokens[$name] ?? null) !== $value) {
                $drifted[] = $name;
            }
        }
        foreach ($currentTokens as $name => $value) {
            if (!array_key_exists($name, $expectedTokens)) {
                $drifted[] = $name;
            }
        }
        $drifted = array_values(array_unique($drifted));
        fwrite(STDERR, 'Token drift detected: ' . implode(', ', $drifted ?: ['generated region']) . "\n");
        exit(1);
    }

    echo "Token build check OK\n";
    exit(0);
}

if (file_put_contents($inputPath, $expectedContents) === false) {
    failBuild("unable to write {$inputPath}");
}

echo "Generated tokens in public/_/input.css\n";

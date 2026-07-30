<?php
/**
 * Title block — the C · Sheet footer. Replaces the page footer on Sheet pages.
 *
 * DESIGN.md §Do's: put revision and date on any page carrying a title block.
 * A stale sheet that admits it beats a fresh-looking one that doesn't. So every
 * value here is DERIVED, never typed. Revision is the number of commits that
 * have touched the page and date is the last one, both read from git, so the
 * block cannot drift away from the page it describes.
 *
 * Params:
 *   $sheetNo    string   sheet number, e.g. 'A-01'
 *   $sheetFile  string   repo-relative path the revision is read from
 *   $sheetTitle string   small-caps line in the id panel
 *   $sheetMeta  string   optional HTML line under the title
 *   $sheetRevFallback   string  used when git is unavailable (shallow clone)
 *   $sheetDateFallback  string  ISO date, same
 */
require_once 'resources/git.php';

$sheetRevFallback  = $sheetRevFallback  ?? '1';
$sheetDateFallback = $sheetDateFallback ?? date('Y-m-d');

// Both helpers return null on a shallow clone rather than the wrong answer
// git would otherwise give. See resources/git.php.
$sheetRev  = git_commit_count($sheetFile)  ?? $sheetRevFallback;
$sheetDate = git_last_modified($sheetFile) ?? $sheetDateFallback;
$sheetDateDisplay = str_replace('-', '.', $sheetDate);
?>
<div class="title-block">
    <div class="title-block__id">
        <span class="smallcaps-lg"><?= $sheetTitle ?></span>
        <?php if (!empty($sheetMeta)): ?>
        <p class="mt-2 text-[0.875rem] leading-relaxed text-muted-foreground"><?= $sheetMeta ?></p>
        <?php endif; ?>
    </div>
    <dl class="title-block__cells">
        <div><dt>sheet</dt><dd><?= htmlspecialchars($sheetNo) ?></dd></div>
        <div><dt>rev</dt><dd><?= htmlspecialchars($sheetRev) ?></dd></div>
        <div><dt>date</dt><dd><?= htmlspecialchars($sheetDateDisplay) ?></dd></div>
        <div><dt>drawn</dt><dd>SL</dd></div>
    </dl>
</div>

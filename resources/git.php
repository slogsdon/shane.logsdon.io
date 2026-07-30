<?php
/**
 * Build-time git facts, behind one guard.
 *
 * The title block derives revision and date from git rather than taking them
 * typed, so the block cannot drift away from the page it describes. That works
 * on a full clone and fails quietly on a shallow one.
 *
 * A shallow clone still answers `rev-list --count` and `log -1`. It answers
 * WRONG: the boundary commit looks like it introduced every file in the repo,
 * so every page reports rev 1 and the date of the deploy. Measured against a
 * depth-5 clone of this branch, all four Sheet pages reported rev 1 and today.
 * A title block stating a confident wrong revision is worse than one stating
 * nothing, because admitting staleness is the only job it has.
 *
 * netlify.toml runs `git fetch --unshallow` ahead of the build, so the normal
 * path is the correct one. This guard is what happens when that fetch fails.
 */

if (!function_exists('git_history_available')) {

    /**
     * True only when git can answer questions about history honestly.
     */
    function git_history_available(): bool
    {
        static $available = null;
        if ($available !== null) {
            return $available;
        }

        $insideWorkTree = @trim((string) shell_exec('git rev-parse --is-inside-work-tree 2>/dev/null'));
        if ($insideWorkTree !== 'true') {
            return $available = false;
        }

        // --is-shallow-repository needs git 2.15. Older versions print nothing,
        // which is indistinguishable from "not shallow", so the marker file is
        // checked as well rather than trusting an empty answer.
        $shallowFlag = @trim((string) shell_exec('git rev-parse --is-shallow-repository 2>/dev/null'));
        $gitDir = @trim((string) shell_exec('git rev-parse --git-dir 2>/dev/null'));
        $hasMarker = $gitDir !== '' && file_exists($gitDir . '/shallow');

        return $available = ($shallowFlag !== 'true' && !$hasMarker);
    }

    /**
     * Commits that have touched one path, or null when history is unavailable.
     */
    function git_commit_count(string $path): ?string
    {
        if (!git_history_available()) {
            return null;
        }
        $count = @trim((string) shell_exec(
            sprintf('git rev-list --count HEAD -- %s 2>/dev/null', escapeshellarg($path))
        ));

        return ($count === '' || $count === '0') ? null : $count;
    }

    /**
     * Date of the last commit touching one path, or null when unavailable.
     * $format takes a git date placeholder: %cs for Y-m-d, %cI for ISO 8601.
     */
    function git_last_modified(string $path, string $format = '%cs'): ?string
    {
        if (!git_history_available()) {
            return null;
        }
        $date = @trim((string) shell_exec(
            sprintf('git log -1 --format=%s -- %s 2>/dev/null', escapeshellarg($format), escapeshellarg($path))
        ));

        return $date === '' ? null : $date;
    }
}

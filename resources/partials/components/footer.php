<?php
$folioDate = date('Y.m.d');
?>
<?php $this->insert('partials::components/newsletter'); ?>
<footer class="border-t border-rule bg-background" style="padding-bottom: env(safe-area-inset-bottom);">
    <div class="mx-auto max-w-editorial px-6 py-10">
        <div class="flex flex-wrap items-baseline justify-between gap-x-10 gap-y-6">
            <div class="flex items-baseline gap-6">
                <a href="/" class="wordmark wordmark--sm hover:no-underline">Shane Logsdon</a>
                <span class="folio">
                    <span><?= $folioDate ?></span>
                    <span class="pos">/ <?= date('Y') ?></span>
                </span>
            </div>

            <ul class="flex flex-wrap items-baseline gap-x-6 gap-y-2">
                <li><a class="smallcaps hover:!text-foreground" href="https://www.linkedin.com/in/shanelogsdon" target="_blank" rel="noreferrer noopener">linkedin</a></li>
                <li><a class="smallcaps hover:!text-foreground" href="https://bsky.app/profile/shane.logsdon.io" target="_blank" rel="noreferrer noopener">bluesky</a></li>
                <li><a class="smallcaps hover:!text-foreground" href="https://github.com/slogsdon" target="_blank" rel="noreferrer noopener">github</a></li>
                <li><a class="smallcaps hover:!text-foreground" href="/work/">work</a></li>
                <li><a class="smallcaps hover:!text-foreground" href="/services/">services</a></li>
                <li><a class="smallcaps hover:!text-foreground" href="/contact/">contact</a></li>
                <li><a class="smallcaps hover:!text-foreground" href="/archive/">archive</a></li>
            </ul>
        </div>
    </div>
</footer>

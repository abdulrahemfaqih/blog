<?php
if ($type == "success") {
    $type = "green";
} else {
    $type = "red";
}
?>
<div class="dismissible-alert p-4 mb-2 border-l-4 border-<?= $type ?>-500 bg-<?= $type ?>-50 rounded-lg flex items-start justify-between">
    <div class="flex items-center">
        <?php if ($type == "green") : ?>
            <svg class="w-5 h-5 text-<?= $type ?>-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        <?php else : ?>
            <svg class="w-5 h-5 text-<?= $type ?>-500 mr-3" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        <?php endif ?>
        <div>
            <p class="text-<?= $type ?>-700"><?= $message ?></p>
        </div>
    </div>
    <button class="text-<?= $type ?>-500 hover:text-<?= $type ?>-600">×</button>
</div>
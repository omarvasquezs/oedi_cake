<?php
/**
 * Default flash element that other types can reuse. Expects:
 * - $message
 * - $params['class'] if provided
 */
?>
<div class="message <?= h($params['class'] ?? '') ?>">
    <?= $this->fetch('content') ?: $message ?>
</div>

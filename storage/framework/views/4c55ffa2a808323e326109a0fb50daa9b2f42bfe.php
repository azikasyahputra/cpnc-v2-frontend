<?php
    $crumbs = [];
    if (isset($raw) && $raw !== '') {
        preg_match_all('#<li[^>]*>(.*?)</li>#s', $raw, $lis);
        $crumbs = array_map(function ($x) {
            return trim(strip_tags($x));
        }, $lis[1] ?? []);
        $last = count($crumbs) ? array_pop($crumbs) : '';
        preg_match('#<h1[^>]*>(.*?)</h1>#s', $raw, $h1);
        $page = trim(strip_tags($h1[1] ?? $last));
        $crumbs = array_values(array_filter($crumbs, function ($c) {
            return $c !== '';
        }));
    } else {
        $page = '';
    }
?>
<?php if($page !== ''): ?>
    <h6 class="fw-bold text-end mb-2">
        <?php if(count($crumbs)): ?>
            <span class="text-muted fw-light"><?php echo e(implode(' / ', $crumbs)); ?> /</span>
        <?php endif; ?>
        <?php echo e($page); ?>

    </h6>
<?php endif; ?>
<?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc-v2-frontend/resources/views/layout/partials/page_header.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Kemasan'); ?>
<?php $__env->startSection('breadcumbs'); ?>
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Master Input /</span> Kemasan</h4>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('kemasan-table', [])->html();
} elseif ($_instance->childHasBeenRendered('bNW91F0')) {
    $componentId = $_instance->getRenderedChildComponentId('bNW91F0');
    $componentTag = $_instance->getRenderedChildComponentTagName('bNW91F0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('bNW91F0');
} else {
    $response = \Livewire\Livewire::mount('kemasan-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('bNW91F0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/kemasan/index.blade.php ENDPATH**/ ?>
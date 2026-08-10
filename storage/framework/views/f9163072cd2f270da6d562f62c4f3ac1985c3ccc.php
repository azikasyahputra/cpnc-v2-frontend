<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Semua Invoice Trucking</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Invoice Trucking</a></li>
                              <li class="active">Semua Invoice Trucking</li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('invoice-trucking-table', ['group' => $group ?? null])->html();
} elseif ($_instance->childHasBeenRendered('1I6LiMb')) {
    $componentId = $_instance->getRenderedChildComponentId('1I6LiMb');
    $componentTag = $_instance->getRenderedChildComponentTagName('1I6LiMb');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('1I6LiMb');
} else {
    $response = \Livewire\Livewire::mount('invoice-trucking-table', ['group' => $group ?? null]);
    $html = $response->html();
    $_instance->logRenderedChild('1I6LiMb', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/invoicetrucking/index.blade.php ENDPATH**/ ?>
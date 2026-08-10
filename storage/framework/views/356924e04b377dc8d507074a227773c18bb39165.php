<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Daftar Referensi</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Master Input</a></li>
                              <li class="active">Daftar Referensi</li>
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
    $html = \Livewire\Livewire::mount('daftar-referensi-table', [])->html();
} elseif ($_instance->childHasBeenRendered('GtDAfP2')) {
    $componentId = $_instance->getRenderedChildComponentId('GtDAfP2');
    $componentTag = $_instance->getRenderedChildComponentTagName('GtDAfP2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('GtDAfP2');
} else {
    $response = \Livewire\Livewire::mount('daftar-referensi-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('GtDAfP2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/daftarreferensi/index.blade.php ENDPATH**/ ?>
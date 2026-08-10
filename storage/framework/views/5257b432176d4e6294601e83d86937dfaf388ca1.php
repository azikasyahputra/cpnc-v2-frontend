<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Buku Kas</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Buku Kas</a></li>
                              <li class="active">Semua Jurnal Kas</li>
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
    $html = \Livewire\Livewire::mount('buku-kas-table', [])->html();
} elseif ($_instance->childHasBeenRendered('6la68vF')) {
    $componentId = $_instance->getRenderedChildComponentId('6la68vF');
    $componentTag = $_instance->getRenderedChildComponentTagName('6la68vF');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('6la68vF');
} else {
    $response = \Livewire\Livewire::mount('buku-kas-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('6la68vF', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jscript'); ?>
<script>
  document.addEventListener("DOMContentLoaded",function(event){
    var element = document.getElementById("bukukas");
    element.classList.add("active");
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/bukukas/index.blade.php ENDPATH**/ ?>
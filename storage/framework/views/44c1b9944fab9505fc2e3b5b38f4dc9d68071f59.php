<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Order</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Order</a></li>
                              <li class="active">Semua Order</li>
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
    $html = \Livewire\Livewire::mount('pengeluaran-table', [])->html();
} elseif ($_instance->childHasBeenRendered('YIGf0DM')) {
    $componentId = $_instance->getRenderedChildComponentId('YIGf0DM');
    $componentTag = $_instance->getRenderedChildComponentTagName('YIGf0DM');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('YIGf0DM');
} else {
    $response = \Livewire\Livewire::mount('pengeluaran-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('YIGf0DM', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jscript'); ?>
<script>
  document.addEventListener("DOMContentLoaded",function(event){
    var element = document.getElementById("pengeluaran");
    element.classList.add("active");
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/pengeluaran/index.blade.php ENDPATH**/ ?>
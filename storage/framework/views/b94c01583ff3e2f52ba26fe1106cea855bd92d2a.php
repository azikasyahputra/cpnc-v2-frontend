<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Role</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Pengaturan</a></li>
                              <li class="active">Role</li>
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
    $html = \Livewire\Livewire::mount('role-table', [])->html();
} elseif ($_instance->childHasBeenRendered('07POFvK')) {
    $componentId = $_instance->getRenderedChildComponentId('07POFvK');
    $componentTag = $_instance->getRenderedChildComponentTagName('07POFvK');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('07POFvK');
} else {
    $response = \Livewire\Livewire::mount('role-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('07POFvK', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc-v2-frontend/resources/views/role/index.blade.php ENDPATH**/ ?>
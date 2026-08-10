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
    $html = \Livewire\Livewire::mount('order-table', ['group' => $group ?? null])->html();
} elseif ($_instance->childHasBeenRendered('12IuSLv')) {
    $componentId = $_instance->getRenderedChildComponentId('12IuSLv');
    $componentTag = $_instance->getRenderedChildComponentTagName('12IuSLv');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('12IuSLv');
} else {
    $response = \Livewire\Livewire::mount('order-table', ['group' => $group ?? null]);
    $html = $response->html();
    $_instance->logRenderedChild('12IuSLv', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jscript'); ?>
<script>
  document.addEventListener("DOMContentLoaded",function(event){
    var element = document.getElementById("order");
    var element2 = document.getElementById("order2");
    var element3 = document.getElementById("order3");
    element.classList.add("active");
    element.classList.add("show");
    element2.setAttribute("aria-expanded","true");
    element3.classList.add("show");
   
    var mystr = document.URL;
    var myarr = mystr.split("/");
    var sorting = myarr[myarr.length-1];
    if(sorting=='sudahinvoice'){
        document.getElementById("ordersudahinvoice1").style.color='#03a9f3';
        document.getElementById("ordersudahinvoice2").style.color='#03a9f3';
    }else if(sorting=='beluminvoice'){
        document.getElementById("orderbeluminvoice1").style.color='#03a9f3';
        document.getElementById("orderbeluminvoice2").style.color='#03a9f3';
    }else{
        document.getElementById("ordersemua1").style.color='#03a9f3';
        document.getElementById("ordersemua2").style.color='#03a9f3';
    }
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/order/index.blade.php ENDPATH**/ ?>
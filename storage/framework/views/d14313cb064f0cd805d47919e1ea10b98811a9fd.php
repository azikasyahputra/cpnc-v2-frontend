<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Invoice</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Invoice</a></li>
                              <li class="active">Semua Invoice</li>
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
    $html = \Livewire\Livewire::mount('invoice-table', ['group' => $group ?? null])->html();
} elseif ($_instance->childHasBeenRendered('EuZUWPA')) {
    $componentId = $_instance->getRenderedChildComponentId('EuZUWPA');
    $componentTag = $_instance->getRenderedChildComponentTagName('EuZUWPA');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('EuZUWPA');
} else {
    $response = \Livewire\Livewire::mount('invoice-table', ['group' => $group ?? null]);
    $html = $response->html();
    $_instance->logRenderedChild('EuZUWPA', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jscript'); ?>
<script>
  document.addEventListener("DOMContentLoaded",function(event){
    var element = document.getElementById("invoice");
    var element2 = document.getElementById("invoice2");
    var element3 = document.getElementById("invoice3");
    element.classList.add("active");
    element.classList.add("show");
    element2.setAttribute("aria-expanded","true");
    element3.classList.add("show");
   
    var mystr = document.URL;
    var myarr = mystr.split("/");
    var sorting = myarr[myarr.length-1];
    if(sorting=='belumdibayar'){
        document.getElementById("invoicebelumlunas1").style.color='#03a9f3';
        document.getElementById("invoicebelumlunas2").style.color='#03a9f3';
    }else if(sorting=='sudahdibayar'){
        document.getElementById("invoicesudahlunas1").style.color='#03a9f3';
        document.getElementById("invoicesudahlunas2").style.color='#03a9f3';
    }else if(sorting=='belumpengeluaran'){
        document.getElementById("invoicebelumpengeluaran1").style.color='#03a9f3';
        document.getElementById("invoicebelumpengeluaran2").style.color='#03a9f3';
    }else if(sorting=='sudahpengeluaran'){
        document.getElementById("invoicesudahpengeluaran1").style.color='#03a9f3';
        document.getElementById("invoicesudahpengeluaran2").style.color='#03a9f3';
    }else{
        document.getElementById("invoicesemua1").style.color='#03a9f3';
        document.getElementById("invoicesemua2").style.color='#03a9f3';
    }
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/invoice/index.blade.php ENDPATH**/ ?>
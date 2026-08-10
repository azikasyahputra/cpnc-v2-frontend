<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Invoice Kas</title>

<style type="text/css">
   html{margin-left:10px;margin-right:10px;}
   /* * {
        font-family: Verdana, Arial, sans-serif;
    }*/
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray;
    }
    .judullaporan{
        border: black 2px solid;
        padding-left: 10px;
        padding-bottom: 0px;
        padding-top: 0px;
        font-family: serif;
        
    }
    .judullaporan h1{
        font-size: 15px;
    }
     table{
        table-layout: fixed;
    }
    td{
        word-wrap:break-word;
        font-size: x-small;
    }
    .bordertable{
      font-size: x-small;
    }
    .bordertable2{
      font-size: x-small;
      border-bottom: 2px solid black;
      border-top: 2px solid black;
    }
    .propertyisi{
      /*font-size: 15px;*/
    }
    .propertyhasil{
      /*font-size: 15px;*/
      border-top: 1px solid black;
    }
</style>

</head>
<body>

  <table width="100%">
    <?php $__currentLoopData = $header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataheader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td>&nbsp;</td>
        <td colspan="3"><strong>PT.CAHYAPRAJA NUSACERIA<br>Tlp:4358506,4358602 Fax:4358652</strong></td>
        <td colspan="2">&nbsp;</td>
         <?php
          $tanggal_transaksi=DateTime::createFromFormat('Y-m-d', $dataheader->tanggal_transaksi); 
          $tanggal_transaksi=$tanggal_transaksi->format('d/m/Y');
        ?>
        <td colspan="3"><strong>No Transaksi. <?php echo e($dataheader->no_transaksi); ?><br><?php echo e($tanggal_transaksi); ?></strong></td>
        <td colspan="1">&nbsp;</td>
    </tr>
  </table>
  <br>
  <table width="100%" style="border-collapse:collapse">
    <thead>
      <tr>
        <th class="bordertable2" align="left" width="10%">Kode</th>
        <th class="bordertable2">Keterangan</th>
        <th class="bordertable2" align="right">Debit</th>
        <th class="bordertable2" align="right">Kredit</th>
      </tr>
    </thead>
    <tbody>
       <?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datadetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td class="propertyisi" width="10%">
         <?php $__currentLoopData = $referensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referensi2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(e($referensi2->id_referensi)==$datadetail->id_referensi): ?>
            <?php echo e(e($referensi2->kode_referensi)); ?>

            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
        <td class="propertyisi"><?php echo e($datadetail->keterangan); ?></td>
        <td class="propertyisi" align="right"><?php echo e(number_format($datadetail->biaya_debit,0,'','.')); ?></td>
        <td class="propertyisi" align="right"><?php echo e(number_format($datadetail->biaya_kredit,0,'','.')); ?></td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php $n=$detailcount+1;?>
      <?php while($n<7): ?>
      <tr>
        <td class="propertyisi" width="10%">0</td>
        <td class="propertyisi">0</td>
        <td class="propertyisi" align="right">0</td>
        <td class="propertyisi" align="right">0</td>
      </tr>
      <?php $n++;?>
      <?php endwhile; ?>
    </tbody>
    <tfoot>
      <tr>
        <td class="propertyhasil" colspan="2" align="right">total debit:</td>
        <td class="propertyhasil" align="right" colspan="2"><?php echo e(number_format($dataheader->total_debit,0,'','.')); ?></td>
      </tr>
       <tr>
        <td colspan="2" align="right">total kredit:</td>
        <td align="right" colspan="2"><?php echo e(number_format($dataheader->total_kredit,0,'','.')); ?></td>
      </tr>
    </tfoot>
  </table>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/bukukas/invoicekas.blade.php ENDPATH**/ ?>
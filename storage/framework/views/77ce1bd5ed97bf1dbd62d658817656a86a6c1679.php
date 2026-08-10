<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Laporan Order</title>

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
      border: 1px solid black;
    }
    .propertyisi{
      /*font-size: 15px;*/
    }
    .propertyhasil{
      /*font-size: 15px;*/
      border: 1px solid black;
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td class="judullaporan" width="25%">
            <h1>Laporan Order</h1>
        </td>
        <td>&nbsp;</td>
    </tr>

  </table>

  <table width="100%">
    <tr>
        <td align="center" style="font-size: 12px;">
           <?php
              $tanggalawal=DateTime::createFromFormat('m/d/Y', $tanggalawal); 
              $tanggalawal=$tanggalawal->format('d/m/Y');
              $tanggalakhir=DateTime::createFromFormat('m/d/Y', $tanggalakhir); 
              $tanggalakhir=$tanggalakhir->format('d/m/Y');
            ?>
          <strong>Tanggal:</strong> <?php echo e($tanggalawal); ?>-<?php echo e($tanggalakhir); ?>

        </td>
    </tr>

  </table>

  <br/>
  <table width="100%" border="1" style="border-collapse: collapse;">
    <thead>
      <tr>
        <?php for($i=0;$i<count($header);$i++): ?>
        <th class="bordertable" align="left" width="15%"><?php echo e($header[$i]); ?></th>
        <?php endfor; ?>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataorder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td class="propertyisi" width="15%"><?php echo e($dataorder['nama_client']); ?></td>
        <?php $__currentLoopData = $dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datadokumen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $namadokumen=$datadokumen->nama_dokumen;?>
        <td align="right" class="propertyisi" width="7%"><?php echo e($dataorder[$namadokumen]); ?></td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <tfoot>
        <tr>
          <td class="propertyisi" width="15%">Total</td>
           <?php for($n=0;$n<count($total);$n++): ?>
            <td align="right" class="propertyisi" width="7%"><?php echo e($total[$n]); ?></td>
           <?php endfor; ?>
        </tr>
    </tfoot>
  </table>

</body>
</html><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/laporanpiutang/laporanorder.blade.php ENDPATH**/ ?>
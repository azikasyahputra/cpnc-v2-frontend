<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Laporan Komisi <?php echo e($namasupir); ?></title>

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
    th{
        word-wrap:break-word;
        font-size: x-small;
    }
    .bordertable{
      font-size: x-small;
    }
    .bordertable2{
      font-size: x-small;
      border-bottom: 1px solid black;
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
        <?php
          $tanggalawal=DateTime::createFromFormat('m/d/Y', $tanggalawal); 
          $tanggalawal=$tanggalawal->format('d-M-Y');
          $tanggalakhir=DateTime::createFromFormat('m/d/Y', $tanggalakhir); 
          $tanggalakhir=$tanggalakhir->format('d-M-Y');
      ?>
        <td>&nbsp;</td>
        <td colspan="3"><strong>PT.CAHYAPRAJA NUSACERIA<br>Tlp:4358506,4358602 Fax:4358652</strong></td>
        <td colspan="2">&nbsp;</td>
        <td colspan="3"><strong><?php echo e($namasupir); ?><br>TGL: <?php echo e($tanggalawal); ?> s.d <?php echo e($tanggalakhir); ?></strong></td>
        <td colspan="1">&nbsp;</td>
    </tr>
   <tr>
        <td colspan="10">&nbsp;</td>
        <td align="right"><?php echo e(number_format($totalkuranglebih,0,'','.')); ?></td>
        <td align="right"><?php echo e(number_format($totalkomisisupir,0,'','.')); ?></td>
        <td align="right"><?php echo e(number_format($totalkomisikenek,0,'','.')); ?></td>
      </tr>
  </table>
  <table width="100%" border="1" style="border-collapse:collapse">
    <thead>
      <tr>
        <th class="bordertable" align="left" width="5%">No AJU</th>
        <th class="bordertable">Tgl</th>
        <th class="bordertable">Tujuan</th>
        <th class="bordertable">Party</th>
        <th class="bordertable">Order</th>
        <th class="bordertable">Container</th>
        <th class="bordertable">KAS BON <br>U-JALAN</th>
        <th class="bordertable">UANG JALAN</th>
        <th class="bordertable">LIFT OFF<br>LIFT ON</th>
        <th class="bordertable">Bongkar,Muat<br>Kawalan,Mel</th>
        <th class="bordertable">KURANG<br>LEBIH</th>
        <th class="bordertable">Komisi Supir</th>
        <th class="bordertable">Komisi Kenek</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trucking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <?php
          $tanggal_order=DateTime::createFromFormat('Y-m-d', $trucking[1]); 
          $tanggal_order=$tanggal_order->format('d-M-Y');
      ?>
      <tr>
        <td class="propertyisi" width="5%"><?php echo e($trucking[0]); ?></td>
        <td class="propertyisi"><?php echo e($tanggal_order); ?></td>
        <td class="propertyisi"><?php echo e($trucking[2]); ?></td>
        <td class="propertyisi"><?php echo e($trucking[3]); ?></td>
        <td class="propertyisi"><?php echo e($trucking[4]); ?></td>
        <td class="propertyisi"><?php echo e($trucking[5]); ?></td>
        <td class="propertyisi" align="right"><?php echo e(number_format($trucking[6],0,'','.')); ?></td>
        <td class="propertyisi" align="right"><?php echo e(number_format($trucking[7],0,'','.')); ?></td>
        <td class="propertyisi" align="right"><?php echo e(number_format($trucking[8],0,'','.')); ?></td>
        <td class="propertyisi" align="right"><?php echo e(number_format($trucking[9],0,'','.')); ?></td>
        <td class="propertyisi" align="right"><?php echo e(number_format($trucking[10],0,'','.')); ?></td>
        <td class="propertyisi" align="right"><?php echo e(number_format($trucking[11],0,'','.')); ?></td>
        <td class="propertyisi" align="right"><?php echo e(number_format($trucking[12],0,'','.')); ?></td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php if($alasanpemotongan!=''): ?>
      <tr>
            <td class="propertyisi" colspan="10" align="center"><?php echo e($alasanpemotongan); ?></td>
            <td class="propertyisi" align="right">-<?php echo e(number_format($biayapemotongan,0,'','.')); ?></td>
            <td class="propertyisi" align="right">&nbsp;</td>
            <td class="propertyisi" align="right">&nbsp;</td>
      </tr>
      <?php endif; ?>
    </tbody>
    <tfoot>
      <tr>
        <td class="propertyhasil" colspan="10">GRAND TOTAL</td>
        <td class="propertyhasil" align="right"><?php echo e(number_format($totalkuranglebih,0,'','.')); ?></td>
        <td class="propertyhasil" align="right"><?php echo e(number_format($totalkomisisupir,0,'','.')); ?></td>
        <td class="propertyhasil" align="right"><?php echo e(number_format($totalkomisikenek,0,'','.')); ?></td>
      </tr>
    </tfoot>
  </table>
 <br>
 <table width="40%">
    <tr>
        <?php
          $tanggalakhirbulan=DateTime::createFromFormat('d-M-Y', $tanggalakhir); 
          $tanggalakhirbulan=$tanggalakhirbulan->format('M');
      ?>
        <td><?php echo e($namasupir); ?></td>
        <td><?php echo e($tanggalakhirbulan); ?></td>
        <td><?php echo e($tanggalakhir); ?></td>
    </tr>
  </table>
  <table width="40%" border="1" style="border-collapse:collapse">
    <thead>
      <tr>
        <th class="bordertable" align="center" width="10%"><?php echo e($jumlah); ?><br>RIT KOMISI</th>
        <th class="bordertable" colspan="2" align="center" width="20%">RINCIAN KOMISI</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="propertyisi" width="10%">KOMISI SUPIR</td>
        <td class="propertyisi" align="right" width="10%"><?php echo e(number_format($totalkomisisupir,0,'','.')); ?></td>
        <td class="propertyisi" align="right" width="10%">-</td>
      </tr>
      <tr>
        <td class="propertyisi" width="10%">KOMISI KENEK</td>
        <td class="propertyisi" align="right" width="10%"><?php echo e(number_format($totalkomisikenek,0,'','.')); ?></td>
        <td class="propertyisi" align="right" width="10%">&nbsp;</td>
      </tr>
       <tr>
        <?php if($totalkuranglebih>0): ?>
        <td class="propertyisi" width="10%">UANG KANTOR</td>
        <?php elseif($totalkuranglebih<0): ?>
        <td class="propertyisi" width="10%">UANG SOPIR</td>
        <?php endif; ?>
        <td class="propertyisi" align="right" width="10%"><?php echo e(number_format($totalkuranglebih,0,'','.')); ?></td>
        <td class="propertyisi" align="right" width="10%">&nbsp;</td>
      </tr>
       <tr>
        <td class="propertyisi" width="10%">&nbsp;</td>
        <td class="propertyisi" align="right" width="10%">-</td>
        <td class="propertyisi" align="right" width="10%">&nbsp;</td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td class="propertyhasil" width="10%">TERIMA KOMISI</td>
        <td class="propertyhasil" align="right" width="10%"><?php echo e(number_format($totalkomisi,0,'','.')); ?></td>
        <td class="propertyhasil" align="right" width="10%">&nbsp;</td>
      </tr>
    </tfoot>
  </table>
  
</body>
</html><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/laporantrucking/laporankomisisupir.blade.php ENDPATH**/ ?>
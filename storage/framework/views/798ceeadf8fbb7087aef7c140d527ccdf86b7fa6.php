<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice</title>

    <style type="text/css">
    html {
        margin-left: 5px !important;
        margin-right: 5px !important;
    }

    * {
        font-family: Verdana, Arial, sans-serif;
    }

    table {
        font-size: 5px !important;
    }

    tfoot tr td {
        font-weight: bold;
        font-size: 5px !important;
    }

    .gray {
        background-color: lightgray
    }

    table {
        table-layout: fixed;
    }

    td {
        word-wrap: break-word;
    }

    th {
        /* padding: 5px; */
    }

    html {
        height: 100%;
    }

    body {
        position: relative;
        margin: 0;
        min-height: 100%;
    }

    .no-invoice {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .pelanggan {
        position: absolute;
        top: 6px;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .nominal {
        position: absolute;
        top: 23px;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .detail-invoice {
        position: absolute;
        top: 30px;
        bottom: 0;
        left: 0;
        right: 0;
    }
    
    .total {
        position: absolute;
        right: 0;
        bottom: 25px;
        left: 0;
        text-align: center;
    }

    .footer {
        position: absolute;
        right: 0;
        bottom: 30px;
        left: 0;
        text-align: center;
    }

    @page  {
        margin: 0;
    }
    </style>

</head>

<body>
    <?php $__currentLoopData = $header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="no-invoice">
        <table width="100%">
            <tr>
                <!--<td><strong>INVOICE NO:</strong></td>-->
                <td width="12%">&nbsp;</td>
                <td><?php echo e($header->no_invoice); ?></td>
            </tr>
        </table>
    </div>
    <div class="pelanggan">
        <table width="100%">
            <tr>
                <td width="25%">&nbsp;</td>
                <td>
                    <p style="text-transform:uppercase;"><?php echo e($header->nama_client); ?></p>
                </td>
            </tr>
        </table>
    </div>
    <div class="nominal">
        <table width="100%">
            <tr style="text-transform:uppercase;">
                <td style="width:25%">&nbsp;</td>
                <td> <?php echo e($header->biaya_terbilang); ?></td>
            </tr>
        </table>
    </div>
    <div class="detail-invoice">
        <table width="100%">
            <tr style="text-transform:uppercase;">
                <td style="width:25%">&nbsp;</td>
                <td> 
                	<?php
                	 $detail_kwitansi = [];
                	 foreach($detail as $detaildata){
		        	array_push($detail_kwitansi,$detaildata->nama_biaya);
		         }
		         $detail_kwitansi = implode(",",$detail_kwitansi);
		        ?>
                	<?php echo e($detail_kwitansi); ?>

                </td>
            </tr>
        </table>
    </div>
    <div class="total">
        <table width="100%">
            <tr style="text-transform:uppercase;">
                <td style="width:23%">&nbsp;</td>
                <td><?php echo e(number_format($header->jumlah_biaya,0,'','.')); ?></td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <table width="100%">
            <tr>
                <td align="right">&nbsp;</td>
                <td align="left" width="30%" style="font-size:15px;">JAKARTA,
                    <?php $tanggal_invoice=DateTime::createFromFormat('Y-m-d',$header->tanggal_invoice); $tanggal_invoice=$tanggal_invoice->format('d/m/Y'); ?>
                    <?php echo e(//date('m/d/Y')
                $tanggal_invoice); ?>

                </td>
            </tr>
        </table>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>

</html>
<?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/invoice/kwitansi.blade.php ENDPATH**/ ?>
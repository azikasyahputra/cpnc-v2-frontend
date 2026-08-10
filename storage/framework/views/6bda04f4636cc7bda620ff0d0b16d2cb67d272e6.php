<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Laporan Rugi/Laba Keuangan</title>

<style type="text/css">
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
        font-size: 18px;
    }
     table{
        table-layout: fixed;
        border-collapse: collapse;
    }
    td{
        word-wrap:break-word;
        font-size: x-small;
    }
    .bordertable{
      border-bottom: 1px solid black;
    }
    .propertyisi{
      font-size: 15px;
      border-top: 1px solid black;
      border-right: 1px solid black;
      border-bottom: 1px solid black;
    }
    .propertyheader{
      font-size: 15px;
      border: 1px solid black;
    }
    .propertykiri{
      font-size: 15px;
      border-left: 1px solid black;
      border-bottom: 1px solid black;
    }
    .propertyhasil{
      font-size: 15px;
      border: 1px solid black;
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td class="judullaporan" width="100%" align="center">
           <?php
              $tanggalakhir=DateTime::createFromFormat('d/m/Y', $tanggalakhir); 
              $tanggalhari=$tanggalakhir->format('d');
              $tanggalbulan=$tanggalakhir->format('m');
              switch($tanggalbulan){
                case '01':
                  $tanggalbulan = 'Januari';
                  break;
                case '02':
                  $tanggalbulan = 'Februari';
                  break;
                case '03':
                  $tanggalbulan = 'Maret';
                  break;
                case '04':
                  $tanggalbulan = 'April';
                  break;
                case '05':
                  $tanggalbulan = 'Mei';
                  break;
                case '06':
                  $tanggalbulan = 'Juni';
                  break;
                case '07':
                  $tanggalbulan = 'Juli';
                  break;
                case '08':
                  $tanggalbulan = 'Agustus';
                  break;
                case '09':
                  $tanggalbulan = 'September';
                  break;
                case '10':
                  $tanggalbulan = 'Oktober';
                  break;
                case '11':
                  $tanggalbulan = 'November';
                  break;
                case '12':
                  $tanggalbulan = 'Desember';
                  break;
              }
              $tanggaltahun=$tanggalakhir->format('Y');
            ?>
            <h1>PT.CAHYAPRAJA NUSACERIA<br>NERACA<br>PER
            <?php echo e($tanggalhari); ?> <?php echo e($tanggalbulan); ?> <?php echo e($tanggaltahun); ?>

            </h1>
        </td>
        <td>&nbsp;</td>
    </tr>
  </table>
  <table width="100%">
      <tr>
        <td class="propertyheader" colspan="2" width="10%">AKTIVA</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
        <td class="propertyheader" colspan="2" width="10%">KEWAJIBAN</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td class="propertyheader" colspan="2" width="10%">Aktiva Lancar</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
        <td class="propertyheader" colspan="2" width="10%">Kewajiban</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
      </tr>
     <tr>
        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%">Kas dan Setara Kas</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($totalkas,0,'','.')); ?></td>
        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%">Utang Usaha</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($utangusaha,0,'','.')); ?></td>
      </tr>
      <tr>
        <td class="propertyheader" align="right"  colspan="2" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%">Utang Pajak</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($utangpajak,0,'','.')); ?></td>
      </tr>
      <tr>
        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%">Piutang</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($piutang,0,'','.')); ?></td>
        <td class="propertyheader" colspan="2">&nbsp;</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%">Persediaan</td>
        <td class="propertyisi" width="10%" align="right">-</td>
        <td class="propertyheader" colspan="2">&nbsp;</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td class="propertyheader" colspan="2">Aktiva Tetap</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
        <td class="propertyheader" colspan="2">Ekuitas</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%">Inventaris (Neto)</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($inventaris,0,'','.')); ?></td>
        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%">Modal Disetor</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($modaldisetor,0,'','.')); ?></td>
      </tr>
      <tr>
        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%">Penambahan Aktiva</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($penambahanaktiva,0,'','.')); ?></td>
        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%">Laba (Rugi) Tahun Berjalan</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($labarugiberjalan,0,'','.')); ?></td>
      </tr>
      <tr>
        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%">Akumulasi Penyusutan</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($akumulasipenyusutan,0,'','.')); ?></td>
        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">&nbsp;</td>
        <td class="propertyisi" width="10%">Laba (Rugi) Tahun Lalu</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($labarugilalu,0,'','.')); ?></td>
      </tr>
      <tr>
        <td class="propertyheader" colspan="2">&nbsp;</td>
        <td class="propertyisi" width="10%" align="right">-</td>
        <td class="propertyheader" colspan="2">&nbsp;</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td class="propertyheader" colspan="2">&nbsp;</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
        <td class="propertyheader" colspan="2">&nbsp;</td>
        <td class="propertyisi" width="10%" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td class="propertyheader" colspan="2">JUMLAH AKTIVA</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($jumlahaktiva,0,'','.')); ?></td>
        <td class="propertyheader" colspan="2">JUMLAH KEWAJIBAN DAN EKUITAS</td>
        <td class="propertyisi" width="10%" align="right"><?php echo e(number_format($jumlahkewajiban,0,'','.')); ?></td>
      </tr>
        
  </table>
  <br><br>
  <table width="100%">
  <tr>
      <td align="right">Jakarta, </td>
      <td align="left" width="12.85%">
          <?php echo e($tanggalhari); ?> <?php echo e($tanggalbulan); ?> <?php echo e($tanggaltahun); ?>

      </td>
  </tr>
  </table>
  <br><br><br>
  <table width="100%">
  <tr>
      <td align="right">&nbsp;</td>
      <td align="left" width="12.85%">
          <u>Yoppy Benny</u><br>Direktur
      </td>
  </tr>
  </table>

</body>
</html><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/laporankeuangan/laporanneraca.blade.php ENDPATH**/ ?>
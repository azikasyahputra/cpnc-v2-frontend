<?php ini_set('max_execution_time', 3000);
    ini_set('memory_limit','128M');?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Laporan Rugi Laba</title>

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
        <td class="judullaporan" width="25%">
            <h1>Laporan Laba/Rugi Order</h1>
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
          <strong>Tanggal:</strong> {{$tanggalawal}}-{{$tanggalakhir}}
        </td>
    </tr>

  </table>

  <br/>
  <table width="100%" style="border-top: 3px solid black;border-bottom: 3px solid black;">
    <thead>
      <tr>
        <th class="bordertable" align="left" width="7%">Order No</th>
        <th class="bordertable" align="left" width="7%">Tanggal</th>
        <th class="bordertable" align="left" width="15%">Nama Customer</th>
        <th class="bordertable" align="left" width="4%">Doc</th>
        <th class="bordertable" align="left" width="5%">Party</th>
        <th class="bordertable" align="right" width="7%">Piutang</th>
        <th class="bordertable" align="right" width="7%">Reimburs</th>
        <th class="bordertable" align="right" width="7%">Trucking</th>
        <th class="bordertable" align="right" width="7%">Dana Kerja</th>
        <th class="bordertable" align="right" width="7%">PPN</th>
        <th class="bordertable" align="right" width="7%">Jasa</th>
        <th class="bordertable" align="right" width="7%">Laba</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $totalpiutang = '0';$totalreimburs = '0';$totaltrucking = '0';$totaldanakerja = '0';$totalppn = '0';
        $totaljasa = '0';$totallaba = '0';
      ?>
      @foreach($data as $datalaba)
      <?php
          $tanggalorder=DateTime::createFromFormat('Y-m-d H:i:s', $datalaba[1]);$tanggalorder=$tanggalorder->format('d-M-y');
      ?>
      <tr>
        <td class="propertyisi" width="7%">{{$datalaba[0]}}</td>
        <td class="propertyisi" width="7%">{{$tanggalorder}}</td>
        <td class="propertyisi" width="15%">{{$datalaba[2]}}</td>
        <td class="propertyisi" width="4%">{{$datalaba[3]}}</td>
        <td class="propertyisi" width="5%">{{$datalaba[4]}}</td>
        <td align="right" class="propertyisi" width="7%">{{number_format($datalaba[5],0,'','.')}}</td>
        <td align="right" class="propertyisi" width="7%">{{number_format($datalaba[6],0,'','.')}}</td>
        <td align="right" class="propertyisi" width="7%">{{number_format($datalaba[7],0,'','.')}}</td>
        <td align="right" class="propertyisi" width="7%">{{number_format($datalaba[8],0,'','.')}}</td>
        <td align="right" class="propertyisi" width="7%">{{number_format($datalaba[9],0,'','.')}}</td>
        <td align="right" class="propertyisi" width="7%">{{number_format($datalaba[10],0,'','.')}}</td>
        <td align="right" class="propertyisi" width="7%">{{number_format($datalaba[11],0,'','.')}}</td>
      </tr>
       <?php
        $totalpiutang =  $totalpiutang+$datalaba[5] ;$totalreimburs = $totalreimburs+ $datalaba[6] ;
        $totaltrucking = $totaltrucking+$datalaba[7] ;$totaldanakerja = $totaldanakerja+$datalaba[8];
        $totalppn = $totalppn + $datalaba[9];$totaljasa = $totaljasa + $datalaba[10];
        $totallaba = $totallaba + $datalaba[11];
      ?>
      @endforeach
    </tbody>
    <tfoot>
        <tr>
          <td colspan="5"></td>
          <td align="right" class="propertyhasil" width="8%">{{number_format($totalpiutang,0,'','.')}}</td>
          <td align="right" class="propertyhasil" width="8%">{{number_format($totalreimburs,0,'','.')}}</td>
          <td align="right" class="propertyhasil" width="8%">{{number_format($totaltrucking,0,'','.')}}</td>
          <td align="right" class="propertyhasil" width="8%">{{number_format($totaldanakerja,0,'','.')}}</td>
          <td align="right" class="propertyhasil" width="8%">{{number_format($totalppn,0,'','.')}}</td>
          <td align="right" class="propertyhasil" width="8%">{{number_format($totaljasa,0,'','.')}}</td>
          <td align="right" class="propertyhasil" width="8%">{{number_format($totallaba,0,'','.')}}</td>
        </tr>
    </tfoot>
  </table>

</body>
</html>
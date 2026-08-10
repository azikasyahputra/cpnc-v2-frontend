<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Laporan Tagihan Klien {{$nama}}</title>

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
        <td>&nbsp;</td>
        <td colspan="3"><strong>PT.CAHYAPRAJA NUSACERIA<br>Tlp:4358506,4358602 Fax:4358652</strong></td>
        <td colspan="2">&nbsp;</td>
        <td colspan="3"><strong>INVOICE No. {{$noinvoice}}<br>{{$nama}}</strong></td>
        <td colspan="1">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="9">&nbsp;</td>
        <td align="right">{{number_format($totalsemua,0,'','.')}}</td>
    </tr>
  </table>
  <table width="100%" border="1" style="border-collapse:collapse">
    <thead>
      <tr>
        <th class="bordertable" align="left" width="5%">No</th>
        <th class="bordertable">Tgl</th>
        <th class="bordertable">Tujuan</th>
        <th class="bordertable">Party</th>
        <th class="bordertable">Container</th>
        <th class="bordertable" align="right">Ongkos</th>
        <th class="bordertable" align="right">DP</th>
        <th class="bordertable" align="right">Lift Off</th>
        <th class="bordertable" align="right">U.Bongkar</th>
        <th class="bordertable" align="right">Kurang</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $tagihan)
       <?php
          $tanggal_order=DateTime::createFromFormat('Y-m-d', $tagihan[1]); 
          $tanggal_order=$tanggal_order->format('d-M-Y');
      ?>
      <tr>
        <td class="propertyisi" width="5%">{{$tagihan[0]}}</td>
        <td class="propertyisi">{{$tanggal_order}}</td>
        <td class="propertyisi">{{$tagihan[2]}}</td>
        <td class="propertyisi">{{$tagihan[3]}}</td>
        <td class="propertyisi">{{$tagihan[4]}}</td>
        <td class="propertyisi" align="right">{{number_format($tagihan[5],0,'','.')}}</td>
        <td class="propertyisi" align="right">{{number_format($tagihan[6],0,'','.')}}</td>
        <td class="propertyisi" align="right">{{number_format($tagihan[7],0,'','.')}}</td>
        <td class="propertyisi" align="right">{{number_format($tagihan[8],0,'','.')}}</td>
        <td class="propertyisi" align="right">{{number_format($tagihan[9],0,'','.')}}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td class="propertyhasil" colspan="9">&nbsp;</td>
        <td class="propertyhasil" align="right">{{number_format($totalsemua,0,'','.')}}</td>
      </tr>
    </tfoot>
  </table>

</body>
</html>
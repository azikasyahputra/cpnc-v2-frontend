<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Laporan Buku Besar</title>

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
            <h1>Laporan Buku Besar</h1>
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
        <th class="bordertable" align="left" width="15%">No Referensi</th>
        <th class="bordertable" align="right">Debit</th>
        <th class="bordertable" align="right">Kredit</th>
        <th class="bordertable" align="right">Saldo</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $datakeseluruhan)
      <tr>
        <td class="propertyisi" width="15%">{{$datakeseluruhan['kode_referensi']}}</td>
        <td class="propertyisi" align="right">{{number_format($datakeseluruhan['debit'],0,'','.')}}</td>
        <td class="propertyisi" align="right">{{number_format($datakeseluruhan['kredit'],0,'','.')}}</td>
        <td class="propertyisi" align="right">{{number_format($datakeseluruhan['saldo'],0,'','.')}}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      @foreach($datatotal as $total)
      <tr>
        <td class="propertyhasil">GRAND TOTAL</td>
        <td class="propertyhasil" align="right">{{number_format($total[0],0,'','.')}}</td>
        <td class="propertyhasil" align="right">{{number_format($total[1],0,'','.')}}</td>
        <td class="propertyhasil" align="right">{{number_format($total[2],0,'','.')}}</td>
      </tr>
      @endforeach
    </tfoot>
  </table>

</body>
</html>
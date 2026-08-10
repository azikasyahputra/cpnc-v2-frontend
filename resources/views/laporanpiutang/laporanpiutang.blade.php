<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Laporan Piutang</title>

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
      border: 2px solid black;
    }
</style>

</head>
<body>
  <table width="100%">
    <tr>
        <td class="judullaporan" width="18%">
            <h1>Laporan Piutang</h1>
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
  <hr>
  <table width="100%">
    <thead>
      <tr>
        <th class="bordertable" align="left" width="15%">Nama Customer</th>
        <th class="bordertable" align="left" width="7%">Tanggal</th>
        <th class="bordertable" align="left" width="7%">Order No</th>
        <th class="bordertable" align="left" width="5%">Party</th>
        <th class="bordertable" align="left" width="4%">Doc</th>
        <th class="bordertable" align="right" width="7%">Total Tagihan</th>
        <th class="bordertable" align="right" width="7%">Diterima</th>
        <th class="bordertable" align="right" width="7%">Piutang</th>
      </tr>
    </thead>
    <tbody>
    <?php $cetak='awal'?>
    @foreach($data as $datapiutang)
      @if($cetak=='awal')
      <tr><td colspan="8" class="bordertable2"></td></tr>
      <?php $cetak='akhir';?>
      @endif
      @if($datapiutang[1]!='kosong' && $datapiutang[2]!='kosong' && $datapiutang[3]!='kosong'  && $datapiutang[4]!='kosong')
      <tr>
        <td class="propertyisi" width="15%">{{$datapiutang[0]}}</td>
        <?php
        $tanggalinvoice=DateTime::createFromFormat('Y-m-d H:i:s', $datapiutang[1]);
        $tanggalinvoice=$tanggalinvoice->format('d/m/Y');
        ?>
        <td class="propertyisi" width="7%">{{$tanggalinvoice}}</td>
        <td class="propertyisi" width="7%">{{$datapiutang[2]}}</td>
        <td class="propertyisi" width="4%">{{$datapiutang[3]}}</td>
        <td class="propertyisi" width="5%">{{$datapiutang[4]}}</td>
        <td align="right" class="propertyisi" width="7%">{{number_format($datapiutang[5],0,'','.')}}</td>
        <td align="right" class="propertyisi" width="7%">{{number_format($datapiutang[6],0,'','.')}}</td>
        <td align="right" class="propertyisi" width="7%">{{number_format($datapiutang[7],0,'','.')}}</td>
      </tr>
      @else
      <tr>
          <td class="propertyhasil" colspan="2"><strong>{{$datapiutang[0]}}</strong></td>
          <td colspan="3"></td>
          <td align="right" class="propertyhasil" width="8%">{{number_format($datapiutang[5],0,'','.')}}</td>
          <td align="right" class="propertyhasil" width="8%">{{number_format($datapiutang[6],0,'','.')}}</td>
          <td align="right" class="propertyhasil" width="8%">{{number_format($datapiutang[7],0,'','.')}}</td>
      </tr>
      <?php $cetak='awal'; ?>
      @endif
      @endforeach
    </tbody>
  </table>
  <hr>
</body>
</html>
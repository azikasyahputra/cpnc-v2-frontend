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
    @foreach($header as $dataheader)
    <tr>
        <td>&nbsp;</td>
        <td colspan="3"><strong>PT.CAHYAPRAJA NUSACERIA<br>Tlp:4358506,4358602 Fax:4358652</strong></td>
        <td colspan="2">&nbsp;</td>
         <?php
          $tanggal_transaksi=DateTime::createFromFormat('Y-m-d', $dataheader->tanggal_transaksi); 
          $tanggal_transaksi=$tanggal_transaksi->format('d/m/Y');
        ?>
        <td colspan="3"><strong>No Transaksi. {{$dataheader->no_transaksi}}<br>{{$tanggal_transaksi}}</strong></td>
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
       @foreach($detail as $datadetail)
      <tr>
        <td class="propertyisi" width="10%">
         @foreach($referensi as $referensi2)
            @if(e($referensi2->id_referensi)==$datadetail->id_referensi)
            {{e($referensi2->kode_referensi)}}
            @endif
        @endforeach
        </td>
        <td class="propertyisi">{{$datadetail->keterangan}}</td>
        <td class="propertyisi" align="right">{{number_format($datadetail->biaya_debit,0,'','.')}}</td>
        <td class="propertyisi" align="right">{{number_format($datadetail->biaya_kredit,0,'','.')}}</td>
      </tr>
      @endforeach
      <?php $n=$detailcount+1;?>
      @while ($n<7)
      <tr>
        <td class="propertyisi" width="10%">0</td>
        <td class="propertyisi">0</td>
        <td class="propertyisi" align="right">0</td>
        <td class="propertyisi" align="right">0</td>
      </tr>
      <?php $n++;?>
      @endwhile
    </tbody>
    <tfoot>
      <tr>
        <td class="propertyhasil" colspan="2" align="right">total debit:</td>
        <td class="propertyhasil" align="right" colspan="2">{{number_format($dataheader->total_debit,0,'','.')}}</td>
      </tr>
       <tr>
        <td colspan="2" align="right">total kredit:</td>
        <td align="right" colspan="2">{{number_format($dataheader->total_kredit,0,'','.')}}</td>
      </tr>
    </tfoot>
  </table>
  @endforeach
</body>
</html>
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
          <strong>Tanggal:</strong> {{$tanggalawal}}-{{$tanggalakhir}}
        </td>
    </tr>

  </table>

  <br/>
  <table width="100%" border="1" style="border-collapse: collapse;">
    <thead>
      <tr>
        @for($i=0;$i<count($header);$i++)
        <th class="bordertable" align="left" width="15%">{{$header[$i]}}</th>
        @endfor
      </tr>
    </thead>
    <tbody>
      @foreach($data as $dataorder)
      <tr>
        <td class="propertyisi" width="15%">{{$dataorder['nama_client']}}</td>
        @foreach($dokumen as $datadokumen)
        <?php $namadokumen=$datadokumen->nama_dokumen;?>
        <td align="right" class="propertyisi" width="7%">{{$dataorder[$namadokumen]}}</td>
        @endforeach
      </tr>
      @endforeach
    </tbody>
    <tfoot>
        <tr>
          <td class="propertyisi" width="15%">Total</td>
           @for($n=0;$n<count($total);$n++)
            <td align="right" class="propertyisi" width="7%">{{$total[$n]}}</td>
           @endfor
        </tr>
    </tfoot>
  </table>

</body>
</html>
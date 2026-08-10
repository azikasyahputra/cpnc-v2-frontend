<?php ini_set('max_execution_time', 3000);
    ini_set('memory_limit','128M');?>
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

            <h1>PT.CAHYAPRAJA NUSACERIA<br>Laporan Laba/Rugi<br>Untuk Tahun yang berakhir

            {{$tanggalhari}} {{$tanggalbulan}} {{$tanggaltahun}}

            <br>(dalam rupiah)

            </h1>

        </td>

        <td>&nbsp;</td>

    </tr>

  </table>

  <table width="100%">

      <tr>

        <td class="propertyheader" colspan="2">Peredaran Usaha</td>

        <td class="propertyisi"></td>

        <td class="propertyisi"></td>

      </tr>

      <tr>
        <td class="propertykiri" width="10%">&nbsp;</td>

        <td class="propertyisi" width="40%">Pendapatan Jasa</td>

        <td class="propertyisi" width="10%" align="right">{{number_format($totalpendapatanjasa,0,'','.')}}</td>

        <td class="propertyisi" width="18%" align="right"></td>

      </tr>

       <tr>
        <td class="propertykiri" width="10%">&nbsp;</td>

        <td class="propertyisi" width="40%">Pendapatan Operasional</td>

        <td class="propertyisi" width="10%" align="right">{{number_format($totalpendapatanoperasional,0,'','.')}}</td>

        <td class="propertyisi" width="18%" align="right"></td>

      </tr>

       <tr>
        <td class="propertykiri" width="10%">&nbsp;</td>

        <td class="propertyisi" width="40%">Pendapatan Trucking</td>

        <td class="propertyisi" width="10%" align="right">{{number_format($totalpendapatantrucking,0,'','.')}}</td>

        <td class="propertyisi" width="18%" align="right"></td>

      </tr>
	
      <tr>

        <td class="propertyheader" colspan="2">Total Pendapatan</td>

        <td class="propertyisi" width="10%" align="right"></td>

        <td class="propertyisi" width="18%" align="right">{{number_format($totallababruto,0,'','.')}}</td>

      </tr>

      <tr>

        <td class="propertyheader" colspan="2">&nbsp;</td>

        <td class="propertyisi" width="20%" align="right"></td>

        <td class="propertyisi" width="3%" align="right"></td>

      </tr>

      <tr>

        <td class="propertyheader" colspan="2">Laba Bruto Usaha</td>

        <td class="propertyisi" width="10%" align="right"></td>

        <td class="propertyisi" width="18%" align="right"><strong>{{number_format($totallababruto,0,'','.')}}</strong></td>

      </tr>

      <tr>

        <td class="propertyheader" colspan="2" align="center">&nbsp;</td>

        <td class="propertyisi" width="10%" align="right"></td>

        <td class="propertyisi" width="18%" align="right"></td>

      </tr>

      @foreach($data as $databiaya)

      <tr>

        <td class="propertyheader" align="right" style="border-right: 0px;" width="10%">Biaya&nbsp;</td>

        <td class="propertyisi" width="40%">&nbsp;{{$databiaya['nama_biaya']}}</td>

        <td class="propertyisi" width="10%" align="right"></td>

        <td class="propertyisi" width="18%" align="right">{{number_format($databiaya['jumlah_biaya'],0,'','.')}}</td>

      </tr>

      @endforeach

      <tr>

        <td class="propertyheader" colspan="2" align="center">Total Biaya</td>

        <td class="propertyisi" width="10%" align="right"></td>

        <td class="propertyisi" width="18%" align="right"><strong>{{number_format($totalbiaya,0,'','.')}}</strong></td>

      </tr>

      <tr>

        <td class="propertyheader" colspan="2" align="center">&nbsp;</td>

        <td class="propertyisi" width="10%" align="right"></td>

        <td class="propertyisi" width="18%" align="right"></td>

      </tr>

      <tr>

         <td class="propertyheader" colspan="2">Laba (Rugi) Neto Usaha</td>

         <td class="propertyisi" width="10%" align="right"></td>

         <td class="propertyisi" width="18%" align="right"><strong>{{number_format($labarugineto,0,'','.')}}</strong></td>

       </tr>

      <tr>

         <td class="propertyheader" colspan="2">Penghasilan dari Luar Usaha</td>

         <td class="propertyisi" width="10%" align="right"></td>

         <td class="propertyisi" width="18%" align="right"><strong>{{number_format($totalpenghasilanluarusaha,0,'','.')}}</strong></td>

       </tr>

      <tr>

         <td class="propertyheader" colspan="2">Biaya dari Luar Usaha</td>

         <td class="propertyisi" width="10%" align="right"></td>

         <td class="propertyisi" width="18%" align="right"><strong>{{number_format($totalbiayaluarusaha,0,'','.')}}</strong></td>

       </tr>

      <tr>

         <td class="propertyheader" colspan="2">Laba (Rugi) Neto setelah pajak</td>

         <td class="propertyisi" width="10%" align="right"></td>

         <td class="propertyisi" width="18%" align="right"><strong>{{number_format($labarugineto,0,'','.')}}</strong></td>

       </tr>

  </table>

  <br><br>

  <table width="100%">

  <tr>

      <td align="right">Jakarta, </td>

      <td align="left" width="12.85%">

          {{$tanggalhari}} {{$tanggalbulan}} {{$tanggaltahun}}

      </td>

  </tr>

  </table>

  <br><br><br>

  <table width="100%">

  <tr>

      <td align="right">&nbsp;</td>

      <td align="left" width="12.85%">

          Yoppy Benny

      </td>

  </tr>

  </table>



</body>

</html>
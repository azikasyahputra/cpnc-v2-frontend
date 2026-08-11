<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'LoginController@index');
Route::get('/logout', 'LoginController@logout')->name('logout')->middleware('usersession');
Route::post('/checklogin', 'LoginController@checklogin')->name('checklogin')->middleware('throttle:5,1');
Route::get('/dashboard', 'LoginController@dashboard')->name('dashboard');
//Klien
Route::get('/klien', 'KlienController@index')->name('klien')->middleware('usersession');
Route::post('/kliens', 'KlienController@indexs')->name('kliens')->middleware('usersession');
Route::get('/klien/create', 'KlienController@create')->name('kliencreate')->middleware('usersession');
Route::post('/klien/save', 'KlienController@save')->name('kliensave')->middleware('usersession');
Route::get('/klien/edit/{id}', 'KlienController@edit')->name('klienedit')->middleware('usersession');
Route::post('/klien/saveedit', 'KlienController@saveedit')->name('kliensaveedit')->middleware('usersession');
Route::get('/klien/hapus/{id}', 'KlienController@hapus')->name('klienhapus')->middleware('usersession');
//Klien
Route::get('/supir', 'SupirController@index')->name('supir')->middleware('usersession');
Route::get('/supir/create', 'SupirController@create')->name('supircreate')->middleware('usersession');
Route::post('/supir/save', 'SupirController@save')->name('supirsave')->middleware('usersession');
Route::get('/supir/edit/{id}', 'SupirController@edit')->name('supiredit')->middleware('usersession');
Route::post('/supir/saveedit', 'SupirController@saveedit')->name('supirsaveedit')->middleware('usersession');
Route::get('/supir/hapus/{id}', 'SupirController@hapus')->name('supirhapus')->middleware('usersession');
//Pelayaran
Route::get('/pelayaran', 'PelayaranController@index')->name('pelayaran')->middleware('usersession');
Route::get('/pelayaran/create', 'PelayaranController@create')->name('pelayarancreate')->middleware('usersession');
Route::post('/pelayaran/save', 'PelayaranController@save')->name('pelayaransave')->middleware('usersession');
Route::get('/pelayaran/edit/{id}', 'PelayaranController@edit')->name('pelayaranedit')->middleware('usersession');
Route::post('/pelayaran/saveedit', 'PelayaranController@saveedit')->name('pelayaransaveedit')->middleware('usersession');
Route::get('/pelayaran/hapus/{id}', 'PelayaranController@hapus')->name('pelayaranhapus')->middleware('usersession');
//Gudang
Route::get('/gudang', 'GudangController@index')->name('gudang')->middleware('usersession');
Route::get('/gudang/create', 'GudangController@create')->name('gudangcreate')->middleware('usersession');
Route::post('/gudang/save', 'GudangController@save')->name('gudangsave')->middleware('usersession');
Route::get('/gudang/edit/{id}', 'GudangController@edit')->name('gudangedit')->middleware('usersession');
Route::post('/gudang/saveedit', 'GudangController@saveedit')->name('gudangsaveedit')->middleware('usersession');
Route::get('/gudang/hapus/{id}', 'GudangController@hapus')->name('gudanghapus')->middleware('usersession');
//Lapangan
Route::get('/lapangan', 'LapanganController@index')->name('lapangan')->middleware('usersession');
Route::get('/lapangan/create', 'LapanganController@create')->name('lapangancreate')->middleware('usersession');
Route::post('/lapangan/save', 'LapanganController@save')->name('lapangansave')->middleware('usersession');
Route::get('/lapangan/edit/{id}', 'LapanganController@edit')->name('lapanganedit')->middleware('usersession');
Route::post('/lapangan/saveedit', 'LapanganController@saveedit')->name('lapangansaveedit')->middleware('usersession');
Route::get('/lapangan/hapus/{id}', 'LapanganController@hapus')->name('lapanganhapus')->middleware('usersession');
//Kosongan
Route::get('/kosongan', 'KosonganController@index')->name('kosongan')->middleware('usersession');
Route::get('/kosongan/create', 'KosonganController@create')->name('kosongancreate')->middleware('usersession');
Route::post('/kosongan/save', 'KosonganController@save')->name('kosongansave')->middleware('usersession');
Route::get('/kosongan/edit/{id}', 'KosonganController@edit')->name('kosonganedit')->middleware('usersession');
Route::post('/kosongan/saveedit', 'KosonganController@saveedit')->name('kosongansaveedit')->middleware('usersession');
Route::get('/kosongan/hapus/{id}', 'KosonganController@hapus')->name('kosonganhapus')->middleware('usersession');
//Biaya
Route::get('/biaya', 'BiayaController@index')->name('biaya')->middleware('usersession');
Route::get('/biaya/create', 'BiayaController@create')->name('biayacreate')->middleware('usersession');
Route::post('/biaya/save', 'BiayaController@save')->name('biayasave')->middleware('usersession');
Route::get('/biaya/edit/{id}', 'BiayaController@edit')->name('biayaedit')->middleware('usersession');
Route::post('/biaya/saveedit', 'BiayaController@saveedit')->name('biayasaveedit')->middleware('usersession');
Route::get('/biaya/hapus/{id}', 'BiayaController@hapus')->name('biayahapus')->middleware('usersession');
//Kemasan
Route::get('/kemasan', 'KemasanController@index')->name('kemasan')->middleware('usersession');
Route::get('/kemasan/create', 'KemasanController@create')->name('kemasancreate')->middleware('usersession');
Route::post('/kemasan/save', 'KemasanController@save')->name('kemasansave')->middleware('usersession');
Route::get('/kemasan/edit/{id}', 'KemasanController@edit')->name('kemasanedit')->middleware('usersession');
Route::post('/kemasan/saveedit', 'KemasanController@saveedit')->name('kemasansaveedit')->middleware('usersession');
Route::get('/kemasan/hapus/{id}', 'KemasanController@hapus')->name('kemasanhapus')->middleware('usersession');
//Jenis Dokumen
Route::get('/jenisdokumen', 'JenisDokumenController@index')->name('jenisdokumen')->middleware('usersession');
Route::get('/jenisdokumen/create', 'JenisDokumenController@create')->name('jenisdokumencreate')->middleware('usersession');
Route::post('/jenisdokumen/save', 'JenisDokumenController@save')->name('jenisdokumensave')->middleware('usersession');
Route::get('/jenisdokumen/edit/{id}', 'JenisDokumenController@edit')->name('jenisdokumenedit')->middleware('usersession');
Route::post('/jenisdokumen/saveedit', 'JenisDokumenController@saveedit')->name('jenisdokumensaveedit')->middleware('usersession');
Route::get('/jenisdokumen/hapus/{id}', 'JenisDokumenController@hapus')->name('jenisdokumenhapus')->middleware('usersession');
//Status
Route::get('/status', 'StatusController@index')->name('status')->middleware('usersession');
Route::get('/status/create', 'StatusController@create')->name('statuscreate')->middleware('usersession');
Route::post('/status/save', 'StatusController@save')->name('statussave')->middleware('usersession');
Route::get('/status/edit/{id}', 'StatusController@edit')->name('statusedit')->middleware('usersession');
Route::post('/status/saveedit', 'StatusController@saveedit')->name('statussaveedit')->middleware('usersession');
Route::get('/status/hapus/{id}', 'StatusController@hapus')->name('statushapus')->middleware('usersession');
//Daftar Referensi
Route::get('/daftarreferensi', 'DaftarReferensiController@index')->name('daftarreferensi')->middleware('usersession');
Route::get('/daftarreferensi/create', 'DaftarReferensiController@create')->name('daftarreferensicreate')->middleware('usersession');
Route::post('/daftarreferensi/save', 'DaftarReferensiController@save')->name('daftarreferensisave')->middleware('usersession');
Route::get('/daftarreferensi/edit/{id}', 'DaftarReferensiController@edit')->name('daftarreferensiedit')->middleware('usersession');
Route::post('/daftarreferensi/saveedit', 'DaftarReferensiController@saveedit')->name('daftarreferensisaveedit')->middleware('usersession');
Route::get('/daftarreferensi/hapus/{id}', 'DaftarReferensiController@hapus')->name('daftarreferensihapus')->middleware('usersession');
//Order
Route::get('/order', 'OrderController@index')->name('order')->middleware('usersession');
Route::get('/order/group/{sorting}', 'OrderController@sort')->name('ordersorting')->middleware('usersession');
Route::get('/order/detail/{id}', 'OrderController@detail')->name('orderdetail')->middleware('usersession');
Route::get('/order/create', 'OrderController@create')->name('ordercreate')->middleware('usersession');
Route::post('/order/save', 'OrderController@save')->name('ordersave')->middleware('usersession');
Route::get('/order/edit/{id}', 'OrderController@edit')->name('orderedit')->middleware('usersession');
Route::post('/order/saveedit', 'OrderController@saveedit')->name('ordersaveedit')->middleware('usersession');
Route::get('/order/hapus/{id}', 'OrderController@hapus')->name('orderhapus')->middleware('usersession');
//Invoice
Route::get('/invoice', 'InvoiceController@index')->name('invoice')->middleware('usersession')->middleware('usersession');
Route::get('/invoice/download/{id}', 'InvoiceController@downloadinvoice')->name('downloadinvoice')->middleware('usersession');
Route::get('/invoice/downloadkwitansi/{id}', 'InvoiceController@downloadkwitansi')->name('downloadkwitansi')->middleware('usersession');
Route::get('/invoice/{sorting}', 'InvoiceController@sort')->name('invoicesorting')->middleware('usersession');
Route::get('/invoice/detail/{id}', 'InvoiceController@detail')->name('invoicedetail')->middleware('usersession');
Route::get('/invoice/print/{id}', 'InvoiceController@print')->name('invoiceprint');
Route::get('/invoice/create/{id}', 'InvoiceController@create')->name('invoicecreate')->middleware('usersession');
Route::post('/invoice/save', 'InvoiceController@save')->name('invoicesave')->middleware('usersession');
Route::get('/invoice/edit/{id}', 'InvoiceController@edit')->name('invoiceedit')->middleware('usersession');
Route::post('/invoice/saveedit', 'InvoiceController@saveedit')->name('invoicesaveedit')->middleware('usersession');
Route::get('/invoice/lunas/{id}', 'InvoiceController@lunas')->name('invoicelunas')->middleware('usersession');
Route::get('/invoice/hapus/{id}', 'InvoiceController@hapus')->name('invoicehapus')->middleware('usersession');
//Pengeluaran
Route::get('/pengeluaran', 'PengeluaranController@index')->name('pengeluaran')->middleware('usersession');
Route::get('/pengeluaran/{sorting}', 'PengeluaranController@sort')->name('pengeluaransorting')->middleware('usersession');
Route::get('/pengeluaran/detail/{id}', 'PengeluaranController@detail')->name('pengeluarandetail')->middleware('usersession');
Route::get('/pengeluaran/print/{id}', 'PengeluaranController@print')->name('pengeluaranprint')->middleware('usersession');
Route::get('/pengeluaran/create/{id}', 'PengeluaranController@create')->name('pengeluarancreate')->middleware('usersession');
Route::post('/pengeluaran/save', 'PengeluaranController@save')->name('pengeluaransave')->middleware('usersession');
Route::get('/pengeluaran/edit/{id}', 'PengeluaranController@edit')->name('pengeluaranedit')->middleware('usersession');
Route::post('/pengeluaran/saveedit', 'PengeluaranController@saveedit')->name('pengeluaransaveedit')->middleware('usersession');
Route::get('/pengeluaran/hapus/{id}', 'PengeluaranController@hapus')->name('pengeluaranhapus')->middleware('usersession');
//Kas
Route::get('/kas', 'BukuKasController@index')->name('kas')->middleware('usersession');
//Route::get('/kas/group/{sorting}', 'BukuKasController@sort')->name('kassorting');
Route::get('/kas/detail/{id}', 'BukuKasController@detail')->name('kasdetail')->middleware('usersession');
Route::get('/kas/print/{id}', 'BukuKasController@downloadinvoice')->name('kasdownloadinvoice')->middleware('usersession');
Route::get('/kas/create', 'BukuKasController@createkas')->name('kascreate')->middleware('usersession');
//Route::get('/kas/createkaskecil', 'BukuKasController@createkaskecil')->name('kascreatekaskecil');
//Route::get('/kas/createkasbank', 'BukuKasController@createkasbank')->name('kascreatekasbank');
Route::post('/kas/save', 'BukuKasController@save')->name('kassave')->middleware('usersession');
Route::get('/kas/edit/{id}', 'BukuKasController@edit')->name('kasedit')->middleware('usersession');
Route::post('/kas/saveedit', 'BukuKasController@saveedit')->name('kassaveedit')->middleware('usersession');
Route::get('/kas/hapus/{id}', 'BukuKasController@hapus')->name('kashapus')->middleware('usersession');
//Laporan Piutang
Route::get('/laporanpiutang', 'LaporanPiutangController@laporanpiutang')->name('laporanpiutang')->middleware('usersession');
Route::post('/downloadlaporanpiutang', 'LaporanPiutangController@downloadlaporanpiutang')->name('downloadlaporanpiutang')->middleware('usersession');
Route::get('/laporanorder', 'LaporanPiutangController@laporanorder')->name('laporanorder')->middleware('usersession');
Route::post('/downloadlaporanorder', 'LaporanPiutangController@downloadlaporanorder')->name('downloadlaporanorder')->middleware('usersession');
Route::get('/laporankeseluruhan', 'LaporanPiutangController@laporankeseluruhan')->name('laporankeseluruhan')->middleware('usersession');
Route::post('/downloadlaporankeseluruhan', 'LaporanPiutangController@downloadlaporankeseluruhan')->name('downloadlaporankeseluruhan')->middleware('usersession');
Route::get('/laporanrugilaba', 'LaporanPiutangController@laporanrugilaba')->name('laporanrugilaba')->middleware('usersession');
Route::post('/downloadlaporanrugilaba', 'LaporanPiutangController@downloadlaporanrugilaba')->name('downloadlaporanrugilaba')->middleware('usersession');
//Laporan keuangan
Route::get('/laporanbukubesar', 'LaporanKeuanganController@laporanbukubesar')->name('laporanbukubesar')->middleware('usersession');
Route::post('/downloadlaporanbukubesar', 'LaporanKeuanganController@downloadlaporanbukubesar')->name('downloadlaporanbukubesar')->middleware('usersession');
Route::get('/laporanneraca', 'LaporanKeuanganController@laporanneraca')->name('laporanneraca')->middleware('usersession');
Route::post('/downloadlaporanneraca', 'LaporanKeuanganController@downloadlaporanneraca')->name('downloadlaporanneraca')->middleware('usersession');
Route::get('/laporanrugilabakeuangan', 'LaporanKeuanganController@laporanrugilabakeuangan')->name('laporanrugilabakeuangan')->middleware('usersession');
Route::post('/downloadlaporanrugilabakeuangan', 'LaporanKeuanganController@downloadlaporanrugilabakeuangan')->name('downloadlaporanrugilabakeuangan')->middleware('usersession');
//Trucking
Route::get('/trucking', 'TruckingController@index')->name('trucking')->middleware('usersession');
Route::get('/trucking/group/{sorting}', 'TruckingController@sort')->name('truckingsorting')->middleware('usersession');
Route::get('/trucking/detail/{id}', 'TruckingController@detail')->name('truckingdetail')->middleware('usersession');
Route::get('/trucking/create', 'TruckingController@create')->name('truckingcreate')->middleware('usersession');
Route::post('/trucking/save', 'TruckingController@save')->name('truckingsave')->middleware('usersession');
Route::get('/trucking/edit/{id}', 'TruckingController@edit')->name('truckingedit')->middleware('usersession');
Route::get('/trucking/kasbonjalan/{id}', 'TruckingController@kasbonjalan')->name('truckingkasbonjalan')->middleware('usersession');
Route::post('/trucking/savekasbonjalan', 'TruckingController@saveeditkasbonjalan')->name('truckingkasbonjalansaveedit')->middleware('usersession');
Route::post('/trucking/saveedit', 'TruckingController@saveedit')->name('truckingsaveedit')->middleware('usersession');
Route::get('/trucking/hapus/{id}', 'TruckingController@hapus')->name('truckinghapus')->middleware('usersession');
Route::get('/trucking/lunas/{id}', 'TruckingController@lunas')->name('truckinglunas')->middleware('usersession');
//Laporan Trucking
Route::get('/laporanpiutangtrucking', 'LaporanTruckingController@laporanpiutang')->name('laporanpiutangtrucking')->middleware('usersession');
Route::post('/downloadlaporanpiutangtrucking', 'LaporanTruckingController@downloadlaporanpiutang')->name('downloadlaporanpiutangtrucking')->middleware('usersession');
Route::get('/laporantagihanklien', 'LaporanTruckingController@laporantagihanklien')->name('laporantagihanklien')->middleware('usersession');
Route::post('/downloadlaporantagihanklien', 'LaporanTruckingController@downloadlaporantagihanklien')->name('downloadlaporantagihanklien')->middleware('usersession');
Route::get('/laporanrugilabatrucking', 'LaporanTruckingController@laporanrugilabatrucking')->name('laporanrugilabatrucking')->middleware('usersession');
Route::post('/downloadlaporanrugilabatrucking', 'LaporanTruckingController@downloadlaporanrugilabatrucking')->name('downloadlaporanrugilabatrucking')->middleware('usersession');
Route::get('/laporankomisisupir', 'LaporanTruckingController@laporankomisisupir')->name('laporankomisisupir')->middleware('usersession');
Route::post('/downloadlaporankomisisupir', 'LaporanTruckingController@downloadlaporankomisisupir')->name('downloadlaporankomisisupir')->middleware('usersession');
//Invoice Trucking
Route::get('/invoicetrucking', 'InvoiceTruckingController@index')->name('invoicetrucking')->middleware('usersession');
Route::get('/invoicetrucking/create', 'InvoiceTruckingController@create')->name('invoicetruckingcreate')->middleware('usersession');
Route::get('/invoicetrucking/detail/{id}', 'InvoiceTruckingController@detail')->name('invoicetruckingdetail')->middleware('usersession');
Route::get('/invoicetrucking/edit/{id}', 'InvoiceTruckingController@edit')->name('invoicetruckingedit')->middleware('usersession');
Route::get('/invoicetrucking/download/{id}', 'InvoiceTruckingController@download')->name('invoicetruckingdownload')->middleware('usersession');
Route::get('/invoicetrucking/downloadxlsx/{id}', 'InvoiceTruckingController@downloadxlsx')->name('invoicetruckingdownloadxlsx')->middleware('usersession');
Route::get('/invoicetrucking/lunas/{id}', 'InvoiceTruckingController@lunas')->name('invoicetruckinglunas')->middleware('usersession');
Route::get('/invoicetrucking/hapus/{id}', 'InvoiceTruckingController@hapus')->name('invoicetruckinghapus')->middleware('usersession');
Route::get('/invoicetrucking/{sorting}', 'InvoiceTruckingController@sort')->name('invoicetruckingsorting')->middleware('usersession');
Route::post('/invoicetrucking/search', 'InvoiceTruckingController@search')->name('invoicetruckingsearch')->middleware('usersession');
Route::post('/invoicetrucking/save', 'InvoiceTruckingController@save')->name('invoicetruckingsave')->middleware('usersession');
Route::post('/invoicetrucking/saveedit', 'InvoiceTruckingController@saveedit')->name('invoicetruckingsaveedit')->middleware('usersession');


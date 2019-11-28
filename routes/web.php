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

// Route::get('/', function () {
//     return view('admin.layoutPinjam');
// });

Route::get('/','HomeUserController@homeUser');

Route::get('/login', 'LoginController@pageLogin');
Route::post('/login', 'LoginController@cekLogin');
Route::get('/logout', 'LoginController@logout');

Route::get('/daftar', 'LoginController@formDaftar');
Route::post('/daftar', 'LoginController@simpanDaftar');

Route::get('tentang', 'HomeUserController@tentang');
Route::group(['middleware' => 'login.auth'], function(){
	Route::prefix('admin')->group(function(){
		Route::get('/', 'HomeUserController@homeAdmin');

		Route::get('/suplier/list', 'suplierController@listSuplier');
		Route::get('/suplier/form', 'suplierController@formSuplier');
		Route::post('/suplier/form', 'suplierController@simpanSuplier');
		Route::get('/suplier/{id}/edit', 'suplierController@editSuplier');
		Route::post('/suplier/{id}/edit', 'suplierController@ubahSuplier');
		Route::get('/suplier/{id}/hapus' ,'suplierController@hapusSuplier');

		Route::get('/karyawan/list', 'karyawanController@listKaryawan');
		Route::get('/karyawan/form', 'karyawanController@formKaryawan');
		Route::post('/karyawan/form', 'karyawanController@simpanKaryawan');
		Route::get('/karyawan/{id}/edit', 'karyawanController@editKaryawan');
		Route::post('/karyawan/{id}/edit', 'karyawanController@ubahKaryawan');
		Route::get('/karyawan/{id}/hapus' ,'karyawanController@hapusKaryawan');

		Route::get('/pelanggan/list', 'pelangganController@listPelanggan');
		Route::get('/pelanggan/{id}/hapus', 'pelangganController@hapusPelanggan');
		Route::get('/pelanggan/form', 'pelangganController@formPelanggan');
		Route::post('/pelanggan/form', 'pelangganController@simpanPelanggan');
		Route::get('/pelanggan/{id}/edit', 'pelangganController@editPelanggan');
		Route::post('/pelanggan/{id}/edit', 'pelangganController@ubahPelanggan');

		Route::get('/alat/list', 'alatController@listAlat');
		Route::get('/alat/form', 'alatController@formAlat');
		Route::post('/alat/form', 'alatController@simpanAlat');
		Route::get('/alat/{id}/hapus', 'alatController@hapusAlat');
		Route::get('/alat/{id}/edit', 'alatController@editAlat');
		Route::post('/alat/{id}/edit', 'alatController@ubahAlat');		

		Route::get('/pinjam/list/{tgl}' ,'PinjamController@listPinjam');
		Route::get('/pinjam/formOffline/{tgl}', 'PinjamController@formOffline');
		Route::post('/pinjam/formOffline/{tgl}', 'PinjamController@simpanFormOffline');
		Route::get('/pinjam/listalat/{kdSewa}', 'PinjamController@listAlatPinjam');

		Route::get('/pinjam/listalat/{idSewa}/batal', 'PinjamController@batalPinjam');
		Route::get('/pinjam/detailalat/{kdSewa}/{idAlat}', 'PinjamController@detailAlatOffline');
		Route::post('/pinjam/detailalat/{kdSewa}/{idAlat}', 'PinjamController@tambahKeranjang');

		Route::get('/pinjam/keranjang/{idSewa}', 'PinjamController@isiKeranjang');
		Route::post('/pinjam/keranjang/{idSewa}', 'PinjamController@simpanTransaksi');
		Route::get('/pinjam/keranjang/{idSewa}/{idAlat}/hapus', 'PinjamController@hapusItem');

		Route::get('/pinjam/keranjang/{idSewa}/{idAlat}/edit', 'PinjamController@editJumlah');
		Route::post('/pinjam/keranjang/{idSewa}/{idAlat}/edit', 'PinjamController@ubahJumlah');
		
		Route::get('/pinjam/bukti/{idSewa}', 'PinjamController@bukti');
		Route::get('/pinjam/bukti/{idSewa}/preview', 'PinjamController@previewBukti');

		Route::get('/stok/list', 'StokController@listStok');
		Route::get('/stok/form/{idAlat}', 'StokController@formStok');
		Route::post('/stok/form/{idAlat}', 'StokController@simpanFormStok');
		Route::get('/stok/form/{idAlat}/edit', 'StokController@editStok');
		Route::post('/stok/form/{idAlat}/edit', 'StokController@simpanEditStok');

		Route::get('/kembali/list/{tgl}', 'KembaliController@listKembali');
		Route::get('/kembali/{kdPinjam}/form', 'KembaliController@formKembali');
		Route::post('/kembali/{kdPinjam}/form', 'KembaliController@simpanFormKembali');
		Route::get('/kembali/proses/{kdPinjam}/{alatId}', 'KembaliController@formProsesKembali');
		Route::post('/kembali/proses/{kdPinjam}/{alatId}', 'KembaliController@formProsesKembaliSimpan');
		Route::get('/kembali/preview/{kdPinjam}', 'KembaliController@preview');
		Route::get('/kembali/{kdPinjam}/previewCetak', 'KembaliController@previewCetak');

		Route::get('/booking/list', 'BookingAdminController@listBookingAdmin');
		Route::get('/booking/{kdPinjam}/batal', 'BookingAdminController@batalBooking');

		Route::get('/booking/{kdPinjam}/proses', 'BookingAdminController@prosesPinjam');
		Route::post('/booking/{kdPinjam}/proses', 'BookingAdminController@prosesPinjamSimpan');

		Route::get('/gantisandi/{kodeUser}', 'ManajemenController@gantiSandi');
		Route::post('/gantisandi/{kodeUser}', 'ManajemenController@gantiSandiSimpan');
		Route::get('/manajemen/user/list', 'ManajemenController@listPengguna');

		Route::get('/manajemen/user/{kodeUser}/reset', 'ManajemenController@editSandi');
		Route::post('/manajemen/user/{kodeUser}/reset', 'ManajemenController@resetSandi');
		Route::get('/manajemen/user/{kodeUser}/hapus', 'ManajemenController@hapusUser');
		Route::get('/manajemen/user', 'ManajemenController@listNotUser');

		Route::get('/manajemen/user/{idKaryawan}/setPass', 'ManajemenController@formSetPass');
		Route::post('/manajemen/user/{idKaryawan}/setPass', 'ManajemenController@simpanSetPass');

		Route::get('/gaji/list/{tgl}', 'GajiController@listGaji');
		Route::post('/gaji/list/{tgl}', 'GajiController@simpanGaji');
		Route::get('/gaji/{id}/hapus', 'GajiController@hapusGaji');

		Route::get('/biaya/list/{tgl}', 'BiayaController@listBiaya');
		Route::get('/biaya/form/{tgl}', 'BiayaController@prosesForm');
		Route::get('/biaya/formOperasional/{kdOperasional}', 'BiayaController@formOperasional');
		Route::post('/biaya/formOperasional/{kdOperasional}', 'BiayaController@simpanDetail');
		Route::get('/biaya/batal/{kdOperasional}', 'BiayaController@batalTransaksi');
		Route::get('/biaya/formOperasional/{idOperasional}/{id}/hapus', 'BiayaController@hapusItem');
		Route::get('/biaya/list/{idOperasional}/hapus', 'BiayaController@hapusTransaski');
		Route::get('/biaya/detail/{idOperasional}', 'BiayaController@detail');

		Route::get('/beli/list/{tgl}', 'BeliController@list');
		Route::get('/beli/form/{tgl}', 'BeliController@form');
		Route::post('/beli/form/{tgl}', 'BeliController@simpanForm');

		Route::get('/beli/proses/{tgl}/{kdBeli}', 'BeliController@formProses');
		Route::post('/beli/proses/{tgl}/{kdBeli}', 'BeliController@SimpanFormProses');	
		Route::get('/beli/batal/{kdBeli}', 'BeliController@batalBeli');
		Route::get('/beli/{idBeli}/{idAlat}/hapus', 'BeliController@hapusItemBeli');
		Route::get('/beli/{idBeli}/selsai', 'BeliController@selesai');
		Route::get('/beli/detail/{idBeli}', 'BeliController@detail');

		Route::get('/alatrusak/list/{bulan}','AlatRusakController@list');
		Route::get('/alatrusak/form/{tgl}', 'AlatRusakController@form');
		Route::post('/alatrusak/form/{tgl}', 'AlatRusakController@formSimpan');
		Route::get('/alatrusak/detail/{alatId}/{bulan}', 'AlatRusakController@detail');

		Route::get('/konfirmasiDetail/{kdSewa}', 'BookingAdminController@detailKonfirmasi');

		Route::get('/laporan/alat/form', 'LaporanController@formAlatLaporan');
		Route::get('/laporan/alat/preview', 'LaporanController@detailLaporanAlat');
		
		Route::get('/laporan/suplier/form', 'LaporanController@formSuplierLaporan');
		Route::get('/laporan/suplier/preview', 'LaporanController@previewLaporanSuplier');

		Route::get('/laporan/karyawan/form', 'LaporanController@formKaryawanLaporan');
		Route::get('/laporan/karyawan/preview', 'LaporanController@previewLaporanKaryawan');

		Route::get('/laporan/pelanggan/form', 'LaporanController@formPelangganLaporan');
		Route::get('/laporan/pelanggan/preview', 'LaporanController@previewLaporanPelanggan');

		Route::get('/laporan/biaya/form', 'LaporanController@formBiayaLaporan');
		Route::get('/laporan/biaya/proses', 'LaporanController@prosesBiayaLaporan');
		Route::get('/laporan/biaya/{bulan}/previewSemua', 'LaporanController@previewSemua');
		Route::get('/laporan/biaya/{id}/previewDetail', 'LaporanController@previewDetail');

		Route::get('/laporan/gaji/form', 'LaporanController@formGajiLaporan');
		Route::get('/laporan/gaji/proses', 'LaporanController@prosesGajiLaporan');
		Route::get('/laporan/gaji/preview/{bulan}', 'LaporanController@previewGajiLaporan');

		Route::get('/laporan/penyewaan/form', 'LaporanController@formPenyewaanLaporan');
		Route::get('/laporan/penyewaan/proses', 'LaporanController@prosesPenyewaanLaporan');
		Route::get('/laporan/penyewaan/{bulan}/previewSemua', 'LaporanController@previewSemuaPenyewaan');
		Route::get('/laporan/penyewaan/{id}/previewDetail', 'LaporanController@previewDetailPenyewaan');

		Route::get('/laporan/pengembalian/form', 'LaporanController@formPengembalianLaporan');
		Route::get('/laporan/pengembalian/proses', 'LaporanController@prosesPengembalianLaporan');
		Route::get('/laporan/pengembalian/{bulan}/previewSemua', 'LaporanController@previewSemuaPengembalian');
		Route::get('/laporan/pengembalian/{kdKembali}/previewDetail', 'LaporanController@previewDetailPengembalian');

		Route::get('/laporan/pembelian/form', 'LaporanController@formPembelianLaporan');
		Route::get('/laporan/pembelian/proses', 'LaporanController@prosesPembelianLaporan');
		Route::get('/laporan/pembelian/{bulan}/previewSemua', 'LaporanController@previewSemuaPembelian');
		Route::get('/laporan/pembelian/{id}/previewDetail', 'LaporanController@previewDetailPembelian');

		Route::get('/laporan/labarugi/form', 'LaporanController@formLabaRugiLaporan');
		Route::get('/laporan/labarugi/proses', 'LaporanController@prosesLabaRugiLaporan');
		Route::get('/laporan/labarugi/{bulan}/previewSemua/{dapat}/{keluar}', 'LaporanController@previewSemuaLabaRugi');

		Route::get('/pemberitahuan','HomeUserController@pemberitahuan');
		Route::get('/pemberitahuan/detail/{id}', 'HomeUserController@detailPemberitahuan');

	});				
	
	Route::prefix('user')->group(function(){
		Route::get('/ubahProfile/{kdUser}', 'HomeUserController@editProfile');
		Route::post('/ubahProfile/{kdUser}', 'HomeUserController@simpanProfile');

		// ini pertama gsan nyimpan kode penyimpanan
		Route::get('/detailAlat/{idAlat}', 'BookingController@detailAlat');
		Route::post('/detailAlat/{idAlat}', 'BookingController@simpanBooking');

		// ini gasan myimpan detail alat yg dopinjam
		Route::get('/booking/listalat/{kdSewa}', 'BookingController@listAlatBooking');
		Route::get('/booking/detailalatsewa/{kdSewa}/{idAlat}', 'BookingController@detailAlatSewa');
		Route::post('/booking/detailalatsewa/{kdSewa}/{idAlat}', 'BookingController@detailAlatSewaSimpan');

		Route::get('/booking/keranjang/{idSewa}', 'BookingController@isiKeranjangBooking');
		Route::get('/booking/keranjang/{idSewa}/{alatId}/hapus', 'BookingController@hapusItemUser');
		Route::get('/booking/keranjang/{idSewa}/{alatId}/edit', 'BookingController@editJumlahUser');
		Route::post('/booking/keranjang/{idSewa}/{alatId}/edit', 'BookingController@ubahJumlahUser');

		Route::post('/booking/keranjang/{idSewa}', 'BookingController@simpanTransaksiUser');
		Route::get('/booking/bukti/{idSewa}', 'BookingController@buktiUser');
		Route::get('/booking/bukti/{idSewa}/preview', 'BookingController@previewBuktiUser');

		Route::get('/booking/list/{idPelanggan}', 'BookingController@listUser');
		Route::get('/booking/{kdPinjam}/Batal', 'BookingController@batalUser');
		Route::get('/booking/{kdPinjam}/BatalSimpan', 'BookingController@batalSimpanUser');

		Route::get('/konfirmasi/{kdPinjam}', 'BookingController@konfirmasi');
		Route::post('/konfirmasi/{kdPinjam}', 'BookingController@konfirmasiProses');
	});
});
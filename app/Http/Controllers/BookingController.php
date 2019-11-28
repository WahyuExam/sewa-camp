<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\stok;
use App\model\alat;
use App\model\pinjam;
use App\model\pelanggan;
use App\model\booking;

class BookingController extends Controller
{
	public function detailAlat($idAlat, stok $stok)
    {
        $dataAlats   = $stok->getStokByIdAlat($idAlat);
        $randomAlats = alat::getDataRandom($idAlat);
        
        return view('user.booking.detailAlat', compact('dataAlats', 'randomAlats'));
    }

    public function simpanBooking(Request $req, $idAlat, pinjam $pinjam, stok $stok)
    {
        date_default_timezone_set('Asia/Makassar');
        $this->validate($req,[
            'jmlPinjam' => 'required|numeric'
        ]);

        if ($req->jmlPinjam<1){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Jumlah Pinjam Tidak Boleh Kurang Dari 1']]);  
        };

        // cek ketersediaan stok
        if ($req->jmlPinjam > $req->stokAlat){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Ketersediaan Stok Tidak Mencukupi']]);
        };

        
        // cek jika pelanggan masih memiliki pinjaman
        $status = $pinjam->cekStatusPinjam(session('auth')->id);
        if (!empty($status)){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Pelanggan Masih Memiliki Peralatan Yang Belum Dikembalikan']]);
        };

        // simpan ke dalam table pinjam dengan status booking = 1
        $kdSewa = $pinjam->kode('SWA');
        $pinjam->simpanBooking($req, $kdSewa, session('auth')->id, date('Y-m-d H:i:s'));

        // kurangi stok alat
        $dataStok = $stok->getStokByIdAlat($idAlat);
        $stokBaru = $dataStok->stok - $req->jmlPinjam;
        $stok->ubahStokById($idAlat, $stokBaru);

        // cari id tblsewa
        $dataPinjam = $pinjam->getDataPinjam($kdSewa);
        $cekAlat    = $pinjam->cekDetailAlatKeranjang($req->alatId, $dataPinjam->id);

        if (empty($cekAlat)){
            $pinjam->addKeranjang($req, $dataPinjam->id);
        }
        else{
            $jml = $cekAlat->jml;
            $jml += $req->jmlPinjam;

            $pinjam->ubahJumlah($req->alatId, $dataPinjam->id, $jml);
        };

        // ubah total biaya detail peminjaman
        $data = $pinjam->getDataDetailPinjamByIdsewa($dataPinjam->id, $idAlat);
        $ttlBiaya = $data->biayaSewa * $data->jml;
        $pinjam->ubahTtlbiayaByIdsewa($dataPinjam->id, $idAlat, $ttlBiaya);

        $keranjangs = $pinjam->cekKeranjang($kdSewa);
        $jml = 0;
        foreach($keranjangs as $keranjang){
            $jml += $keranjang->jml;
        };

        $session = $req->session();
        $session->put('jmlKeranjang', $jml);
        $session->put('idSewa',$dataPinjam->id);
        $session->put('kdPinjam',$kdSewa);

        return redirect('/user/booking/listalat/'.$kdSewa)->with('alerts',[['type' => 'success', 'text' => 'Item Sudah Dimasukkan Kedalam Keranjang']]);
    }

    public function listAlatBooking($kdSewa, pinjam $pinjam)
    {
        $dataSewa = $pinjam->getDataPinjam($kdSewa);
        $listAlat = alat::getAllPage();

        return view('user.booking.listAlatSewa', compact('kdSewa', 'dataSewa', 'listAlat'));
    }

    public function isiKeranjangBooking($idSewa, pinjam $pinjam)
    {
        if ($idSewa=='-'){
            return back();
        };

        $keranjangs = $pinjam->getDetailByIdSewa($idSewa);
        
        $total = 0;
        foreach($keranjangs as $keranjang){
            $total += $keranjang->ttlBiaya;
        };

        return view('user.booking.detailSewa', compact('keranjangs', 'total'));
    }

    public function detailAlatSewa($kdSewa, $idAlat, stok $stok)
    {
        $dataAlats   = $stok->getStokByIdAlat($idAlat);
        $randomAlats = alat::getDataRandom($idAlat);
        
        return view('user.booking.detailAlatSewa', compact('kdSewa', 'dataAlats', 'randomAlats'));
    }

    public function detailAlatSewaSimpan(Request $req, $kdSewa, $idAlat, pinjam $pinjam, stok $stok)
    {
        $this->validate($req,[
            'jmlPinjam' => 'required|numeric'
        ]);

        if ($req->jmlPinjam<1){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Jumlah Pinjam Tidak Boleh Kurang Dari 1']]);  
        };

        // cek ketersediaan stok
        if ($req->jmlPinjam > $req->stokAlat){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Ketersediaan Stok Tidak Mencukupi']]);
        };

        // kurangi stok alat
        $dataStok = $stok->getStokByIdAlat($idAlat);
        $stokBaru = $dataStok->stok - $req->jmlPinjam;
        $stok->ubahStokById($idAlat, $stokBaru);

        // cari id tblsewa
        $dataPinjam = $pinjam->getDataPinjam($kdSewa);
        $cekAlat    = $pinjam->cekDetailAlatKeranjang($req->alatId, $dataPinjam->id);

        if (empty($cekAlat)){
            $pinjam->addKeranjang($req, $dataPinjam->id);
        }
        else{
            $jml = $cekAlat->jml;
            $jml += $req->jmlPinjam;

            $pinjam->ubahJumlah($req->alatId, $dataPinjam->id, $jml);
        };

        // ubah total biaya detail peminjaman
        $data = $pinjam->getDataDetailPinjamByIdsewa($dataPinjam->id, $idAlat);
        $ttlBiaya = $data->biayaSewa * $data->jml;
        $pinjam->ubahTtlbiayaByIdsewa($dataPinjam->id, $idAlat, $ttlBiaya);

        $keranjangs = $pinjam->cekKeranjang($req->kdSewa);
        $jml = 0;
        foreach($keranjangs as $keranjang){
            $jml += $keranjang->jml;
        };

        $session = $req->session();
        $session->put('jmlKeranjang', $jml);
        return redirect('/user/booking/listalat/'.$kdSewa)->with('alerts',[['type' => 'success', 'text' => 'Item Sudah Dimasukkan Kedalam Keranjang']]);
    }

    public function hapusItemUser(Request $req, $idSewa, $idAlat, pinjam $pinjam, stok $stok)
    {
        // kembalikan stok alat
        $data         = $pinjam-> getDataDetailPinjamByIdsewa($idSewa, $idAlat);
        $dataStokAlat = $stok->getStokByIdAlat($idAlat);
        $stokBaru     = $dataStokAlat->stok + $data->jml;
        $stok->ubahStokById($idAlat, $stokBaru);

        // hapus item
        $pinjam->hapusItem($idSewa, $idAlat);

        $dataPinjam = $pinjam->getDataByIdSewa($idSewa);
        $keranjangs = $pinjam->cekKeranjang($dataPinjam->kdPinjam);
        $jml = 0;
        foreach($keranjangs as $keranjang){
            $jml += $keranjang->jml;
        };

        $session = $req->session();
        $session->put('jmlKeranjang', $jml);

        return back()->with('alerts',[['type' => 'success', 'text' => 'Item Berhasil Dihapus']]);
    }

    public function editJumlahUser($idSewa, $idAlat, pinjam $pinjam, stok $stok)
    {
        $dataAlats   = $pinjam->getDataUbahJumlah($idSewa, $idAlat);
        $stokAlat    = $stok->getStokByIdAlat($idAlat);

        return view('user.booking.ubahJumlah',compact('dataAlats', 'idSewa', 'idAlat', 'stokAlat'));
    }

    public function ubahJumlahUser(Request $req, $idSewa, $idAlat, pinjam $pinjam, stok $stok)
    {
        $this->validate($req,[
            'jmlPinjam' => 'required|numeric'
        ]);

        if ($req->jmlPinjam<1){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Jumlah Pinjam Tidak Boleh Kurang Dari 1']]);  
        };
        
        // cek ketersediaan stok
        $stokKembali = $req->stokAlat + $req->jmlPinjamLama;
        $stokHilang  = $stokKembali - $req->jmlPinjam; 

        if ($req->jmlPinjam > $stokKembali){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Ketersediaan Stok Tidak Mencukupi']]);
        };

        // update jumlah pinjam
        $jumlah = $req->jmlPinjam;
        $pinjam->updateJumlah($jumlah, $idSewa, $idAlat);   

        // updte totalbiaya
        $data = $pinjam->getDataDetailPinjamByIdsewa($idSewa, $idAlat);
        $ttlBiaya = $data->biayaSewa * $data->jml;
        $pinjam->ubahTtlbiayaByIdsewa($idSewa, $idAlat, $ttlBiaya);

        // update Stok
        $stok->ubahStokById($idAlat, $stokHilang);

        $dataPinjam = $pinjam->getDataByIdSewa($idSewa);
        $keranjangs = $pinjam->cekKeranjang($dataPinjam->kdPinjam);
        $jml = 0;
        foreach($keranjangs as $keranjang){
            $jml += $keranjang->jml;
        };

        $session = $req->session();
        $session->put('jmlKeranjang', $jml);

        return redirect('/user/booking/keranjang/'.$idSewa)->with('alerts',[['type' => 'success', 'text' => 'Jumlah Pinjam Berhasil Diubah']]);
    }

    public function simpanTransaksiUser(Request $req, $idSewa, pinjam $pinjam)
    {
        date_default_timezone_set('Asia/Makassar');
        $this->validate($req,[
            'lamaPinjam'    => 'required|numeric'
        ]);

        $dataPel = pelanggan::getPelangganByKd(session('auth')->kodeUser);
        if (empty($dataPel->alamatPel) || empty($dataPel->noTelpPel)){
            return redirect('/user/ubahProfile/'.session('auth')->kodeUser);
        };

        if ($req->lamaPinjam < 1){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Lama Peminjaman Tidak Boleh Kurang Dari 0']]);
        };
        
        // update lama pinjam
        $pinjam->updateLamaPinjam($idSewa, $req->lamaPinjam);

        // mencari total bayar baru dikali lama pakai
        $dataPinjam = $pinjam->getDetailByIdSewa($idSewa);
        $bayar      = 0;

        foreach($dataPinjam as $pjm){          
            $bayar = $pjm->ttlBiaya * $pjm->lamaPinjam;
            $pinjam->ubahTtlbiayaByIdsewa($idSewa, $pjm->alatId, $bayar);
        };

        $dataPinjam = $pinjam->getDetailByIdSewa($idSewa);
        $total = 0;
        foreach($dataPinjam as $pjmm){          
            $total += $pjmm->ttlBiaya;
        };        

        $pinjam->updateTtlBayar($idSewa, $total);
        session()->forget('jmlKeranjang');
        session()->forget('kdPinjam');
        session()->forget('idSewa');

        $dataBooking = $pinjam->jmlBooking(session('auth')->id);
        $session = $req->session();
        $session->put('jmlBooking',count($dataBooking));
        
        $sewa = $pinjam-> getDataByIdSewa($idSewa);
        $pesan = 'Transaksi Peminjaman Online Berhasil Dilakukan, Kode Sewa ('.$sewa->kdPinjam.'), Nama Penyewa ('.session('auth')->nmPelanggan.'), Alamat ('.session('auth')->alamatPel.'), No. Telp ('.session('auth')->noTelpPel.'), Status Pembayaran (Belum Dikonfirmasi Pelanggan)';
        $pinjam->simpanPemberitahuan(date('Y-m-d H:i:s'), $pesan);

        return redirect('/user/booking/bukti/'.$idSewa);
    }

    public function buktiUser($idSewa, pinjam $pinjam)
    {
        $keranjangs = $pinjam->getDetailByIdSewa($idSewa);
        $item = 0;
        foreach($keranjangs as $keranjang){
            $item += $keranjang->jml;
        };

        return view('user.booking.buktiUser', compact('keranjangs', 'item'));
    }

    public function previewBuktiUser($idSewa, pinjam $pinjam)
    {
        $keranjangs = $pinjam->getDetailByIdSewa($idSewa);
        $item = 0;
        foreach($keranjangs as $keranjang){
            $item += $keranjang->jml;
        };
        
        return view('user.booking.preview', compact('keranjangs', 'item'));
    }

    public function listUser(Request $req, $idPelanggan, pinjam $pinjam, stok $stok)
    {
        $listBooking = $pinjam->getDataByStatusBooking($idPelanggan);
        // dd($listBooking);
        foreach ($listBooking as $booking){
            date_default_timezone_set('Asia/Makassar');
            $awal     = date_create($booking->tglPinjam);
            $akhir    = date_create(); // waktu sekarang
            $diff     = date_diff( $awal, $akhir );   
            // dd($diff->h);
            if ($diff->h >= 2 && $booking->statusBayar==0){
                $dataPinjam = $pinjam->getDataPinjamByKdPinjam($booking->kdPinjam);
                $cekData = $pinjam->cekDetailPinjamByIdSewa($dataPinjam->id);
                if (!empty($cekData)){
                    $dataPinjam = $pinjam->getDetailByIdSewa($dataPinjam->id);
                    $stokBaru   = 0;
                    foreach($dataPinjam as $pjm){
                        $dataAlat = $stok->getStokByIdSederhana($pjm->alatId);

                        $stokBaru = $pjm->jml + $dataAlat->stok;
                        $stok->ubahStokById($pjm->alatId, $stokBaru);
                    };
                };       

                $pinjam->batalPinjam($dataPinjam[0]->pinjamId);
                
                session()->forget('jmlBooking');
                $dataBooking = $pinjam->jmlBooking(session('auth')->id);
                $session = $req->session();
                $session->put('jmlBooking',count($dataBooking));
                $listBooking = $pinjam->getDataByStatusBooking($idPelanggan); 
            }
        }
        return view('user.booking.listBooking',compact('listBooking'));
    }

    public function batalUser(Request $req, $kdPinjam, pinjam $pinjam, stok $stok)
    {
        date_default_timezone_set('Asia/Makassar');
        if (!empty(session('idSewa'))){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Anda Masih Memiliki Transaksi Yang Masih Berjalan, Batalkan Proses Sebelumnya Untuk Melanjutkan Proses Ini.']]);
        };

        $dataPinjam = $pinjam->getDataPinjamByKdPinjam($kdPinjam);
        $cekData = $pinjam->cekDetailPinjamByIdSewa($dataPinjam->id);
        if (!empty($cekData)){
            $dataPinjam = $pinjam->getDetailByIdSewa($dataPinjam->id);
            $stokBaru   = 0;
            foreach($dataPinjam as $pjm){
                $dataAlat = $stok->getStokByIdSederhana($pjm->alatId);

                $stokBaru = $pjm->jml + $dataAlat->stok;
                $stok->ubahStokById($pjm->alatId, $stokBaru);
            };
        };        
        
        // keranjang
        // $dataPinjam = $pinjam->getDataByIdSewa($idSewa);
        $keranjangs = $pinjam->cekKeranjang($kdPinjam);
        $jml = 0;
        foreach($keranjangs as $keranjang){
            $jml += $keranjang->jml;
        };

        session()->forget('jmlKeranjang');
        $pinjam->batalPinjam($dataPinjam[0]->pinjamId);
        
        $dataBooking = $pinjam->jmlBooking(session('auth')->id);
        $session = $req->session();
        $session->put('jmlBooking',count($dataBooking));

        $pesan = 'Transaksi Peminjaman Dibatalkan, Kode Sewa ('.$kdPinjam.'), Nama Penyewa ('. session('auth')->nmPelanggan.'), Alamat ('.session('auth')->alamatPel.'), No. Telp ('.session('auth')->noTelpPel.'), Status (Peminjaman Dibatalkan)';
        $pinjam->simpanPemberitahuan(date('Y-m-d H:i:s'), $pesan);

        return back()->with('alerts',[['type' => 'success', 'text' => 'Sukses Melakukan Pembatalan Transaksi']]);
    }

    public function batalSimpanUser(Request $req, $kdPinjam, pinjam $pinjam, stok $stok)
    {
        $dataPinjam = $pinjam->getDataPinjamByKdPinjam($kdPinjam);
        $cekData = $pinjam->cekDetailPinjamByIdSewa($dataPinjam->id);
        if (!empty($cekData)){
            $dataPinjam = $pinjam->getDetailByIdSewa($dataPinjam->id);
            $stokBaru   = 0;
            foreach($dataPinjam as $pjm){
                $dataAlat = $stok->getStokByIdSederhana($pjm->alatId);

                $stokBaru = $pjm->jml + $dataAlat->stok;
                $stok->ubahStokById($pjm->alatId, $stokBaru);
            };
        };        
        
        
        $dataBooking = $pinjam->jmlBooking(session('auth')->id);
        $session = $req->session();
        session()->put('jmlBooking',count($dataBooking));
        
        session()->forget('jmlKeranjang');
        session()->forget('idSewa');
        session()->forget('kdPinjam');

        $pinjam->batalPinjam($dataPinjam[0]->pinjamId);
        return redirect('/');
    }

    public function konfirmasi($kdPinjam)
    {
        return view('user.booking.konfirmasiForm');
    }

    public function konfirmasiProses(Request $req, $kdPinjam, booking $booking, pinjam $pinjam)
    {
        date_default_timezone_set('Asia/Makassar');
        $this->validate($req,[
            'tglBayar'  => 'required',
            'bukti'     => 'required'
        ]);

        $foto       = $req->file('bukti');
        $namaFoto   = $foto->getClientOriginalName();
        $namaAsli   = $kdPinjam.$namaFoto; 

        $foto->storeAs('/public/bukti',$namaAsli);
        $booking->simpanKonfirmasi($kdPinjam, $req, $namaAsli);

        $pesan = 'Transaksi Peminjaman Online Berhasil Dilakukan, Kode Sewa ('.$kdPinjam.'), Nama Penyewa ('. session('auth')->nmPelanggan.'), Alamat ('.session('auth')->alamatPel.'), No. Telp ('.session('auth')->noTelpPel.'), Status Pembayaran (Pelanggan Sudah Melakukan Transfer Pembayaran dan Konfirmasi)';
        $pinjam->simpanPemberitahuan(date('Y-m-d H:i:s'), $pesan);
        
        return redirect('/user/booking/list/'.session('auth')->id)->with([['type' => 'success', 'text' => 'Konfirmasi Pembayaran Berhasil Diproses']]);
    }
}

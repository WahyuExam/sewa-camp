<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\pinjam;
use App\model\pelanggan;
use App\model\alat;
use App\model\stok;

class PinjamController extends Controller
{
    public function listPinjam(Request $req, pinjam $pinjam)
    {
    	$listPinjam = $pinjam->getAllPage(date('Y-m-d'));
    	if ($req->has('q')){
    		$cari = $req->input('q');
    		$listPinjam = $pinjam->getPage($cari, date('Y-m-d'));
    	};
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.pinjam.list',compact('listPinjam', 'jmlPemberitahuan'));
    }

    public function formOffline($tgl, pinjam $pinjam)
    {
    	$kode       = $pinjam->kode('SWA');
    	$pelanggans = pelanggan::getAllPelanggan();
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.pinjam.formOffline',compact('tgl', 'kode', 'pelanggans', 'jmlPemberitahuan'));
    }

    public function simpanFormOffline(Request $req, pinjam $pinjam)
    {
        $this->validate($req,[
            'pelanggan' => 'required',
            'jaminan'   => 'required',
            'noJaminan' => 'required',
            'lamaPinjam'=> 'required|numeric'
        ]);

        // cek status Pinjam Pelanggan
        $status = $pinjam->cekStatusPinjam($req->pelanggan);
        if (!empty($status)){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Pelanggan Masih Memiliki Peralatan Yang Belum Dikembalikan']]);
        };

        // simpan data sewa
        $pinjam->simpanPinjam($req, session('auth')->kodeUser, date('Y-m-d'));
        
        $keranjangs = $pinjam->cekKeranjang($req->kdSewa);
        $jml = 0;
        foreach($keranjangs as $keranjang){
            $jml += $keranjang->jml;
        };

        $dataPinjam = $pinjam->getDataPinjam($req->kdSewa);

        $session = $req->session();
        $session->put('jmlKeranjang', $jml);
        $session->put('idSewa',$dataPinjam->id);

        return redirect('/admin/pinjam/listalat/'.$req->kdSewa);
    }

    public function listAlatPinjam($kdSewa, pinjam $pinjam)
    {
        $dataSewa = $pinjam->getDataPinjam($kdSewa);
        $listAlat = alat::getAllPage();
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.pinjam.listAlat', compact('dataSewa', 'listAlat', 'jmlPemberitahuan'));
    }

    public function batalPinjam($idSewa, pinjam $pinjam, stok $stok)
    {
        $cekData = $pinjam->cekDetailPinjamByIdSewa($idSewa);
        if (!empty($cekData)){
            $dataPinjam = $pinjam->getDetailByIdSewa($idSewa);
            $stokBaru   = 0;
            foreach($dataPinjam as $pjm){
                $dataAlat = $stok->getStokByIdSederhana($pjm->alatId);

                $stokBaru = $pjm->jml + $dataAlat->stok;
                $stok->ubahStokById($pjm->alatId, $stokBaru);
            };
        };        

        $pinjam->batalPinjam($idSewa);
        return redirect('/admin/pinjam/list/'.date('Y-m-d'));
    }

    public function detailAlatOffline($kdSewa, $idAlat, stok $stok)
    {
        $dataAlats   = $stok->getStokByIdAlat($idAlat);
        $randomAlats = alat::getDataRandom($idAlat);

        return view('admin.pinjam.detailAlat', compact('dataAlats', 'randomAlats', 'kdSewa'));
    }

    public function tambahKeranjang(Request $req, $kdSewa, $idAlat, pinjam $pinjam, stok $stok)
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
        $ttlBiaya = ($data->biayaSewa * $data->jml) * $data->lamaPinjam;
        $pinjam->ubahTtlbiayaByIdsewa($dataPinjam->id, $idAlat, $ttlBiaya);

        $keranjangs = $pinjam->cekKeranjang($req->kdSewa);
        $jml = 0;
        foreach($keranjangs as $keranjang){
            $jml += $keranjang->jml;
        };

        $session = $req->session();
        $session->put('jmlKeranjang', $jml);

        return redirect('/admin/pinjam/listalat/'.$kdSewa)->with('alerts',[['type' => 'success', 'text' => 'Item Sudah Dimasukkan Kedalam Keranjang']]);
    }

    public function isiKeranjang($idSewa, pinjam $pinjam)
    {
        $keranjangs = $pinjam->getDetailByIdSewa($idSewa);
        
        $total = 0;
        foreach($keranjangs as $keranjang){
            $total += $keranjang->ttlBiaya;
        };

        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.pinjam.detailSewa', compact('keranjangs', 'total', 'jmlPemberitahuan'));
    }

    public function hapusItem(Request $req, $idSewa, $idAlat, pinjam $pinjam, stok $stok)
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

    public function editJumlah($idSewa, $idAlat, pinjam $pinjam, stok $stok)
    {
        $dataAlats   = $pinjam->getDataUbahJumlah($idSewa, $idAlat);
        $stokAlat    = $stok->getStokByIdAlat($idAlat);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.pinjam.ubahJumlah',compact('dataAlats', 'idSewa', 'idAlat', 'stokAlat', 'jmlPemberitahuan'));
    }

    public function ubahJumlah(Request $req, $idSewa, $idAlat, pinjam $pinjam, stok $stok)
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
        $ttlBiaya = ($data->biayaSewa * $data->jml) * $data->lamaPinjam;
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

        return redirect('/admin/pinjam/keranjang/'.$idSewa)->with('alerts',[['type' => 'success', 'text' => 'Jumlah Pinjam Berhasil Diubah']]);
    }

    public function simpanTransaksi(Request $req, $idSewa, pinjam $pinjam)
    {
        $pinjam->updateStatusTtlBayar($idSewa, $req->total);
        session()->forget('jmlKeranjang');
        return redirect('/admin/pinjam/bukti/'.$idSewa);
    }

    public function bukti($idSewa, pinjam $pinjam)
    {
        $keranjangs = $pinjam->getDetailByIdSewa($idSewa);
        $item = 0;
        foreach($keranjangs as $keranjang){
            $item += $keranjang->jml;
        };
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.pinjam.bukti', compact('keranjangs', 'item', 'jmlPemberitahuan'));
    }

    public function previewBukti($idSewa, pinjam $pinjam)
    {
        $keranjangs = $pinjam->getDetailByIdSewa($idSewa);
        $item = 0;
        foreach($keranjangs as $keranjang){
            $item += $keranjang->jml;
        };
        
        return view('admin.pinjam.preview', compact('keranjangs', 'item'));
    }
}

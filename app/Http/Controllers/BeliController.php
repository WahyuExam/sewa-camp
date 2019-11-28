<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\suplier;
use App\model\alat;
use App\model\beli;
use App\model\stok;
use App\model\pinjam;

class BeliController extends Controller
{
    public function list (Request $req, $tgl, beli $beli, pinjam $pinjam)
    {
    	$listBeli = $beli->getAllDataTgl($tgl);
    	if($req->has('q')){
    		$cari 	  = $req->input('q');
    		$listBeli = $beli->getAllDataTglCari($tgl, $cari); 
    	}
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.beli.list',compact('listBeli', 'jmlPemberitahuan'));
    }

    public function form($tgl, beli $beli, pinjam $pinjam)
    {
    	// hapus kode beli yg ttlBayarnya null atau kosong
        $beli-> hapusNull();        
        $kode     = $beli->kode('BLI');
    	$supliers = suplier::getSuplier();
    	$alats    = alat::getAlat();
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.beli.form', compact('supliers', 'alats', 'kode', 'jmlPemberitahuan'));
    }

    public function simpanForm(Request $req, beli $beli)
    {
        $this->validate($req,[
            'suplier'   => 'required',
            'alat'      => 'required',
            'hargaBeli' => 'required|numeric',
            'jmlBeli'   => 'required|numeric'
        ]);

        $beli->simpanBeli($req);

        $dataBeli = $beli->getBeliByKdBeli($req->kdBeli);
        $sub = $req->hargaBeli * $req->jmlBeli;
        $beli->simpanDetail($dataBeli->id, $req, $sub);

        return redirect('/admin/beli/proses/'.date('Y-m-d').'/'.$dataBeli->kdBeli);
    }

    public function formProses($tgl, $kdBeli, beli $beli, pinjam $pinjam)
    {
        $alats    = alat::getAlat();
        $supliers = suplier::getSuplier();
        $dataBeli = $beli->getBeliByKdBeli($kdBeli);
        $detailBeli = $beli->getDetailbeliById($dataBeli->id);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        $totalBeli = 0;
        foreach($detailBeli as $bli){
            $totalBeli += $bli->sub;
        }
        
        return view('admin.beli.formProses',compact('kdBeli', 'alats', 'dataBeli', 'supliers', 'detailBeli', 'totalBeli', 'jmlPemberitahuan'));
    }

    public function batalBeli($kdBeli, beli $beli)
    {   
        $beli->batalBeli($kdBeli);
        return redirect('/admin/beli/list/'.date('Y-m-d'))->with('alerts',[['type' => 'success', 'text' => 'Transaksi Dibatalkan']]);
    }

    public function SimpanFormProses(Request $req, beli $beli)
    {
        $this->validate($req,[
            'alat'      => 'required',
            'hargaBeli' => 'required|numeric',
            'jmlBeli'   => 'required|numeric'
        ]);
        
        // alat sudah ada
        $dataBeli = $beli->getBeliByKdBeli($req->kdBeli);
        $alatAda = $beli->alatAda($dataBeli->id, $req->alat);      
        if(count($alatAda)>0){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Item Sudah Ada, Hapus Item Jika Ingin Melakukan Update Item']]);
        }

        $dataBeli = $beli->getBeliByKdBeli($req->kdBeli);
        $sub = $req->hargaBeli * $req->jmlBeli;
        $beli->simpanDetail($dataBeli->id, $req, $sub);

        return back()->with('alerts',[['type' => 'success', 'text' => 'Item Berhasil Ditambahkan']]);
    }

    public function hapusItemBeli($idBeli, $idAlat, beli $beli)
    {
        $beli->hapusItem($idBeli, $idAlat);
        return back()->with('alerts',[['type' => 'success', 'text' => 'Item Sudah Dihapus']]);
    }

    public function selesai($idBeli, beli $beli, stok $stok)
    {
        $data     = $beli->getBeliByKdBeli($idBeli);
        $dataBeli = $beli->getDetailbeliById($data->id);

        $totalBeli = 0;
        foreach($dataBeli as $bli){
            $totalBeli += $bli->sub;
        };

        // update ttlBeli
        $beli->updateTtlBeli($data->id, $totalBeli);

        // tambahkan stok
        $stokBaru   = 0;
        foreach($dataBeli as $bli){
            $dataAlat = $stok->getStokByIdSederhana($bli->alatId);
            if (!empty($dataAlat)){
                $stokBaru = $bli->jmlBeli + $dataAlat->stok;
                $stok->ubahStokById($bli->alatId, $stokBaru);
            }
            else{
                // simpan ke tabel stok
                $denda    = $bli->hargaBeli - ($bli->hargaBeli * (50/100));
                $stok->simpanStokBeli($bli->alatId, $bli->jmlBeli, $bli->hargaBeli, $denda);
            }

        };

        return redirect('/admin/beli/list/'.date('Y-m-d'))->with('alerts',[['type' => 'success', 'text' => 'Transaksi Berhasil Disimpan']]);
    }

    public function detail($idBeli, beli $beli, pinjam $pinjam)
    {
        $dataBeli   = $beli->getBeliByIdBeli($idBeli);
        $detailBeli = $beli->getDetailbeliById($idBeli);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.beli.detail',compact('detailBeli', 'dataBeli', 'jmlPemberitahuan'));
    }
}

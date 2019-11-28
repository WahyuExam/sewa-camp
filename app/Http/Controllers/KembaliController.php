<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\alat;
use App\model\kembali;
use App\model\pinjam;
use App\model\stok;
use App\model\karyawan;
use App\model\AlatRusak;

class KembaliController extends Controller
{
    public function listKembali(Request $req, kembali $kembali, $tgl, pinjam $pinjam)
    {
    	$listPinjam = $kembali->getAllData($tgl);

    	if ($req->has('q')){
    		$cari = $req->input('q');
    		$listPinjam = $kembali->getAllDataCari($tgl, $cari);
    	};
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

     	return view('admin.kembali.list',compact('listPinjam', 'jmlPemberitahuan'));
    }

    public function formKembali($kdPinjam, pinjam $pinjam, kembali $kembali)
    {
    	$kode		= $kembali->kode('KBI');
    	$dataPinjam = $pinjam->getDataPinjamByKdPinjam($kdPinjam);
    	$pinjams    = $pinjam->getDetailByIdSewa($dataPinjam->id);

    	$awal 		= date_create($dataPinjam->tglPinjam);
        $akhir		= date_create(); // waktu sekarang
        $diff  		= date_diff( $awal, $akhir ); 	
        $durasi 	= $diff->d;
        $lamaDenda  = 0;

        if ($durasi>$dataPinjam->lamaPinjam){
        	$lamaDenda 	= $durasi - $dataPinjam->lamaPinjam;
            
            $denda = 0;
            foreach($pinjams as $pjm){
                $alats  = alat::getAlatByKode($pjm->kdAlat); 
                $denda = ($pjm->biayaDenda * $pjm->jml) * $lamaDenda;
            	$pinjam->updateDenda($dataPinjam->id, $alats->id, $denda);
            };	
        }
        else{
            $denda = 0;
            foreach($pinjams as $pjm){
                $alats  = alat::getAlatByKode($pjm->kdAlat); 
                $pinjam->updateDenda($dataPinjam->id, $alats->id, $denda);
            };   
        }
        
        $ttlDenda = 0;
        $item 	  = 0;
        $rusak    = 0;

        $pinjams = $pinjam->getDetailByIdSewa($dataPinjam->id);
		foreach($pinjams as $pjmm){
			$ttlDenda += $pjmm->ttlDenda;
			$item     += $pjmm->jml;
            $rusak    += $pjmm->ttlDendaHilang;
		};

        $totalBayar = $ttlDenda + $rusak;
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.kembali.form', compact('pinjams', 'lamaDenda', 'ttlDenda', 'durasi', 'item', 'kode', 'rusak', 'totalBayar', 'rusak', 'jmlPemberitahuan'));
    }

    public function simpanFormKembali(Request $req, $kdPinjam, kembali $kembali, pinjam $pinjam)
    {
    	
        // simpan ke table kembali dan ubah status sewa
    	// $karyawans = karyawan::getDataByKd(session('auth')->idKaryawan);
    	// $kembali->simpanKembali($req, $karyawans->id);
    	// $kembali->ubahStatusSewaKembali($req->pinjamId);

    	// ubah stok
    	// $data = $pinjam->getDataPinjam($kdPinjam);
	    // $dataPinjam = $pinjam->getDetailByIdSewa($data->id);
     //    $stokBaru   = 0;
     //    foreach($dataPinjam as $pjm){
     //        $dataAlat = $stok->getStokByIdSederhana($pjm->alatId);

     //        $stokBaru = $pjm->jml + $dataAlat->stok;
     //        $stok->ubahStokById($pjm->alatId, $stokBaru);
     //    };        


        $dataPinjam  = $pinjam->getDataPinjam($kdPinjam);
        $kembalis    = $pinjam->getStsKembaliByIdSewa($dataPinjam->id);
      
        if(count($kembalis)<>0){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Masih Ada Perlatan Yang Belum Diproses Kembali']]);            
        }
        else{
            $karyawans = karyawan::getDataByKd(session('auth')->idKaryawan);
            $kembali->simpanKembali($req, $karyawans->id);
            $kembali->ubahStatusSewaKembali($req->pinjamId);
    	    
            // return redirect('/admin/kembali/list/'.date('Y-m-d'))->with('alerts',[['type' => 'success', 'text' => 'Pengembalian Peralatan Sukses']]); 
            return redirect('/admin/kembali/preview/'.$kdPinjam);
        }

    } 

    public function formProsesKembali($kdPinjam, $alatId, pinjam $pinjam)
    {
        $dataPinjam = $pinjam->getDataPinjamByKdPinjam($kdPinjam);
        $pinjams    = $pinjam->getSingleDataByIdSewa($dataPinjam->id, $alatId);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.kembali.proses',compact('pinjams', 'jmlPemberitahuan'));
    }

    public function formProsesKembaliSimpan(Request $req, $kdPinjam, $alatId, pinjam $pinjam, stok $stok, AlatRusak $alatRusak, kembali $kembali)
    {
        $this->validate($req,[
            'alatRusak'      => 'required|numeric',
            'biayaAlatRusak' => 'required|numeric'
        ]);

        $alats = alat::getAlatByKode($alatId);

        // simpan alat rusak 
        $alatRusak->simpanAlatRusak($alats->id, $req->alatRusak, date('Y-m-d'), 'Barang Hilang / Rusak Dari Pelaggan');
        
        // $cekAlatRusak = $alatRusak->cekALatRusakByIdAlat($alats->id);
        // if(count($cekAlatRusak)==0){
        //     $alatRusak->simpanAlatRusak($alats->id, $req->alatRusak);
        // }  
        // else{
        //     $alatRusaks = $alatRusak->getDataRusakByIdAlat($alats->id);
        //     $ttlAlatRusak = $alatRusaks->jmlRusak + $req->alatRusak;
        //     $alatRusak->updateJmlRusakByAlat($alats->id, $ttlAlatRusak);
        // }

        // update stok alat yg tidak rusak
        $dataAlat = $stok->getStokByIdSederhana($alats->id);
        $stokBaru = $dataAlat->stok + $req->alatBaik;
        $stok->ubahStokById($alats->id, $stokBaru);   

        $data = $pinjam->getDataPinjam($kdPinjam);
        $pinjam->updateStsKembali($data->id, $alats->id); 
        $pinjam->updateDendaHilang($req, $data->id, $alats->id, $req->ttlBiayaAlatRusak);

        return redirect('/admin/kembali/'.$kdPinjam.'/form')->with('alert',[['type' => 'success', 'text' => 'Data Berhasil Diproses']]);

    }

    public function preview($kdPinjam, pinjam $pinjam){
        $dataPinjam = $pinjam->getDataPinjamByKdPinjam($kdPinjam);
        $pinjams    = $pinjam->getDetailByIdSewa($dataPinjam->id);

        $awal       = date_create($dataPinjam->tglPinjam);
        $akhir      = date_create(); // waktu sekarang
        $diff       = date_diff( $awal, $akhir );   
        $durasi     = $diff->d;
        $lamaDenda  = 0;

        if ($durasi>$dataPinjam->lamaPinjam){
            $lamaDenda  = $durasi - $dataPinjam->lamaPinjam;
            
            $denda = 0;
            foreach($pinjams as $pjm){
                $alats  = alat::getAlatByKode($pjm->kdAlat); 
                $denda = ($pjm->biayaDenda * $pjm->jml) * $lamaDenda;
                $pinjam->updateDenda($dataPinjam->id, $alats->id, $denda);
            };  
        }
        else{
            $denda = 0;
            foreach($pinjams as $pjm){
                $alats  = alat::getAlatByKode($pjm->kdAlat); 
                $pinjam->updateDenda($dataPinjam->id, $alats->id, $denda);
            };   
        }
        
        $ttlDenda = 0;
        $item     = 0;
        $rusak    = 0;

        $pinjams = $pinjam->getDetailByIdSewa($dataPinjam->id);
        foreach($pinjams as $pjmm){
            $ttlDenda += $pjmm->ttlDenda;
            $item     += $pjmm->jml;
            $rusak    += $pjmm->ttlDendaHilang;
        };

        $totalBayar = $ttlDenda + $rusak;
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.kembali.previewKembali', compact('pinjams', 'lamaDenda', 'ttlDenda', 'durasi', 'item', 'kode', 'rusak', 'totalBayar', 'rusak', 'kdPinjam', 'jmlPemberitahuan'));
    }

     public function previewCetak($kdPinjam, pinjam $pinjam){
        $dataPinjam = $pinjam->getDataPinjamByKdPinjam($kdPinjam);
        $pinjams    = $pinjam->getDetailByIdSewa($dataPinjam->id);

        $awal       = date_create($dataPinjam->tglPinjam);
        $akhir      = date_create(); // waktu sekarang
        $diff       = date_diff( $awal, $akhir );   
        $durasi     = $diff->d;
        $lamaDenda  = 0;

        if ($durasi>$dataPinjam->lamaPinjam){
            $lamaDenda  = $durasi - $dataPinjam->lamaPinjam;
            
            $denda = 0;
            foreach($pinjams as $pjm){
                $alats  = alat::getAlatByKode($pjm->kdAlat); 
                $denda = ($pjm->biayaDenda * $pjm->jml) * $lamaDenda;
                $pinjam->updateDenda($dataPinjam->id, $alats->id, $denda);
            };  
        }
        else{
            $denda = 0;
            foreach($pinjams as $pjm){
                $alats  = alat::getAlatByKode($pjm->kdAlat); 
                $pinjam->updateDenda($dataPinjam->id, $alats->id, $denda);
            };   
        }
        
        $ttlDenda = 0;
        $item     = 0;
        $rusak    = 0;

        $pinjams = $pinjam->getDetailByIdSewa($dataPinjam->id);
        foreach($pinjams as $pjmm){
            $ttlDenda += $pjmm->ttlDenda;
            $item     += $pjmm->jml;
            $rusak    += $pjmm->ttlDendaHilang;
        };

        $totalBayar = $ttlDenda + $rusak;

        return view('admin.kembali.preview', compact('pinjams', 'lamaDenda', 'ttlDenda', 'durasi', 'item', 'kode', 'rusak', 'totalBayar', 'rusak'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\AlatRusak;
use App\model\alat;
use App\model\stok;
use App\model\pinjam;

class AlatRusakController extends Controller
{
    public function list(Request $req, $bulan, AlatRusak $alatRusak, pinjam $pinjam)
    {
    	$listAlatRusak = $alatRusak->getAllData($bulan);
    	if($req->has('q')){
    		$cari = $req->input('q');
    		$listAlatRusak = $alatRusak->getAllDataCari($bulan, $cari);	
    	};
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.alatRusak.list',compact('listAlatRusak', 'bulan', 'jmlPemberitahuan'));
    }

    public function form(pinjam $pinjam)
    {
    	$listAlat = alat::getAlat();
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.alatRusak.form',compact('listAlat', 'jmlPemberitahuan'));
    }

    public function formSimpan(Request $req, AlatRusak $alatRusak, stok $stok)
    {
    	$this->validate($req,[
    		'alat'			=> 'required',
    		'jmlRusak'		=> 'required|numeric',
    		'ketAlatRusak'	=> 'required'
    	]);

    	// kurangi stok
    	$dataAlat = $stok->getStokByIdSederhana($req->alat);
        $stokBaru = $dataAlat->stok - $req->jmlRusak;
        $stok->ubahStokById($req->alat, $stokBaru);

    	$alatRusak->simpanAlatRusak($req->alat, $req->jmlRusak, date('Y-m-d'), $req->ketAlatRusak);
    	return redirect('/admin/alatrusak/list/'.date('Y-m'))->with('alerts',[['type' => 'success', 'text' => 'Data Berhasil Disimpan']]);
    }

    public function detail($alatId, $bulan, AlatRusak $alatRusak, pinjam $pinjam)
    {
    	$alatRusaks = $alatRusak->detail($alatId, $bulan);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.alatRusak.detail',compact('alatRusaks', 'jmlPemberitahuan'));
    }
}

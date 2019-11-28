<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\stok;
use App\model\pinjam;

class StokController extends Controller
{
    public function listStok(Request $req, stok $stok, pinjam $pinjam)
    {
    	$listAlat = $stok->getAllStok();

    	if ($req->has('q')){
    		$cari = $req->input('q');
    		$listAlat = $stok->getAllStokCari($cari);
    	};
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.stok.list', compact('listAlat', 'jmlPemberitahuan'));
    }

    public function formStok($idAlat, stok $stok, pinjam $pinjam)
    {
    	$dataAlats = $stok->getStokByIdAlat($idAlat);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.stok.form',compact('dataAlats', 'jmlPemberitahuan'));
    }

    public function simpanFormStok(Request $req, $idAlat, stok $stok)
    {
    	$this->validate($req,[
    		'biayaSewa'	=> 'required|numeric',
    		'stokAlat'	=> 'required|numeric'
    	]);

    	$denda = $req->biayaSewa - ($req->biayaSewa * (50/100));
    	$stok->simpanStok($req, $idAlat, $denda);

    	return redirect('/admin/stok/list')->with('alerts',[['type' => 'success', 'text' => 'Data Berhasil Diperbarui']]);
    }

    public function editStok($idAlat, stok $stok, pinjam $pinjam)
    {
    	$dataAlats = $stok->getStokByIdAlat($idAlat);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.stok.edit',compact('dataAlats', 'jmlPemberitahuan'));
    }

    public function simpanEditStok(Request $req, $idAlat, stok $stok)
    {
    	$this->validate($req,[
    		'biayaSewa'	=> 'required|numeric',
    		'stokAlat'	=> 'numeric'
    	]);

    	$denda    = $req->biayaSewa - ($req->biayaSewa * (50/100));
    	$stokBaru = $req->stokAlatLama + $req->stokAlat;

    	$stok->ubahStok($req, $idAlat, $denda, $stokBaru);

    	return redirect('/admin/stok/list')->with('alerts',[['type' => 'success', 'text' => 'Data Berhasil Diperbarui']]);
    }
}

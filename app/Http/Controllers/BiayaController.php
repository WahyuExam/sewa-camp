<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\biaya;
use App\model\pinjam;

class BiayaController extends Controller
{
    public function listBiaya($tgl, biaya $biaya, pinjam $pinjam)
    {
    	$listBiaya = $biaya->getOperasionalTgl($tgl);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.biaya.list',compact('listBiaya', 'jmlPemberitahuan'));
    }

    public function prosesForm(biaya $biaya, $tgl)
    {
    	$kode = $biaya->kode('OPR');

    	// simpan ketabel operasional
    	$biaya->simpanOperasional($kode, date('Y-m-d'));
    	return redirect('/admin/biaya/formOperasional/'.$kode);	
    }

    public function formOperasional($kdOperasional, biaya $biaya, pinjam $pinjam)
    {
    	$getId 			= $biaya->getOperasionalByKd($kdOperasional);
    	$listDetail 	= $biaya->getDetailById($getId->id);
 		$idOperasional	= $getId->id;

 		$ttlBiaya = 0;
 		foreach($listDetail as $det){
 			$ttlBiaya += $det->biaya;
 		};
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

 		return view('admin.biaya.form',compact('kdOperasional', 'listDetail', 'ttlBiaya', 'idOperasional', 'jmlPemberitahuan'));
    }

    public function batalTransaksi($kdOperasional, biaya $biaya)
    {
    	$biaya->batal($kdOperasional);
    	return redirect('/admin/biaya/list/'.date('Y-m-d'));
    }

    public function simpanDetail(Request $req, biaya $biaya)
    {
    	$this->validate($req,[
    		'ket'	=> 'required',
    		'biaya'	=> 'required|numeric'
    	]);

    	$idOperasional = $req->idOperasional;
    	$cekNama = $biaya->cekNama($idOperasional, $req->ket);
   
    	if (empty($cekNama)){
    		$biaya->simpanDetail($idOperasional,$req);
    	}
    	else{
    		$total = $cekNama->biaya + $req->biaya;
    		$biaya->ubahBiaya($idOperasional, $req->ket, $total);
    	};

    	$details 	   = $biaya->getDetailById($idOperasional);
    	$total  = 0;
    	foreach($details as $detail){
    		$total += $detail->biaya; 
    	};
    	$biaya->updateTotalBiaya($idOperasional, $total);
    	return back()->with('alerts',[['type' => 'success', 'text' => 'Data Sudah Disimpan']]);
    }

    public function hapusItem($idOperasional, $id, biaya $biaya)
    {
    	$biaya->hapusItem($idOperasional, $id);

    	$details 	   = $biaya->getDetailById($idOperasional);
    	$total  = 0;
    	foreach($details as $detail){
    		$total += $detail->biaya; 
    	};
    	$biaya->updateTotalBiaya($idOperasional, $total);
    	return back()->with('alerts',[['type' => 'success', 'text' => 'Item Sudah Dihapus']]);
    }

    public function hapusTransaski($idOperasional, biaya $biaya)
    {
    	$biaya->hapusTransaksi($idOperasional);
    	return back()->with('alerts',[['type' => 'success', 'text' => 'Data Berhasil Dihapus']]);
    }

    public function detail($idOperasional, biaya $biaya)
    {   
        $dataBiaya  = $biaya->getBiayaById($idOperasional);
        $listDetail = $biaya->getDetailById($idOperasional);

        return view('admin.biaya.detail',compact('dataBiaya', 'listDetail'));
    }
}

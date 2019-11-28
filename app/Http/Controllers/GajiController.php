<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\karyawan;
use App\model\gaji;
use App\model\pinjam;

class GajiController extends Controller
{
    public function listGaji($tgl, gaji $gaji, pinjam $pinjam)
    {	
    	$listGaji = $gaji->getListGaji($tgl);
    	$listKaryawan = karyawan::getKaryawan();
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.gaji.list',compact('listGaji', 'listKaryawan', 'jmlPemberitahuan'));
    }

    public function simpanGaji(Request $req, gaji $gaji, $tgl)
    {
    	$this->validate($req,[
    		'nmKar'	=> 'required',
    		'gaji'  => 'required|numeric'
    	]);

    	$sudahDiGaji = $gaji->sudahDiGaji($tgl, $req->nmKar);
    	if (!empty($sudahDiGaji)){
    		$gaji->ubahGaji($tgl, $req);
    		return back()->with('alerts',[['type' => 'success', 'text' => 'Gaji Berhasil Diubah']]);
    	}
    	else{
    		$gaji->simpanGaji($req);
    		return back()->with('alerts',[['type' => 'success', 'text' => 'Data Berhasil Disimpan']]);
    	};
    }

    public function hapusGaji($id, gaji $gaji)
    {
        $gaji->hapusGaji($id);
        return back()->with('alerts',[['type' => 'success', 'text' => 'Data Berhasil Dihapus']]);
    }
}
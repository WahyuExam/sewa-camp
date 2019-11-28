<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\suplier;
use App\model\pinjam;
use DB;

class suplierController extends Controller
{
    public function listSuplier(Request $req, pinjam $pinjam){
    	$listSuplier = suplier::getAllWithPage();
    	if($req->has('q')){
    		$cari		 = $req->input('q');
    		$listSuplier = suplier::pencarian($cari); 
    	};

        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.suplier.list',compact('listSuplier', 'jmlPemberitahuan'));
    }

    public function formSuplier(pinjam $pinjam){
    	$kode = suplier::kode('SPL');
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.suplier.form',compact('kode', 'jmlPemberitahuan'));
    }

    public function simpanSuplier(Request $req){
    	$this->validate($req,[
    		'nmSup'		=> 'required',
    		'noTelpSup'	=> 'required|numeric',
    		'alamatSup'	=> 'required'
    	]);

    	$dataSama = suplier::dataSama($req->nmSup, $req->alamatSup);
    	if (empty($dataSama)){
    		$simpan = suplier::simpanData($req);
    		return redirect('/admin/suplier/list')->with('alerts',[['type' => 'success', 'text' => 'Data Sudah Disimpan']]);
    	}
        else{
            return back()->with('alerts',[['type'=>'danger', 'text'=>'Data Sudah Ada']]);
        }
    }

    public function editSuplier($id, pinjam $pinjam){
    	$data = suplier::dataEdit($id);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.suplier.edit',compact('data', 'jmlPemberitahuan'));
    }

    public function hapusSuplier($id){
        suplier::hapusData($id);
        return redirect('/admin/suplier/list')->with('alerts',[['type' => 'success', 'text' => 'Data Sudah Dihapus']]);;
    }

    public function ubahSuplier(Request $req, $id){
        $this->validate($req,[
            'nmSup'     => 'required',
            'noTelpSup' => 'required|numeric',
            'alamatSup' => 'required'
        ]);

        if ($req->nmSup == $req->nmSupLama && $req->alamatSup == $req->alamatSupLama){
            return redirect('admin/suplier/list');
        }
        elseif ($req->nmSup <> $req->nmSupLama || $req->alamatSup <> $req->alamatSupLama){
            $dataSama = suplier::dataSama($req->nmSup,$req->alamatSup);
            if (empty($dataSama)){
                $ubahData = suplier::ubahData($req,$id);
                return redirect('admin/suplier/list')->with('alerts',[['type' => 'success', 'text' => 'Data Sudah Disimpan']]);;
            }
            else{
                return back()->with('alerts', [['type' => 'danger', 'text' => 'Data Sudah Ada']]);
            }
        }
    }
}

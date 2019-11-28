<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\alat;
use App\model\pinjam;

class alatController extends Controller
{
    public function listAlat(Request $req, pinjam $pinjam){
    	$listAlat = alat::getAllPage();

    	if($req->has('q')){
    		$cari = $req->input('q');
    		$listAlat = alat::getPage($cari);
    	}

        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

   		return view('admin.alat.list',compact('listAlat', 'jmlPemberitahuan'));
    }

    public function formAlat(pinjam $pinjam){
    	$kode = alat::kode('ALT');
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.alat.form',compact('kode', 'jmlPemberitahuan'));
    }

    public function simpanAlat(Request $req){
    	$this->validate($req,[
    		'nmAlat'	=> 'required',
    		'merkAlat'	=> 'required',
    		'ketAlat'	=> 'required',
    		'fotoAlat'	=> 'required'
    	]);

    	$cekNmAlat = alat::cekNmAlat($req->nmAlat);
    	if(empty($cekNmAlat)){
    	    $foto 		= $req->file('fotoAlat');
    		$namaFoto 	= $foto->getClientOriginalName();
    		$namaAsli	= $req->kdAlat.$namaFoto; 

            $foto->storeAs('/public/fotoAlat',$namaAsli);
            alat::simpanData($req, $namaAsli);
            return redirect('/admin/alat/list')->with('alerts',[['type' => 'success', 'text' => 'Data Sudah Disimpan']]);
    	}
	    else{
	    	return back()->with('alerts',[['type' => 'danger', 'text' => 'Data Sudah Ada']]);		
	    }
    }

    public function hapusAlat($id){
    	$data = alat::getDataById($id);
        \File::delete(storage_path('/app/public/fotoAlat/'.$data->fotoAlat));
        alat::hapusData($id);
    	return redirect('/admin/alat/list')->with('alerts',[['type' => 'success', 'text' => 'Data Sudah Dihapus']]);
    }

    public function editAlat($id, pinjam $pinjam){
    	$dataAlat = alat::getDataById($id);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.alat.edit',compact('dataAlat', 'jmlPemberitahuan'));
    }

    public function ubahAlat(Request $req, $id){
    	$this->validate($req,[
    		'nmAlat'	=> 'required',
    		'merkAlat'	=> 'required',
    		'ketAlat'	=> 'required'
    	]);

    	if ($req->nmAlat<>$req->nmAlatLama){
            $dataSama = alat::cekNmAlat($req->nmAlat);
            if (empty($dataSama)){
                $namaAsli = $this->ubahFoto($req->kdAlat, $req->file('fotoAlat'), $id);
                alat::ubahData($req, $id, $namaAsli);
                return redirect('/admin/alat/list')->with('pesans',[['type' => 'success', 'text' => 'Data Sudah Disimpan']]);       
            }
            else{
                return back()->with('pesans',[['type' => 'danger', 'text' => 'Data Sudah Ada']]);
            }
        }
        else{
            $namaAsli = $this->ubahFoto($req->kdAlat, $req->file('fotoAlat'), $id);
            alat::ubahData($req, $id, $namaAsli);
            return redirect('/admin/alat/list')->with('pesans',[['type' => 'success', 'text' => 'Data Sudah Disimpan']]);
        }
    }

    private function ubahFoto($kdMobil, $namaFoto, $id){
        $foto = $namaFoto;
        if (!empty($foto)){
            $namaFoto   = $foto->getClientOriginalName();
            $namaAsli   = $kdMobil.$namaFoto;       

            //hapus foto seblumnya 
            $data = alat::getDataById($id);
            \File::delete(storage_path('/app/public/fotoAlat/'.$data->fotoAlat));
            $foto->storeAs('/public/fotoAlat',$namaAsli);
        }
        else{
            $data     = alat::getDataById($id);
            $namaAsli = $data->fotoAlat; 
        };        

        return $namaAsli;
    }
}

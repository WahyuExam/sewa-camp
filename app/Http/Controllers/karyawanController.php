<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\karyawan;
use App\model\login;
use App\model\pinjam;

class karyawanController extends Controller
{
    public function listKaryawan(Request $req, pinjam $pinjam){
    	$listKaryawan = karyawan::getAllWithPage();
    	if ($req->has('q')){
    		$cari 			= $req->input('q');
    		$listKaryawan 	= karyawan::pencarian($cari); 
    	};

        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
    	return view('admin.karyawan.list', compact('listKaryawan', 'jmlPemberitahuan'));
    }

    public function formKaryawan(pinjam $pinjam){
    	$kode = karyawan::kode('KAR');
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
    	
        return view('admin.karyawan.form',compact('kode', 'jmlPemberitahuan'));
    }

     public function simpanKaryawan(Request $req, login $login){
    	$this->validate($req,[
    		'nmKar'		=> 'required',
    		'noTelpKar'	=> 'required|numeric',
    		'alamatKar'	=> 'required',
            'fotoKaryawan' => 'required'
    	]);

    	$dataSama = karyawan::dataSama($req->nmKar, $req->alamatKar);
    	if (empty($dataSama)){
            $foto       = $req->file('fotoKaryawan');
            $namaFoto   = $foto->getClientOriginalName();
            $namaAsli   = $req->idKar.$namaFoto; 

            $foto->storeAs('/public/fotoKaryawan',$namaAsli);
    		karyawan::simpanData($req, $namaAsli);
            $login->simpanUserById($req->idKar, '2');
            
    		return redirect('/admin/karyawan/list')->with('alerts',[['type' => 'success', 'text' => 'Data Sudah Disimpan']]);
    	}
    	else {
    		return back()->with('alerts',[['type' => 'danger', 'text' => 'Data Sudah Ada']]);
    	}
    }

    public function hapusKaryawan($id){
        $data = karyawan::getDataById($id);
        \File::delete(storage_path('/app/public/fotoKaryawan/'.$data->fotoKaryawan));
    	karyawan::hapusData($id);
    	return redirect('admin/karyawan/list')->with('alerts',[['type' => 'success', 'text' => 'Data Berhasil Dihapus']]);
    }

    public function editKaryawan($id, pinjam $pinjam){
    	$data = karyawan::dataEdit($id);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.karyawan.edit',compact('data', 'jmlPemberitahuan'));
    }

    public function ubahkaryawan(Request $req, $id){
        $this->validate($req,[
            'nmKar'     => 'required',
            'noTelpKar' => 'required|numeric',
            'alamatKar' => 'required'
        ]);

        if ($req->nmKar == $req->nmKarLama && $req->alamatKar == $req->alamatKarLama){
            $namaAsli = $this->ubahFoto($req->idKar, $req->file('fotoKaryawan'), $id);
            $ubahData = karyawan::ubahData($req, $id, $namaAsli);
            return redirect('admin/karyawan/list');
        }
        elseif ($req->nmKar <> $req->nmKarLama || $req->alamatKar <> $req->alamatKarLama){
            $dataSama = karyawan::dataSama($req->nmKar,$req->alamatKar);
            if (empty($dataSama)){
                $namaAsli = $this->ubahFoto($req->kdAlat, $req->file('fotoKaryawan'), $id);
                $ubahData = karyawan::ubahData($req, $id, $namaAsli);
                return redirect('admin/karyawan/list')->with('alerts',[['type' => 'success', 'text' => 'Data Sudah Disimpan']]);;
            }
            else{
                return back()->with('alerts', [['type' => 'danger', 'text' => 'Data Sudah Ada']]);
            }
        }

    }

    private function ubahFoto($idKaryawan, $namaFoto, $id){
        $foto = $namaFoto;
        if (!empty($foto)){
            $namaFoto   = $foto->getClientOriginalName();
            $namaAsli   = $idKaryawan.$namaFoto;       

            //hapus foto seblumnya 
            $data = karyawan::getDataById($id);
            \File::delete(storage_path('/app/public/fotoKaryawan/'.$data->fotoKaryawan));
            $foto->storeAs('/public/fotoKaryawan',$namaAsli);
        }
        else{
            $data     = karyawan::getDataById($id);
            $namaAsli = $data->fotoKaryawan; 
        };        

        return $namaAsli;
    }
}
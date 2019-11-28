<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\pelanggan;
use App\model\login;
use App\model\pinjam;
use DB;

class pelangganController extends Controller
{
     public function listPelanggan(Request $req, pinjam $pinjam){
    	$listPelanggan = pelanggan::getAllWithPage();
    	if ($req->has('q')){
    		$cari 			= $req->input('q');
    		$listPelanggan 	= pelanggan::pencarian($cari); 
    	};
        
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
    	return view('admin.pelanggan.list', compact('listPelanggan', 'jmlPemberitahuan'));
    }

    public function hapusPelanggan($id){
       
        // hapus user kalo ada usernya
        $kodeUser = DB::table('tblpelanggan')->where('id',$id)->first();
        DB::table('tbluser')->where('kodeUser',$kodeUser->idPelanggan)->delete();
    	pelanggan::hapusData($id);

    	return redirect('admin/pelanggan/list')->with('alerts',[['type' => 'success', 'text' => 'Data Berhasil Dihapus']]);
    }

    public function formPelanggan(pinjam $pinjam){
    	$kode = pelanggan::kode('PEL');
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
    	
        return view('admin.pelanggan.form',compact('kode', 'jmlPemberitahuan'));
    }

    public function simpanPelanggan(Request $req, login $login){
    	$this->validate($req,[
    		'nmPel'		=> 'required',
    		'noTelpPel'	=> 'required|numeric',
    		'alamatPel'	=> 'required',
    		'email'		=> 'required'
    	]);

    	$dataSama = pelanggan::dataSama($req->nmPel, $req->alamatPel);
    	if (empty($dataSama)){
    		pelanggan::simpanData($req,'2');
            $login->simpanUserById($req->idPel, '3');
    		return redirect('/admin/pelanggan/list')->with('alerts',[['type' => 'success', 'text' => 'Data Berhasil Disimpan']]);
    	}
    	else{
    		return back()->with('alerts',[['type' => 'danger', 'text' => 'Data Sudah Ada']]);
    	};
    }

    public function editPelanggan($id, pinjam $pinjam){
        $dataPelanggan = pelanggan::getDataById($id);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.pelanggan.edit',compact('dataPelanggan', 'jmlPemberitahuan'));
    }

    public function ubahPelanggan(Request $req, $id){
        $this->validate($req,[
            'nmPel'     => 'required',
            'noTelpPel' => 'required|numeric',
            'alamatPel' => 'required',
            'email'     => 'required'
        ]);

        if ($req->nmPel <> $req->nmPelLama || $req->alamatPel <> $req->alamatPelLama){
            $dataSama = pelanggan::dataSama($req->nmPel, $req->alamatPel);
            if (!empty($dataSama)){
                return back()->with('alerts',[['type' => 'danger', 'text' => 'Data Sudah Ada']]);
            };
        }; 

        pelanggan::ubahData($req, $id, '2');
        return redirect('/admin/pelanggan/list')->with('alerts',[['type' => 'success', 'text' => 'Data Berhasil Disimpan']]);   
    }
}

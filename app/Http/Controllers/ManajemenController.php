<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\pelanggan;
use App\model\karyawan;
use App\model\login;
use App\model\pinjam;

class ManajemenController extends Controller
{
    public function listPengguna(Request $req, login $login, pinjam $pinjam)
    {	
    	$users = $login->getAllData();

        if($req->has('q')){
            $cari  = $req->input('q');
            $users = $login->getAllDataCari($cari);
        }

        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
    	return view('admin.user.list',compact('users', 'jmlPemberitahuan'));
    } 

    public function gantiSandi($kdUser, login $login, pinjam $pinjam)
    {
    	$users = $login->getUser($kdUser);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
    	return view('admin.sandi.form', compact('users', 'jmlPemberitahuan'));
    }

    public function gantiSandiSimpan(Request $req, login $login)
    {
    	$this->validate($req,[
    		'sandiBaru'		=> 'required'
    	]);

        $login->ubahSandi($req->kdUser, $req->sandiBaru);
        return redirect('/admin');
    }

    public function hapusUser($kodeUser, login $login)
    {
    	$login->hapusUser($kodeUser);
    	return back()->with('alerts',[['type' => 'success', 'text' => 'User Berhasil Dihapus']]);		
    }

    public function resetSandi(Request $req, login $login)
    {
        $this->validate($req,[
            'sandiBaru'     => 'required'
        ]);

        $login->ubahSandi($req->kdUser, $req->sandiBaru);
        return redirect('/admin/manajemen/user/list')->with('alerts',[['type' => 'success', 'text' => 'Kata Sandi Berhasil Diubah']]);   
    }

    public function editSandi($kodeUser, login $login, pinjam $pinjam)
    {
        $users = $login->getUser($kodeUser);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        return view('admin.sandi.form', compact('users', 'jmlPemberitahuan'));
    }

    public function listNotUser(Request $req, login $login, pinjam $pinjam)
    {
        $users = $login->getListNotUser();
        
        if($req->has('q')){
            $cari  = $req->input('q');
            $users = $login->cariNotUser($cari);
        };

        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        return view('admin.user.listNotUser',compact('users', 'jmlPemberitahuan'));
    }

    public function formSetPass($idKaryawan, pinjam $pinjam)
    {
        $users = karyawan::getDataByKd($idKaryawan);
        if (empty($users)){
            $users = pelanggan::getPelangganByKd($idKaryawan);
            $id    = $users->idPelanggan;
            $nama  = $users->nmPelanggan;
        }
        else {
            $id    = $users->idKaryawan;
            $nama  = $users->nmKaryawan;
        };

        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        return view('admin.user.formSetPas',compact('users', 'id', 'nama', 'jmlPemberitahuan'));
    }

    public function simpanSetPass(Request $req, login $login)
    {
        $this->validate($req,[
            'pengguna'  => 'required',
            'sandi'     => 'required'
        ]);

        $penggunaSama = pelanggan::cekPengguna($req->pengguna);
        if (!empty($penggunaSama)){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Pengguna Sudah Digunakan']]);  
        };
 
        $login->simpanUser($req);
        return redirect('admin/manajemen/user/list')->with('alerts',[['type' => 'success', 'text' => 'User Berhasil Ditambahkan']]);
    }
}

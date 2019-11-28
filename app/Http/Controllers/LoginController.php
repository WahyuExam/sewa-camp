<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\login;
use App\model\pelanggan;
use App\model\pinjam;

class LoginController extends Controller
{
    public function pageLogin()
    {
    	return view('login');
    }

    public function cekLogin(Request $req, login $login, pinjam $pinjam)
    {
    	$data = $login->getDataUser($req->pengguna, $req->sandi);
    	if (!empty($data)){
             $dataUser = $login->getDataUserByKode($data->kodeUser);
                      
             $session = $req->session();
             $session->put('auth',$dataUser);

           	 if ((session('auth')->level==1) or session('auth')->level==2 )  {
           	 		return redirect('/admin');
           	 }
           	 else{
                  // cek profile 
                  $dataUser = pelanggan::cekProfile($data->kodeUser);
                  if ($dataUser->alamatPel=='' && $dataUser->noTelpPel==''){
                        return redirect('/user/ubahProfile/'.$data->kodeUser);
                  };

                  // jumlah booking
                  $dataBooking = $pinjam->jmlBooking(session('auth')->id);
                  $session->put('jmlBooking',count($dataBooking));

           	 	  return redirect('/');
           	 };
    	}
    	else{
    		return back()->with('alerts',[['type' => 'danger', 'text' => 'Login Gagal !']]);
    	}
    }

    public function logout()
    {
        session()->forget('auth');
        session()->forget('jmlKeranjang');
        session()->forget('jmlBooking');
        session()->forget('idSewa');
        session()->forget('kdPinjam');
        return redirect('/');
    }

    public function formDaftar()
    {
        return view('daftar');
    }

    public function simpanDaftar(Request $req)
    {
        $emailSama = pelanggan::cekEmail($req->email);
        if (!empty($emailSama)){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Email Sudah Digunakan']]);  
        };

        $penggunaSama = pelanggan::cekPengguna($req->pengguna);
        if (!empty($penggunaSama)){
            return back()->with('alerts',[['type' => 'danger', 'text' => 'Pengguna Sudah Digunakan']]);  
        };

        // simpan ke pelanggan
        $kodePelanggan = pelanggan::kode('PEL');
        pelanggan::simpanDataDaftar($req, $kodePelanggan);

        // simpan ke user
        $dataPel = pelanggan::getPelangganByKd($kodePelanggan);
        pelanggan::simpanUser($req, $dataPel->idPelanggan, $dataPel->email);

        return redirect('/login')->with('alerts',[['type' => 'success', 'text' => 'Proses Daftar Sukses']]);
    }
}

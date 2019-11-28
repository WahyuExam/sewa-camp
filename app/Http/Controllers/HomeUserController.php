<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\alat;
use App\model\login;
use App\model\pelanggan;
use App\model\dashboard;
use App\model\pinjam;

class HomeUserController extends Controller
{
    public function homeuser()
    {
    	$alats = alat::getAllPage();

    	return view('user.homeUser',compact('alats'));
    }

    public function homeAdmin(dashboard $dashboard, pinjam $pinjam)
    {
        // pendapatan
        $dapatSewa   = $dashboard->pendapatanSewa(date('Y-m'));
        $dapatDenda  = $dashboard->pendapatanDenda(date('Y-m'));
        $dapatHilang = $dashboard->pendapatanHilang(date('Y-m'));
        $ttlPendapatan = $dapatSewa->pendapatanSewa + $dapatDenda->pendapatanDenda + $dapatHilang->pendapatanHilang;

        // pengeluaran
        $keluarBeli = $dashboard->pengeluaranBeli(date('Y-m'));
        $keluarOpr  = $dashboard->pengeluaranOperasional(date('Y-m'));
        $keluarGaji = $dashboard->pengeluaranGaji(date('Y-m'));
        $ttlPengeluaran = $keluarBeli->keluarBeli + $keluarOpr->keluarOperasional + $keluarGaji->keluarGaji;

        $jmlKaryawan  = $dashboard->jumlahKaryawan();
        $jmlPelanggan = $dashboard->jumlahPelanggan();
        $jmlSuplier   = $dashboard->jumlahSuplier();

        $jmlALat    = $dashboard->jumlahAlat();
        $jmlPinjam  = $dashboard->jumlahAlatPinjam(date('Y-m'));
        $jmlRusak   = $dashboard->jumlahAlatRusak(date('Y-m'));
        $topAlat    = $dashboard->topAlatPinjam(date('Y-m'));

        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        
    	return view('admin.dashboard',compact('ttlPendapatan', 'ttlPengeluaran', 'jmlKaryawan', 'jmlPelanggan', 'jmlSuplier', 'jmlALat', 'jmlPinjam', 'jmlRusak', 'topAlat', 'jmlPemberitahuan'));
    }

    public function editProfile($kdUser, login $login)
    {
        $dataPelanggan = $login->getDataUserByKode($kdUser); 
        
        return view('user.ubahProfile',compact('dataPelanggan'));
    }

    public function simpanProfile(Request $req, login $login)
    {
        $this->validate($req,[
            'nmPel'         => 'required',
            'noTelpPel'     => 'required|numeric',
            'email'         => 'required|email',
            'alamatPel'     => 'required',
            'pengguna'      => 'required',
            'sandi'         => 'required'
        ]);

        // cek email dan pengguna
        if ($req->email<>$req->emailLama){
            $emailSama = pelanggan::cekEmail($req->email);
            if (!empty($emailSama)){
                return back()->with('alerts',[['type' => 'danger', 'text' => 'Email Sudah Digunakan']]);  
            };
        };

        if ($req->pengguna<>$req->penggunaLama){
            $penggunaSama = pelanggan::cekPengguna($req->pengguna);
            if (!empty($penggunaSama)){
                return back()->with('alerts',[['type' => 'danger', 'text' => 'Pengguna Sudah Digunakan']]);  
            };        
        };

        // ubah profile pelanggan dan user
        pelanggan::ubahData($req, $req->idPelanggan, '1');
        pelanggan::updateUser($req, $req->idPel);

        return redirect('/');
    }

    public function tentang()
    {
        return view('user.tentang');
    }

    public function pemberitahuan(dashboard $dashboard, pinjam $pinjam)
    {
        $pemberitahuans     = $dashboard->pemberitahuan();
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.pemberitahuan.list', compact('pemberitahuans', 'jmlPemberitahuan'));
    }

    public function detailPemberitahuan(Request $req, $id, pinjam $pinjam, dashboard $dashboard)
    {
        $pinjam->ubahStatusPemberitahuan($id);
        $pemberitahuan = $pinjam->getPemberitahuanById($id);

        $session = $req->session();
        $session->forget('jmlPemberitahuan');
        $jmlPemberitahuan =  $pinjam->getPemberitahuan();
        $session->put('jmlPemberitahuan',count($jmlPemberitahuan));

        return view('admin.pemberitahuan.detail', compact('pemberitahuan'));
    }
}

<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class login extends Model
{
    public function getDataUser($pengguna, $sandi)
    {
    	return DB::table('tbluser')
    			->where('pengguna','=',$pengguna)
    			->where('sandi','=',md5($sandi))
    			->first();
    }

    public function getDataUserByKode($kodeUser)
    {
    	return DB::table('tbluser')
    			->leftJoin('tblkaryawan','tbluser.kodeUser','=','tblkaryawan.idKaryawan')
    			->leftJoin('tblpelanggan','tbluser.kodeUser','=','tblpelanggan.idPelanggan')
    			->select('tbluser.*', 'tblkaryawan.*', 'tblpelanggan.*')
    			->where('tbluser.kodeUser','=',$kodeUser)
    			->first();
    }

    public function getAllData()
    {
        return DB::table('tbluser')
                ->leftJoin('tblkaryawan','tbluser.kodeUser','=','tblkaryawan.idKaryawan')
                ->leftJoin('tblpelanggan','tbluser.kodeUser','=','tblpelanggan.idPelanggan')
                ->select('tbluser.*', 'tblkaryawan.*', 'tblpelanggan.*')
                ->orderBy('tbluser.level','ASC')
                ->get();   
    }

    public function getAllDataCari($cari)
    {
        return DB::table('tbluser')
                ->leftJoin('tblkaryawan','tbluser.kodeUser','=','tblkaryawan.idKaryawan')
                ->leftJoin('tblpelanggan','tbluser.kodeUser','=','tblpelanggan.idPelanggan')
                ->select('tbluser.*', 'tblkaryawan.*', 'tblpelanggan.*')
                ->where('tbluser.kodeUser','LIKE','%'.$cari.'%')
                ->orwhere('tblkaryawan.nmKaryawan','LIKE','%'.$cari.'%')
                ->orwhere('tblpelanggan.nmPelanggan','LIKE','%'.$cari.'%')
                ->get();
    }

    public function hapusUser($kodeUser)
    {
        return DB::table('tbluser')->where('kodeUser','=',$kodeUser)->delete();
    }

    public function getUser($kodeUser)
    {
        return DB::table('tbluser')->where('kodeUser','=',$kodeUser)->first();
    }

    public function cekSandiLama($req)
    {
        return DB::table('tbluser')
            ->where('kodeUser','=',$req->kdUser)
            ->where('sandi','=',md5($req->sandiLama))
            ->first();
    }

    public function ubahSandi($kdUSer, $sandi)
    {
        return DB::table('tbluser')->where('kodeUser','=',$kdUSer)
            ->update([
                'sandi' => md5($sandi)
            ]);
    }

    public function resetSandi($kdUSer)
    {
        return DB::table('tbluser')->where('kodeUser','=',$kdUSer)
            ->update([
                'sandi' => md5('kosong')
            ]);
    }
    
    public function getListNotUser()
    {
        // return DB::table('tblkaryawan')
        //     ->leftJoin('tbluser','tblkaryawan.idKaryawan','=','tbluser.kodeUser')
        //     ->leftJoin('tblpelanggan','tbluser.kodeUser','=','tblpelanggan.idPelanggan')
        //     ->whereNull('tbluser.pengguna')
        //     ->get();

        return DB::table('tbluser')
            ->leftJoin('tblkaryawan','tbluser.kodeUser','=','tblkaryawan.idKaryawan')
            ->leftJoin('tblpelanggan','tbluser.kodeUser','=','tblpelanggan.idPelanggan')
            ->whereNull('tbluser.pengguna')
            ->get();
    }

    public function getListNotUserPelanggan()
    {
        return DB::table('tblkaryawan')
            ->leftJoin('tbluser','tblkaryawan.idKaryawan','=','tbluser.kodeUser')
            ->whereNull('tbluser.pengguna')
            ->get();
    }

    public function cariNotUser($cari)
    {
        // return DB::table('tblkaryawan')
        //     ->leftJoin('tbluser','tblkaryawan.idKaryawan','=','tbluser.kodeUser')
        //     ->whereNull('tbluser.pengguna')
        //     ->where(function($query) use ($cari){
        //         $query->where('tblkaryawan.idKaryawan','LIKE','%'.$cari.'%')
        //               ->orwhere('tblkaryawan.nmKaryawan','LIKE','%'.$cari.'%');
        //       })
        //     ->get();

        return DB::table('tbluser')
            ->leftJoin('tblkaryawan','tbluser.kodeUser','=','tblkaryawan.idKaryawan')
            ->leftJoin('tblpelanggan','tbluser.kodeUser','=','tblpelanggan.idPelanggan')
            ->whereNull('tbluser.pengguna')
            ->where(function($query) use ($cari){
                $query->where('tblkaryawan.idKaryawan','LIKE','%'.$cari.'%')
                      ->orwhere('tblkaryawan.nmKaryawan','LIKE','%'.$cari.'%')
                      ->orwhere('tblpelanggan.idPelanggan','LIKE','%'.$cari.'%')
                      ->orwhere('tblpelanggan.nmPelanggan','LIKE','%'.$cari.'%');
            })
            ->get();
    }

    public function simpanUser($req)
    {
        return DB::table('tbluser')
            ->where('kodeUser','=',$req->kdUser)
            ->update([
                'pengguna'      => $req->pengguna,
                'sandi'         => md5($req->sandi),
                'token'         => md5($req->sandi),
            ]);
    }

    public function simpanUserById($id, $level)
    {
        return DB::table('tbluser')->insert([
            'kodeUser'  => $id,
            'level'     => $level
        ]);
    }
}

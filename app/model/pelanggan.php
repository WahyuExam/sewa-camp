<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class pelanggan extends Model
{
    public static function getAllWithPage(){
   		return DB::table('tblpelanggan')->paginate(10);	
    }

    public static function pencarian($cari){
    	return DB::table('tblpelanggan')
    			->where('idPelanggan','LIKE','%'.$cari.'%')
    			->orwhere('nmPelanggan','LIKE','%'.$cari.'%')
    			->paginate(10);
    }

    public static function kode($idPelanggan){
        $data = DB::select('select max(right(idPelanggan,3)) as kdMax from tblpelanggan');
        if (empty($data)){
            $kode = '0001';
        }
        else {
            foreach($data as $kd){
                $tmp  = ((int)$kd->kdMax) + 1;
                $kode = sprintf("%04s",$tmp); 
            }
        }
        $kodeAsli = $idPelanggan.'-'.$kode;
        return $kodeAsli;
    }

    public static function dataSama($namaPel, $alamatPel){
    	return DB::table('tblpelanggan')
    			->where('nmPelanggan','=',$namaPel)
    			->where('alamatPel','=',$alamatPel)
    			->first();
    }

    public static function simpanData($req, $status){
    	return DB::table('tblpelanggan')->insert([
    			'idPelanggan'		=> $req->idPel,
    			'nmPelanggan'		=> $req->nmPel,
    			'alamatPel'			=> $req->alamatPel,
    			'noTelpPel'			=> $req->noTelpPel,
    			'email'				=> $req->email,
    			'statusPelanggan'	=> $status
    	]);
    }

	public static function dataEdit($id){
    	return DB::table('tblpelanggan')
    			->where('id','=',$id)
    			->first();
    }    

    public static function hapusData($id){
        return DB::table('tblpelanggan')->where('id','=',$id)->delete();
    }

    public static function ubahData($req, $id, $status){
        return DB::table('tblpelanggan')->where('id','=',$id)->update([
            'nmPelanggan'    	=> $req->nmPel,
            'noTelpPel'        	=> $req->noTelpPel,
            'alamatPel'        	=> $req->alamatPel,
            'email'				=> $req->email,
            'statusPelanggan' 	=> $status	
        ]);
    }

    public static function getDataById($id){
        return DB::table('tblpelanggan')->where('id','=',$id)->first();
    }

    public static function getAllPelanggan(){
        return DB::table('tblpelanggan')->get();
    }

    public static function cekEmail($email)
    {
        return DB::table('tblpelanggan')->where('email','=',$email)->first();
    }

    public static function cekPengguna($pengguna)
    {
        return DB::table('tbluser')->where('pengguna','=',$pengguna)->first();
    }

    public static function simpanDataDaftar($req, $idPelanggan){
        return DB::table('tblpelanggan')->insert([
                'idPelanggan'       => $idPelanggan,
                'nmPelanggan'       => $req->nama,
                'email'             => $req->email,
                'statusPelanggan'   => '1'
        ]);
    }

    public static function simpanUser($req, $kodeUser, $email)
    {
        return DB::table('tbluser')->insert([
            'kodeUser'      => $kodeUser,
            'pengguna'      => $req->pengguna,
            'sandi'         => md5($req->sandi),
            'token'         => md5($email),
            'level'         => '3'
        ]);
    }

    public static function getPelangganByKd($kdPelanggan)
    {
        return DB::table('tblpelanggan')->where('idPelanggan','=',$kdPelanggan)->first();
    }

    public static function cekProfile($kodeUser)
    {
        return DB::table('tblpelanggan')
            ->where('idPelanggan','=',$kodeUser)
            ->first();
    }

    public static function updateUser($req, $kdUser)
    {
        return DB::table('tbluser')->where('kodeUser','=',$kdUser)
            ->update([
                'pengguna'  => $req->pengguna,
                'sandi'     => $req->sandi
            ]);
    } 
}
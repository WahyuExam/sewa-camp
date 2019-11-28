<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class karyawan extends Model
{
    public static function getAllWithPage(){
   		return DB::table('tblkaryawan')->paginate(10);	
    }

    public static function pencarian($cari){
    	return DB::table('tblkaryawan')
    			->where('idKaryawan','LIKE','%'.$cari.'%')
    			->orwhere('nmKaryawan','LIKE','%'.$cari.'%')
    			->paginate(10);
    }

    public static function kode($idKaryawan){
        $data = DB::select('select max(right(idKaryawan,3)) as kdMax from tblkaryawan');
        if (empty($data)){
            $kode = '001';
        }
        else {
            foreach($data as $kd){
                $tmp  = ((int)$kd->kdMax) + 1;
                $kode = sprintf("%03s",$tmp); 
            }
        }
        $kodeAsli = $idKaryawan.'-'.$kode;
        return $kodeAsli;
    }

    public static function dataSama($namaSup, $alamatSup){
    	return DB::table('tblkaryawan')
    			->where('nmKaryawan','=',$namaSup)
    			->where('alamatKar','=',$alamatSup)
    			->first();
    }

    public static function simpanData($req, $foto){
    	return DB::table('tblkaryawan')->insert([
    			'idKaryawan'	=> $req->idKar,
    			'nmKaryawan'	=> $req->nmKar,
    			'alamatKar'		=> $req->alamatKar,
    			'noTelpKar'		=> $req->noTelpKar,
                'fotoKaryawan'  => $foto
    	]);
    }

	public static function dataEdit($id){
    	return DB::table('tblkaryawan')
    			->where('id','=',$id)
    			->first();
    }    

    public static function hapusData($id){
        return DB::table('tblkaryawan')->where('id','=',$id)->delete();
    }

    public static function ubahData($req, $id, $foto){
        return DB::table('tblkaryawan')->where('id','=',$id)->update([
            'nmKaryawan'     => $req->nmKar,
            'noTelpKar'         => $req->noTelpKar,
            'alamatKar'         => $req->alamatKar,
            'fotoKaryawan'   => $foto
        ]);
    }

    public static function getDataById($id){
        return DB::table('tblkaryawan')->where('id','=',$id)->first();
    }

    public static function getDataByKd($kdKaryawan)
    {
        return DB::table('tblkaryawan')->where('idKaryawan','=',$kdKaryawan)->first();   
    }

    public static function getKaryawan()
    {
        return DB::table('tblkaryawan')->get();
    }
}
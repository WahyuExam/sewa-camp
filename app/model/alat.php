<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class alat extends Model
{
    public static function getAllPage(){
    	return DB::table('tblalat')->paginate(12);
    }

    public static function getPage($cari){
    	return DB::table('tblalat')
    			->where('kdAlat','LIKE','%'.$cari.'%')
    			->orwhere('nmAlat','LIKE','%'.$cari.'%')
    			->paginate(12);
    }

    public static function kode($kdAlat){
        $data = DB::select('select max(right(kdAlat,3)) as kdMax from tblalat');
        if (empty($data)){
            $kode = '0001';
        }
        else {
            foreach($data as $kd){
                $tmp  = ((int)$kd->kdMax) + 1;
                $kode = sprintf("%04s",$tmp); 
            }
        }
        $kodeAsli = $kdAlat.'-'.$kode;
        return $kodeAsli;
    }

    public static function simpanData($req, $foto){
    	return DB::table('tblalat')->insert([
    		'kdAlat'	=> $req->kdAlat,
    		'nmAlat'	=> $req->nmAlat,
    		'merkAlat'	=> $req->merkAlat,
    		'ketAlat'	=> $req->ketAlat,
    		'fotoAlat'	=> $foto
    	]);
    }

    public static function ubahData($req, $id, $foto){
    	return DB::table('tblalat')->where('id','=',$id)->update([
    		'nmAlat'	=> $req->nmAlat,
    		'merkAlat'	=> $req->merkAlat,
    		'ketAlat'	=> $req->ketAlat,
    		'fotoAlat'	=> $foto
    	]);	
    }

    public static function cekNmAlat($nmAlat){
    	return DB::table('tblalat')->where('nmAlat','=',$nmAlat)->first();
    } 

    public static function hapusData($id){
    	return DB::table('tblalat')->where('id','=',$id)->delete();
    }

    public static function getDataById($id){
    	return DB::table('tblalat')->where('id','=',$id)->first();
    }

    public static function getDataRandom($id){
        return DB::table('tblalat')->where('id','!=',$id)->get()->random(4);
    }

    public static function getAlat(){
        return DB::table('tblalat')->get();
    }

    public static function getAlatByKode($kdAlat)
    {
        return DB::table('tblalat')->where('kdAlat','=',$kdAlat)->first();
    }

}
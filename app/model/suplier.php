<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class suplier extends Model
{
    public static function getAllWithPage(){
   		return DB::table('tblsuplier')->paginate(10);	
    }

    public static function pencarian($cari){
    	return DB::table('tblsuplier')
    			->where('kdSuplier','LIKE','%'.$cari.'%')
    			->orwhere('nmSuplier','LIKE','%'.$cari.'%')
    			->paginate(10);
    }

    public static function kode($kodeSuplier){
        $data = DB::select('select max(right(kdSuplier,3)) as kdMax from tblsuplier');
        if (empty($data)){
            $kode = '001';
        }
        else {
            foreach($data as $kd){
                $tmp  = ((int)$kd->kdMax) + 1;
                $kode = sprintf("%03s",$tmp); 
            }
        }
        $kodeAsli = $kodeSuplier.'-'.$kode;
        return $kodeAsli;
    }

    public static function dataSama($namaSup, $alamatSup){
    	return DB::table('tblsuplier')
    			->where('nmSuplier','=',$namaSup)
    			->where('alamat','=',$alamatSup)
    			->first();
    }

    public static function simpanData($req){
    	return DB::table('tblsuplier')->insert([
    			'kdSuplier'		=> $req->kdSup,
    			'nmSuplier'		=> $req->nmSup,
    			'noTelp'		=> $req->noTelpSup,
    			'alamat'		=> $req->alamatSup
    	]);
    }

	public static function dataEdit($id){
    	return DB::table('tblsuplier')
    			->where('id','=',$id)
    			->first();
    }    

    public static function hapusData($id){
        return DB::table('tblsuplier')->where('id','=',$id)->delete();
    }

    public static function ubahData($req, $id){
        return DB::table('tblsuplier')->where('id','=',$id)->update([
            'nmSuplier'     => $req->nmSup,
            'noTelp'        => $req->noTelpSup,
            'alamat'        => $req->alamatSup
        ]);
    }

    public static function getSuplier()
    {
        return DB::table('tblsuplier')->get();   
    }
}
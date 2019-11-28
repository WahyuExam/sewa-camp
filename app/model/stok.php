<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class stok extends Model
{
    public function getAllStok()
    {
    	return DB::table('tblalat')
    			->leftJoin('tblstok','tblalat.id','=','tblstok.alatId')
    			->select('tblalat.id','tblalat.kdAlat','tblalat.nmAlat','tblalat.merkAlat','tblalat.ketAlat','tblalat.fotoAlat','tblstok.alatId','tblstok.biayaSewa','tblstok.biayaDenda','tblstok.stok')
    			->paginate(10);
    }

    public function getAllStokCari($cari)
    {
    	return DB::table('tblalat')
    			->leftJoin('tblstok','tblalat.id','=','tblstok.alatId')
    			->select('tblalat.id','tblalat.kdAlat','tblalat.nmAlat','tblalat.merkAlat','tblalat.ketAlat','tblalat.fotoAlat','tblstok.alatId','tblstok.biayaSewa','tblstok.biayaDenda','tblstok.stok')
    			->where('tblalat.kdAlat','LIKE','%'.$cari.'%')
    			->orwhere('tblalat.nmAlat','LIKE','%'.$cari.'%')
    			->paginate(10);
    }

    public function getStokByIdAlat($idAlat)
    {
    	return DB::table('tblalat')
    			->leftJoin('tblstok','tblalat.id','=','tblstok.alatId')
    			->select('tblalat.id','tblalat.kdAlat','tblalat.nmAlat','tblalat.merkAlat','tblalat.ketAlat','tblalat.fotoAlat','tblstok.alatId','tblstok.biayaSewa','tblstok.biayaDenda','tblstok.stok')
    			->where('tblalat.id','=',$idAlat)
    			->first();
    }

    public function simpanStok($req, $idAlat, $denda)
    {
    	return DB::table('tblstok')->insert([
    		'alatId'	 => $idAlat,
    		'biayaSewa'  => $req->biayaSewa,
    		'biayaDenda' => $denda,
    		'stok'		 => $req->stokAlat
    	]);
    }

    public function ubahStok($req, $idAlat, $denda, $stokBaru)
    {
    	return DB::table('tblstok')
    			->where('alatId','=',$idAlat)
    			->update([
    				'biayaSewa'	 => $req->biayaSewa,
    				'biayaDenda' => $denda,
    				'stok'		 => $stokBaru
    			]);
    }

    public function ubahStokById($idAlat, $stok)
    {
        return DB::table('tblstok')
            ->where('alatId','=',$idAlat)
            ->update([
                'stok'  => $stok
            ]);
    }

    public function getStokByIdSederhana($idAlat)
    {
        return DB::table('tblstok')->where('alatId','=',$idAlat)->first();
    }

    public function simpanStokBeli($idAlat, $stok, $biayaSewa, $denda)
    {
        return DB::table('tblstok')->insert([
            'alatId'     => $idAlat,
            'biayaSewa'  => $biayaSewa,
            'biayaDenda' => $denda,
            'stok'       => $stok
        ]);
    }

}

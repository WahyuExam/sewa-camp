<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class beli extends Model
{
    public function getAllDataTgl($tgl)
    {
    	return DB::table('tblbeli')
    		->leftJoin('tblsuplier','tblbeli.suplierId','=','tblsuplier.id')
    		->where('tblbeli.tglBeli','LIKE','%'.$tgl.'%')
            ->whereNotNull('tblbeli.ttlBeli')
            ->select('tblbeli.*','tblsuplier.kdSuplier','tblsuplier.nmSuplier','tblsuplier.alamat','tblsuplier.noTelp')
    		->paginate(10);
    }

    public function getAllDataTglCari($tgl, $cari)
    {
    	return DB::table('tblbeli')
    		->leftJoin('tblsuplier','tblbeli.suplierId','=','tblsuplier.id')
    		->where('tblbeli.tglBeli','LIKE','%'.$tgl.'%')
    		->where('tblbeli.kdBeli','LIKE','%'.$cari.'%')
            ->whereNotNull('tblbeli.ttlBeli')
    		->paginate(10);
    }

    public function kode($kodeBeli)
    {
        $data = DB::select('select max(right(kdBeli,4)) as kdMax from tblbeli');
        if (empty($data)){
            $kode = '0001';
        }
        else {
            foreach($data as $kd){
                $tmp  = ((int)$kd->kdMax) + 1;
                $kode = sprintf("%04s",$tmp); 
            }
        }
    
        $kodeAsli = date('ymd').$kodeBeli.$kode;
        return $kodeAsli;
    }

    public function simpanBeli($req)
    {
        return DB::table('tblbeli')->insert([
            'kdBeli'    => $req->kdBeli,
            'tglBeli'   => date('Y-m-d',strtotime($req->tglBeli)),
            'suplierId' => $req->suplier
        ]);
    }

    public function simpanDetail($idBeli, $req, $sub)
    {
        return DB::table('tbldetbeli')->insert([
            'beliId'    => $idBeli,
            'alatId'    => $req->alat,
            'hargaBeli' => $req->hargaBeli,
            'jmlBeli'   => $req->jmlBeli,
            'sub'       => $sub
        ]);
    }

    public function getBeliByKdBeli($kdBeli)
    {
        return DB::table('tblbeli')->where('kdBeli','=',$kdBeli)->first();
    }

    public function getDetailbeliById($idBeli)
    {
        return DB::table('tbldetbeli')
            ->leftJoin('tblalat','tbldetbeli.alatId','=','tblalat.id')
            ->where('beliId','=',$idBeli)
            ->get();
    }

    public function batalBeli($kdBeli)
    {
        return DB::table('tblbeli')->where('kdBeli','=',$kdBeli)->delete();
    }

    public function hapusItem($idBeli, $alatId)
    {
        return DB::table('tbldetbeli')
            ->where('beliId','=',$idBeli)
            ->where('alatId','=',$alatId)
            ->delete();
    }

    public function alatAda($idBeli, $idAlat)
    {
        return DB::table('tbldetbeli')
            ->where('beliId','=',$idBeli)
            ->where('alatId','=',$idAlat)
            ->first();
    }

    public function hapusNull()
    {
        return DB::table('tblbeli')->whereNull('ttlBeli')->delete();
    }

    public function updateTtlBeli($idBeli, $ttlBeli)
    {
        return DB::table('tblbeli')->where('id','=',$idBeli)->update(['ttlBeli' => $ttlBeli]);
    }

    public function getBeliByIdBeli($idBeli)
    {
        return DB::table('tblbeli')->where('id','=',$idBeli)->first();
    }
}

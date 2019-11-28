<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class gaji extends Model
{
    public function getListGaji($tgl)
    {
        $bln = date('m',strtotime($tgl));
        $thn = date('Y',strtotime($tgl));
    	return DB::table('tblkaryawan')
    		->leftJoin('tblgaji','tblkaryawan.id','=','tblgaji.karyawanId')
    		->whereMonth('tblgaji.tglGaji',$bln)
            ->whereYear('tblgaji.tglGaji',$thn)
    		->get();
    }

    public function simpanGaji($req)
    {
        return DB::table('tblgaji')->insert([
            'tglGaji'       => date('Y-m-d'),
            'karyawanId'    => $req->nmKar,
            'gaji'          => $req->gaji
        ]);
    }

    public function sudahDiGaji($tgl, $id)
    {
        $bln = date('m',strtotime($tgl));
        $thn = date('Y',strtotime($tgl));
        return DB::table('tblgaji')
            ->whereMonth('tglGaji',$bln)
            ->whereYear('tblgaji.tglGaji',$thn)
            ->where('karyawanId','=',$id)
            ->first();
    }

    public function ubahGaji($tgl, $req)
    {
        $bln = date('m',strtotime($tgl));
        return DB::table('tblgaji')
            ->whereMonth('tglGaji',$bln)
            ->where('karyawanId','=',$req->nmKar)
            ->update([
                'tglGaji' => date('Y-m-d'),
                'gaji'    => $req->gaji
            ]);
    }

    public function hapusGaji($id)
    {
        return DB::table('tblgaji')->where('id',$id)->delete();
    }
}

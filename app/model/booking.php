<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class booking extends Model
{
    public function getStatusBookingNull()
    {
    	return DB::table('tblpinjam')   
    		->leftJoin('tblpelanggan','tblpinjam.pelangganId','=','tblpelanggan.id')
            ->where('statusSewa','=','1')
            ->orwhereNull('statusSewa')
            ->get();
    } 

    public function cariBooking($cari)
    {
    	return DB::table('tblpinjam')   
    		->leftJoin('tblpelanggan','tblpinjam.pelangganId','=','tblpelanggan.id')
            ->where('tblpinjam.kdPinjam','LIKE','%'.$cari.'%')
            ->orwhere('tblpelanggan.nmPelanggan','LIKE','%'.$cari.'%')
            ->where(function($query){
            		$query->where('statusSewa','=','1')
            			  ->orwhereNull('statusSewa');
              })
            ->get();	
    }

    public function getDataById($kdPinjam)
    {
    	return DB::table('tblpinjam')   
    		->leftJoin('tblpelanggan','tblpinjam.pelangganId','=','tblpelanggan.id')
            ->where('tblpinjam.kdPinjam','=',$kdPinjam)
            ->first();
    }

    public function updateTblPinjam($req, $kdPinjam, $tglPinjam, $karyawanId)
    {
    	return DB::table('tblpinjam')	
    			->where('kdPinjam','=',$kdPinjam)
    			->update([
    				'statusSewa' => '2',
    				'tglPinjam'	 => $tglPinjam,
    				'noJaminan'	 => $req->noJaminan,
    				'ket'		 => $req->jaminan,
    				'karyawanId' => $karyawanId
    			]);
    }

    public function simpanKonfirmasi($kdPinjam, $req, $foto)
    {
        return DB::table('tblpinjam')
            ->where('kdPinjam','=',$kdPinjam)
            ->update([
                'statusBayar'   => 1,
                'tglBayar'      => $req->tglBayar,
                'catatan'       => $req->ket,
                'fotoBukti'     => $foto
            ]);
    }
}

<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;	

class kembali extends Model
{
    public function getAllData($tgl)
    {
    	return DB::table('tblpinjam')
			->leftJoin('tblpelanggan','tblpinjam.pelangganId','=','tblpelanggan.id')
			->leftJoin('tblkembali','tblpinjam.id','=','tblkembali.pinjamId')
			->leftJoin('tblkaryawan','tblkembali.karyawanId','=','tblkaryawan.id')
			->where('tblpinjam.statusSewa','=','2')
			->orwhere('tblkembali.tglkembali','LIKE','%'.$tgl.'%')
			->orderBy('tblpinjam.statusSewa','ASC') 
			->paginate(10); 
    }

    public function getAllDataCari($tgl, $cari)
    {
    	return DB::table('tblpinjam')
			->leftJoin('tblpelanggan','tblpinjam.pelangganId','=','tblpelanggan.id')
			->leftJoin('tblkembali','tblpinjam.id','=','tblkembali.pinjamId')
			->leftJoin('tblkaryawan','tblkembali.karyawanId','=','tblkaryawan.id')
			->where(function($query) use ($tgl){
				$query->where('tblpinjam.statusSewa','=','2')	
					  ->orwhere('tblkembali.tglkembali','LIKE','%'.$tgl.'%');
			})
			->where(function($query) use ($cari){
				$query->where('tblpinjam.kdPinjam','LIKE','%'.$cari.'%')	
					  ->orwhere('tblpelanggan.nmPelanggan','LIKE','%'.$cari.'%');
			})
			->orderBy('tblpinjam.statusSewa','ASC') 
			->paginate(10); 
    }

    public function kode($kodeKembali)
    {
        $data = DB::select('select max(right(kdKembali,4)) as kdMax from tblkembali');
        if (empty($data)){
            $kode = '0001';
        }
        else {
            foreach($data as $kd){
                $tmp  = ((int)$kd->kdMax) + 1;
                $kode = sprintf("%04s",$tmp); 
            }
        }
        // $kodeAsli = $kodeKembali.'-'.$kode;
        $kodeAsli = $kodeKembali.date('ymd').$kode;
        return $kodeAsli;
    }

    public function simpanKembali($req, $karyawanId)
    {
    	return DB::table('tblkembali')->insert([
    		'kdKembali'		=> $req->kode,
    		'tglkembali'	=> date('Y-m-d'),
    		'durasi'		=> $req->durasi,
    		'denda'			=> $req->denda,
            'dendaHilang'   => $req->dendaHilang,
    		'pinjamId'		=> $req->pinjamId,
    		'karyawanId'	=> $karyawanId
    	]);
    }

    public function ubahStatusSewaKembali($idSewa)
    {
    	return DB::table('tblpinjam')->where('id','=',$idSewa)->update(['statusSewa' => '3']);
    }
}

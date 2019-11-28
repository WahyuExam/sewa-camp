<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class biaya extends Model
{
    public function getOperasionalTgl($tgl)
    {
	    $bln = date('m',strtotime($tgl));
	    $thn = date('Y',strtotime($tgl));

	    return DB::table('tbloperasional')
	    		->whereMonth('tglOperasional',$bln)
	    		->whereYear('tglOperasional',$thn)
	    		->get();
    }

    public static function kode($kdOperasional){
        $data = DB::select('select max(right(kdOperasional,5)) as kdMax from tbloperasional');
        if (empty($data)){
            $kode = '00001';
        }
        else {
            foreach($data as $kd){
                $tmp  = ((int)$kd->kdMax) + 1;
                $kode = sprintf("%05s",$tmp); 
            }
        }
        $kodeAsli = date('Ymd').$kdOperasional.$kode;
        return $kodeAsli;
    }

    public function simpanOperasional($kode, $tgl)
    {
        return DB::table('tbloperasional')->insert([
            'kdOperasional'     => $kode,
            'tglOperasional'    => $tgl
        ]);
    }

    public function getOperasionalByKd($kdOperasional)
    {
        return DB::table('tbloperasional')->where('kdOperasional','=',$kdOperasional)->first();
    }

    public function getDetailById($idOperasional)
    {
        return DB::table('tbldetoperasional')
            ->where('tbldetoperasional.operasionalId','=',$idOperasional)
            ->get();

    }

    public function batal($kdOperasional)
    {
        return DB::table('tbloperasional')->where('kdOperasional','=',$kdOperasional)->delete();
    }

    public function hapusTransaksi($idOperasional)
    {
        return DB::table('tbloperasional')->where('id','=',$idOperasional)->delete();
    }

    public function simpanDetail($idOperasional,$req)
    {
        return DB::table('tbldetoperasional')->insert([
            'operasionalId' => $idOperasional,
            'ket'           => $req->ket,
            'biaya'         => $req->biaya
        ]);
    }

    public function cekNama($idOperasional, $ket)
    {
        return DB::table('tbldetoperasional')
                ->where('operasionalId','=',$idOperasional)
                ->where('ket','=',$ket)
                ->first();
    }

    public function ubahBiaya($idOperasional, $ket, $total)
    {
        return DB::table('tbldetoperasional')
                ->where('operasionalId','=',$idOperasional)
                ->where('ket','=',$ket)
                ->update([
                    'biaya'  => $total
                ]);
    }

    public function updateTotalBiaya($idOperasional, $total)
    {
        return DB::table('tbloperasional')
            ->where('id','=',$idOperasional)
            ->update([
                'biayaOperasional' => $total
            ]);
    }

    public function hapusItem($idOperasional, $id)
    {
        return DB::table('tbldetoperasional')->where('operasionalId','=',$idOperasional)->where('id','=',$id)->delete();
    }

    public function getBiayaById($idOperasional)
    {
        return DB::table('tbloperasional')->where('id','=',$idOperasional)->first();
    }
}

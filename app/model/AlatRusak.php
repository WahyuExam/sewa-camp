<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class AlatRusak extends Model
{
     public function cekALatRusakByIdAlat($alatId)
    {
        return DB::table('tblalatrusak')->where('alatId','=',$alatId)->first();
    }

    public function updateJmlRusakByAlat($alatId, $jmlRusak)
    {
        return DB::table('tblalatrusak')->where('alatId','=',$alatId)->update(['jmlRusak' => $jmlRusak]);
    }

    public function getDataRusakByIdAlat($idAlat)
    {
        return DB::table('tblalatrusak')->where('alatId','=',$idAlat)->first();
    }
    
    public function simpanAlatRusak($alatId, $jmlRusak, $date, $ket)
    {
        return DB::table('tblalatrusak')->insert([
            'alatId'    => $alatId,
            'jmlRusak'  => $jmlRusak,
            'tglRusak'  => $date,
            'ket'       => $ket
        ]);
    }

    public function getAllData($tgl)
    {
        $bln = date('m',strtotime($tgl));
        return DB::table('tblalat')
            ->leftJoin('tblalatrusak','tblalat.id','=','tblalatrusak.alatId')
            ->select('tblalat.*','tblalatrusak.jmlRusak','tblalatrusak.tglRusak','tblalatrusak.ket', DB::raw('SUM(tblalatrusak.jmlRusak) as total'))
            ->whereMonth('tblalatrusak.tglRusak',$bln)
            ->groupBy('tblalat.id')
            ->paginate(10);
    }

    public function getAllDataCari($tgl, $cari)
    {
        $bln = date('m',strtotime($tgl));
        return DB::table('tblalat')
            ->leftJoin('tblalatrusak','tblalat.id','=','tblalatrusak.alatId')
            ->select('tblalat.*','tblalatrusak.jmlRusak','tblalatrusak.tglRusak','tblalatrusak.ket', DB::raw('SUM(tblalatrusak.jmlRusak) as total'))
            ->whereMonth('tblalatrusak.tglRusak',$bln)
            ->where(function ($query) use ($cari){
                $query->where('tblalat.kdAlat','LIKE','%'.$cari.'%')
                      ->orwhere('tblalat.nmAlat','LIKE','%'.$cari.'%');
             })
            ->groupBy('tblalat.id')
            ->paginate(10);
    }

    public function detail($alatId, $bulan)
    {
        $bln = date('m',strtotime($bulan));
        return DB::table('tblalat')
            ->leftJoin('tblalatrusak','tblalat.id','=','tblalatrusak.alatId')
            ->whereMonth('tblalatrusak.tglRusak',$bln)
            ->where('tblalat.id','=',$alatId)
            ->where('tblalatrusak.jmlRusak','<>',0)
            ->get();
    }
}

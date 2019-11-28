<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class dashboard extends Model
{
    public function pendapatanSewa($bulan)
    {
    	$bln = date('m',strtotime($bulan));
        $thn = date('Y',strtotime($bulan));
    	return DB::table('tblpinjam')
            ->whereIn('statusSewa',['2','3'])
    		->whereMonth('tglPinjam',$bln)
            ->whereYear('tglPinjam',$thn)
    		->select(DB::raw('sum(totalBayar) as pendapatanSewa'))
    		->first();
    }

    public function pendapatanDenda($bulan)
    {
    	$bln = date('m',strtotime($bulan));
        $thn = date('Y',strtotime($bulan));
    	return DB::table('tblkembali')
    		->whereMonth('tglkembali',$bln)
            ->whereYear('tglkembali',$thn)
    		->select(DB::raw('sum(denda) as pendapatanDenda'))
    		->first();
    }

    public function pendapatanHilang($bulan)
    {
    	$bln = date('m',strtotime($bulan));
        $thn = date('Y',strtotime($bulan));
    	return DB::table('tblkembali')
    		->whereMonth('tglkembali',$bln)
            ->whereYear('tglkembali',$thn)
    		->select(DB::raw('sum(dendaHilang) as pendapatanHilang'))
    		->first();
    }

    public function pengeluaranBeli($bulan)
    {
    	$bln = date('m',strtotime($bulan));
        $thn = date('Y',strtotime($bulan));
    	return DB::table('tblbeli')
    		->whereMonth('tglbeli',$bln)
            ->whereYear('tglbeli',$thn)
    		->select(DB::raw('sum(ttlBeli) as keluarBeli'))
    		->first();	
    }

    public function pengeluaranOperasional($bulan)
    {
    	$bln = date('m',strtotime($bulan));
        $thn = date('Y',strtotime($bulan));
    	return DB::table('tbloperasional')
    		->whereMonth('tgloperasional',$bln)
            ->whereYear('tgloperasional',$thn)
    		->select(DB::raw('sum(biayaOperasional) as keluarOperasional'))
    		->first();	
    }

    public function pengeluaranGaji($bulan)
    {
    	$bln = date('m',strtotime($bulan));
    	$thn = date('Y',strtotime($bulan));
        return DB::table('tblgaji')
    		->whereMonth('tglGaji',$bln)
            ->whereYear('tglGaji',$thn)
    		->select(DB::raw('sum(gaji) as keluarGaji'))
    		->first();	
    }

    public function jumlahKaryawan()
    {
        return DB::table('tblkaryawan')
            ->select(DB::raw('Count(id) as jumlahKaryawan'))
            ->first();
    }

    public function jumlahPelanggan()
    {
        return DB::table('tblpelanggan')
            ->select(DB::raw('Count(id) as jumlahPelanggan'))
            ->first();
    }

    public function jumlahSuplier()
    {
        return DB::table('tblsuplier')
            ->select(DB::raw('Count(id) as jumlahSuplier'))
            ->first();
    }

    public function jumlahAlat()
    {
        return DB::table('tblstok')
            ->select(DB::raw('sum(stok) as jumlahStok'))
            ->first();
    }

    public function jumlahAlatPinjam($bulan)
    {
        $bln = date('m',strtotime($bulan));
        return DB::table('tblpinjam')
            ->leftJoin('tbldetailpinjam','tblpinjam.id','=','tbldetailpinjam.pinjamId')
            ->whereMonth('tblpinjam.tglPinjam',$bln)
            ->whereIn('statusSewa',[2])
            ->select(DB::raw('sum(jml) as jumlahPinjam'))
            ->first();
    }

    public function jumlahAlatRusak($bulan)
    {
        $bln = date('m',strtotime($bulan));
        // return DB::table('tblpinjam')
        //     ->leftJoin('tbldetailpinjam','tblpinjam.id','=','tbldetailpinjam.pinjamId')
        //     ->whereMonth('tblpinjam.tglPinjam',$bln)
        //     ->where('tblpinjam.statusSewa','=','3')
        //     ->select(DB::raw('sum(tbldetailpinjam.jmlRusak) as jumlahRusak'))
        //     ->first();

        return DB::table('tblalatrusak')
            ->whereMonth('tglRusak',$bln)
            ->select(DB::raw('sum(jmlRusak) as jumlahRusak'))
            ->first();
    }

    public function topAlatPinjam($bulan)
    {
        $bln = date('m',strtotime($bulan));
        return DB::table('tblpinjam')
            ->leftJoin('tbldetailpinjam','tblpinjam.id','=','tbldetailpinjam.pinjamId')
            ->leftJoin('tblalat','tbldetailpinjam.alatId','=','tblalat.id')
            ->whereMonth('tblpinjam.tglPinjam',$bln)
            ->where('tblpinjam.statusSewa','=','3')
            ->select('tblalat.*', DB::raw('sum(tbldetailpinjam.jml) as jumlahPinjam'))
            ->groupby('tblalat.id')
            ->limit(10)
            ->orderBy('jumlahPinjam','DESC')
            ->get();
    }

    public function pemberitahuan()
    {
        return DB::table('tblpemberitahuan')->where('status','0')->orderBy('id','DESC')->get();
    }
}

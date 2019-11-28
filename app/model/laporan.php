<?php

namespace App\model;
use DB;

use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
	public function laporanAlatForm()
	{
	    return DB::table('tblalat')	
	    	->leftJoin('tblstok','tblalat.id','=','tblstok.alatId')
	    	->get();
	}

	public function laporanSuplierForm()
	{
		return DB::table('tblsuplier')->get();
	}

	public function laporanKaryawanForm()
	{
		return DB::table('tblkaryawan')->get();
	}

	public function laporanPelangganForm()
	{
		return DB::table('tblpelanggan')->get();
	}

	public function getAllLaporanBiayaStatusKosong($bulan, $tahun)
    {
        return DB::table('tbloperasional')
        	->whereMonth('tglOperasional',$bulan)
	    	->whereYear('tglOperasional',$tahun)
	    	->get();
    }

    public function getAllLaporanGaji($bulan,$tahun)
    {
    	return DB::table('tblgaji')
    		->leftJoin('tblkaryawan','tblgaji.karyawanId','=','tblkaryawan.id')
    		->whereMonth('tblgaji.tglGaji',$bulan)
    		->whereYear('tblgaji.tglGaji',$tahun)
    		->get();
    }

    public function getAllLaporanPenyewaan($bulan, $tahun)
    {
    	 return DB::table('tblpinjam')
                ->leftJoin('tblPelanggan','tblpinjam.pelangganId','=','tblPelanggan.id')
                ->leftJoin('tblkaryawan','tblpinjam.karyawanId','=','tblkaryawan.id')
    			->whereMonth('tblpinjam.tglPinjam',$bulan)
    			->whereYear('tblpinjam.tglPinjam',$tahun)
                ->whereIn('tblpinjam.statusSewa',['2','3'])
                ->get();
    }

    public function getLaporanPenyewaanDetail($kdSewa)
    {
    	return DB::table('tblpinjam')
            ->leftJoin('tblPelanggan','tblpinjam.pelangganId','=','tblPelanggan.id')
            ->leftJoin('tblkaryawan','tblpinjam.karyawanId','=','tblkaryawan.idKaryawan')
            ->leftJoin('tbldetailpinjam','tblpinjam.id','=','tbldetailpinjam.pinjamId')
            ->leftJoin('tblalat','tbldetailpinjam.alatId','=','tblalat.id')
            ->leftJoin('tblstok','tblalat.id','=','tblstok.alatId')
            ->where('tblpinjam.kdPinjam','=',$kdSewa)
            ->get();
    }

    public function getAllLaporanPengembalian($bulan, $tahun)
    {
        return DB::table('tblpinjam')
            ->leftJoin('tblpelanggan','tblpinjam.pelangganId','=','tblpelanggan.id')
            ->leftJoin('tblkembali','tblpinjam.id','=','tblkembali.pinjamId')
            ->leftJoin('tblkaryawan','tblkembali.karyawanId','=','tblkaryawan.id')
            ->whereMonth('tblkembali.tglKembali',$bulan)
            ->whereYear('tblkembali.tglKembali',$tahun)
            ->where('tblpinjam.statusSewa','3')
            ->get();
    }

    public function getLaporanPengembalianDetail($kdKembali)
    {
        return DB::table('tblkembali')
            ->leftJoin('tblpinjam','tblkembali.pinjamId','=','tblpinjam.id')
            ->leftJoin('tblpelanggan','tblpinjam.pelangganId','=','tblPelanggan.id')
            ->leftJoin('tblkaryawan','tblkembali.karyawanId','=','tblkaryawan.id')
            ->leftJoin('tbldetailpinjam','tblpinjam.id','=','tbldetailpinjam.pinjamId')
            ->leftjoin('tblalat','tbldetailpinjam.alatId','=','tblalat.id')
            ->where('tblkembali.kdKembali',$kdKembali)
            ->get();
    }

    public function getAllPembelian($bulan, $tahun)
    {
        return DB::table('tblbeli')
            ->leftJoin('tblsuplier','tblbeli.suplierId','=','tblsuplier.id')
            ->select('tblbeli.*', 'tblsuplier.kdSuplier', 'tblsuplier.nmSuplier', 'tblsuplier.alamat', 'tblsuplier.noTelp')
            ->whereMonth('tblbeli.tglBeli',$bulan)
            ->whereYear('tblbeli.tglBeli',$tahun)
            ->get();
    }

    public function getPembelianDetail($idBeli)
    {
        return DB::table('tbldetbeli')
           ->leftJoin('tblalat','tbldetbeli.alatId','=','tblalat.id')
           ->where('beliId','=',$idBeli)
           ->get();
    }

    public function getBeliById($id)
    {
        return DB::table('tblbeli')->where('id',$id)->first();
    }

    public function pendapatanSewa($bulan, $tahun)
    {
        return DB::table('tblpinjam')
            ->whereIn('statusSewa',['2','3'])
            ->whereMonth('tglPinjam',$bulan)
            ->whereYear('tglPinjam',$tahun)
            ->select(DB::raw('sum(totalBayar) as pendapatanSewa'))
            ->first();
    }

    public function pendapatanDenda($bulan, $tahun)
    {
        return DB::table('tblkembali')
            ->whereMonth('tglkembali',$bulan)
            ->whereYear('tglkembali',$tahun)
            ->select(DB::raw('sum(denda) as pendapatanDenda'))
            ->first();
    }

    public function pendapatanHilang($bulan, $tahun)
    {
        return DB::table('tblkembali')
            ->whereMonth('tglkembali',$bulan)
            ->whereYear('tglkembali',$tahun)
            ->select(DB::raw('sum(dendaHilang) as pendapatanHilang'))
            ->first();
    }

    public function pengeluaranBeli($bulan, $tahun)
    {
        return DB::table('tblbeli')
            ->whereMonth('tglbeli',$bulan)
            ->whereYear('tglbeli',$tahun)
            ->select(DB::raw('sum(ttlBeli) as keluarBeli'))
            ->first();  
    }

    public function pengeluaranOperasional($bulan, $tahun)
    {
        return DB::table('tbloperasional')
            ->whereMonth('tgloperasional',$bulan)
            ->whereYear('tgloperasional',$tahun)
            ->select(DB::raw('sum(biayaOperasional) as keluarOperasional'))
            ->first();  
    }

    public function pengeluaranGaji($bulan, $tahun)
    {
        return DB::table('tblgaji')
            ->whereMonth('tglGaji',$bulan)
            ->whereYear('tglGaji',$tahun)
            ->select(DB::raw('sum(gaji) as keluarGaji'))
            ->first();  
    }

    public function hapusRugiLabaPerBulan($bulan, $tahun)
    {
        return DB::table('tblrugilaba')->truncate();
    }

    public function simpanRugiLaba($bulan, $tahun, $ket, $dapat, $keluar)
    {
        return DB::table('tblrugilaba')->insert([
            'bulan'         => $bulan,
            'tahun'         => $tahun,
            'keterangan'    => $ket,
            'pendapatan'    => $dapat,
            'pengeluaran'   => $keluar
        ]);
    }

    public function getLabaRugi()
    {
        return DB::table('tblrugilaba')->get();
    }
}

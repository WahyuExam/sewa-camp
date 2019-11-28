<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class pinjam extends Model
{
    public function getAllPage($tgl)
    {
    	return DB::table('tblpinjam')
    			->leftJoin('tblpelanggan','tblpinjam.pelangganId','=','tblpelanggan.id')
    			->where('tblpinjam.tglPinjam','LIKE','%'.$tgl.'%')
                ->where('tblpinjam.statusSewa','=','2')
    			->paginate(10); 
    }

    public function getPage($cari, $tgl)
    {
    	return DB::table('tblpinjam')
			->leftJoin('tblpelanggan','tblpinjam.pelangganId','=','tblpelanggan.id')
			->where('tblpinjam.tglPinjam','LIKE','%'.$tgl.'%')
            ->where('tblpinjam.statusSewa','=','2')
			->where(function ($query) use ($cari){
                  $query->where('tblpinjam.kdPinjam','LIKE','%'.$cari.'%')
						->orwhere('tblpelanggan.nmPelanggan','LIKE','%'.$cari.'%');
              })
			->paginate(10);
    }

    public function kode($kodeSewa)
    {
        $data = DB::select('select max(right(kdPinjam,4)) as kdMax from tblpinjam');
        if (empty($data)){
            $kode = '0001';
        }
        else {
            foreach($data as $kd){
                $tmp  = ((int)$kd->kdMax) + 1;
                $kode = sprintf("%04s",$tmp); 
            }
        }
        // $kodeAsli = $kodeSewa.'-'.$kode;
        $kodeAsli = $kodeSewa.date('ymd').$kode;
        return $kodeAsli;
    }

    public function cekKeranjang($kdSewa)
    {
        return DB::table('tblpinjam')
                ->leftJoin('tblPelanggan','tblpinjam.pelangganId','=','tblPelanggan.id')
                ->leftJoin('tblkaryawan','tblpinjam.karyawanId','=','tblkaryawan.id')
                ->leftJoin('tbldetailpinjam','tblpinjam.id','=','tbldetailpinjam.pinjamId')
                ->where('tblpinjam.kdPinjam','=',$kdSewa)
                ->get();
    }

    public function simpanPinjam($req, $kdKaryawan, $tgl)
    {
        return DB::table('tblpinjam')->insert([
            'kdPinjam'    => $req->kdSewa,
            'tglPinjam'   => $tgl,
            'pelangganId' => $req->pelanggan,
            'noJaminan'   => $req->noJaminan,
            'ket'         => $req->jaminan,
            'karyawanId'  => $kdKaryawan,
            'lamaPinjam'  => $req->lamaPinjam
        ]);
    }

    public function cekStatusPinjam($idPelanggan)
    {
        return DB::table('tblpinjam')
            ->where('pelangganId','=',$idPelanggan)
            ->where('statusSewa','=','2')
            ->first();
    }

    public function getDataPinjam($kdSewa)
    {
        return DB::table('tblpinjam')
            ->where('kdPinjam','=',$kdSewa)
            ->first();
    }

    public function batalPinjam($id)
    {
        return DB::table('tblpinjam')->where('id','=',$id)->delete();
    }

    public function addKeranjang($req, $pinjamId)
    {
        return DB::table('tbldetailpinjam')->insert([
            'alatId'    => $req->alatId,
            'jml'       => $req->jmlPinjam,
            'pinjamId'  => $pinjamId
        ]);
    }

    public function cekDetailAlatKeranjang($idAlat, $idSewa)
    {
        return DB::table('tbldetailpinjam')
            ->where('alatId','=',$idAlat)
            ->where('pinjamId','=',$idSewa)
            ->first();
    }

    public function ubahJumlah($idAlat, $idSewa, $jumlah)
    {
        return DB::table('tbldetailpinjam')
            ->where('alatId','=',$idAlat)
            ->where('pinjamId','=',$idSewa)
            ->update([
                'jml'   => $jumlah
            ]);
    }

    public function getDetailByIdSewa($idSewa)
    {
        return DB::table('tblpinjam')
            ->leftJoin('tblPelanggan','tblpinjam.pelangganId','=','tblPelanggan.id')
            ->leftJoin('tblkaryawan','tblpinjam.karyawanId','=','tblkaryawan.idKaryawan')
            ->leftJoin('tbldetailpinjam','tblpinjam.id','=','tbldetailpinjam.pinjamId')
            ->leftJoin('tblalat','tbldetailpinjam.alatId','=','tblalat.id')
            ->leftJoin('tblstok','tblalat.id','=','tblstok.alatId')
            ->where('tblpinjam.id','=',$idSewa)
            ->get();
    }

    public function hapusItem($idSewa, $idAlat)
    {
        return DB::table('tbldetailpinjam')->where('pinjamId','=',$idSewa)->where('alatId','=',$idAlat)->delete();
    }

    public function getDataByIdSewa($idSewa)
    {
        return DB::table('tblpinjam')->where('id','=',$idSewa)->first();
    }

    public function getDataUbahJumlah($idSewa, $idAlat)
    {
        return DB::table('tbldetailpinjam')
                ->leftJoin('tblalat','tbldetailpinjam.alatId','=','tblalat.id')
                ->where('tbldetailpinjam.pinjamId','=',$idSewa)
                ->where('tbldetailpinjam.alatId','=',$idAlat)
                ->first();
    }

    public function updateJumlah($jumlah, $idSewa, $idAlat)
    {
        return DB::table('tbldetailpinjam')
            ->where('pinjamId','=',$idSewa)
            ->where('alatId','=',$idAlat)
            ->update([
                'jml' => $jumlah
            ]);
    }

    public function getDataDetailPinjamByIdsewa($idSewa, $idAlat)
    {
        return DB::table('tbldetailpinjam')
            ->leftJoin('tblpinjam','tbldetailpinjam.pinjamId','=','tblpinjam.id')
            ->leftJoin('tblalat','tbldetailpinjam.alatId','=','tblalat.id')
            ->leftJoin('tblstok','tblalat.id','=','tblstok.alatId')
            ->select('tbldetailpinjam.pinjamId','tbldetailpinjam.alatid','tblstok.biayaSewa', 'tbldetailpinjam.jml', 'tblpinjam.lamaPinjam')
            ->where('tbldetailpinjam.pinjamId','=',$idSewa)
            ->where('tbldetailpinjam.alatId','=',$idAlat)
            ->first();
    }

    public function ubahTtlbiayaByIdsewa($idSewa, $idAlat, $ttlBiaya)
    {
        return DB::table('tbldetailpinjam')
            ->where('pinjamId','=',$idSewa)
            ->where('alatId','=',$idAlat)
            ->update([
                'ttlBiaya'  => $ttlBiaya
            ]);       
    }

    public function cekDetailPinjamByIdSewa($idSewa)
    {
        return DB::table('tbldetailpinjam')->where('pinjamId','=',$idSewa)->first();
    }

    public function updateStatusTtlBayar($idSewa, $total)
    {
        return DB::table('tblpinjam')
                ->where('id','=',$idSewa)
                ->update([
                    'statusSewa'    => '2',
                    'totalBayar'    => $total,
                    'statusBayar'   => 1
                ]);
    }

    public function getDataPinjamByKdPinjam($kdPinjam)
    {
        return DB::table('tblpinjam')->where('kdPinjam','=',$kdPinjam)->first();
    }

    public function updateDenda($idSewa, $idAlat, $denda)
    {
        return DB::table('tbldetailpinjam')
            ->where('pinjamId','=',$idSewa)
            ->where('alatId','=',$idAlat)
            ->update([
                'ttlDenda' => $denda
            ]);
    }

    public function simpanBooking($req, $kdSewa, $pelangganId, $tgl)
    {
        return DB::table('tblpinjam')->insert([
            'kdPinjam'    => $kdSewa,
            'tglPinjam'   => $tgl,
            'pelangganId' => $pelangganId,
            'noJaminan'   => '',
            'ket'         => '',
            'karyawanId'  => '',
            'lamaPinjam'  => '0'
        ]);
    }

    public function updateTtlBayar($idSewa, $total)
    {
        return DB::table('tblpinjam')
                ->where('id','=',$idSewa)
                ->update([
                    'statusSewa'    => '1',
                    'totalBayar'    => $total
                ]);
    }

    public function updateLamaPinjam($idSewa, $lamaPinjam)
    {
        return DB::table('tblpinjam')
            ->where('id','=',$idSewa)
            ->update([
                'lamaPinjam'    => $lamaPinjam
            ]);
    }

    public function jmlBooking($id)
    {
        return DB::table('tblpinjam')   
            ->where('pelangganId','=',$id)
            ->where('statusSewa','=','1')
            ->get();
    }

    public function getDataByStatusBooking($idPelanggan)
    {
        return DB::table('tblpinjam')
                ->leftJoin('tblpelanggan','tblpinjam.pelangganId','=','tblPelanggan.id')
                ->where('tblPelanggan.id','=',$idPelanggan)
                ->where('tblpinjam.statusSewa','=','1')
                ->get();
    }

    public function getStsKembaliByIdSewa($idSewa)
    {
        return DB::table('tbldetailpinjam')
            ->where('pinjamId','=',$idSewa)
            ->where('stskembali','=',0)
            ->get();
    }

    public function getSingleDataByIdSewa($idSewa, $alatId)
    {
        return DB::table('tblpinjam')
            ->leftJoin('tblPelanggan','tblpinjam.pelangganId','=','tblPelanggan.id')
            ->leftJoin('tblkaryawan','tblpinjam.karyawanId','=','tblkaryawan.idKaryawan')
            ->leftJoin('tbldetailpinjam','tblpinjam.id','=','tbldetailpinjam.pinjamId')
            ->leftJoin('tblalat','tbldetailpinjam.alatId','=','tblalat.id')
            ->leftJoin('tblstok','tblalat.id','=','tblstok.alatId')
            ->where('tblpinjam.id','=',$idSewa)
            ->where('tblalat.kdAlat','=',$alatId)
            ->first();
    }   

    public function updateStsKembali($pinjamId, $alatId)
    {
        return DB::table('tbldetailpinjam')
            ->where('pinjamId','=',$pinjamId)
            ->where('alatId','=',$alatId)
            ->update([
                'stsKembali'    => 1
            ]);
    }

    public function updateDendaHilang($req, $pinjamId, $alatId, $ttlDendaHilang)
    {
        return DB::table('tbldetailpinjam')
            ->where('pinjamId','=',$pinjamId)
            ->where('alatId','=',$alatId)
            ->update([
                'jmlBaik'           => $req->alatBaik,
                'jmlRusak'          => $req->alatRusak,
                'biayaAlatRusak'    => $req->biayaAlatRusak,
                'ttlDendaHilang'    => $ttlDendaHilang
            ]);
    }

    public function getDataKonfirmasi($kdSewa)
    {
        return DB::table('tblpinjam')->where('kdPinjam','=',$kdSewa)->first();
    }

    public function simpanPemberitahuan($tgl, $isi)
    {
        return DB::table('tblpemberitahuan')->insert([
            'tgl'    => $tgl,
            'isi'    => $isi,
            'status' => '0'
        ]);
    }

    public function getPemberitahuan()
    {
        return DB::table('tblpemberitahuan')->where('status','0')->get();
    }

    public function ubahStatusPemberitahuan($id)
    {
        return DB::table('tblpemberitahuan')->where('id',$id)->update(['status' => '1']);
    }

    public function getPemberitahuanById($id)
    {
        return DB::table('tblpemberitahuan')->where('id',$id)->first();
    }

    public function jmlPemberitahuan()
    {
        return DB::table('tblpemberitahuan')
            ->select(DB::raw('count(*) as jml'))
            ->where('status','0')
            ->get();
    }
}
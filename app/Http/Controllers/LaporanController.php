<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\laporan;
use App\model\biaya;
use App\model\pinjam;

class LaporanController extends Controller
{
    public function formAlatLaporan(laporan $laporan, pinjam $pinjam)
    {
    	$alats = $laporan->laporanAlatForm();
    	if (count($alats)==0){
    		return redirect('/admin')->with('alerts',[['type' => 'success', 'text' => 'Data Tidak Ada']]);
    	}
    	else{
            $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
    		return view('admin.laporan.alat.formLaporan',compact('alats', 'jmlPemberitahuan'));
    	}
    }

    public function formSuplierLaporan(laporan $laporan, pinjam $pinjam)
    {
    	$supliers = $laporan->laporanSuplierForm();
    	if (count($supliers)==0){
    		return redirect('/admin')->with('alerts',[['type' => 'success', 'text' => 'Data Tidak Ada']]);
    	}
    	else{
            $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
    		return view('admin.laporan.suplier.formLaporan',compact('supliers', 'jmlPemberitahuan'));
    	}
    }

    public function detailLaporanAlat(laporan $laporan, pinjam $pinjam)
    {
    	$alats = $laporan->laporanAlatForm();
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.laporan.alat.preview', compact('alats', 'jmlPemberitahuan'));
    }

    public function previewLaporanSuplier(laporan $laporan, pinjam $pinjam)
    {
    	$supliers = $laporan->laporanSuplierForm();	
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.laporan.suplier.preview',compact('supliers', 'jmlPemberitahuan'));
    }

    public function formKaryawanLaporan(laporan $laporan, pinjam $pinjam)
    {
    	$karyawans = $laporan->laporanKaryawanForm();
    	if (count($karyawans)==0){
    		return redirect('/admin')->with('alerts',[['type' => 'success', 'text' => 'Data Tidak Ada']]);
    	}
    	else{
            $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
    		return view('admin.laporan.karyawan.formLaporan',compact('karyawans', 'jmlPemberitahuan'));
    	};
    }

    public function previewLaporanKaryawan(laporan $laporan, pinjam $pinjam)
    {
    	$karyawans = $laporan->laporanKaryawanForm();
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.laporan.karyawan.preview',compact('karyawans', 'jmlPemberitahuan'));
    }

    public function formPelangganLaporan(laporan $laporan, pinjam $pinjam)
    {
    	$pelanggans = $laporan->laporanPelangganForm();
    	if (count($pelanggans)==0){
    		return redirect('/admin')->with('alerts',[['type' => 'success', 'text' => 'Data Tidak Ada']]);
    	}
    	else{
            $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
    		return view('admin.laporan.pelanggan.formLaporan',compact('pelanggans', 'jmlPemberitahuan'));
    	};
    }

    public function previewLaporanPelanggan(laporan $laporan, pinjam $pinjam)
    {
    	$pelanggans = $laporan->laporanPelangganForm();
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

    	return view('admin.laporan.pelanggan.preview',compact('pelanggans', 'jmlPemberitahuan'));
    }

    public function formBiayaLaporan(pinjam $pinjam)
    {
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        return view('admin.laporan.biaya.form', compact('jmlPemberitahuan'));
    }

    public function prosesBiayaLaporan(Request $req, laporan $laporan, pinjam $pinjam)
    {
        $this->validate($req,[
            'blnLaporan' => 'required',
            'thnLaporan' => 'required'
        ]);

        // laporan 
        $bulan = $req->thnLaporan.'-'.$req->blnLaporan;
        $bln = $this->getBulanIndo($req->blnLaporan);
        $thn = $req->thnLaporan;

        $lists = $laporan->getAllLaporanBiayaStatusKosong($req->blnLaporan, $req->thnLaporan);
        $total = 0;
        foreach($lists as $l){
            $total += $l->biayaOperasional;
        };


        if (count($lists)){
            $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
            return view('admin.laporan.biaya.semua', compact('lists', 'bulan', 'bln', 'thn', 'total', 'jmlPemberitahuan'));
        }
       
        return back()->with('alerts',[['type' => 'success', 'text' => 'Data Tidak Ada']]);

    }

    public function previewSemua($bulan, laporan $laporan, pinjam $pinjam)
    {
         $pisah = explode('-', $bulan);
         $bln = $this->getBulanIndo($pisah[1]);
         $thn = $pisah[0];

         $lists = $laporan->getAllLaporanBiayaStatusKosong($pisah[1], $pisah[0]);
         $total = 0;
         foreach($lists as $l){
             $total += $l->biayaOperasional;
         };
        
         $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
         return view('admin.laporan.biaya.previewSemua', compact('lists', 'bln', 'thn', 'total', 'jmlPemberitahuan'));  
    }

    public function previewDetail($id, biaya $biaya, pinjam $pinjam)
    {
         $dataBiaya  = $biaya->getBiayaById($id);
         $listDetail = $biaya->getDetailById($id);
         $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

         return view('admin.laporan.biaya.detailPreview', compact('listDetail', 'dataBiaya', 'jmlPemberitahuan'));
    }

    public function formGajiLaporan(pinjam $pinjam)
    {
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        return view('admin.laporan.gaji.form', compact('jmlPemberitahuan'));
    }

    public function prosesGajiLaporan(Request $req, laporan $laporan, pinjam $pinjam)
    {
        $this->validate($req,[
            'blnLaporan' => 'required',
            'thnLaporan' => 'required'
        ]);

        // laporan 
        $bulan = $req->thnLaporan.'-'.$req->blnLaporan;
        $bln = $this->getBulanIndo($req->blnLaporan);
        $thn = $req->thnLaporan;

        $lists = $laporan->getAllLaporanGaji($req->blnLaporan, $req->thnLaporan);
        $total = 0;
         foreach($lists as $l){
             $total += $l->gaji;
         };

        if (count($lists)){
            $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
            return view('admin.laporan.gaji.laporan', compact('lists', 'bulan', 'bln', 'thn', 'total', 'jmlPemberitahuan')); 
        }
       
        return back()->with('alerts',[['type' => 'success', 'text' => 'Data Tidak Ada']]);

    }

    private function getBulanIndo($bln)
    {
        switch ($bln) {
            case '1':
                $bulanIndo = 'Januari';
                break;

            case '2':
                $bulanIndo = 'Februari';
                break;

             case '3':
                $bulanIndo = 'Maret';
                break;

             case '4':
                $bulanIndo = 'April';
                break;

             case '5':
                $bulanIndo = 'Mei';
                break;

             case '6':
                $bulanIndo = 'Juni';
                break;

             case '7':
                $bulanIndo = 'Juli';
                break;

             case '8':
                $bulanIndo = 'Agustus';
                break;

             case '9':
                $bulanIndo = 'September';
                break;

             case '10':
                $bulanIndo = 'Oktober';
                break;

             case '11':
                $bulanIndo = 'November';
                break;

             case '12':
                $bulanIndo = 'Desember';
                break;
            
            default:
                $bulanIndo = 'Tidak Ada';
                break;
        }

        return $bulanIndo;
    }

    public function previewGajiLaporan($bulan, laporan $laporan, pinjam $pinjam)
    {
        $bulan = explode('-', $bulan);
        $bln = $this->getBulanIndo($bulan[1]);
        $thn = $bulan[0];

        $lists = $laporan->getAllLaporanGaji($bulan[1], $bulan[0]);
        $total = 0;
            foreach($lists as $l){
                $total += $l->gaji;
        };

        if (count($lists)){
            $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
            return view('admin.laporan.gaji.preview', compact('lists', 'bulan', 'bln', 'thn', 'total', 'jmlPemberitahuan')); 
        }
    }

    public function formPenyewaanLaporan(pinjam $pinjam)
    {
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        return view('admin.laporan.penyewaan.form', compact('jmlPemberitahuan'));
    }

    public function prosesPenyewaanLaporan(Request $req, laporan $laporan, pinjam $pinjam)
    {
        $this->validate($req,[
            'blnLaporan' => 'required',
            'thnLaporan' => 'required'
        ]);

        // laporan 
        $bulan = $req->thnLaporan.'-'.$req->blnLaporan;
        $bln = $this->getBulanIndo($req->blnLaporan);
        $thn = $req->thnLaporan;

        $lists = $laporan->getAllLaporanPenyewaan($req->blnLaporan, $req->thnLaporan);
        $total = 0;
        foreach($lists as $l){
            $total += $l->totalBayar;
        };

        if (count($lists)){
            $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
            return view('admin.laporan.penyewaan.semua', compact('lists', 'bulan', 'bln', 'thn', 'total', 'jmlPemberitahuan'));
        }
       
        return back()->with('alerts',[['type' => 'success', 'text' => 'Data Tidak Ada']]);
    }

    public function previewSemuaPenyewaan($bulan, laporan $laporan, pinjam $pinjam)
    {
        $pisah = explode('-', $bulan);
         $bln = $this->getBulanIndo($pisah[1]);
         $thn = $pisah[0];

         $lists = $laporan->getAllLaporanPenyewaan($pisah[1], $pisah[0]);
         $total = 0;
         foreach($lists as $l){
            $total += $l->totalBayar;
         };

         $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
         return view('admin.laporan.penyewaan.previewSemua', compact('lists', 'bln', 'thn', 'total', 'jmlPemberitahuan'));  
    }

    public function previewDetailPenyewaan($id, laporan $laporan, pinjam $pinjam)
    {
         $listDetail = $laporan->getLaporanPenyewaanDetail($id);
         $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

         return view('admin.laporan.penyewaan.previewDetail', compact('listDetail', 'jmlPemberitahuan'));
    }

    public function formPengembalianLaporan(pinjam $pinjam)
    {
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        return view('admin.laporan.pengembalian.form', compact('jmlPemberitahuan'));
    }

    public function prosesPengembalianLaporan(Request $req, laporan $laporan, pinjam $pinjam)
    {
        $this->validate($req,[
            'blnLaporan' => 'required',
            'thnLaporan' => 'required'
        ]);

        // laporan 
        $bulan = $req->thnLaporan.'-'.$req->blnLaporan;
        $bln = $this->getBulanIndo($req->blnLaporan);
        $thn = $req->thnLaporan;

        $lists = $laporan->getAllLaporanPengembalian($req->blnLaporan, $req->thnLaporan);
        $denda       = 0;
        $dendaHilang = 0;
        $totalDenda  = 0;

        foreach($lists as $l){
            $denda += $l->denda;
            $dendaHilang += $l->dendaHilang;
            $totalDenda += $l->denda + $l->dendaHilang;
        };

        if (count($lists)){
            $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
            return view('admin.laporan.pengembalian.semua', compact('lists', 'bulan', 'bln', 'thn', 'denda', 'dendaHilang', 'totalDenda', 'jmlPemberitahuan'));
        }
       
        return back()->with('alerts',[['type' => 'success', 'text' => 'Data Tidak Ada']]);
    }

    public function previewSemuaPengembalian($bulan, laporan $laporan, pinjam $pinjam)
    {
         $pisah = explode('-', $bulan);
         $bln = $this->getBulanIndo($pisah[1]);
         $thn = $pisah[0];

         $lists = $laporan->getAllLaporanPengembalian($pisah[1], $pisah[0]);
         $denda       = 0;
         $dendaHilang = 0;
         $totalDenda  = 0;

         foreach($lists as $l){
             $denda += $l->denda;
             $dendaHilang += $l->dendaHilang;
             $totalDenda += $l->denda + $l->dendaHilang;
         };

         $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
         return view('admin.laporan.pengembalian.previewSemua', compact('lists', 'bln', 'thn', 'denda', 'dendaHilang', 'totalDenda', 'jmlPemberitahuan'));  
    }

    public function previewDetailPengembalian($kdKembali, laporan $laporan, pinjam $pinjam)
    {
         $listDetail = $laporan->getLaporanPengembalianDetail($kdKembali);
         $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
         return view('admin.laporan.pengembalian.previewDetail', compact('listDetail' ,'jmlPemberitahuan'));
    }

    public function formPembelianLaporan(pinjam $pinjam)
    {
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        return view('admin.laporan.pembelian.form', compact('jmlPemberitahuan'));
    }

    public function prosesPembelianLaporan(Request $req, laporan $laporan, pinjam $pinjam)
    {
        $this->validate($req,[
            'blnLaporan' => 'required',
            'thnLaporan' => 'required'
        ]);

        // laporan 
        $bulan = $req->thnLaporan.'-'.$req->blnLaporan;
        $bln = $this->getBulanIndo($req->blnLaporan);
        $thn = $req->thnLaporan;

        $lists = $laporan->getAllPembelian($req->blnLaporan, $req->thnLaporan);
        $total = 0;
        foreach($lists as $l){
            $total += $l->ttlBeli;
        };

        if (count($lists)){
            $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
            return view('admin.laporan.pembelian.semua', compact('lists', 'bulan', 'bln', 'thn', 'total', 'jmlPemberitahuan'));
        }
       
        return back()->with('alerts',[['type' => 'success', 'text' => 'Data Tidak Ada']]);
    }

    public function previewSemuaPembelian($bulan, laporan $laporan, pinjam $pinjam)
    {
        $pisah = explode('-', $bulan);
        $bln = $this->getBulanIndo($pisah[1]);
        $thn = $pisah[0];

        $lists = $laporan->getAllPembelian($pisah[1], $pisah[0]);
        $total = 0;
        foreach($lists as $l){
            $total += $l->ttlBeli;
        };

        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        return view('admin.laporan.pembelian.previewSemua', compact('lists', 'bln', 'thn', 'total', 'jmlPemberitahuan'));  
    }

    public function previewDetailPembelian($idKembali, laporan $laporan, pinjam $pinjam)
    {
        $dataBeli   = $laporan->getBeliById($idKembali);
        $listDetail = $laporan->getPembelianDetail($idKembali);
        $total = 0;
        foreach($listDetail as $detail){
            $total += $detail->sub;
        };
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        return view('admin.laporan.pembelian.previewDetail', compact('listDetail', 'dataBeli', 'total' ,'jmlPemberitahuan'));
    }

    public function formLabaRugiLaporan(pinjam $pinjam)
    {
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();
        return view('admin.laporan.labarugi.form', compact('jmlPemberitahuan'));
    }

    public function prosesLabaRugiLaporan(Request $req, laporan $laporan, pinjam $pinjam)
    {
        $this->validate($req,[
            'blnLaporan' => 'required',
            'thnLaporan' => 'required'
        ]);

        // laporan 
        $bulan = $req->thnLaporan.'-'.$req->blnLaporan;
        $bln = $this->getBulanIndo($req->blnLaporan);
        $thn = $req->thnLaporan;

        $laporan->hapusRugiLabaPerBulan($req->blnLaporan, $req->thnLaporan);

        // pendapatan
        $dapatSewa   = $laporan->pendapatanSewa($req->blnLaporan, $req->thnLaporan);
        $dapatDenda  = $laporan->pendapatanDenda($req->blnLaporan, $req->thnLaporan);
        $dapatHilang = $laporan->pendapatanHilang($req->blnLaporan, $req->thnLaporan);
        $ttlPendapatan = $dapatSewa->pendapatanSewa + $dapatDenda->pendapatanDenda + $dapatHilang->pendapatanHilang;

        // pengeluaran
        $keluarBeli = $laporan->pengeluaranBeli($req->blnLaporan, $req->thnLaporan);
        $keluarOpr  = $laporan->pengeluaranOperasional($req->blnLaporan, $req->thnLaporan);
        $keluarGaji = $laporan->pengeluaranGaji($req->blnLaporan, $req->thnLaporan);
        $ttlPengeluaran = $keluarBeli->keluarBeli + $keluarOpr->keluarOperasional + $keluarGaji->keluarGaji;
        // dd($dapatSewa);

        // simpan cara gaptek
        $laporan->simpanRugiLaba($req->blnLaporan, $req->thnLaporan, 'Pendapatan Dari Penyewaan Alat', $dapatSewa->pendapatanSewa, 0);
        $laporan->simpanRugiLaba($req->blnLaporan, $req->thnLaporan, 'Pendapatan Dari Denda Keterlambatan Pengembalian', $dapatDenda->pendapatanDenda, 0);
        $laporan->simpanRugiLaba($req->blnLaporan, $req->thnLaporan, 'Pendapatan Dari Denda Alat Rusak / Hilang', $dapatHilang->pendapatanHilang, 0);

        $laporan->simpanRugiLaba($req->blnLaporan, $req->thnLaporan, 'Pengeluaran Untuk Pembelian Peralatan', 0, $keluarBeli->keluarBeli);
        $laporan->simpanRugiLaba($req->blnLaporan, $req->thnLaporan, 'Pengeluaran Untuk Biaya Operasional', 0, $keluarOpr->keluarOperasional);
        $laporan->simpanRugiLaba($req->blnLaporan, $req->thnLaporan, 'Pengeluaran Untuk Penggajihan Karyawan', 0, $keluarGaji->keluarGaji);

        $lists = $laporan->getLabaRugi();
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.laporan.labarugi.semua', compact('lists', 'bulan', 'bln', 'thn', 'ttlPendapatan', 'ttlPengeluaran', 'jmlPemberitahuan'));
    }

    public function previewSemuaLabaRugi($bulan, laporan $laporan, $ttlPendapatan, $ttlPengeluaran, pinjam $pinjam)
    {
        $pisah = explode('-', $bulan);
        $bln = $this->getBulanIndo($pisah[1]);
        $thn = $pisah[0];

        $lists = $laporan->getLabaRugi();
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.laporan.labarugi.preview', compact('lists', 'bln', 'thn', 'ttlPengeluaran', 'ttlPendapatan', 'jmlPemberitahuan'));  
    }

}

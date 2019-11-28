<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\booking;
use App\model\pinjam;
use App\model\stok;

class BookingAdminController extends Controller
{
    public function listBookingAdmin(Request $req, booking $booking, pinjam $pinjam)
    {
        $listBooking = $booking->getStatusBookingNull();

        if($req->has('q')){
            $cari = $req->input('q');
            $listBooking = $booking->cariBooking($cari);
        };

        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.booking.list',compact('listBooking', 'jmlPemberitahuan'));
    }

    public function batalBooking($kdPinjam, pinjam $pinjam, stok $stok)
    {
    	$dataPinjam = $pinjam->getDataPinjamByKdPinjam($kdPinjam);
        $cekData = $pinjam->cekDetailPinjamByIdSewa($dataPinjam->id);
        if (!empty($cekData)){
            $dataPjm = $pinjam->getDetailByIdSewa($dataPinjam->id);
            $stokBaru   = 0;
            foreach($dataPjm as $pjm){
                $dataAlat = $stok->getStokByIdSederhana($pjm->alatId);

                $stokBaru = $pjm->jml + $dataAlat->stok;
                $stok->ubahStokById($pjm->alatId, $stokBaru);
            };
        };

        $pinjam->batalPinjam($dataPinjam->id);
        return back()->with('alerts',[['type' => 'success', 'text' => 'Penghapusan Data Berhasil']]);
    }

    public function prosesPinjam($idPinjam, booking $booking, pinjam $pinjam)
    {
        $booking = $booking->getDataById($idPinjam);
        $jmlPemberitahuan   = $pinjam->jmlPemberitahuan();

        return view('admin.booking.form', compact('booking', 'jmlPemberitahuan'));
    }

    public function prosesPinjamSimpan(Request $req, $kdPinjam, booking $booking)
    {
        $this->validate($req,[
            'jaminan'   => 'required',
            'noJaminan' => 'required'
        ]);
        // ubah data tabl pinjam berdasarkan id / kode pinjam
        $booking->updateTblPinjam($req, $kdPinjam, date('Y-m-d'), session('auth')->idKaryawan);
        return redirect('/admin/booking/list')->with('alerts',[['type' => 'success', 'text' => 'Data Berhasil Diproses']]);
    }

    public function detailKonfirmasi($kdSewa, pinjam $pinjam)
    {
        $data = $pinjam->getDataKonfirmasi($kdSewa);
        return view('admin.booking.konfirmasi',compact('data'));
    }
}

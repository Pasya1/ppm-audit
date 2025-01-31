<?php

namespace App\Http\Controllers;

use App\Models\detailRTL;
use App\Models\HasilRtl;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DetailRTLController extends Controller
{

    public function detail($id)
    {
        $detailHasilRTL = HasilRtl::where('id', $id)->first();
        $alldetail = detailRTL::where('hasil_r_t_l_id', $id)->get();
        $user = Auth::user();

        return view('detailhasilrtl', compact('detailHasilRTL', 'alldetail', 'user'));
    }

    public function store(Request $request, $id = null)
    {

        // Validasi dan simpan data
        $request->validate([
            'pernyataan_standar' => 'nullable|string',
            'keterangan_hasil_AMI' => 'nullable|string',
            'rencana_tindak_lanjut' => 'nullable|string',
            'sumber_daya' => 'nullable|string',
            'hasil_RTL' => 'nullable|string',
        ]);


        $detailHasilRTL = new detailRTL;

        $detailHasilRTL->pernyataan_standar = $request->pernyataan_standar;
        $detailHasilRTL->keterangan_hasil_AMI = $request->keterangan_hasil_AMI;
        $detailHasilRTL->rencana_tindak_lanjut = $request->rencana_tindak_lanjut;
        $detailHasilRTL->sumber_daya = $request->sumber_daya;
        $detailHasilRTL->hasil_RTL = $request->hasil_RTL;
        $detailHasilRTL->hasil_r_t_l_id = $id;

        $detailHasilRTL->save();

        return redirect()->back()->with('success', 'Detail Hasil RTL berhasil disimpan!');
    }

    public function update(Request $request)
    {
        $id = $request->editId;
        // Temukan data berdasarkan ID
        $detailHasilRTL = detailRTL::findOrFail($id);

        // Update data berdasarkan input yang dikirimkan
        $detailHasilRTL->update([
            'pernyataan_standar' => $request->pernyataan_standar_edit,
            'keterangan_hasil_AMI' => $request->keterangan_hasil_AMI_edit,
            'rencana_tindak_lanjut' => $request->rencana_tindak_lanjut_edit,
            'sumber_daya' => $request->sumber_daya_edit,
            'hasil_RTL' => $request->hasil_RTL_edit,
        ]);

        // Redirect ke halaman index atau halaman lain yang sesuai
        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id, Request $request)
    {
        // Validasi untuk memastikan ID yang diterima valid
        $detailAudit = detailRTL::findOrFail($id);

        // Proses penghapusan
        $detailAudit->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function downloadPDF($id)
    {
        $HasilRTL = HasilRtl::findOrFail($id);
        $detailRTL = detailRTL::where('hasil_r_t_l_id', $id)->get();
        $site = Site::first();

        // Muat data ke dalam PDF
        $pdf = PDF::loadView('pdf.cetak_hasil_RTL', compact('HasilRTL', 'detailRTL', 'site'));

        return $pdf->stream('Hasil-Rencana-Tindak-Lanjut.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DaftarTilik;
use App\Models\DeskEvaluation;
use App\Models\detailHasilAudit;
use App\Models\detailtindaklanjut;
use App\Models\Documents;
use App\Models\HasilAudit;
use App\Models\Site;
use App\Models\Standart;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class DetailHasilAuditController extends Controller
{
    public function detail($id)
    {
        $detailHasilAudit = HasilAudit::where('id', $id)->first();
        $alldetail = detailHasilAudit::where('hasil_audit_id', $id)->get();
        $standarts = Standart::all();
        $documents = Documents::all();
        $user = Auth::user();

        return view('detailhasilaudit', compact('detailHasilAudit', 'alldetail', 'standarts', 'user', 'documents'));
    }

    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'dokumen_acuan' => 'required|exists:standarts,id',
            'deskripsi_temuan' => 'required|string|max:500',
            'status_temuan' => 'required|in:open,close,ob',
            'tindakan_koreksi' => 'required|string|max:500',
        ]);

        $standart = Standart::find($validatedData['dokumen_acuan']);
        if (!$standart) {
            return redirect()->back()->withErrors(['dokumen_acuan' => 'Dokumen acuan tidak ditemukan.']);
        }
        $dokumenAcuan = $standart->dokumen_acuan;

        $isOpen = $validatedData['status_temuan'] === 'open';
        $isClose = $validatedData['status_temuan'] === 'close';
        $isOb = $validatedData['status_temuan'] === 'ob';
        // Simpan data ke database
        detailHasilAudit::create([
            'standart_id' => $validatedData['dokumen_acuan'],
            'hasil_audit_id' => $id,
            'dokumen_acuan' => $dokumenAcuan,
            'deskripsi_temuan' => $validatedData['deskripsi_temuan'],
            'OPEN' => $isOpen,
            'CLOSE' => $isClose,
            'OB' => $isOb,
            'permintaan_tindakan_koreksi' => $validatedData['tindakan_koreksi'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Detail hasil audit berhasil ditambahkan.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:detail_hasil_audits,id',
            'standart_id' => 'required',
            'deskripsi_temuan' => 'required',
            'status_temuan' => 'required',
            'permintaan_tindakan_koreksi' => 'nullable',
        ]);

        $detail = detailHasilAudit::find($request->id);
        $detail->dokumen_acuan = $request->standart_id;
        $detail->deskripsi_temuan = $request->deskripsi_temuan;
        $detail->OPEN = $request->status_temuan === 'open';
        $detail->CLOSE = $request->status_temuan === 'close';
        $detail->OB = $request->status_temuan === 'ob';
        $detail->permintaan_tindakan_koreksi = $request->permintaan_tindakan_koreksi;
        $detail->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id, Request $request)
    {
        // Validasi untuk memastikan ID yang diterima valid
        $detailAudit = detailHasilAudit::findOrFail($id);

        // Proses penghapusan
        $detailAudit->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function downloadPDF($id, Request $request)
    {
        // Ambil dokumen berdasarkan ID
        $includePenilaian = $request->query('include_penilaian', 'null');
        $hasilAudit = HasilAudit::findOrFail($id);
        $site = Site::first();
        $detailHasilAudit = detailHasilAudit::where('hasil_audit_id', $id)->get();
        $detailTindakLanjut = detailtindaklanjut::where('hasil_audit_id', $id)->get();
        $validasi = Validasi::where('hasil_audit_id', $id)->first();

        // Ambil dokumen jika include_penilaian tidak 'null'
        $standarts = [];
        $selectedDocument = null;
        $deskEvaluation = [];
        $daftarTilik = [];

        if ($includePenilaian !== 'null') {
            $selectedDocument = Documents::find($includePenilaian);
            // Ambil semua Standart terkait dokumen
            $standarts = Standart::where('dokumen_audit_id', $includePenilaian)->get();

            if ($standarts->isEmpty()) {
                // Set flash message ke session
                session()->flash('error', 'Tidak dapat mencetak hasil karna auditor belum melakukan penilaian');

                // Redirect ke halaman sebelumnya
                return redirect()->back();
            }

            // Ambil semua Desk Evaluation berdasarkan dokumen ID dan setiap Standart ID
            $deskEvaluation = DeskEvaluation::where('document_id', $includePenilaian)
                ->whereIn('standart_id', $standarts->pluck('id'))
                ->get();

            // Ambil semua Daftar Tilik berdasarkan Standart ID
            $daftarTilik = DaftarTilik::whereIn('standart_id', $standarts->pluck('id'))->get();
        }

        // Periksa apakah ada data
        if ($detailHasilAudit->isEmpty()) {
            // Set flash message ke session
            session()->flash('error', 'Tidak dapat mencetak hasil karna auditor belum menambahkan deskripsi temuan');

            // Redirect ke halaman sebelumnya
            return redirect()->back();
        }

        // Muat data ke dalam PDF
        $pdf = PDF::loadView('pdf.cetakdetailaudit_hasil', compact('hasilAudit', 'detailHasilAudit', 'detailTindakLanjut', 'site', 'validasi', 'selectedDocument', 'standarts', 'deskEvaluation', 'daftarTilik'));

        return $pdf->stream('hasil_audit.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DaftarTilik;
use App\Models\DeskEvaluation;
use App\Models\Documents;
use App\Models\Standart;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StandartController extends Controller
{
    public function standart($id)
    {
        $document = Documents::findOrFail($id);

        // Ambil semua data dari tabel atau model Standart
        $standarts = Standart::where('dokumen_audit_id', $id)->get();
        $user = Auth::user();

        // Kirim kedua data ke view
        return view('standart', compact('document', 'standarts', 'user'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama_standart' => 'required|string|max:255',
            'dokumen_audit_id' => 'required|exists:documents,id', // Pastikan ID valid
        ]);

        // Simpan data ke tabel Standart
        Standart::create([
            'dokumen_audit_id' => $validated['dokumen_audit_id'],
            'dokumen_acuan' => $validated['nama_standart'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Standart berhasil ditambahkan!');
    }

    public function update(Request $request, $idstandart)
    {
        $validatedData = $request->validate([
            'nama_standart_edit' => 'required|string',
        ]);
        $validatedData['dokumen_acuan'] = $validatedData['nama_standart_edit'];
        unset($validatedData['nama_standart_edit']);

        $standart = Standart::findOrFail($idstandart);
        // Lakukan update
        $standart->update($validatedData);

        // Redirect atau Feedback
        return redirect()->back()->with('success', 'Standart berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $standart = Standart::findOrFail($id);

        try {
            $standart->delete();
            return redirect()->back()->with('success', 'Dokumen Acuan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus dokumen acuan.');
        }
    }

    public function downloadPDF($documentId)
    {
        // Ambil dokumen berdasarkan ID
        $dokumen = Documents::findOrFail($documentId);

        // Ambil semua Standart terkait dokumen
        $standarts = Standart::where('dokumen_audit_id', $documentId)->get();

        // Periksa apakah ada data Standart
        if ($standarts->isEmpty()) {
            // Set flash message ke session
            session()->flash('error', 'Tidak dapat mencetak hasil karna auditor belum melakukan penilaian');

            // Redirect ke halaman sebelumnya
            return redirect()->back();
        }



        // Ambil semua Desk Evaluation berdasarkan dokumen ID dan setiap Standart ID
        $deskEvaluation = DeskEvaluation::where('document_id', $documentId)
            ->whereIn('standart_id', $standarts->pluck('id'))
            ->get();

        // Ambil semua Daftar Tilik berdasarkan Standart ID
        $daftarTilik = DaftarTilik::whereIn('standart_id', $standarts->pluck('id'))->get();

        // Muat data ke dalam PDF
        $pdf = PDF::loadView('pdf.cetak_hasil', compact('dokumen', 'standarts', 'deskEvaluation', 'daftarTilik'));

        return $pdf->stream('hasil_evaluasi.pdf');
    }
}

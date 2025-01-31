<?php

namespace App\Http\Controllers;

use App\Models\DaftarTilik;
use App\Models\Documents;
use App\Models\Standart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarTilikController extends Controller
{
    public function DaftarTilik($documentId, $standartId)
    {
        // Mengambil data dokumen dan standar berdasarkan ID
        $document = Documents::findOrFail($documentId);
        $standart = Standart::findOrFail($standartId);
        $data = DaftarTilik::all();
        $user = Auth::user();

        $DaftartilikData = DaftarTilik::where('document_id', $documentId)
            ->where('standart_id', $standartId)
            ->get();

        // Mengambil atau membuat evaluasi desk berdasarkan dokumentasi dan standar
        // $deskEvaluation = DeskEvaluation::firstOrCreate(
        //     ['document_id' => $documentId, 'standart_id' => $standartId],
        //     ['evaluation_result' => '']
        // );
        // Mengembalikan view dengan data evaluasi desk
        return view('daftar_tilik', compact('document', 'standart', 'data', 'DaftartilikData', 'user'));
    }
    public function store(Request $request, $documentId, $standartId)
    {
        // Validasi data
        $validated = $request->validate([
            'pertanyaan_DaftarTilik' => 'required|string|max:255',
            'document_id' => 'required|exists:documents,id',
            'standart_id' => 'required|exists:standarts,id',
        ]);


        // Simpan data ke tabel Standart
        DaftarTilik::create([
            'document_id' => $documentId,
            'standart_id' => $standartId,
            'pertanyaan_tilik' => $validated['pertanyaan_DaftarTilik'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $ids = array_keys($data['dokumen_terkait_tilik'] ?? []);

        foreach ($ids as $id) {
            DaftarTilik::where('id', $id)->update([
                'dokumen_terkait_tilik' => $data['dokumen_terkait_tilik'][$id] ?? null,
                'tanggapan_audit' => $data['tanggapan_audit'][$id] ?? null,
                'hasil_audit' => $data['hasil_audit'][$id] ?? null,
                'my_tilik' => isset($data['my_tilik'][$id]),
                'mb_tilik' => isset($data['mb_tilik'][$id]),
                'm_tilik' => isset($data['m_tilik'][$id]),
                'mp_tilik' => isset($data['mp_tilik'][$id]),
                'rekomendasi' => $data['rekomendasi'][$id] ?? null,
            ]);
        }
        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id, Request $request)
    {
        // Validasi untuk memastikan ID yang diterima valid
        $daftarTilik = DaftarTilik::findOrFail($id);

        // Proses penghapusan
        $daftarTilik->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}

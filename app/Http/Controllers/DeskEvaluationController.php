<?php

namespace App\Http\Controllers;

use App\Models\DeskEvaluation;
use App\Models\Documents;
use App\Models\Standart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeskEvaluationController extends Controller
{
    public function DeskEvaluation($documentId, $standartId)
    {
        // Mengambil data dokumen dan standar berdasarkan ID
        $document = Documents::findOrFail($documentId);
        $standart = Standart::findOrFail($standartId);
        $data = DeskEvaluation::all();
        $user = Auth::user();

        $deskEvaluationData = DeskEvaluation::where('document_id', $documentId)
            ->where('standart_id', $standartId)
            ->get();

        // Mengambil atau membuat evaluasi desk berdasarkan dokumentasi dan standar
        // $deskEvaluation = DeskEvaluation::firstOrCreate(
        //     ['document_id' => $documentId, 'standart_id' => $standartId],
        //     ['evaluation_result' => '']
        // );
        // Mengembalikan view dengan data evaluasi desk
        return view('desk_evaluation', compact('document', 'standart', 'data', 'deskEvaluationData', 'user'));
    }
    public function store(Request $request, $documentId, $standartId)
    {
        // Validasi data
        $validated = $request->validate([
            'pertanyaan_DeskEvaluation' => 'required|string|max:255',
            'document_id' => 'required|exists:documents,id',
            'standart_id' => 'required|exists:standarts,id',
        ]);


        // Simpan data ke tabel Standart
        DeskEvaluation::create([
            'document_id' => $documentId,
            'standart_id' => $standartId,
            'dokumen_terkait' => $validated['pertanyaan_DeskEvaluation'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $ids = array_keys($data['penanggung_jawab'] ?? []);

        foreach ($ids as $id) {
            DeskEvaluation::where('id', $id)->update([
                // 'open' => isset($data['status_open'][$id]),
                // 'close' => isset($data['status_close'][$id]),
                'my' => isset($data['kondisi_dokumen_my'][$id]),
                'mb' => isset($data['kondisi_dokumen_mb'][$id]),
                'm' => isset($data['kondisi_dokumen_m'][$id]),
                'mp' => isset($data['kondisi_dokumen_mp'][$id]),
                'ob' => isset($data['kategori_temuan_ob'][$id]),
                'kts' => isset($data['kategori_temuan_kts'][$id]),
                'catatan' => $data['catatan'][$id] ?? null,
                'penanggung_jawab' => $data['penanggung_jawab'][$id] ?? null,
            ]);
        }
        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id, Request $request)
    {
        // Validasi untuk memastikan ID yang diterima valid
        $DeskEvaluationn = DeskEvaluation::findOrFail($id);

        // Proses penghapusan
        $DeskEvaluationn->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}

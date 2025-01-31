<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->program_studi_id) {
            $documents = Documents::with('uploadedBy') // Eager load relasi
                ->where('program_studi_id', $user->program_studi_id)
                ->get();
        } else {
            $documents = Documents::with('uploadedBy')->get(); // Eager load relasi
        }

        return view('document', compact('documents', 'user'));
    }

    public function document(Request $request)
    {
        // Validasi Data
        $validatedData = $request->validate([
            'tanggal_audit' => 'required|date',
            'tahun_audit' => 'required|string|max:255',
            'judul_audit' => 'required|string|max:255',
            'link_drive' => 'required|url',
            'nama_auditee' => 'required|string|max:255',
        ]);

        $validatedData['uploaded_by'] = Auth::user()->id;
        $validatedData['program_studi_id'] = Auth::user()->program_studi_id ?? null;

        // Simpan Data ke Database
        $saveDocument = Documents::create($validatedData);
        $saveDocument->save();

        // Redirect atau Berikan Feedback
        return redirect()->back()->with('success', 'Dokumen berhasil diupload!');
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'tanggal_audit_edit' => 'required|date',
            'edit_judul_audit' => 'required|string|max:255',
            'edit_tahun_audit' => 'required|string|max:255',
            'edit_link_drive' => 'required|url',
        ]);

        $validatedData['tanggal_audit'] = $validatedData['tanggal_audit_edit'];
        $validatedData['judul_audit'] = $validatedData['edit_judul_audit'];
        $validatedData['tahun_audit'] = $validatedData['edit_tahun_audit'];
        $validatedData['link_drive'] = $validatedData['edit_link_drive'];
        unset($validatedData['tanggal_audit_edit'], $validatedData['edit_judul_audit'], $validatedData['edit_tahun_audit'], $validatedData['edit_link_drive']);

        // Menambahkan uploaded_by
        $validatedData['uploaded_by'] = Auth::user()->id;

        // Cari dokumen yang ingin diperbarui
        $document = Documents::findOrFail($id);

        // Lakukan update
        $document->update($validatedData);

        // Redirect atau Feedback
        return redirect()->route('document')->with('success', 'Dokumen berhasil diupdate!');
    }

    public function destroy($id)
    {
        $document = Documents::findOrFail($id);

        try {
            $document->delete();
            return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus dokumen.');
        }
    }
}

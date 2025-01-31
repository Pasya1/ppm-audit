<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\HasilAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HasilAudit2Controller extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->program_studi_id) {
            $hasilaudit = HasilAudit::where('program_studi_id', $user->program_studi_id)
                ->get();
        } else {
            $hasilaudit = HasilAudit::all();
        }

        return view('finalaudit', compact('hasilaudit', 'user'));
    }

    public function tambah(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'daftar_hadir' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'berita_acara' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'tahun_pelaksanaan' => 'required|digits:4|integer|min:2000',
            'lembaga' => 'required|string|max:255',
            'tanggal_laporan' => 'required|date',
            'koordinator_nama' => 'required|string|max:255',
            'koordinator_nip' => 'required|string|max:255',
            'direktur' => 'required|string|max:255',
            'periode' => 'required|string|max:255',
            'waktu_pelaksanaan' => 'nullable|string|max:255',
            'tempat_kegiatan' => 'nullable|string|max:255',
            'ketua_auditor' => 'nullable|string|max:255',
            'sekretaris_auditor' => 'nullable|string|max:255',
            'auditee' => 'nullable|string|max:255',
            'dokumentasi' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'tanggal_desk' => 'nullable|date',
            'jangka_waktu_perbaikan' => 'nullable|integer',
        ]);

        $validatedData['program_studi_id'] = Auth::user()->program_studi_id ?? null;
        // Simpan data ke database
        $hasilAudit = new HasilAudit();
        $hasilAudit->fill($validatedData);

        // Handle file upload

        // if ($request->hasFile('surat_pengesahan')) {
        //     $hasilAudit->surat_pengesahan = $request->file('surat_pengesahan')->store('surat_pengesahan', 'public');
        // }

        if ($request->hasFile('daftar_hadir')) {
            $hasilAudit->daftar_hadir = $request->file('daftar_hadir')->store('daftar_hadir', 'public');
        }

        if ($request->hasFile('berita_acara')) {
            $hasilAudit->berita_acara = $request->file('berita_acara')->store('berita_acara', 'public');
        }

        if ($request->hasFile('dokumentasi')) {
            $hasilAudit->dokumentasi = $request->file('dokumentasi')->store('dokumentasi', 'public');
        }


        $hasilAudit->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'tahun_pelaksanaan_edit' => 'required|digits:4|integer|min:2000',
            'edit_lembaga' => 'required|string|max:255',
            'tanggal_laporan_edit' => 'required|date',
            'koordinator_nama_edit' => 'required|string|max:255',
            'koordinator_nip_edit' => 'required|string|max:255',
            'direktur_edit' => 'required|string|max:255',
            'edit_periode' => 'required|string|max:255',
            'waktu_pelaksanaan_edit' => 'nullable|string|max:255',
            'tempat_kegiatan_edit' => 'nullable|string|max:255',
            'ketua_auditor_edit' => 'nullable|string|max:255',
            'sekretaris_auditor_edit' => 'nullable|string|max:255',
            'auditee_edit' => 'nullable|string|max:255',
            'tanggal_desk_edit' => 'nullable|date',
            'jangka_waktu_perbaikan_edit' => 'nullable|integer',
            'daftar_hadir_edit' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'berita_acara_edit' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'dokumentasi_edit' => 'nullable|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Cari data berdasarkan ID
        $hasilAudit = HasilAudit::findOrFail($id);

        // Update data
        $hasilAudit->tahun_pelaksanaan = $validatedData['tahun_pelaksanaan_edit'];
        $hasilAudit->lembaga = $validatedData['edit_lembaga'];
        $hasilAudit->tanggal_laporan = $validatedData['tanggal_laporan_edit'];
        $hasilAudit->koordinator_nama = $validatedData['koordinator_nama_edit'];
        $hasilAudit->koordinator_nip = $validatedData['koordinator_nip_edit'];
        $hasilAudit->direktur = $validatedData['direktur_edit'];
        $hasilAudit->periode = $validatedData['edit_periode'];
        $hasilAudit->waktu_pelaksanaan = $validatedData['waktu_pelaksanaan_edit'];
        $hasilAudit->tempat_kegiatan = $validatedData['tempat_kegiatan_edit'];
        $hasilAudit->ketua_auditor = $validatedData['ketua_auditor_edit'];
        $hasilAudit->sekretaris_auditor = $validatedData['sekretaris_auditor_edit'];
        $hasilAudit->auditee = $validatedData['auditee_edit'];
        $hasilAudit->tanggal_desk = $validatedData['tanggal_desk_edit'];
        $hasilAudit->jangka_waktu_perbaikan = $validatedData['jangka_waktu_perbaikan_edit'];

        // Handle file upload
        // if ($request->hasFile('surat_pengesahan_edit')) {
        //     $hasilAudit->surat_pengesahan = $request->file('surat_pengesahan_edit')->store('surat_pengesahan', 'public');
        // }

        if ($request->hasFile('daftar_hadir_edit')) {
            $hasilAudit->daftar_hadir = $request->file('daftar_hadir_edit')->store('daftar_hadir', 'public');
        }

        if ($request->hasFile('berita_acara_edit')) {
            $hasilAudit->berita_acara = $request->file('berita_acara_edit')->store('berita_acara', 'public');
        }

        if ($request->hasFile('dokumentasi_edit')) {
            $hasilAudit->dokumentasi = $request->file('dokumentasi_edit')->store('dokumentasi', 'public');
        }
        // Simpan perubahan
        $hasilAudit->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $hasilAudit = HasilAudit::find($id);

        if (!$hasilAudit) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $fileFields = ['daftar_hadir', 'berita_acara', 'dokumentasi'];

        foreach ($fileFields as $field) {
            if ($hasilAudit->$field && Storage::disk('public')->exists($hasilAudit->$field)) {
                Storage::disk('public')->delete($hasilAudit->$field);
            }
        }

        // Hapus data dari database
        $hasilAudit->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}

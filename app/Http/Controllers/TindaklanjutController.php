<?php

namespace App\Http\Controllers;

use App\Models\detailHasilAudit;
use App\Models\detailtindaklanjut;
use App\Models\Documents;
use App\Models\HasilAudit;
use App\Models\tindaklanjut;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TindaklanjutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->program_studi_id) {
            $tindaklanjut = HasilAudit::where('program_studi_id', $user->program_studi_id)
                ->get();
        } else {
            $tindaklanjut = HasilAudit::all();
        }

        $tindaklanjut->map(function ($item) {
            $validasi = Validasi::where('hasil_audit_id', $item->id)->first();
            $item->ttd_auditor = $validasi->tanda_tangan_auditor ?? null;
            $item->ttd_auditee = $validasi->tanda_tangan_auditee ?? null;
            $item->status_validasi = $validasi->status_validasi ?? null;
            return $item;
        });

        return view('tindaklanjut', compact('tindaklanjut', 'user'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'surat_pengesahan' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'daftar_hadir' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'berita_acara' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'tahun_pelaksanaan' => 'required|digits:4|integer|min:2000',
            'lembaga' => 'required|string|max:255',
            'tanggal_laporan' => 'required|date',
            'koordinator_nama' => 'required|string|max:255',
            'koordinator_nip' => 'required|string|max:255',
            'periode' => 'required|string|max:255',
            'hari_tanggal_visitasi' => 'nullable|string|max:255',
            'waktu_pelaksanaan' => 'nullable|string|max:255',
            'tempat_kegiatan' => 'nullable|string|max:255',
            'ketua_auditor' => 'nullable|string|max:255',
            'sekretaris_auditor' => 'nullable|string|max:255',
            'auditee' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'dokumentasi' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'tanggal_desk' => 'nullable|date',
            'kesimpulan' => 'nullable|string|max:255',
        ]);

        // Simpan data ke database
        $tindakLanjut = new tindaklanjut();
        $tindakLanjut->fill($validatedData);

        // Handle file upload

        if ($request->hasFile('surat_pengesahan')) {
            $tindakLanjut->surat_pengesahan = $request->file('surat_pengesahan')->store('surat_pengesahan_tindak_lanjut', 'public');
        }

        if ($request->hasFile('daftar_hadir')) {
            $tindakLanjut->daftar_hadir = $request->file('daftar_hadir')->store('daftar_hadir_tindak_lanjut', 'public');
        }

        if ($request->hasFile('berita_acara')) {
            $tindakLanjut->berita_acara = $request->file('berita_acara')->store('berita_acara_tindak_lanjut', 'public');
        }

        if ($request->hasFile('dokumentasi')) {
            $tindakLanjut->dokumentasi = $request->file('dokumentasi')->store('dokumentasi_tindak_lanjut', 'public');
        }

        $tindakLanjut->save();

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
            'edit_periode' => 'required|string|max:255',
            'hari_tanggal_visitasi_edit' => 'nullable|string|max:255',
            'waktu_pelaksanaan_edit' => 'nullable|string|max:255',
            'tempat_kegiatan_edit' => 'nullable|string|max:255',
            'ketua_auditor_edit' => 'nullable|string|max:255',
            'sekretaris_auditor_edit' => 'nullable|string|max:255',
            'auditee_edit' => 'nullable|string|max:255',
            'tanggal_desk_edit' => 'nullable|date',
            'kesimpulan_edit' => 'nullable|string|max:255',
            'jurusan_edit' => 'nullable|string|max:255',
            'surat_pengesahan_edit' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'daftar_hadir_edit' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'berita_acara_edit' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'dokumentasi_edit' => 'nullable|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Cari data berdasarkan ID
        $tindakLanjut = tindaklanjut::findOrFail($id);

        // Update data
        $tindakLanjut->tahun_pelaksanaan = $validatedData['tahun_pelaksanaan_edit'];
        $tindakLanjut->lembaga = $validatedData['edit_lembaga'];
        $tindakLanjut->tanggal_laporan = $validatedData['tanggal_laporan_edit'];
        $tindakLanjut->koordinator_nama = $validatedData['koordinator_nama_edit'];
        $tindakLanjut->koordinator_nip = $validatedData['koordinator_nip_edit'];
        $tindakLanjut->periode = $validatedData['edit_periode'];
        $tindakLanjut->hari_tanggal_visitasi = $validatedData['hari_tanggal_visitasi_edit'];
        $tindakLanjut->waktu_pelaksanaan = $validatedData['waktu_pelaksanaan_edit'];
        $tindakLanjut->tempat_kegiatan = $validatedData['tempat_kegiatan_edit'];
        $tindakLanjut->ketua_auditor = $validatedData['ketua_auditor_edit'];
        $tindakLanjut->sekretaris_auditor = $validatedData['sekretaris_auditor_edit'];
        $tindakLanjut->auditee = $validatedData['auditee_edit'];
        $tindakLanjut->tanggal_desk = $validatedData['tanggal_desk_edit'];
        $tindakLanjut->kesimpulan = $validatedData['kesimpulan_edit'];
        $tindakLanjut->jurusan = $validatedData['jurusan_edit'];

        // Handle file upload
        if ($request->hasFile('surat_pengesahan_edit')) {
            $tindakLanjut->surat_pengesahan = $request->file('surat_pengesahan_edit')->store('surat_pengesahan_tindak_lanjut', 'public');
        }

        if ($request->hasFile('daftar_hadir_edit')) {
            $tindakLanjut->daftar_hadir = $request->file('daftar_hadir_edit')->store('daftar_hadir_tindak_lanjut', 'public');
        }

        if ($request->hasFile('berita_acara_edit')) {
            $tindakLanjut->berita_acara = $request->file('berita_acara_edit')->store('berita_acara_tindak_lanjut', 'public');
        }

        if ($request->hasFile('dokumentasi_edit')) {
            $tindakLanjut->dokumentasi = $request->file('dokumentasi_edit')->store('dokumentasi_tindak_lanjut', 'public');
        }

        // Simpan perubahan
        $tindakLanjut->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $tindakLanjut = TindakLanjut::find($id);

        if (!$tindakLanjut) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $fileFields = ['surat_pengesahan', 'daftar_hadir', 'berita_acara', 'dokumentasi'];

        foreach ($fileFields as $field) {
            if ($tindakLanjut->$field && Storage::disk('public')->exists($tindakLanjut->$field)) {
                Storage::disk('public')->delete($tindakLanjut->$field);
            }
        }

        // Hapus data dari database
        $tindakLanjut->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function validasi($id, Request $request)
    {
        $request->validate([
            'tanda_tangan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tanda_tangan_auditor2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanda_tangan_koordinator' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanda_tangan_direktur' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Cari atau buat data validasi terkait hasil audit
        $validasi = Validasi::firstOrCreate(
            ['hasil_audit_id' => $id],
            [
                'tanda_tangan_auditor' => null,
                'tanda_tangan_auditor2' => null,
                'tanda_tangan_auditee' => null,
                'tanda_tangan_direktur' => null,
                'tanda_tangan_koordinator' => null,
                'status_validasi' => 0,
            ]
        );

        // Proses upload tanda tangan
        if ($request->hasFile('tanda_tangan')) {
            // Untuk file pertama (tanda_tangan)
            $filePath = $request->file('tanda_tangan')->store('tanda_tangan', 'public');

            // Simpan tanda tangan berdasarkan role user
            if ($user->role == 'Auditor' || $user->role == 'Admin') {
                // Simpan tanda tangan auditor
                $validasi->tanda_tangan_auditor = $filePath;
                // Pastikan file tanda tangan direktur, koordinator, dan auditor 2 ada sebelum menyimpan
                if ($request->hasFile('tanda_tangan_direktur')) {
                    $validasi->tanda_tangan_direktur = $request->file('tanda_tangan_direktur')->store('tanda_tangan_direktur', 'public');
                }

                if ($request->hasFile('tanda_tangan_koordinator')) {
                    $validasi->tanda_tangan_koordinator = $request->file('tanda_tangan_koordinator')->store('tanda_tangan_koordinator', 'public');
                }

                if ($request->hasFile('tanda_tangan_auditor2')) {
                    $validasi->tanda_tangan_auditor2 = $request->file('tanda_tangan_auditor2')->store('tanda_tangan_auditor2', 'public');
                }
            } elseif ($user->role == 'Auditee') {
                // Jika role Auditee, simpan tanda tangan auditee
                $validasi->tanda_tangan_auditee = $filePath;
            }
        }


        // Update status validasi
        if ($validasi->tanda_tangan_auditor && $validasi->tanda_tangan_auditee) {
            $validasi->status_validasi = 2; // Status validasi selesai
        } else {
            $validasi->status_validasi = 1; // Menunggu salah satu pihak
        }

        $validasi->save();

        return redirect()->back()->with('success', 'Validasi berhasil diperbarui!');
    }
}

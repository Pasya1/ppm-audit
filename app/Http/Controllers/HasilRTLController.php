<?php

namespace App\Http\Controllers;

use App\Models\HasilAudit;
use App\Models\HasilRTL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HasilRTLController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->program_studi_id) {
            $HasilRTL = HasilRTL::where('program_studi_id', $user->program_studi_id)
                ->get();
        } else {
            $HasilRTL = HasilRTL::all();
        }
        $hasilAudit = HasilAudit::all();

        return view('hasilrtl', compact('HasilRTL', 'user', 'hasilAudit'));
    }

    public function tambah(Request $request)
    {
        // Validasi input request
        $validated = $request->validate([
            'tanggal_laporan' => 'required|date',
            'reference_ami' => 'nullable|exists:hasil_audits,id',
            'jadwal_perbaikan' => 'required|string',
            'status_temuan' => 'required|in:Minor,Major,OB,KTS',
        ]);

        // Menangani nilai 'null' pada reference_ami
        $referenceAmi = $validated['reference_ami'] ?: null;

        // Menentukan status temuan
        $statusTemuan = $validated['status_temuan'];
        $isMinor = $statusTemuan === 'Minor';
        $isMajor = $statusTemuan === 'Major';
        $isOb = $statusTemuan === 'OB';
        $isKts = $statusTemuan === 'KTS';

        // ID Program Studi
        $idProdi = Auth::user()->program_studi_id ?? null;

        // Menyimpan data ke tabel hasil_r_t_l_s
        HasilRtl::create([
            'tanggal_laporan' => $validated['tanggal_laporan'],
            'hasil_audit_id' => $referenceAmi,
            'jadwal_perbaikan' => $validated['jadwal_perbaikan'],
            'Minor' => $isMinor,
            'Major' => $isMajor,
            'OB' => $isOb,
            'KTS' => $isKts,
            'program_studi_id' => $idProdi,
        ]);

        // Redirect atau response setelah berhasil menyimpan data
        return redirect()->route('hasilRTL.index')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request)
    {
        $id = $request->edit_hasil_rtl_id;
        // Validasi input form
        $request->validate([
            'tanggal_laporan' => 'required|date',
            'hasil_audit_id' => 'nullable|exists:hasil_audits,id',
            'jadwal_perbaikan' => 'required|string|max:255',
            'status_temuan' => 'required|in:Minor,Major,OB,KTS'
        ]);

        // Cari data berdasarkan ID
        $hasilRTL = HasilRTL::findOrFail($id);

        $referenceAmi = $request->hasil_audit_id ?: null;

        // Reset semua status temuan menjadi false
        $hasilRTL->Minor = false;
        $hasilRTL->Major = false;
        $hasilRTL->OB = false;
        $hasilRTL->KTS = false;

        // Set status temuan yang dipilih menjadi true
        $statusTemuan = $request->status_temuan;
        if ($statusTemuan === 'Minor') {
            $hasilRTL->Minor = true;
        } elseif ($statusTemuan === 'Major') {
            $hasilRTL->Major = true;
        } elseif ($statusTemuan === 'OB') {
            $hasilRTL->OB = true;
        } elseif ($statusTemuan === 'KTS') {
            $hasilRTL->KTS = true;
        }

        // Update data
        $hasilRTL->tanggal_laporan = $request->tanggal_laporan;
        $hasilRTL->hasil_audit_id = $referenceAmi;
        $hasilRTL->jadwal_perbaikan = $request->jadwal_perbaikan;
        $hasilRTL->save();

        // Redirect dengan pesan sukses
        return redirect()->route('hasilRTL.index')->with('success', 'Data RTL berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $HasilRTL = HasilRTL::findOrFail($id);

        try {
            $HasilRTL->delete();
            return redirect()->back()->with('success', 'Dokumen Acuan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus dokumen acuan.');
        }
    }
}

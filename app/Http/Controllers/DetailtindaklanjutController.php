<?php

namespace App\Http\Controllers;

use App\Models\detailHasilAudit;
use App\Models\detailtindaklanjut;
use App\Models\Documents;
use App\Models\HasilAudit;
use App\Models\Standart;
use App\Models\tindaklanjut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DetailtindaklanjutController extends Controller
{
    public function detail($id)
    {
        $detailTindakLanjut = HasilAudit::where('id', $id)->first();
        $alldetail = detailHasilAudit::where('hasil_audit_id', $id)->get();
        $standarts = Standart::all();
        $tindaklanjut = detailtindaklanjut::where('hasil_audit_id', $id)->get();
        $user = Auth::user();
        $documents = Documents::all();

        $tanggalMulai = $detailTindakLanjut->created_at ?? null; // Pastikan field ini ada di database
        $jangkaWaktu = $detailTindakLanjut->jangka_waktu_perbaikan ?? 0;

        $waktuHabis = false; // Default waktu belum habis
        if ($tanggalMulai) {
            $tanggalAkhir = Carbon::parse($tanggalMulai)->addDays($jangkaWaktu);
            $waktuHabis = Carbon::now()->greaterThan($tanggalAkhir);
        }

        return view('detailtindaklanjut', compact('detailTindakLanjut', 'alldetail', 'standarts', 'tindaklanjut', 'user', 'waktuHabis', 'documents'));
    }

    public function store(Request $request, $id)
    {

        $validatedData = $request->validate([
            'deskripsi_tindak_lanjut' => 'required|string|max:500',
            'link_dokumen' => 'required|string',
        ]);

        detailtindaklanjut::create([
            'hasil_audit_id' => $id,
            'tindak_lanjut' => $validatedData['deskripsi_tindak_lanjut'],
            'link_drive' => $validatedData['link_dokumen'],
        ]);

        return redirect()->back()->with('success', 'Tindak Lanjut Berhasil Ditambahkan');
    }


    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:detailtindaklanjuts,id',
            'editDeskripsiTindakLanjut' => 'required',
            'editlinkdrive' => 'required',
        ]);

        $detail = detailtindaklanjut::find($request->id);
        $detail->tindak_lanjut = $request->editDeskripsiTindakLanjut;
        $detail->link_drive = $request->editlinkdrive;
        $detail->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy($id, Request $request)
    {
        // Validasi untuk memastikan ID yang diterima valid
        $detailTindakLanjut = detailtindaklanjut::findOrFail($id);

        // Proses penghapusan
        $detailTindakLanjut->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}

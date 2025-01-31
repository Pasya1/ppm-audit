<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        $site = Site::all();
        $user = Auth::user();

        return view('site_setting', compact('site', 'user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kata_pengantar' => 'required|string',
        ]);

        $site = Site::findOrFail($id);
        $site->kata_pengantar = $request->input('kata_pengantar');
        $site->save();

        return redirect()->back()->with('success', 'Kata Pengantar berhasil diperbarui.');
    }
    public function updateDaftarIsi(Request $request, $id)
    {
        $request->validate([
            'daftar_isi' => 'required|string',
        ]);

        $site = Site::findOrFail($id);
        $site->daftar_isi = $request->input('daftar_isi');
        $site->save();

        return redirect()->back()->with('success', 'Daftar Isi berhasil diperbarui.');
    }
    public function updateLatarBelakang(Request $request, $id)
    {
        $request->validate([
            'latar_belakang' => 'required|string',
        ]);

        $site = Site::findOrFail($id);
        $site->latar_belakang = $request->input('latar_belakang');
        $site->save();

        return redirect()->back()->with('success', 'Latar Belakang berhasil diperbarui.');
    }
    public function updateTujuanPemeriksaan(Request $request, $id)
    {
        $request->validate([
            'tujuan_pemeriksaan' => 'required|string',
        ]);

        $site = Site::findOrFail($id);
        $site->tujuan_pemeriksaan = $request->input('tujuan_pemeriksaan');
        $site->save();

        return redirect()->back()->with('success', 'Tujuan Pemeriksaan berhasil diperbarui.');
    }
    public function updateLingkupPemeriksaan(Request $request, $id)
    {
        $request->validate([
            'lingkup_pemeriksaan' => 'required|string',
        ]);

        $site = Site::findOrFail($id);
        $site->lingkup_pemeriksaan = $request->input('lingkup_pemeriksaan');
        $site->save();

        return redirect()->back()->with('success', 'Lingkup Pemeriksaan berhasil diperbarui.');
    }
    public function updateDasarHukum(Request $request, $id)
    {
        $request->validate([
            'dasar_hukum' => 'required|string',
        ]);

        $site = Site::findOrFail($id);
        $site->dasar_hukum = $request->input('dasar_hukum');
        $site->save();

        return redirect()->back()->with('success', 'Dasar Hukum berhasil diperbarui.');
    }

    public function updateBatasan(Request $request, $id)
    {
        $request->validate([
            'batasan_masalah' => 'required|string|max:1000',
        ]);

        $site = Site::findOrFail($id);
        $site->batasan_pemeriksaan = $request->batasan_masalah;
        $site->save();

        return redirect()->back()->with('success', 'Batasan Pemeriksaan berhasil diperbarui.');
    }
    public function updateMetodePemeriksaan(Request $request, $id)
    {
        $request->validate([
            'metode_pemeriksaan' => 'required|string',
        ]);

        $site = Site::findOrFail($id);
        $site->metode_pemeriksaan = $request->input('metode_pemeriksaan');
        $site->save();

        return redirect()->back()->with('success', 'Metode Pemeriksaan berhasil diperbarui.');
    }
    public function updatePengorganisasian(Request $request, $id)
    {
        $request->validate([
            'pengorganisasian' => 'required|string',
        ]);

        $site = Site::findOrFail($id);
        $site->pengorganisasian_tim_audit = $request->input('pengorganisasian');
        $site->save();

        return redirect()->back()->with('success', 'Pengorganisasian Tim Audit berhasil diperbarui.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\programstudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramstudiController extends Controller
{
    public function index()
    {
        $allprogramstudi = programstudi::all();
        $user = Auth::user();

        return view('programstudi', compact('allprogramstudi', 'user'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama_prodi' => 'required|string|max:255',
            'kode_prodi' => 'required|string|max:255',
        ]);

        // Simpan data ke tabel
        programstudi::create([
            'nama_program_studi' => $validated['nama_prodi'],
            'kode_program_studi' => $validated['kode_prodi'],
        ]);

        return redirect()->back()->with('success', 'Program Studi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama_prodi_edit' => 'required|string',
            'kode_prodi_edit' => 'required|string',
        ]);

        // Cek apakah kode program studi sudah ada kecuali pada ID saat ini
        $existingProdi = ProgramStudi::where('kode_program_studi', $request->kode_prodi_edit)
            ->where('id', '!=', $id)
            ->first();

        if ($existingProdi) {
            // Jika kode program studi duplikat, redirect dengan alert merah
            return redirect()->back()->with('error', 'Kode Program Studi sudah digunakan oleh program studi lain!');
        }

        // Map nama field ke database
        $validatedData['nama_program_studi'] = $validatedData['nama_prodi_edit'];
        $validatedData['kode_program_studi'] = $validatedData['kode_prodi_edit'];
        unset($validatedData['nama_prodi_edit'], $validatedData['kode_prodi_edit']);

        // Cari program studi yang ingin diperbarui
        $prodi = ProgramStudi::findOrFail($id);

        // Lakukan update
        $prodi->update($validatedData);

        // Redirect atau Feedback
        return redirect()->back()->with('success', 'Program Studi berhasil diupdate!');
    }



    public function destroy($id)
    {
        $prodi = programstudi::findOrFail($id);

        try {
            $prodi->delete();
            return redirect()->back()->with('success', 'Program Studi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data prodi.');
        }
    }
}

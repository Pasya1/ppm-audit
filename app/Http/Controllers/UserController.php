<?php

namespace App\Http\Controllers;

use App\Models\programstudi;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $allUser = User::all();
        $programStudi = programstudi::all();
        $user = Auth::user();

        return view('daftarpengguna', compact('allUser', 'programStudi', 'user'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'username_baru' => 'required|string|max:255',
            'email_user' => 'required|string|max:255',
            'password_baru' => 'required',
            'program_studi' => 'required|exists:program_studi,id',
            'role' => 'required|in:Admin,Auditor,Auditee',
        ]);

        Log::info('Validasi berhasil:', $validated);

        $existingRole = User::where('program_studi_id', $request->program_studi)
            ->where('role', $request->role)
            ->first();

        if ($existingRole) {
            Log::warning('Role sudah ada');
            return redirect()->back()->with('error', 'Role "' . $request->role . '" sudah ada di program studi ini.');
        }

        $existingUsername = User::where('name', $request->username_baru)
            ->first();

        if ($existingUsername) {
            return redirect()->back()->with('error', 'Username "' . $request->username_baru . '" sudah ada.');
        }

        $user = User::create([
            'name' => $request->username_baru,
            'email' => $request->email_user,
            'password' => Hash::make($request->password_baru),
            'role' => $request->role,
            'program_studi_id' => $request->program_studi,
        ]);

        Log::info('User berhasil disimpan:', $user->toArray());

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan.');
    }


    public function change(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'newPassword' => 'required',
        ]);

        $user = User::findOrFail($id);

        // Update password
        $user->password = Hash::make($request->newPassword);
        $user->save();

        // Redirect atau kembalikan respon
        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'username_edit' => 'required|string|max:255',
            'email_edit' => 'required|string|email|max:255',
        ]);

        // Ambil user berdasarkan ID
        $user = User::findOrFail($id);

        // Cek jika username yang diinput berbeda dengan yang lama
        if ($user->name !== $request->username_edit) {
            // Cek apakah username baru sudah ada, kecuali untuk ID dirinya sendiri
            $checkuser = User::where('name', $request->username_edit)
                ->where('id', '!=', $id) // Mengecualikan ID pengguna yang sedang diperbarui
                ->first();
            if ($checkuser) {
                return redirect()->back()->with('error', 'Username "' . $request->username_edit . '" sudah ada.');
            }
        }

        // Cek jika email yang diinput berbeda dengan yang lama
        if ($user->email !== $request->email_edit) {
            // Cek apakah email baru sudah ada
            $checkemail = User::where('email', $request->email_edit)->first();
            if ($checkemail) {
                return redirect()->back()->with('error', 'Email "' . $request->email_edit . '" sudah terdaftar.');
            }
        }

        // Update user dengan data yang baru
        $user->name = $request->username_edit;
        $user->email = $request->email_edit;
        $user->save();

        // Redirect atau feedback
        return redirect()->back()->with('success', 'Data User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
            return redirect()->back()->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus User.');
        }
    }
}

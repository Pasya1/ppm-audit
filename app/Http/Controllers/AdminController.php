<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\HasilAudit;
use App\Models\HasilRtl;
use App\Models\tindaklanjut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->program_studi_id) {
            $documentCount = Documents::where('program_studi_id', $user->program_studi_id)->count();
        } else {
            $documentCount = Documents::count();
        }

        // Hitung jumlah hasil audit
        if ($user->program_studi_id) {
            $hasilCount = HasilAudit::where('program_studi_id', $user->program_studi_id)->count();
        } else {
            $hasilCount = HasilAudit::count();
        }

        // Hitung jumlah tindak lanjut
        if ($user->program_studi_id) {
            $tindakLanjutCount = HasilRtl::where('program_studi_id', $user->program_studi_id)->count();
        } else {
            $tindakLanjutCount = HasilRtl::count();
        }



        return view('adminview', compact('documentCount', 'hasilCount', 'tindakLanjutCount', 'user'));
    }
}

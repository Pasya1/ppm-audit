<?php

use App\Http\Controllers\DocumentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarTilikController;
use App\Http\Controllers\StandartController;
use App\Http\Controllers\DeskEvaluationController;
use App\Http\Controllers\DetailHasilAuditController;
use App\Http\Controllers\DetailRTLController;
use App\Http\Controllers\DetailtindaklanjutController;
use App\Http\Controllers\FinalAuditController;
use App\Http\Controllers\HasilAudit2Controller;
use App\Http\Controllers\HasilRTLController;
use App\Http\Controllers\ProgramstudiController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TindaklanjutController;
use App\Http\Controllers\UserController;

// Route untuk menampilkan form login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk memproses login
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN MENAMPILKAN HALAMAN
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/document', [DocumentsController::class, 'index'])->name('document');
    Route::get('/admin/hasilaudit', [HasilAudit2Controller::class, 'index'])->name('hasilaudit');
    Route::get('/admin/tindaklanjut', [TindaklanjutController::class, 'index'])->name('tindaklanjut');
    Route::get('/admin/programstudi', [ProgramstudiController::class, 'index'])->name('programstudi');
    Route::get('/admin/finalaudit', [HasilAudit2Controller::class, 'index'])->name('finalaudit');
    Route::get('/admin/site', [SiteController::class, 'index'])->name('site');
    Route::get('/admin/rencana-tindak-lanjut', [HasilRTLController::class, 'index'])->name('hasilRTL.index');

    Route::get('/admin/daftarpengguna', [UserController::class, 'index'])->name('daftarpengguna');

    Route::get('/admin/standart/{id}', [StandartController::class, 'standart'])->name('standart');
    Route::get('/admin/standart/{documentId}/{standartId}', [DeskEvaluationController::class, 'DeskEvaluation'])->name('DeskEvaluation');
    Route::get('/admin/standart/daftartilik/{documentId}/{standartId}', [DaftarTilikController::class, 'DaftarTilik'])->name('DaftarTilik');
    Route::get('/admin/hasilaudit/{id}', [DetailHasilAuditController::class, 'detail'])->name('HasilAudit.detail');
    Route::get('/admin/RTL/{id}', [DetailRTLController::class, 'detail'])->name('HasilRTL.detail');
    Route::get('/admin/tindaklanjut/{id}', [DetailtindaklanjutController::class, 'detail'])->name('TindakLanjut.detail');

    // Admin Page Edit dan Update Dokumen
    Route::put('/document/{id}', [DocumentsController::class, 'update'])->name('documents.update');
    Route::put('/standart/{idstandart}', [StandartController::class, 'update'])->name('standarts.update');
    Route::put('/admin/standarts/{documentId}/{standartId}', [DeskEvaluationController::class, 'update'])->name('deskEvaluation.update');
    Route::put('/admin/standarts/daftartilik/{documentId}/{standartId}', [DaftarTilikController::class, 'update'])->name('daftartilik.update');
    Route::put('/hasilaudit/{id}', [HasilAudit2Controller::class, 'update'])->name('hasilauditedit.update');
    Route::put('/hasilRTL/update', [HasilRTLController::class, 'update'])->name('hasilRTL.update');


    Route::put('/ProgramStudi/{id}', [ProgramstudiController::class, 'update'])->name('prodi.update');
    Route::put('/DaftarPengguna/{id}', [UserController::class, 'update'])->name('user.update');
    Route::put('/tindaklanjut/{id}', [TindaklanjutController::class, 'update'])->name('tindaklanjut.update');
    Route::put('/detail-audit/update', [DetailHasilAuditController::class, 'update'])->name('detailaudit.update');
    Route::put('/detail-rtl/update', [DetailRTLController::class, 'update'])->name('detailrtl.update');
    Route::put('/detail-tindak-lanjut/update', [DetailtindaklanjutController::class, 'update'])->name('detailtindaklanjut.update');
    Route::put('/GantiPassword/{id}', [UserController::class, 'change'])->name('password.update');


    // Admin Page Method Post
    Route::post('/audit/document', [DocumentsController::class, 'document'])->name('audit.document');
    Route::post('/standarts', [StandartController::class, 'store'])->name('standarts.store');
    Route::post('/tindaklanjut', [TindaklanjutController::class, 'store'])->name('tindaklanjut.store');
    Route::post('/programstudi', [ProgramstudiController::class, 'store'])->name('prodi.store');
    Route::post('/admin/hasilaudit', [HasilAudit2Controller::class, 'tambah'])->name('hasilaudit.tambah');
    Route::post('/admin/HasilRTL', [HasilRTLController::class, 'tambah'])->name('hasilRTL.tambah');
    Route::post('/pengguna', [UserController::class, 'store'])->name('users.store')->withoutMiddleware('auth');
    Route::post('/standart/{documentId}/{standartId}', [DeskEvaluationController::class, 'store'])->name('deskEvaluation.store');
    Route::post('/standart/daftartilik/{documentId}/{standartId}', [DaftarTilikController::class, 'store'])->name('daftartilik.store');
    Route::post('/hasilaudit/{id}', [DetailHasilAuditController::class, 'store'])->name('detailaudit.store');
    Route::post('/hasilRTL/{id}', [DetailRTLController::class, 'store'])->name('detailrtl.store');
    Route::post('/tindaklanjut/{id}', [DetailtindaklanjutController::class, 'store'])->name('detailtindaklanjut.store');

    // Admin Page Method Delete
    Route::delete('/standart/{id}', [StandartController::class, 'destroy'])->name('standart.destroy');
    Route::delete('/documents/{id}', [DocumentsController::class, 'destroy'])->name('document.destroy');
    Route::delete('/DeskEvaluation/{id}', [DeskEvaluationController::class, 'destroy'])->name('DeskEvaluation.destroy');
    Route::delete('/daftartilik/{id}', [DaftarTilikController::class, 'destroy'])->name('daftartilik.destroy');
    Route::delete('/HasilAudit/{id}', [HasilAudit2Controller::class, 'destroy'])->name('hasilaudithapus.destroy');
    Route::delete('/HasilRTL/{id}', [HasilRTLController::class, 'destroy'])->name('hasilRTLhapus.destroy');
    Route::delete('/TindakLanjut/{id}', [TindaklanjutController::class, 'destroy'])->name('tindaklanjut.destroy');
    Route::delete('/DetailHasilAudit/{id}', [DetailHasilAuditController::class, 'destroy'])->name('detailhasilaudit.destroy');
    Route::delete('/DetailHasilRTL/{id}', [DetailRTLController::class, 'destroy'])->name('detailhasilrtl.destroy');
    Route::delete('/DetailTindakLanjut/{id}', [DetailtindaklanjutController::class, 'destroy'])->name('detailtindaklanjut.destroy');
    Route::delete('/ProgramStudi/{id}', [ProgramstudiController::class, 'destroy'])->name('prodi.destroy');
    Route::delete('/DaftarPengguna/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Site
    Route::put('/site/{id}/update', [SiteController::class, 'update'])->name('site.update');
    Route::put('/site/{id}/update-batasan', [SiteController::class, 'updateBatasan'])->name('site.update-batasan');
    Route::put('/site/{id}/update-daftar-isi', [SiteController::class, 'updateDaftarIsi'])->name('daftarisi.update');
    Route::put('/site/{id}/update-latar-belakang', [SiteController::class, 'updateLatarBelakang'])->name('latarbelakang.update');
    Route::put('/site/{id}/update-tujuan-pemeriksaan', [SiteController::class, 'updateTujuanPemeriksaan'])->name('tujuanpemeriksaan.update');
    Route::put('/site/{id}/update-lingkup-pemeriksaan', [SiteController::class, 'updateLingkupPemeriksaan'])->name('lingkuppemeriksaan.update');
    Route::put('/site/{id}/update-dasar-hukum', [SiteController::class, 'updateDasarHukum'])->name('dasarhukum.update');
    Route::put('/site/{id}/update-metode-pemeriksaan', [SiteController::class, 'updateMetodePemeriksaan'])->name('metodepemeriksaan.update');
    Route::put('/site/{id}/update-pengorganisasian', [SiteController::class, 'updatePengorganisasian'])->name('pengorganisasian.update');

    // VALIDASI TINDAK LANJUT
    Route::post('/tindaklanjut/validasi/{id}', [TindakLanjutController::class, 'validasi'])->name('TindakLanjut.validasi');


    // Cetak PDF
    Route::get('/cetak-hasil/{documentId}', [StandartController::class, 'downloadPDF'])->name('cetak.hasil');
    Route::get('/detailhasilaudit/{id}', [DetailHasilAuditController::class, 'downloadPDF'])->name('cetakdetailaudit.hasil');
    Route::get('/detailhasilRTL/{id}', [DetailRTLController::class, 'downloadPDF'])->name('cetakdetailrtl.hasil');
});

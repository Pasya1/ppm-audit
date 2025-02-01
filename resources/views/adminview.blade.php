@extends('layouts.master')

@section('title', 'Admin | Dashboard')

@section('content')
    <div class="content" style="height: 100vh;">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fas fa-book" style="color: #001A6E;"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Document</p>
                                    <p class="card-title"><?= $documentCount ?>
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <a href="{{ route('document') }}">
                            <div class="stats">
                                <i class="fas fa-arrow-right"></i>
                                <span style="color: gray;">lihat detail</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="fa-solid fa-chart-bar text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Laporan Hasil Audit</p>
                                <p class="card-title"><?= $hasilCount ?>
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <a href="{{ route('hasilaudit') }}">
                        <div class="stats">
                            <i class="fas fa-arrow-right"></i>
                            <span style="color: gray;">lihat detail</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="fa-solid fa-bars-staggered " style="color: #FF204E;"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Laporan Tindak Lanjut</p>
                                <p class="card-title"><?= $tindakLanjutCount ?>
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <a href="{{ route('hasilRTL.index') }}">
                        <div class="stats">
                            <i class="fas fa-arrow-right"></i>
                            <span style="color: gray;">lihat detail</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <div class="card-header">
                    <h5 class="card-title text-center" style="color: #001A6E;"><strong>ALUR AUDIT</strong></h5>
                    <p class="card-category text-center">Selamat Datang <?= $user->role ?>, baca panduan sebelum
                        menggunakan
                        Sistem yaa
                        !!</p>
                </div>
                <div class="card-body justify-content-center align-items-center text-center">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title" style="color: #001A6E;">1. Input Dokumen</h6>
                                    <p class="card-text">Auditee menginput dokumen kebutuhan audit yang bisa dilihat oleh
                                        admin dan auditor.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title" style="color: #001A6E;">2. Review Dokumen</h6>
                                    <p class="card-text">Auditor melihat dokumen yang telah di upload auditee.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title" style="color: #001A6E;">3. Evaluasi</h6>
                                    <p class="card-text">Auditor melakukan penilain dokumen di desk evaluation.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title" style="color: #001A6E;">4. Checklist</h6>
                                    <p class="card-text">Auditor memberi pertanyaan di daftar tilik yang bisa dijawab
                                        auditee.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title" style="color: #001A6E;">5. Hasil Audit & Tindak Perbaikan</h6>
                                    <p class="card-text">Auditor membuat laporan hasil audit dan auditee bisa melakukan
                                        tindakan perbaikan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title" style="color: #001A6E;">6. Tindak Lanjut</h6>
                                    <p class="card-text">Pembuatan laporan tindak lanjut berdasarkan laporan audit yang
                                        telah dibuat.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title" style="color: #001A6E;">7. Export PDF</h6>
                                    <p class="card-text">Auditor dan Auditee dapat mencetak Hasil ke dalam format PDF.</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="stats">
                        <i class="fa fa-history"></i> <?= date('d M Y, H:i:s') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection

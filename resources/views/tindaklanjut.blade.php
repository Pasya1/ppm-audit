@extends('layouts.master')

@section('title', 'Admin | Tindak Lanjut')

@section('content')
    <div class="content" style="height: 100vh;">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between mx-2">
                            <h5 class="card-title">
                                Tindak Lanjut
                            </h5>
                            {{-- <div class="row px-2">
                                <button data-toggle="modal" data-target="#tambahTindakLanjut" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Isi Data Tindak Lanjut
                                </button>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive px-2">
                            <table class="table">
                                <thead class="text-center" style="color: #001A6E;">
                                    <th>No</th>
                                    <th>Tanggal Penilaian</th>
                                    <th>Periode</th>
                                    <th>Jangka Waktu Perbaikan</th>
                                    <th>Auditee</th>
                                    <th>Tindak Perbaikan</th>
                                    <th>Validasi</th>
                                    <th>Status Pengerjaan</th>
                                </thead>
                                <tbody>
                                    @forelse ($tindaklanjut as $key => $tindaklanjuts)
                                        @php
                                            // Hitung total detail audit untuk hasil audit ini
                                            $totalDetailAudit = \App\Models\detailHasilAudit::where(
                                                'hasil_audit_id',
                                                $tindaklanjuts->id,
                                            )->count();

                                            // Hitung total tindak lanjut untuk hasil audit ini
                                            $totalTindakLanjut = \App\Models\detailtindaklanjut::where(
                                                'hasil_audit_id',
                                                $tindaklanjuts->id,
                                            )->count();

                                            // Tentukan status berdasarkan hitungan
                                            if ($totalTindakLanjut == 0) {
                                                $status = 'Belum';
                                                $icon = 'fas fa-times';
                                                $alertClass2 = 'alert-danger';
                                            } elseif ($totalTindakLanjut < $totalDetailAudit) {
                                                $status = 'Proses';
                                                $icon = 'fas fa-spinner fa-spin';
                                                $alertClass2 = 'alert-warning';
                                            } else {
                                                $status = 'Selesai';
                                                $icon = 'fas fa-check';
                                                $alertClass2 = 'alert-success';
                                            }

                                            $tanggalDesk = \Carbon\Carbon::parse($tindaklanjuts->created_at)
                                                ->setTimezone('Asia/Jakarta')
                                                ->startOfDay();
                                            $tanggalTarget = $tanggalDesk
                                                ->copy()
                                                ->addDays($tindaklanjuts->jangka_waktu_perbaikan);
                                            $tanggalHariIni = \Carbon\Carbon::now('Asia/Jakarta')->startOfDay();

                                            $selisihHari = $tanggalHariIni->diffInDays($tanggalTarget, false);

                                            // Tentukan status berdasarkan selisih
                                            if ($selisihHari > 0) {
                                                $pesan = $selisihHari . ' Hari Tersisa';
                                                $alertClass = 'text-dark';
                                            } elseif ($selisihHari == 0) {
                                                $pesan = 'Hari Ini';
                                                $alertClass = 'alert-warning';
                                            } else {
                                                $pesan = 'Waktu Perbaikan Habis';
                                                $alertClass = 'text-dark';
                                            }

                                        @endphp
                                        <tr class="alert {{ $alertClass }}" role="alert">
                                            <td>{{ $loop->iteration }}</td>
                                            <td><?= formatTanggalIndonesia($tindaklanjuts->tanggal_desk) ?></td>
                                            <td><?= $tindaklanjuts->periode ?></td>
                                            <td>{{ $pesan }} </td>
                                            <td><?= $tindaklanjuts->auditee ?></td>
                                            <td>
                                                <a href="{{ route('TindakLanjut.detail', $tindaklanjuts->id) }}"
                                                    style="width: 30%; height: 40px; color:black;"><i
                                                        class="fas fa-eye pr-2"></i> View</a>
                                            </td>
                                            <td>
                                                @if ($user->role == 'Auditor')
                                                    @if ($tindaklanjuts->ttd_auditor)
                                                        @if ($tindaklanjuts->status_validasi == 2)
                                                            <span class="badge badge-success">Sudah Validasi</span>
                                                        @elseif ($tindaklanjuts->status_validasi == 1)
                                                            <span class="badge badge-warning">
                                                                Menunggu
                                                                @if (!$tindaklanjuts->ttd_auditor)
                                                                    Auditor
                                                                @elseif (!$tindaklanjuts->ttd_auditee)
                                                                    Auditee
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#modalValidasi{{ $tindaklanjuts->id }}">
                                                            Validasi
                                                        </button>
                                                        
                                                    @endif
                                                @elseif ($user->role == 'Auditee')
                                                    @if ($tindaklanjuts->ttd_auditee)
                                                        @if ($tindaklanjuts->status_validasi == 2)
                                                            <span class="badge badge-success">Sudah Validasi</span>
                                                        @elseif ($tindaklanjuts->status_validasi == 1)
                                                            <span class="badge badge-warning">
                                                                Menunggu
                                                                @if (!$tindaklanjuts->ttd_auditor)
                                                                    Auditor
                                                                @elseif (!$tindaklanjuts->ttd_auditee)
                                                                    Auditee
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#modalValidasi{{ $tindaklanjuts->id }}">
                                                            Validasi
                                                        </button>
                                                    @endif
                                                @elseif ($user->role == 'Admin')
                                                    @if ($tindaklanjuts->status_validasi == 2)
                                                        <span class="badge badge-success">Sudah Validasi</span>
                                                    @elseif ($tindaklanjuts->status_validasi == 1)
                                                        <span class="badge badge-warning">
                                                            Menunggu
                                                            @if (!$tindaklanjuts->ttd_auditor)
                                                                Auditor
                                                            @elseif (!$tindaklanjuts->ttd_auditee)
                                                                Auditee
                                                            @endif
                                                        </span>
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#modalValidasi{{ $tindaklanjuts->id }}">
                                                            Validasi
                                                        </button>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="alert {{ $alertClass2 }}">
                                                <i class="{{ $icon }}"></i>
                                                {{ $status }}
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modalValidasi{{ $tindaklanjuts->id ?? 0 }}" tabindex="-1" role="dialog"
                                            aria-labelledby="modalValidasiLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('TindakLanjut.validasi', $tindaklanjuts->id ?? 0) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalValidasiLabel">Validasi Hasil Audit</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Validasi ini dilakukan sebagai tanda bahwa Auditee dan Auditor sudah menyelesaikan Kegiatan
                                                                Audit.</p>
                                                            <!-- Input File Tanda Tangan -->
                                                            <div class="form-group">
                                                                <div class="row mx-1">
                                                                    <label for="tanda_tangan_{{ $tindaklanjuts->id }}" style="left: 0;"> Tanda Tangan :</label>
                                                                </div>
                                                                <label class="btn btn-primary">
                                                                    Upload
                                                                    <input type="file" name="tanda_tangan" id="tanda_tangan_{{ $tindaklanjuts->id }}" class="form-control"
                                                                        accept=".jpg,.jpeg,.png" required onchange="showFileName(this, 'tanda-tangan-name-{{ $tindaklanjuts->id }}')">
                                                                </label>
                                                                <span id="tanda-tangan-name-{{ $tindaklanjuts->id }}" class="text-muted">Belum ada file yang dipilih</span>
                                                            </div>
                                                            @if (!empty($tindaklanjuts->sekretaris_auditor))
                                                            <div class="form-group">
                                                                <div class="row mx-1">
                                                                    <label for="tanda_tangan_auditor2_{{ $tindaklanjuts->id }}" style="left: 0;"> Tanda Tangan Auditor 2 :</label>
                                                                </div>
                                                                <label class="btn btn-primary">
                                                                    Upload
                                                                    <input type="file" name="tanda_tangan_auditor2" id="tanda_tangan_auditor2_{{ $tindaklanjuts->id }}" class="form-control"
                                                                        accept=".jpg,.jpeg,.png" required onchange="showFileName(this, 'tanda-tangan-auditor2-{{ $tindaklanjuts->id }}')">
                                                                </label>
                                                                <span id="tanda-tangan-auditor2-{{ $tindaklanjuts->id }}" class="text-muted">Belum ada file yang dipilih</span>
                                                            </div>
                                                            @endif
                                                            @if ($user->role == 'Auditor' || $user->role === 'Admin')
                                                            <div class="form-group">
                                                                <div class="row mx-1">
                                                                    <label for="tanda_tangan_koordinator_{{ $tindaklanjuts->id }}" style="left: 0;"> Tanda Tangan Koordinator :</label>
                                                                </div>
                                                                <label class="btn btn-primary">
                                                                    Upload
                                                                    <input type="file" name="tanda_tangan_koordinator" id="tanda_tangan_koordinator_{{ $tindaklanjuts->id }}" class="form-control"
                                                                        accept=".jpg,.jpeg,.png" required onchange="showFileName(this, 'tanda-tangan-koordinator-{{ $tindaklanjuts->id }}')">
                                                                </label>
                                                                <span id="tanda-tangan-koordinator-{{ $tindaklanjuts->id }}" class="text-muted">Belum ada file yang dipilih</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row mx-1">
                                                                    <label for="tanda_tangan_direktur_{{ $tindaklanjuts->id }}" style="left: 0;"> Tanda Tangan Direktur :</label>
                                                                </div>
                                                                <label class="btn btn-primary">
                                                                    Upload
                                                                    <input type="file" name="tanda_tangan_direktur" id="tanda_tangan_direktur_{{ $tindaklanjuts->id }}" class="form-control"
                                                                        accept=".jpg,.jpeg,.png" required onchange="showFileName(this, 'tanda-tangan-direktur-{{ $tindaklanjuts->id }}')">
                                                                </label>
                                                                <span id="tanda-tangan-direktur-{{ $tindaklanjuts->id }}" class="text-muted">Belum ada file yang dipilih</span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Validasi</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tindak Lanjut Belum Ditambahkan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="tambahTindakLanjut" tabindex="-1" role="dialog" aria-labelledby="tambahTindakLanjutLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahTindakLanjutLabel">Tambah Data Tindak Lanjut</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tindaklanjut.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <p class="text-center"><strong>KATA PENGANTAR</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Pelaksanaan AMI :</label>
                                    <input type="number" name="tahun_pelaksanaan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Lembaga :</label>
                                    <input type="text" name="lembaga" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Periode :</label>
                                    <input type="text" name="periode" class="form-control"
                                        placeholder="cth : 2024 / 2025" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pembuatan Laporan :</label>
                                    <input type="date" name="tanggal_laporan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Koordinator Audit Mutu Internal :</label>
                                    <input type="text" name="koordinator_nama" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>NRK / NIP Koordinator :</label>
                                    <input type="text" name="koordinator_nip" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <p class="text-center pt-4"><strong>WAKTU DAN PELAKSANAAN AUDIT</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Hari / Tanggal Pelaksanaan Visitasi :</label>
                                    <input type="text" name="hari_tanggal_visitasi" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Waktu Pelaksanaan :</label>
                                    <input type="text" name="waktu_pelaksanaan" class="form-control"
                                        placeholder="cth: 08.00 - 10.00" required>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Kegiatan Audit :</label>
                                    <input type="text" name="tempat_kegiatan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Program Studi/ Unit :</label>
                                    <input type="text" name="jurusan" class="form-control"
                                        placeholder="cth : Teknik Komputer" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ketua Auditor :</label>
                                    <input type="text" name="ketua_auditor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Sekretaris Auditor :</label>
                                    <input type="text" name="sekretaris_auditor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Auditee :</label>
                                    <input type="text" name="auditee" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <p class="text-center pt-4"><strong>BAB II DAFTAR TEMUAN AMI</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Desk Evaluation :</label>
                                    <input type="date" name="tanggal_desk" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kesimpulan :</label>
                                    <input type="text" name="kesimpulan" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <p class="text-center pt-4"><strong>DOKUMEN</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row mx-1">
                                        <label for="surat_pengesahan" style="left: 0;"> Surat Pengesahan :</label>
                                    </div>
                                    <label class="btn btn-primary">
                                        Upload
                                        <input type="file" name="surat_pengesahan" id="surat_pengesahan"
                                            class="form-control" accept=".jpg,.jpeg,.png" required
                                            onchange="showFileName(this, 'cover-name')">
                                    </label>
                                    <span id="cover-name" class="text-muted">Belum ada file yang dipilih</span>
                                </div>
                                <div class="form-group">
                                    <div class="row mx-1">
                                        <label for="surat_pengesahan" style="left: 0;"> Daftar Hadir :</label>
                                    </div>
                                    <label class="btn btn-primary">
                                        Upload
                                        <input type="file" name="daftar_hadir" class="form-control"
                                            accept=".jpg,.jpeg,.png" required
                                            onchange="showFileName(this, 'daftar-hadir-name')">
                                    </label>
                                    <span id="daftar-hadir-name" class="text-muted">Belum ada file yang dipilih</span>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row mx-1">
                                        <label for="surat_pengesahan" style="left: 0;"> Berita Acara :</label>
                                    </div>
                                    <label class="btn btn-primary">
                                        Upload
                                        <input type="file" name="berita_acara" class="form-control"
                                            accept=".jpg,.jpeg,.png" required
                                            onchange="showFileName(this, 'berita-acara-name')">
                                    </label>
                                    <span id="berita-acara-name" class="text-muted">Belum ada file yang dipilih</span>
                                </div>
                                <div class="form-group">
                                    <div class="row mx-1">
                                        <label for="surat_pengesahan" style="left: 0;"> Dokumentasi :</label>
                                    </div>
                                    <label class="btn btn-primary">
                                        Upload
                                        <input type="file" name="dokumentasi" class="form-control"
                                            accept=".jpg,.jpeg,.png" required
                                            onchange="showFileName(this, 'dokumentasi-name')">
                                    </label>
                                    <span id="dokumentasi-name" class="text-muted">Belum ada file yang dipilih</span>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>
                                Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editTindakLanjut" tabindex="-1" role="dialog" aria-labelledby="editTindakLanjutLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTindakLanjutLabel">Edit Data Tindak Lanjut</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tindaklanjut.update', $tindaklanjuts->id ?? 0) }}" method="POST"
                        enctype="multipart/form-data" id="editHasilAuditForm">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="edit_tindak_lanjut_id" id="edit_tindak_lanjut_id">

                        <p class="text-center"><strong>KATA PENGANTAR</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Pelaksanaan AMI :</label>
                                    <input type="number" name="tahun_pelaksanaan_edit" id="tahun_pelaksanaan_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Lembaga :</label>
                                    <input type="text" name="edit_lembaga" id="edit_lembaga" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Periode :</label>
                                    <input type="text" name="edit_periode" id="edit_periode" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pembuatan Laporan :</label>
                                    <input type="date" name="tanggal_laporan_edit" id="tanggal_laporan_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Koordinator Audit Mutu Internal :</label>
                                    <input type="text" name="koordinator_nama_edit" id="koordinator_nama_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>NRK / NIP Koordinator :</label>
                                    <input type="text" name="koordinator_nip_edit" id="koordinator_nip_edit"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <p class="text-center"><strong>WAKTU DAN PELAKSANAAN AUDIT</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Hari / Tanggal Pelaksanaan Visitasi :</label>
                                    <input type="text" name="hari_tanggal_visitasi_edit"
                                        id="hari_tanggal_visitasi_edit" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Waktu Pelaksanaan :</label>
                                    <input type="text" name="waktu_pelaksanaan_edit" id="waktu_pelaksanaan_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Kegiatan Audit :</label>
                                    <input type="text" name="tempat_kegiatan_edit" id="tempat_kegiatan_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Program Studi / Unit :</label>
                                    <input type="text" name="jurusan_edit" id="jurusan_edit" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ketua Auditor :</label>
                                    <input type="text" name="ketua_auditor_edit" id="ketua_auditor_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Sekretaris Auditor :</label>
                                    <input type="text" name="sekretaris_auditor_edit" id="sekretaris_auditor_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Auditee :</label>
                                    <input type="text" name="auditee_edit" id="auditee_edit" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>

                        <p class="text-center pt-4"><strong>BAB II DAFTAR TEMUAN AMI</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Desk Evaluation :</label>
                                    <input type="date" name="tanggal_desk_edit" id="tanggal_desk_edit"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kesimpulan :</label>
                                    <input type="text" name="kesimpulan_edit" id="kesimpulan_edit"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian File -->
                        <p class="text-center pt-4"><strong>DOKUMEN</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surat_pengesahan_edit">Surat Pengesahan:</label>
                                    <div>
                                        <input type="file" name="surat_pengesahan_edit" id="surat_pengesahan_edit"
                                            class="form-control me-2">
                                        <button type="button" id="btn_upload_surat_pengesahan" class="btn btn-primary">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        <span id="file_name_display" class="text-muted mt-2 d-block">File saat ini: Tidak
                                            ada file</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="surat_pengesahan_edit">Daftar Hadir:</label>
                                    <div>
                                        <input type="file" name="daftar_hadir_edit" id="daftar_hadir_edit"
                                            class="form-control me-2">
                                        <button type="button" id="btn_upload_surat_pengesahan" class="btn btn-primary">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        <span id="file_name_display2" class="text-muted mt-2 d-block">File saat ini: Tidak
                                            ada file</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surat_pengesahan_edit">Berita Acara:</label>
                                    <div>
                                        <input type="file" name="berita_acara_edit" id="berita_acara_edit"
                                            class="form-control me-2">
                                        <button type="button" id="btn_upload_surat_pengesahan" class="btn btn-primary">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        <span id="file_name_display3" class="text-muted mt-2 d-block">File saat ini: Tidak
                                            ada file</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="surat_pengesahan_edit">Dokumentasi:</label>
                                    <div>
                                        <input type="file" name="dokumentasi_edit" id="dokumentasi_edit"
                                            class="form-control me-2">
                                        <button type="button" id="btn_upload_surat_pengesahan" class="btn btn-primary">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        <span id="file_name_display4" class="text-muted mt-2 d-block">File saat ini: Tidak
                                            ada file</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Modal Validasi -->
   

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
     function showFileName(input, targetId) {
    const fileName = input.files.length > 0 ? input.files[0].name : 'Belum ada file yang dipilih';
    document.getElementById(targetId).innerText = fileName;
}

    </script>
    <script>
        $(document).ready(function() {
            // Ketika tombol edit diklik
            $('.btn-editTindakLanjut').on('click', function() {
                // Ambil data dari tombol yang diklik
                var id = $(this).data('id');
                var suratPengesahan = $(this).data('suratpengesahan');
                var daftarHadir = $(this).data('daftarhadir');
                var beritaAcara = $(this).data('beritaacara');
                var tahunPelaksanaan = $(this).data('tahunpelaksanaan');
                var lembaga = $(this).data('lembaga');
                var tanggalLaporan = $(this).data('tanggallaporan');
                var koordinatorNama = $(this).data('koordinatornama');
                var koordinatorNip = $(this).data('koordinatornip');
                var periode = $(this).data('periode');
                var hariTanggalVisitasi = $(this).data('haritanggalvisitasi');
                var waktuPelaksanaan = $(this).data('waktupelaksanaan');
                var tempatKegiatan = $(this).data('tempatkegiatan');
                var ketuaAuditor = $(this).data('ketuaauditor');
                var sekretarisAuditor = $(this).data('sekretarisauditor');
                var auditee = $(this).data('auditee');
                var dokumentasi = $(this).data('dokumentasi');
                var tanggalDesk = $(this).data('tanggaldesk');
                var kesimpulan = $(this).data('kesimpulan');
                var jurusan = $(this).data('jurusan');

                // Set data ke modal
                $('#edit_hasil_audit_id').val(id);
                $('#tahun_pelaksanaan_edit').val(tahunPelaksanaan);
                $('#edit_lembaga').val(lembaga);
                $('#edit_periode').val(periode);
                $('#tanggal_laporan_edit').val(tanggalLaporan);
                $('#koordinator_nama_edit').val(koordinatorNama);
                $('#koordinator_nip_edit').val(koordinatorNip);
                $('#hari_tanggal_visitasi_edit').val(hariTanggalVisitasi);
                $('#waktu_pelaksanaan_edit').val(waktuPelaksanaan);
                $('#tempat_kegiatan_edit').val(tempatKegiatan);
                $('#ketua_auditor_edit').val(ketuaAuditor);
                $('#sekretaris_auditor_edit').val(sekretarisAuditor);
                $('#auditee_edit').val(auditee);
                $('#tanggal_desk_edit').val(tanggalDesk);
                $('#kesimpulan_edit').val(kesimpulan);
                $('#jurusan_edit').val(jurusan);

                // Jika ada file yang sudah ada, tampilkan informasi file saat ini
                // Misalnya, jika file sudah ada di server
                if (suratPengesahan) {
                    $('#surat_pengesahan_edit').siblings('span').text('File saat ini: ' + suratPengesahan);
                }
                if (daftarHadir) {
                    $('#daftar_hadir_edit').siblings('span').text('File saat ini: ' + daftarHadir);
                }
                if (beritaAcara) {
                    $('#berita_acara_edit').siblings('span').text('File saat ini: ' + beritaAcara);
                }
                if (dokumentasi) {
                    $('#dokumentasi_edit').siblings('span').text('File saat ini: ' + dokumentasi);
                }

                // Tampilkan modal
                $('#editTindakLanjut').modal('show');
            });
        });
    </script>
    <script>
        document.getElementById('surat_pengesahan_edit').addEventListener('change', function() {
            var fileInput = this;
            var fileNameDisplay = document.getElementById('file_name_display');

            if (fileInput.files && fileInput.files.length > 0) {
                // Ambil nama file yang dipilih
                var fileName = fileInput.files[0].name;
                // Tampilkan nama file di elemen <span>
                fileNameDisplay.textContent = 'File saat ini: ' + fileName;
            } else {
                // Jika tidak ada file yang dipilih
                fileNameDisplay.textContent = 'File saat ini: Tidak ada file';
            }
        });
        document.getElementById('daftar_hadir_edit').addEventListener('change', function() {
            var fileInput = this;
            var fileNameDisplay = document.getElementById('file_name_display2');

            if (fileInput.files && fileInput.files.length > 0) {
                // Ambil nama file yang dipilih
                var fileName = fileInput.files[0].name;
                // Tampilkan nama file di elemen <span>
                fileNameDisplay.textContent = 'File saat ini: ' + fileName;
            } else {
                // Jika tidak ada file yang dipilih
                fileNameDisplay.textContent = 'File saat ini: Tidak ada file';
            }
        });
        document.getElementById('berita_acara_edit').addEventListener('change', function() {
            var fileInput = this;
            var fileNameDisplay = document.getElementById('file_name_display3');

            if (fileInput.files && fileInput.files.length > 0) {
                // Ambil nama file yang dipilih
                var fileName = fileInput.files[0].name;
                // Tampilkan nama file di elemen <span>
                fileNameDisplay.textContent = 'File saat ini: ' + fileName;
            } else {
                // Jika tidak ada file yang dipilih
                fileNameDisplay.textContent = 'File saat ini: Tidak ada file';
            }
        });
        document.getElementById('dokumentasi_edit').addEventListener('change', function() {
            var fileInput = this;
            var fileNameDisplay = document.getElementById('file_name_display4');

            if (fileInput.files && fileInput.files.length > 0) {
                // Ambil nama file yang dipilih
                var fileName = fileInput.files[0].name;
                // Tampilkan nama file di elemen <span>
                fileNameDisplay.textContent = 'File saat ini: ' + fileName;
            } else {
                // Jika tidak ada file yang dipilih
                fileNameDisplay.textContent = 'File saat ini: Tidak ada file';
            }
        });
    </script>


@endsection
<?php
function namaBulan($bulan)
{
    // Daftar nama bulan dalam bahasa Indonesia
    $namaBulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    // Periksa apakah bulan valid
    return $namaBulan[$bulan] ?? 'Bulan tidak valid';
}
function formatTanggalIndonesia($tanggal)
{
    // Format input diharapkan yyyy-mm-dd
    $dateParts = explode('-', $tanggal);
    if (count($dateParts) === 3) {
        $tahun = $dateParts[0];
        $bulan = (int) $dateParts[1];
        $hari = $dateParts[2];

        return $hari . ' ' . namaBulan($bulan) . ' ' . $tahun;
    }
    return 'Tanggal tidak valid';
}
?>

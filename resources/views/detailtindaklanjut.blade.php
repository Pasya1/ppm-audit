@extends('layouts.master')

@section('title', 'Admin | Detail Tindak Perbaikan')

@section('content')
    <style>
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6 !important;
            /* Warna border */
        }

        .table {
            border-collapse: collapse;
            /* Agar border terlihat menyatu */
        }

        .form-check {
            margin-right: 20px;
            /* Atur jarak antar radio button */
        }
    </style>
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
                            <div class="col-md-6">
                                <h5 class="card-title">
                                    BAB II DAFTAR TEMUAN AMI
                                </h5>
                            </div>

                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalCetak">
                                <i class="fas fa-print"></i> Cetak Hasil
                            </a>

                        </div>
                        <div class="row px-3">
                            <div class="table-responsive">
                                <table class="table table-borderless">

                                    <tbody>
                                        <tr>
                                            <td style="width: 30%;">Program Studi/ Unit</td>
                                            <td style="width: 2%;">:</td>
                                            <td>{{ $detailTindakLanjut->auditee }}</td>
                                        </tr>
                                        <tr>
                                            <td>Koordinator</td>
                                            <td>:</td>
                                            <td>{{ $detailTindakLanjut->koordinator_nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Auditor 1</td>
                                            <td>:</td>
                                            <td>{{ $detailTindakLanjut->ketua_auditor }}</td>
                                        </tr>
                                        @if (!empty($detailTindakLanjut->sekretaris_auditor))   
                                            <tr>
                                                <td>Auditor 2</td>
                                                <td>:</td>
                                                <td>{{ $detailTindakLanjut->sekretaris_auditor }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Tanggal Penilaian</td>
                                            <td>:</td>
                                            <td>{{ $detailTindakLanjut->tanggal_desk }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jangka Waktu Perbaikan</td>
                                            <td>:</td>
                                            <td>{{ $detailTindakLanjut->jangka_waktu_perbaikan }} hari</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive px-2">
                            <table class="table table-bordered text-center">
                                <thead class="text-primary">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Dokumen Acuan</th>
                                        <th rowspan="2">Deskripsi Temuan</th>
                                        <th colspan="3">Status Temuan</th>
                                        <th rowspan="2">Permintaan Tindakan Koreksi</th>
                                    </tr>
                                    <tr>
                                        <th>Minor</th>
                                        <th>Major</th>
                                        <th>Observasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($alldetail as $key => $details)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $details->dokumen_acuan }}</td>
                                            <td>{!! $details->deskripsi_temuan !!}</td>
                                            <td>
                                                @if ($details->OPEN)
                                                    <span style="color: green;">&#10004;</span> <!-- Centang hijau -->
                                                @else
                                                    <span style="color: red;">&#10008;</span> <!-- Silang merah -->
                                                @endif
                                            </td>
                                            <td>
                                                @if ($details->CLOSE)
                                                    <span style="color: green;">&#10004;</span> <!-- Centang hijau -->
                                                @else
                                                    <span style="color: red;">&#10008;</span> <!-- Silang merah -->
                                                @endif
                                            </td>
                                            <td>
                                                @if ($details->OB)
                                                    <span style="color: green;">&#10004;</span> <!-- Centang hijau -->
                                                @else
                                                    <span style="color: red;">&#10008;</span> <!-- Silang merah -->
                                                @endif
                                            </td>

                                            <td>{!! $details->permintaan_tindakan_koreksi !!}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center"> Data Belum Ditambahkan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @if ($waktuHabis)
                                <div class="alert alert-danger">
                                    Jangka waktu telah habis. Anda tidak dapat menambahkan tindakan perbaikan.
                                </div>
                            @else
                                @if ($user->role === 'Auditee' || $user->role === 'Admin')
                                    <button data-toggle="modal" data-target="#tambahdetail" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Tindak Perbaikan
                                    </button>
                                @endif
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Deskripsi Tindakan Perbaikan</th>
                                            <th>Link Dokumen</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tindaklanjut as $key => $tindaklanjuts)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{!! $tindaklanjuts->tindak_lanjut !!}</td>
                                                <td>
                                                    <a href="{{ $tindaklanjuts->link_drive }}" target="_blank">
                                                        {{ $tindaklanjuts->link_drive }}</a>
                                                </td>
                                                @if ($user->role === 'Auditee' || $user->role === 'Admin')
                                                    <td>
                                                        <!-- Tombol Edit -->
                                                        <a href="#" data-id="{{ $tindaklanjuts->id }}"
                                                            data-tindaklanjut="{{ $tindaklanjuts->tindak_lanjut }}"
                                                            data-linkdrive="{{ $tindaklanjuts->link_drive }}"
                                                            class="btn-buttonDetail edit-buttonDetail text-warning">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <!-- Tombol Delete -->
                                                        <form
                                                            action="{{ route('detailtindaklanjut.destroy', $tindaklanjuts->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-link text-danger"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                                @if ($user->role === 'Auditor')
                                                    <td>
                                                        -
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center"> Tindakan Perbaikan Belum Ditambahkan
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="row px-3">
                                <a href="{{ route('tindaklanjut') }}" class="btn btn-secondary mt-3 "><i
                                        class="fas fa-backward"></i>
                                    Back</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahdetail" tabindex="-1" role="dialog" aria-labelledby="tambahdetailLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahdetailLabel">Tambah Detail Tindak Perbaikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('detailtindaklanjut.store', $detailTindakLanjut->id ?? 0) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="document_id" id="document_id" value="{{ $detailTindakLanjut->id }}">

                        <!-- Deskripsi Temuan -->
                        <div class="form-group">
                            <label for="deskripsi_tindak_lanjut" class="col-form-label">Deskripsi Tindak Perbaikan</label>
                            <textarea class="form-control" name="deskripsi_tindak_lanjut" id="deskripsi_tindak_lanjut" rows="4" required></textarea>
                        </div>

                        <!-- Permintaan Tindakan Koreksi -->
                        <div class="form-group">
                            <label for="link_dokumen" class="col-form-label">Link Dokumen Drive</label>
                            <input type="text" class="form-control" name="link_dokumen" id="link_dokumen"
                                rows="4" required>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="editDetailModal" tabindex="-1" role="dialog" aria-labelledby="editDetailLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDetailLabel">Edit Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editDetailForm" method="POST" action="{{ route('detailtindaklanjut.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <!-- Hidden Input for ID -->
                        <input type="hidden" name="id" id="editId">

                        <!-- Deskripsi Tindak Perbaikan -->
                        <div class="form-group">
                            <label for="editDeskripsiTindakLanjut">Deskripsi Tindak Perbaikan</label>
                            <textarea class="form-control" name="editDeskripsiTindakLanjut" id="editDeskripsiTindakLanjut" rows="4"
                                required></textarea>
                        </div>
                        <!--Link Drive -->
                        <div class="form-group">
                            <label for="editlinkdrive">Link Dokumen Drive</label>
                            <input type="text" class="form-control" name="editlinkdrive" id="editlinkdrive" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCetak" tabindex="-1" role="dialog" aria-labelledby="modalCetakLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCetakLabel">Pilih Opsi Cetak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cetakdetailaudit.hasil', $detailTindakLanjut->id) }}" method="GET">
                        <div class="form-group">
                            <select name="include_penilaian" id="includePenilaian" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Opsi --</option>
                                <option value="null" style="background-color: yellow;">Cetak Tanpa Hasil Penilaian
                                    Dokumen Manapun</option>
                                @foreach ($documents as $document)
                                    <option value="{{ $document->id }}">
                                        Dokumen : {{ $document->judul_audit }}
                                        ({{ formatTanggalIndonesia($document->tanggal_audit) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <p>Pilih Dokumen terkait jika Anda membutuhkan laporan hasil audit beserta dengan penilaian dan
                            daftar tiliknya. </p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Inisialisasi TinyMCE saat modal tambah detail muncul
    $('#tambahdetail').on('shown.bs.modal', function () {
            tinymce.init({
                selector: '#deskripsi_tindak_lanjut',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar: 'bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                menubar: false,
                height: 150,
                relative_urls: false,
                setup: function (editor) {
                    editor.on('change', function () {
                        tinymce.triggerSave(); // Sinkronisasi otomatis saat ada perubahan
                    });
                }
            });
        });

        // Hapus TinyMCE saat modal ditutup agar tidak terjadi duplikasi
        $('#tambahdetail').on('hidden.bs.modal', function () {
            if (tinymce.get('deskripsi_tindak_lanjut')) {
                tinymce.remove('#deskripsi_tindak_lanjut');
            }
        });

        // Pastikan TinyMCE tersinkronisasi sebelum form dikirim
        $('#tambahdetail form').on('submit', function () {
            tinymce.triggerSave();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih Standar / Dokumen Acuan",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).on('click', '.edit-buttonDetail', function() {
                tinymce.init({
                    selector: '#editDeskripsiTindakLanjut',
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    toolbar: 'bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                    menubar: false,
                    height: 150,
                    relative_urls: false,
                    setup: function (editor) {
                        editor.on('change', function () {
                            tinymce.triggerSave(); // Sinkronisasi otomatis saat ada perubahan
                        });
                    }
                });
            // Ambil data dari atribut tombol
            const id = $(this).data('id');
            const tindaklanjut = $(this).data('tindaklanjut');
            const linkdrive = $(this).data('linkdrive');

            // Isi data ke dalam modal
            $('#editId').val(id);
            $('#editDeskripsiTindakLanjut').val(tindaklanjut);
            $('#editlinkdrive').val(linkdrive);

            // Tampilkan modal
            $('#editDetailModal').modal('show');
            

            // Hapus TinyMCE saat modal ditutup agar tidak terjadi duplikasi
            $('#editDetailModal').on('hidden.bs.modal', function () {
                if (tinymce.get('editDeskripsiTindakLanjut')) {
                    tinymce.remove('#editDeskripsiTindakLanjut');
                }
            });

            // Pastikan TinyMCE tersinkronisasi sebelum form dikirim
            $('#editDetailModal form').on('submit', function () {
                tinymce.triggerSave();
            });
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
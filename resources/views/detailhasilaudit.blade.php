@extends('layouts.master')

@section('title', 'Admin | Detail Hasil Audit')

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
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
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
                        <div class="col-md-6 justify-content-end d-flex">
                            {{-- <a href="{{ route('cetakdetailaudit.hasil', $detailHasilAudit->id) }}"
                                    class="btn btn-success">
                                    <i class="fas fa-print"></i> Cetak Hasil
                                </a> --}}
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalCetak">
                                <i class="fas fa-print"></i> Cetak Hasil
                            </a>

                            @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                <button data-toggle="modal" data-target="#tambahdetail" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="row px-3">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%;">Program Studi/ Unit</td>
                                        <td style="width: 2%;">:</td>
                                        <td>{{ $detailHasilAudit->auditee }}</td>
                                    </tr>
                                    <tr>
                                        <td>Koordinator</td>
                                        <td>:</td>
                                        <td>{{ $detailHasilAudit->koordinator_nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Auditor 1</td>
                                        <td>:</td>
                                        <td>{{ $detailHasilAudit->ketua_auditor }}</td>
                                    </tr>
                                    @if (!empty($detailHasilAudit->sekretaris_auditor))    
                                        <tr>
                                            <td>Auditor 2</td>
                                            <td>:</td>
                                            <td>{{ $detailHasilAudit->sekretaris_auditor }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Tanggal Penilaian</td>
                                        <td>:</td>
                                        <td>{{ $detailHasilAudit->tanggal_desk }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jangka Waktu Perbaikan</td>
                                        <td>:</td>
                                        <td>{{ $detailHasilAudit->jangka_waktu_perbaikan }} hari</td>
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
                                    <th rowspan="2">Aksi</th>
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
                                        @if ($user->role === 'Auditor' || $user->role === 'Admin')
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
                                            <td>
                                                <a href="#" data-id="{{ $details->id }}"
                                                    data-idstandart="{{ $details->standart_id }}"
                                                    data-dokumenacuan="{{ $details->dokumen_acuan }}"
                                                    data-deskripsitemuan="{{ $details->deskripsi_temuan }}"
                                                    data-open="{{ $details->OPEN }}"
                                                    data-close="{{ $details->CLOSE }}"
                                                    data-permintaantindakankoreksi="{{ $details->permintaan_tindakan_koreksi }}"
                                                    class="edit-buttonDetail text-warning">
                                                    <i class="fas fa-pen"></i>
                                                </a>

                                                <!-- Tombol Delete -->
                                                <form action="{{ route('detailhasilaudit.destroy', $details->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-link text-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                        @if ($user->role === 'Auditee')
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
                                            <td>
                                                -
                                            </td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center"> Data Belum Ditambahkan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="row px-3">
                            <a href="{{ route('hasilaudit') }}" class="btn btn-secondary mt-3 "><i
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
                <h5 class="modal-title" id="tambahdetailLabel">Tambah Detail Hasil Audit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('detailaudit.store', $detailHasilAudit->id ?? 0) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="document_id" id="document_id" value="{{ $detailHasilAudit->id }}">

                    <!-- Standar / Dokumen Acuan -->
                    <div class="form-group">
                        <label for="dokumen_acuan"> Pilih Standar / Dokumen Acuan</label>
                        <select class="form-control select2" id="dokumen_acuan" name="dokumen_acuan" required>
                            <option value="">-- Pilih --</option>
                            @foreach ($standarts as $standar)
                                <option value="{{ $standar->id }}">{{ $standar->dokumen_acuan }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Deskripsi Temuan -->
                    <div class="form-group">
                        <label for="deskripsi_temuan" class="col-form-label">Deskripsi Temuan</label>
                        <textarea class="form-control" name="deskripsi_temuan" id="deskripsi_temuan" rows="4" required></textarea>
                    </div>

                    <!-- Status Temuan -->
                    <label class="col-form-label d-block">Status Temuan</label>
                    <div class="row px-3">
                        <input class="" type="radio" name="status_temuan" id="status_open" value="open"
                            required>
                        <label class="form-check-label" for="status_open">Minor</label>
                    </div>
                    <div class="row px-3 py-2">
                        <input class="" type="radio" name="status_temuan" id="status_close" value="close">
                        <label class="form-check-label" for="status_close">Major</label>
                    </div>
                    <div class="row px-3 py-2">
                        <input class="" type="radio" name="status_temuan" id="status_ob" value="ob">
                        <label class="form-check-label" for="status_ob">Observasi</label>
                    </div>

                    <!-- Permintaan Tindakan Koreksi -->
                    <div class="form-group">
                        <label for="tindakan_koreksi" class="col-form-label">Permintaan Tindakan Koreksi</label>
                        <textarea class="form-control" name="tindakan_koreksi" id="tindakan_koreksi" rows="4" required></textarea>
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
            <form id="editDetailForm" method="POST" action="{{ route('detailaudit.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Hidden Input for ID -->
                    <input type="hidden" name="id" id="editId">

                    <!-- Standar ID -->
                    <div class="form-group">
                        <label for="editStandartId">Standart/ Dokumen Acuan</label>
                        <input type="text" class="form-control" name="standart_id" id="editStandartId" readonly>
                    </div>

                    <!-- Deskripsi Temuan -->
                    <div class="form-group">
                        <label for="editDeskripsiTemuan">Deskripsi Temuan</label>
                        <textarea class="form-control" name="deskripsi_temuan" id="editDeskripsiTemuan" rows="4" required></textarea>
                    </div>

                    <!-- Status Temuan -->
                    <label class="col-form-label d-block">Status Temuan</label>
                    <div class="row px-3">
                        <input class="" type="radio" name="status_temuan" id="editStatusOpen"
                            value="open">
                        <label class="form-check-label" for="editStatusOpen">Minor</label>
                    </div>
                    <div class="row px-3 py-2">
                        <input class="" type="radio" name="status_temuan" id="editStatusClose"
                            value="close">
                        <label class="form-check-label" for="editStatusClose">Major</label>
                    </div>
                    <div class="row px-3 py-2">
                        <input class="" type="radio" name="status_temuan" id="editStatusOb" value="ob">
                        <label class="form-check-label" for="editStatusOb">Observasi</label>
                    </div>

                    <!-- Permintaan Tindakan Koreksi -->
                    <div class="form-group">
                        <label for="editPermintaanTindakanKoreksi">Permintaan Tindakan Koreksi</label>
                        <textarea class="form-control" name="permintaan_tindakan_koreksi" id="editPermintaanTindakanKoreksi" rows="4"></textarea>
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
                <form action="{{ route('cetakdetailaudit.hasil', $detailHasilAudit->id) }}" method="GET">
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
   document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi TinyMCE hanya saat modal ditampilkan
        $('#tambahdetail').on('shown.bs.modal', function () {
            if (!tinymce.get('deskripsi_temuan')) { // Cek apakah TinyMCE sudah diinisialisasi
                tinymce.init({
                    selector: '#deskripsi_temuan, #tindakan_koreksi',
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
            }
        });

        // Hapus TinyMCE saat modal ditutup agar tidak terjadi duplikasi
        $('#tambahdetail').on('hidden.bs.modal', function () {
            if (tinymce.get('deskripsi_temuan')) {
                tinymce.remove('#deskripsi_temuan');
            }
            if (tinymce.get('tindakan_koreksi')) {
                tinymce.remove('#tindakan_koreksi');
            }
        });

        // Pastikan TinyMCE tersinkronisasi sebelum form dikirim
        $('form').on('submit', function () {
            tinymce.triggerSave();
        });
    });
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
                    selector: '#editDeskripsiTemuan, #editPermintaanTindakanKoreksi',
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
        const standartId = $(this).data('idstandart');
        const dokumenacuan = $(this).data('dokumenacuan');
        const deskripsiTemuan = $(this).data('deskripsitemuan');
        const open = $(this).data('open');
        const close = $(this).data('close');
        const ob = $(this).data('ob');
        const tindakanKoreksi = $(this).data('permintaantindakankoreksi');

        // Isi data ke dalam modal
        $('#editId').val(id);
        $('#editStandartId').val(dokumenacuan);
        $('#editDeskripsiTemuan').val(deskripsiTemuan);
        $('#editPermintaanTindakanKoreksi').val(tindakanKoreksi);

        // Cek status temuan (radio button)
        if (open) {
            $('#editStatusOpen').prop('checked', true);
        } else if (close) {
            $('#editStatusClose').prop('checked', true);
        } else {
            $('#editStatusOb').prop('checked', true);
        }

        // Tampilkan modal
        $('#editDetailModal').modal('show');

        
        // Hapus TinyMCE saat modal ditutup agar tidak terjadi duplikasi
        $('#editDetailModal').on('hidden.bs.modal', function () {
            if (tinymce.get('editDeskripsiTemuan')) {
                tinymce.remove('#editDeskripsiTemuan');
            }
            if (tinymce.get('editPermintaanTindakanKoreksi')) {
                tinymce.remove('#editPermintaanTindakanKoreksi');
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

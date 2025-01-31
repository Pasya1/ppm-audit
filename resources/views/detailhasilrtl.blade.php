@extends('layouts.master')

@section('title', 'Admin | Detail Hasil Rencana Tindak Lanjut')

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
                                BAB II Rencana Tindak Lanjut
                            </h5>
                        </div>
                        <div class="col-md-6 justify-content-end d-flex">
                            <a href="{{ route('cetakdetailrtl.hasil', $detailHasilRTL->id) }}" class="btn btn-success">
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
                                        <td style="width: 30%;">Tanggal Laporan</td>
                                        <td style="width: 2%;">:</td>
                                        <td>{{ formatTanggalIndonesia($detailHasilRTL->tanggal_laporan) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Referensi Hasil AMI</td>
                                        <td>:</td>
                                        <td>
                                            @if ($detailHasilRTL->hasil_audit_id == null)
                                                Tidak Ada
                                                @else
                                                Auditee : <?= $detailHasilRTL->hasilAudit->auditee ?> (
                                                <?= formatTanggalIndonesia($detailHasilRTL->hasilAudit->tanggal_desk) ?>
                                                Periode : <?= $detailHasilRTL->hasilAudit->periode ?> )
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jadwal Perbaikan</td>
                                        <td>:</td>
                                        <td>{{ $detailHasilRTL->jadwal_perbaikan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>
                                            @if ($detailHasilRTL->Minor == 1)
                                                Minor
                                                @elseif ($detailHasilRTL->Major == 1)
                                                Major
                                                @elseif ($detailHasilRTL->OB == 1)
                                                Observasi
                                                @elseif ($detailHasilRTL->KTS == 1)
                                                Ketidaksesuaian
                                            @endif
                                        </td>
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
                                    <th>No</th>
                                    <th>Pernyataan Standar</th>
                                    <th>Keterangan Hasil AMI</th>
                                    <th>Rencana Tindak Lanjut</th>
                                    <th>Sumber Daya</th>
                                    <th>Hasil RTL</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($alldetail as $key => $details)
                                    <tr>
                                        @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{!! $details->pernyataan_standar !!}</td>
                                            <td>{!! $details->keterangan_hasil_AMI !!}</td>
                                            <td>{!! $details->rencana_tindak_lanjut !!}</td>
                                            <td>{!! $details->sumber_daya !!}</td>
                                            <td>{!! $details->hasil_RTL !!}</td>
                                            <td>
                                                <a href="#" data-id="{{ $details->id }}"
                                                    data-pernyataan="{{ $details->pernyataan_standar }}"
                                                    data-keterangan="{{ $details->keterangan_hasil_AMI }}"
                                                    data-rtl="{{ $details->rencana_tindak_lanjut }}"
                                                    data-sumberdaya="{{ $details->sumber_daya }}"
                                                    data-hasilrtl="{{ $details->hasil_RTL }}"
                                                    class="edit-buttonDetail text-warning">
                                                    <i class="fas fa-pen"></i>
                                                </a>

                                                <!-- Tombol Delete -->
                                                <form action="{{ route('detailhasilrtl.destroy', $details->id) }}"
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
                                            <td>{!! $details->pernyataan_standar !!}</td>
                                            <td>{!! $details->keterangan_hasil_AMI !!}</td>
                                            <td>{!! $details->rencana_tindak_lanjut !!}</td>
                                            <td>{!! $details->sumber_daya !!}</td>
                                            <td>{!! $details->hasil_RTL !!}</td>
                                            <td>
                                                -
                                            </td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center"> Data Belum Ditambahkan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="row px-3">
                            <a href="{{ route('hasilRTL.index') }}" class="btn btn-secondary mt-3 "><i
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
                <h5 class="modal-title" id="tambahdetailLabel">Tambah Detail Hasil RTL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('detailrtl.store', $detailHasilRTL->id ?? 0) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pernyataan_standar" class="col-form-label"><strong>Pernyataan Standar</strong></label>
                                <textarea class="form-control" name="pernyataan_standar" id="pernyataan_standar" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="keterangan_hasil_AMI" class="col-form-label"><strong>Keterangan Hasil AMI</strong></label>
                                <textarea class="form-control" name="keterangan_hasil_AMI" id="keterangan_hasil_AMI" rows="4" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="rencana_tindak_lanjut" class="col-form-label"><strong>Rencana Tindak Lanjut</strong></label>
                                <textarea class="form-control" name="rencana_tindak_lanjut" id="rencana_tindak_lanjut" rows="4" ></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sumber_daya" class="col-form-label"><strong>Sumber Daya</strong></label>
                                <textarea class="form-control" name="sumber_daya" id="sumber_daya" rows="4" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="hasil_RTL" class="col-form-label"><strong>Hasil RTL</strong></label>
                                <textarea class="form-control" name="hasil_RTL" id="hasil_RTL" rows="4" ></textarea>
                            </div>
                        </div>
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
            <form id="editDetailForm" method="POST" action="{{ route('detailrtl.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Hidden Input for ID -->
                    <input type="hidden" name="editId" id="editId">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pernyataan_standar_edit" class="col-form-label">Pernyataan Standar</label>
                                <textarea class="form-control" name="pernyataan_standar_edit" id="pernyataan_standar_edit" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="keterangan_hasil_AMI_edit" class="col-form-label">Keterangan Hasil AMI</label>
                                <textarea class="form-control" name="keterangan_hasil_AMI_edit" id="keterangan_hasil_AMI_edit" rows="4" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="rencana_tindak_lanjut_edit" class="col-form-label">Rencana Tindak
                                    Lanjut</label>
                                <textarea class="form-control" name="rencana_tindak_lanjut_edit" id="rencana_tindak_lanjut_edit" rows="4" ></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sumber_daya_edit" class="col-form-label">Sumber Daya</label>
                                <textarea class="form-control" name="sumber_daya_edit" id="sumber_daya_edit" rows="4" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="hasil_RTL_edit" class="col-form-label">Hasil RTL</label>
                                <textarea class="form-control" name="hasil_RTL_edit" id="hasil_RTL_edit" rows="4" ></textarea>
                            </div>
                        </div>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Inisialisasi TinyMCE saat modal tambah detail hasil RTL muncul
    $('#tambahdetail').on('shown.bs.modal', function () {
        tinymce.init({
            selector: 'textarea', // Mengaktifkan TinyMCE pada semua textarea dalam modal
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar: 'bold italic alignleft aligncenter alignright bullist numlist outdent indent',
            menubar: false,
            height: 200,
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
        tinymce.remove('textarea');
    });

    // Pastikan TinyMCE tersinkronisasi sebelum form dikirim
    $('#tambahdetail form').on('submit', function () {
        tinymce.triggerSave();
    });
</script>

<script>
    $(document).on('click', '.edit-buttonDetail', function() {
        tinymce.init({
            selector: 'textarea', // Mengaktifkan TinyMCE pada semua textarea dalam modal
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar: 'bold italic alignleft aligncenter alignright bullist numlist outdent indent',
            menubar: false,
            height: 200,
            relative_urls: false,
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave(); // Sinkronisasi otomatis saat ada perubahan
                });
            }
        });
        var id = $(this).data('id');
        var pernyataan = $(this).data('pernyataan');
        var keterangan = $(this).data('keterangan');
        var rtl = $(this).data('rtl');
        var sumberdaya = $(this).data('sumberdaya');
        var hasilrtl = $(this).data('hasilrtl');

        // Isi modal dengan data yang diklik
        $('#editId').val(id);
        $('#pernyataan_standar_edit').val(pernyataan).trigger('change');
        $('#keterangan_hasil_AMI_edit').val(keterangan).trigger('change');
        $('#rencana_tindak_lanjut_edit').val(rtl).trigger('change');
        $('#sumber_daya_edit').val(sumberdaya).trigger('change');
        $('#hasil_RTL_edit').val(hasilrtl).trigger('change');

        // Tampilkan modal
        $('#editDetailModal').modal('show');

         // Hapus TinyMCE saat modal ditutup agar tidak terjadi duplikasi
        $('#editDetailModal').on('hidden.bs.modal', function () {
            tinymce.remove('textarea');
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

@extends('layouts.master')

@section('title', 'Admin | Rencana Tindak Lanjut')

@section('content')
    <div class="content" style="height: 100vh;">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between mx-2">
                            <h5 class="card-title">
                                Hasil Rencana Tindak Lanjut
                            </h5>
                            <div class="row px-2">
                                @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                    <button data-toggle="modal" data-target="#tambahRTL" class="btn"
                                        style="background-color: #001A6E;">
                                        <i class="fas fa-plus"></i> Isi Data Hasil RTL
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive px-2">
                            <table class="table">
                                <thead style="color: #001A6E;">
                                    <th>No</th>
                                    <th>Tanggal Laporan</th>
                                    <th>Referensi Hasil AMI</th>
                                    <th>Jadwal Perbaikan</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @forelse ($HasilRTL as $key => $HasilRTLS)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><?= formatTanggalIndonesia($HasilRTLS->tanggal_laporan) ?></td>
                                            <td>
                                                @if ($HasilRTLS->hasil_audit_id == null)
                                                    Tidak Ada
                                                @else
                                                    Auditee : <?= $HasilRTLS->hasilAudit->auditee ?> (
                                                    <?= formatTanggalIndonesia($HasilRTLS->hasilAudit->tanggal_desk) ?> |
                                                    Periode : <?= $HasilRTLS->hasilAudit->periode ?> )
                                                @endif
                                            </td>
                                            <td><?= $HasilRTLS->jadwal_perbaikan ?></td>
                                            <td>
                                                @if ($HasilRTLS->Minor == 1)
                                                    Minor
                                                @elseif ($HasilRTLS->Major == 1)
                                                    Major
                                                @elseif ($HasilRTLS->OB == 1)
                                                    Observasi
                                                @elseif ($HasilRTLS->KTS == 1)
                                                    KTS
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('HasilRTL.detail', $HasilRTLS->id) }}"
                                                    style="width: 30%; height: 40px; color:black;"><i
                                                        class="fas fa-eye pr-2"></i> View</a>
                                            </td>
                                            @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" class="btn-editHasilRTL text-warning"
                                                        data-id="{{ $HasilRTLS->id }}"
                                                        data-tanggallaporan="{{ $HasilRTLS->tanggal_laporan }}"
                                                        data-hasilauditid="{{ $HasilRTLS->hasil_audit_id }}"
                                                        data-jadwalperbaikan="{{ $HasilRTLS->jadwal_perbaikan }}"
                                                        data-minor="{{ $HasilRTLS->Minor }}"
                                                        data-major="{{ $HasilRTLS->Major }}" data-ob="{{ $HasilRTLS->OB }}"
                                                        data-kts="{{ $HasilRTLS->KTS }}">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <!-- Tombol Delete -->
                                                    <form action="{{ route('hasilRTLhapus.destroy', $HasilRTLS->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class=" btn-link text-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </td>
                                            @endif
                                            @if ($user->role === 'Auditee')
                                                <td>
                                                    -
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Hasil RTL Belum Ditambahkan.</td>
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

    <div class="modal fade" id="tambahRTL" tabindex="-1" role="dialog" aria-labelledby="tambahRTLLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRTLLabel">Tambah Data Hasil Rencana Tindak Lanjut</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Input Hasil RTL -->
                    <form action="{{ route('hasilRTL.update', $HasilRTLS->id ?? 0) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Tanggal Laporan -->
                                    <div class="form-group">
                                        <label>Tanggal Pembuatan RTL :</label>
                                        <input type="date" name="tanggal_laporan" class="form-control" required>
                                    </div>

                                    <!-- Referensi AMI -->
                                    <div class="form-group">
                                        <label>Referensi AMI :</label>
                                        <select name="reference_ami" id="reference_ami" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="" style="background-color: yellow;">Tidak Ada</option>
                                            @foreach ($hasilAudit as $hasilAudits)
                                                <option value="{{ $hasilAudits->id }}">
                                                    Auditee: {{ $hasilAudits->auditee }}
                                                    ({{ formatTanggalIndonesia($hasilAudits->tanggal_desk) }} | Periode:
                                                    {{ $hasilAudits->periode }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Jadwal Perbaikan -->
                                    <div class="form-group">
                                        <label>Jadwal Perbaikan :</label>
                                        <input type="text" name="jadwal_perbaikan" class="form-control"
                                            placeholder="cth : 2024 / 2025" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Status Temuan</label>
                                    <div class="row px-3">
                                        <input type="radio" name="status_temuan" value="Minor" required>
                                        <label>Minor</label>
                                    </div>
                                    <div class="row px-3 py-2">
                                        <input type="radio" name="status_temuan" value="Major">
                                        <label>Major</label>
                                    </div>
                                    <div class="row px-3 py-2">
                                        <input type="radio" name="status_temuan" value="OB">
                                        <label>Observasi</label>
                                    </div>
                                    <div class="row px-3 py-2">
                                        <input type="radio" name="status_temuan" value="KTS">
                                        <label>Ketidaksesuaian</label>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>
                                    Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Hasil RTL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hasilRTL.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="edit_hasil_rtl_id" id="edit_hasil_rtl_id">
                        <div class="form-group">
                            <label for="edit-tanggal">Tanggal Laporan</label>
                            <input type="date" class="form-control" name="tanggal_laporan" id="edit-tanggal"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit-hasil-audit">Referensi AMI</label>
                            <select name="hasil_audit_id" id="edit-hasil-audit" class="form-control">
                                <option value="" style="background-color: yellow;">
                                    Tidak Ada
                                </option>
                                @foreach ($hasilAudit as $hasilAudits)
                                    <option value="{{ $hasilAudits->id }}"
                                        {{ isset($data) && $data->hasil_audit_id == $hasilAudits->id ? 'selected' : '' }}>
                                        Auditee: {{ $hasilAudits->auditee }}
                                        ({{ formatTanggalIndonesia($hasilAudits->tanggal_desk) }} | Periode:
                                        {{ $hasilAudits->periode }})
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="edit-jadwal">Jadwal Perbaikan</label>
                            <input type="text" class="form-control" name="jadwal_perbaikan" id="edit-jadwal"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Status Temuan</label>
                            <select name="status_temuan" id="edit-status" class="form-control">
                                <option value="Minor"
                                    {{ isset($data) && $data->status_temuan == 'Minor' ? 'selected' : '' }}>Minor</option>
                                <option value="Major"
                                    {{ isset($data) && $data->status_temuan == 'Major' ? 'selected' : '' }}>Major</option>
                                <option value="OB"
                                    {{ isset($data) && $data->status_temuan == 'OB' ? 'selected' : '' }}>Observasi</option>
                                <option value="KTS"
                                    {{ isset($data) && $data->status_temuan == 'KTS' ? 'selected' : '' }}>KTS</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ketika tombol edit diklik
            $('.btn-editHasilRTL').on('click', function() {
                // Ambil data dari tombol yang diklik
                var id = $(this).data("id");
                var tanggal = $(this).data("tanggallaporan");
                var hasilAuditId = $(this).data("hasilauditid");
                var jadwalPerbaikan = $(this).data("jadwalperbaikan");

                // Status temuan sebagai boolean
                var minor = $(this).data("minor");
                var major = $(this).data("major");
                var ob = $(this).data("ob");
                var kts = $(this).data("kts");

                // Set data ke modal
                $('#edit_hasil_rtl_id').val(id);
                $("#edit-tanggal").val(tanggal);
                $("#edit-hasil-audit").val(hasilAuditId);
                $("#edit-jadwal").val(jadwalPerbaikan);

                if (minor) {
                    $("#edit-status").val("Minor");
                } else if (major) {
                    $("#edit-status").val("Major");
                } else if (ob) {
                    $("#edit-status").val("OB");
                } else if (kts) {
                    $("#edit-status").val("KTS");
                } else {
                    $("#edit-status").val(""); // Kosongkan jika tidak ada status
                }

                // Tampilkan modal
                $('#editModal').modal('show');
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

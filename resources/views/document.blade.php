@extends('layouts.master')

@section('title', 'Admin | Document')

@section('content')
<div id="loading" style="display:none;">
    <img src="{{ asset('AdminStyle') }}/img/pmg.png" alt="Loading..." />
</div>
    <div class="content" style="height: 100vh;">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                @if ($user->role === 'Auditee' || $user->role === 'Admin')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Upload Dokument Kebutuhan Audit
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('audit.document') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row d-flex">
                                    <div class="col-md-6 pb-3">
                                        <label for="tanggal_audit"> Tanggal Audit</label>
                                        <input type="date" name="tanggal_audit" id="tanggal_audit" class="form-control"
                                            required>

                                        <label for="tahun_audit" class="pt-3"> Periode</label>
                                        <input type="text" id="tahun_audit" name="tahun_audit" class="form-control"
                                            placeholder="cth: 2024 / 2025" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="judul_audit"> Judul Audit</label>
                                        <input type="text" id="judul_audit" name="judul_audit" class="form-control"
                                            placeholder="cth: ami_Teknik Komputer" required>

                                        <label for="link_drive" class="pt-3"> Upload Link Drive Dokumen Kebutuhan
                                            Audit</label>
                                        <input type="text" id="link_drive" name="link_drive" class="form-control"
                                            placeholder="https://drive.google.com/" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nama_auditee"> Nama Auditee</label>
                                        <input type="text" id="nama_auditee" name="nama_auditee" class="form-control"
                                            placeholder="nama lengkap auditee">
                                    </div>

                                    <div class="col-md-12 py-3">
                                        <button type="submit" class="form-control text-white"
                                            style="transition: opacity 0.3s ease; opacity: 1; background-color: #001A6E;"
                                            onmouseover="this.style.opacity='0.8';" onmouseout="this.style.opacity='1';">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mx-2"> Document Kebutuhan Audit</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive px-2">
                        <table id="documentsTable" class="table table-hover">
                            <thead style="color: #001A6E;">
                                <th>
                                    No
                                </th>
                                <th>
                                    Tanggal Audit
                                </th>
                                <th>
                                    Nama Dokumen
                                </th>
                                <th>
                                    Unit / Program Studi
                                </th>
                                <th>
                                    Periode
                                </th>
                                <th>
                                    Diupload Oleh
                                </th>
                                <th>
                                    Lihat Dokumen
                                </th>
                                <th>
                                    Nilai Dokumen
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </thead>
                            <tbody>
                                @forelse ($documents as $key => $document)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <?= formatTanggalIndonesia($document->tanggal_audit) ?>
                                        </td>
                                        <td>
                                            {{ $document->judul_audit }}
                                        </td>
                                        <td>
                                            {{ $document->programStudi->nama_program_studi ?? 'Tidak Ada' }}
                                        </td>
                                        <td>
                                            {{ $document->tahun_audit }}
                                        </td>
                                        <td>{{ $document->uploadedBy->name ?? 'Tidak diketahui' }}</td>
                                        <td>
                                            <a href="{{ $document->link_drive }}" target="_blank"
                                                class="justify-content-center align-items-center text-center d-flex"
                                                style="width: 30%; height: 40px; display: inline-block; border-radius: 12px; color:black;"><i
                                                    class="fas fa-eye pr-2"></i> View</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('standart', $document->id) }}"
                                                class="justify-content-center align-items-center text-center d-flex"
                                                style="width: 30%; height: 40px; display: inline-block; border-radius: 12px; color:green;"><i
                                                    class="fas fa-pen-to-square pr-2"></i> Nilai</a>
                                        </td>
                                        <td style="width: 70px;">
                                            <!-- Tombol Edit -->
                                            <a href="#" data-id="{{ $document->id }}"
                                                data-tanggalauditedit="{{ $document->tanggal_audit }}"
                                                data-judul_audit="{{ $document->judul_audit }}"
                                                data-tahun_audit="{{ $document->tahun_audit }}"
                                                data-link_drive="{{ $document->link_drive }}"
                                                class="btn-editDocument text-warning">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <!-- Tombol Delete -->
                                            <form action="{{ route('document.destroy', $document->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-link text-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada dokumen ditemukan.</td>
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
    <div class="modal fade" id="editDocument" tabindex="-1" role="dialog" aria-labelledby="editDocumentLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDocumentLabel">Edit Dokumen Kebutuhan Audit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('documents.update', $document->id ?? 0) }}" method="POST" id="editForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="edit_document_id" id="edit_document_id">

                        <div class="form-group">
                            <label for="tanggal_audit_edit">Tanggal Audit</label>
                            <input type="date" id="tanggal_audit_edit" name="tanggal_audit_edit" class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="judul_audit">Judul Audit</label>
                            <input type="text" id="edit_judul_audit" name="edit_judul_audit" class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="edit_tahun_audit">Periode</label>
                            <input type="text" id="edit_tahun_audit" name="edit_tahun_audit" class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="link_drive">Link Drive Dokumen Kebutuhan Audit</label>
                            <input type="text" id="edit_link_drive" name="edit_link_drive" class="form-control"
                                required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editButtons = document.querySelectorAll('.btn-editDocument');
            const editForm = document.getElementById('editForm');

            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Ambil data dari atribut tombol
                    const id = button.dataset.id;
                    const tanggalauditedit = button.dataset.tanggalauditedit;
                    const judulAudit = button.dataset.judul_audit;
                    const tahunAudit = button.dataset.tahun_audit;
                    const linkDrive = button.dataset.link_drive;

                    // Isi data ke dalam form modal
                    document.getElementById('edit_document_id').value = id;
                    document.getElementById('tanggal_audit_edit').value = tanggalauditedit;
                    document.getElementById('edit_judul_audit').value = judulAudit;
                    document.getElementById('edit_tahun_audit').value = tahunAudit;
                    document.getElementById('edit_link_drive').value = linkDrive;

                    // Update URL action form
                    editForm.action = `/document/${id}`;

                    // Tampilkan modal
                    $('#editDocument').modal('show');
                });
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

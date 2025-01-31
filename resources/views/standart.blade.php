@extends('layouts.master')

@section('title', 'Admin | Standart')

@section('content')
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
                            <h5 class="card-title">
                                Standart / Dokumen Acuan
                            </h5>
                            <div class="row px-2">
                                <a href="{{ route('cetak.hasil', $document->id) }}" class="btn btn-success">
                                    <i class="fas fa-print"></i> Cetak Hasil
                                </a>
                                @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                    <button data-toggle="modal" data-target="#tambahDokumenAcuan" class="btn"
                                        style="background-color:#001A6E;">
                                        <i class="fas fa-plus"></i> Tambah Dokumen Acuan
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="row mx-2">
                            Nama Dokumen : {{ $document->judul_audit }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive px-2">
                            <table class="table">
                                <thead style="color: #001A6E;">
                                    <th>No</th>
                                    <th>Dokumen Acuan</th>
                                    <th>Desk Evaluation</th>
                                    <th>Daftar Tilik</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @forelse ($standarts as $key => $standart)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><?= $standart->dokumen_acuan ?></td>
                                            <td>
                                                <a href="{{ route('DeskEvaluation', [$document->id, $standart->id]) }}"
                                                    class="align-items-center d-flex"
                                                    style="width: 50%; height: 40px; display: inline-block; border-radius: 12px; color:green;"><i
                                                        class="fas fa-pen-to-square pr-2"></i> Desk Evaluation</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('DaftarTilik', [$document->id, $standart->id]) }}"
                                                    class="align-items-center text-center d-flex"
                                                    style="width: 50%; height: 40px; display: inline-block; border-radius: 12px; color:#DE8F5F;"><i
                                                        class="fas fa-pen-to-square pr-2"></i> Daftar Tilik</a>
                                            </td>
                                            @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-idstandart="{{ $standart->id }}"
                                                        data-dokumenacuan="{{ $standart->dokumen_acuan }}"
                                                        class=" edit-buttonStandart text-warning">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <!-- Tombol Delete -->
                                                    <form action="{{ route('standart.destroy', $standart->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-link text-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen acuan ini?');">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </td>
                                            @endif
                                            @if ($user->role === 'Auditee')
                                                <td>-</td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Dokumen Acuan Belum Ditambahkan.</td>
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
    <div class="modal fade" id="tambahDokumenAcuan" tabindex="-1" role="dialog" aria-labelledby="tambahDokumenAcuanLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDokumenAcuanLabel">Tambah Dokumen Acuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('standarts.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="dokumen_audit_id" id="dokumen_audit_id"
                            value="{{ $document->id ?? '' }}">
                        <div class="form-group">
                            <label for="nama_standart" class="col-form-label">Nama Standart</label>
                            <input type="text" class="form-control" id="nama_standart" name="nama_standart" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editDocumentStandart" tabindex="-1" role="dialog"
        aria-labelledby="editDocumentStandartLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDocumentStandartLabel">Edit Dokumen Kebutuhan Audit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('standarts.update', $standart->id ?? 0) }}" method="POST"
                        id="editFormStandart">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="edit_standart_id" id="edit_standart_id">
                        <div class="form-group">
                            <label for="nama_standart_edit" class="col-form-label">Nama Standart</label>
                            <input type="text" class="form-control" id="nama_standart_edit" name="nama_standart_edit"
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
        $('#tambahDokumenAcuan').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Pilih semua tombol edit
            const editButtons = document.querySelectorAll('.edit-buttonStandart');
            const editForm = document.getElementById('editFormStandart');

            editButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    event.preventDefault(); // Mencegah aksi default (navigasi link)

                    // Ambil data dari atribut tombol
                    const idstandart = button.dataset.idstandart; // Case-sensitive
                    const dokumenacuan = button.dataset.dokumenacuan; // Case-sensitive

                    // Debug untuk memastikan data benar
                    console.log({
                        idstandart,
                        dokumenacuan
                    });

                    // Isi data ke dalam form modal
                    document.getElementById('edit_standart_id').value = idstandart ||
                        ''; // Beri default jika undefined
                    document.getElementById('nama_standart_edit').value = dokumenacuan || '';

                    // Update URL action form
                    editForm.action = `/standart/${idstandart}`;

                    // Tampilkan modal
                    $('#editDocumentStandart').modal('show');
                });
            });
        });
    </script>

@endsection

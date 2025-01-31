@extends('layouts.master')

@section('title', 'Admin | Program Studi')

@section('content')
    @if ($user->role === 'Admin')
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
                                    Program Studi
                                </h5>
                                <div class="row px-2">
                                    <button data-toggle="modal" data-target="#tambahProgramStudi" class="btn"
                                        style="background-color: #001A6E">
                                        <i class="fas fa-plus"></i> Tambah Program Studi
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive px-2">
                                <table class="table">
                                    <thead style="color: #001A6E;">
                                        <th>No</th>
                                        <th>Nama Program Studi</th>
                                        <th>Kode Program Studi</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($allprogramstudi as $key => $allprogramstudis)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $allprogramstudis->nama_program_studi }}</td>
                                                <td>{{ $allprogramstudis->kode_program_studi }}</td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-id="{{ $allprogramstudis->id }}"
                                                        data-namaprodi="{{ $allprogramstudis->nama_program_studi }}"
                                                        data-kodeprodi="{{ $allprogramstudis->kode_program_studi }}"
                                                        class="btn-editDocument edit-buttonProdi text-warning">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <!-- Tombol Delete -->
                                                    <form action="{{ route('prodi.destroy', $allprogramstudis->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-link text-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus prodi ini?');">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Data Belum Ditambahkan.</td>
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
        <div class="modal fade" id="tambahProgramStudi" tabindex="-1" role="dialog"
            aria-labelledby="tambahProgramStudiLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahProgramStudiLabel">Tambah Program Studi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('prodi.store') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="nama_prodi" class="col-form-label">Nama Program Studi</label>
                                <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
                            </div>
                            <div class="form-group">
                                <label for="kode_prodi" class="col-form-label">Kode Program Studi</label>
                                <input type="text" class="form-control" id="kode_prodi" name="kode_prodi" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn" style="background-color:#001A6E;"><i
                                    class="fas fa-paper-plane"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editProdi" tabindex="-1" role="dialog" aria-labelledby="editProdiLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProdiLabel">Edit Program Studi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('prodi.update', $allprogramstudis->id ?? 0) }}" method="POST"
                            id="editFormProdi">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="edit_prodi_id" id="edit_prodi_id">
                            <div class="form-group">
                                <label for="nama_prodi_edit" class="col-form-label">Nama Program Studi</label>
                                <input type="text" class="form-control" id="nama_prodi_edit" name="nama_prodi_edit"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="kode_prodi_edit" class="col-form-label">Kode Program Studi</label>
                                <input type="text" class="form-control" id="kode_prodi_edit" name="kode_prodi_edit"
                                    required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn" style="background-color:#001A6E;"><i
                                        class="fas fa-save"></i> Simpan
                                    Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#tambahProgramStudi').on('show.bs.modal', function(event) {
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
                const editButtons = document.querySelectorAll('.edit-buttonProdi');
                const editForm = document.getElementById('editFormProdi');

                editButtons.forEach(button => {
                    button.addEventListener('click', (event) => {
                        event.preventDefault(); // Mencegah aksi default (navigasi link)

                        // Ambil data dari atribut tombol
                        const id = button.dataset.id; // Case-sensitive
                        const namaprodi = button.dataset.namaprodi; // Case-sensitive
                        const kodeprodi = button.dataset.kodeprodi; // Case-sensitive

                        // Isi data ke dalam form modal
                        document.getElementById('edit_prodi_id').value = id ||
                            ''; // Beri default jika undefined
                        document.getElementById('nama_prodi_edit').value = namaprodi || '';
                        document.getElementById('kode_prodi_edit').value = kodeprodi || '';

                        // Update URL action form
                        editForm.action = `/ProgramStudi/${id}`;

                        // Tampilkan modal
                        $('#editProdi').modal('show');
                    });
                });
            });
        </script>
    @endif
@endsection

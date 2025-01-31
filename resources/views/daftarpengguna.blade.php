@extends('layouts.master')

@section('title', 'Admin | Daftar Pengguna')

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
                                    Daftar Penggguna
                                </h5>
                                <div class="row px-2">
                                    <button data-toggle="modal" data-target="#tambahDaftarPengguna" class="btn"
                                        style="background-color: #001A6E;">
                                        <i class="fas fa-plus"></i> Tambah User
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive px-2">
                                <table class="table">
                                    <thead style="color: #001A6E;">
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Program Studi</th>
                                        <th>Ganti Password</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($allUser as $key => $allUsers)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $allUsers->name }}</td>
                                                <td>{{ $allUsers->email }}</td>
                                                <td>{{ $allUsers->role }}</td>
                                                <td>{{ $allUsers->programStudi->nama_program_studi ?? 'Tidak ada data' }}
                                                </td>
                                                <td>
                                                    <!-- Tombol Ganti Password -->
                                                    <a href="#" data-id="{{ $allUsers->id }}"
                                                        class="btn btn-sm text-white" style="background-color:#001A6E;"
                                                        onclick="showPasswordChangeModal('{{ $allUsers->id }}')">
                                                        <i class="fas fa-key me-1"></i> Password
                                                    </a>
                                                </td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-id="{{ $allUsers->id }}"
                                                        data-username="{{ $allUsers->name }}"
                                                        data-email="{{ $allUsers->email }}"
                                                        class="btn-editDocument edit-buttonUser text-warning">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <!-- Tombol Delete -->
                                                    <form action="{{ route('user.destroy', $allUsers->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-link text-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus User ini?');">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">User Belum Ditambahkan.</td>
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
        <div class="modal fade" id="tambahDaftarPengguna" tabindex="-1" role="dialog"
            aria-labelledby="tambahDaftarPenggunaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahDaftarPenggunaLabe">Tambah Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('users.store') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="username_baru" class="col-form-label">Username</label>
                                <input type="text" class="form-control" id="username_baru" name="username_baru" required>
                            </div>
                            <div class="form-group">
                                <label for="password_baru" class="col-form-label">Password</label>
                                <input type="password" class="form-control" id="password_baru" name="password_baru"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="col-form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm_password_baru"
                                    name="confirm_password_baru" required>
                            </div>
                            <div id="passwordLabel" class="text-danger" style="display: none;">
                                Password tidak cocok!
                            </div>
                            <div class="form-group">
                                <label for="email_user" class="col-form-label">Email </label>
                                <input type="text" class="form-control" id="email_user" name="email_user"
                                    placeholder="contoh@gmail.com" required>
                            </div>
                            <div class="form-group">
                                <label for="program_studi" class="col-form-label">Program Studi </label>
                                <select name="program_studi" id="program_studi" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($programStudi as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nama_program_studi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role" class="col-form-label">Role </label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Auditor">Auditor</option>
                                    <option value="Auditee">Auditee</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submitButton1"><i
                                    class="fas fa-paper-plane"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserLabel">Edit Data User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.update', $allUsers->id ?? 0) }}" method="POST" id="editFormUser">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="edit_user_id" id="edit_user_id">
                            <div class="form-group">
                                <label for="username_edit" class="col-form-label">Username</label>
                                <input type="text" class="form-control" id="username_edit" name="username_edit"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="email_edit" class="col-form-label">Email</label>
                                <input type="email" class="form-control" id="email_edit" name="email_edit" required>
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

        <!-- Modal Ganti Password -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Ganti Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="changePasswordForm" action="{{ route('password.update', $allUsers->id ?? 0) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" id="userId">
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password"
                                    required>
                            </div>
                            <div id="passwordFeedback" class="text-danger" style="display: none;">
                                Password tidak cocok!
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" form="changePasswordForm" id="submitButton"
                            disabled>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#tambahDaftarPengguna').on('show.bs.modal', function(event) {
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
                const editButtons = document.querySelectorAll('.edit-buttonUser');
                const editForm = document.getElementById('editFormUser');

                editButtons.forEach(button => {
                    button.addEventListener('click', (event) => {
                        event.preventDefault(); // Mencegah aksi default (navigasi link)

                        // Ambil data dari atribut tombol
                        const id = button.dataset.id; // Case-sensitive
                        const username = button.dataset.username; // Case-sensitive
                        const email = button.dataset.email; // Case-sensitive

                        // Isi data ke dalam form modal
                        document.getElementById('edit_user_id').value = id ||
                            ''; // Beri default jika undefined
                        document.getElementById('username_edit').value = username || '';
                        document.getElementById('email_edit').value = email || '';

                        // Update URL action form
                        editForm.action = `/DaftarPengguna/${id}`;

                        // Tampilkan modal
                        $('#editUser').modal('show');
                    });
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const newPassword = document.getElementById('newPassword');
                const confirmPassword = document.getElementById('confirmPassword');
                const submitButton = document.getElementById('submitButton');
                const feedback = document.getElementById('passwordFeedback');

                function validatePassword() {
                    if (newPassword.value !== confirmPassword.value) {
                        feedback.style.display = 'block'; // Tampilkan pesan error
                        submitButton.disabled = true; // Nonaktifkan tombol
                    } else {
                        feedback.style.display = 'none'; // Sembunyikan pesan error
                        submitButton.disabled = false; // Aktifkan tombol
                    }
                }

                newPassword.addEventListener('input', validatePassword);
                confirmPassword.addEventListener('input', validatePassword);
            });

            document.addEventListener('DOMContentLoaded', function() {
                const password_baru = document.getElementById('password_baru');
                const confirm_baru = document.getElementById('confirm_password_baru');
                const submit_button = document.getElementById('submitButton1');
                const label = document.getElementById('passwordLabel');

                function validatePassword() {
                    if (password_baru.value !== confirm_baru.value) {
                        label.style.display = 'block'; // Tampilkan pesan error
                        submit_button.disabled = true; // Nonaktifkan tombol
                    } else {
                        label.style.display = 'none'; // Sembunyikan pesan error
                        submit_button.disabled = false; // Aktifkan tombol
                    }
                }

                password_baru.addEventListener('input', validatePassword);
                confirm_baru.addEventListener('input', validatePassword);
            });



            function showPasswordChangeModal(userId) {
                // Set nilai ID user pada form
                document.getElementById('userId').value = userId;

                // Reset form dan tombol saat modal dibuka
                document.getElementById('newPassword').value = '';
                document.getElementById('confirmPassword').value = '';
                document.getElementById('passwordFeedback').style.display = 'none';
                document.getElementById('submitButton').disabled = true;

                // Tampilkan modal
                const modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
                modal.show();
            }
        </script>
    @endif
@endsection

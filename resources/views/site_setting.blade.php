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
                                    Pengaturan Dokumen Pdf
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive px-2">
                                <table class="table">
                                    <thead style="color: #001A6E;">
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Isi</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        @forelse ($site as $key => $sites)
                                            <tr>
                                                <td>1</td>
                                                <td><strong>Kata Pengantar</strong></td>
                                                <td>{!! $sites->kata_pengantar !!}</td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-id="{{ $sites->id }}"
                                                        data-current-text="{{ $sites->kata_pengantar }}"
                                                        class="edit-katapengantar text-warning" title="Edit Kata Pengantar">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td><strong>Daftar Isi</strong></td>
                                                <td>{!! $sites->daftar_isi !!}</td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-id-daftar-isi="{{ $sites->id }}"
                                                        data-daftar-isi="{{ $sites->daftar_isi }}"
                                                        class="btn-editDocument edit-daftarIsi text-warning"
                                                        title="Edit Daftar Isi">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td><strong>Latar Belakang</strong></td>
                                                <td>{!! $sites->latar_belakang !!}</td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-id-latar-belakang="{{ $sites->id }}"
                                                        data-latar-belakang="{{ $sites->latar_belakang }}"
                                                        class="btn-editDocument edit-latarBelakang text-warning"
                                                        title="Edit Latar Belakang">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td><strong>Tujuan Pemeriksaan</strong></td>
                                                <td>{!! $sites->tujuan_pemeriksaan !!}</td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-id-tujuan-pemeriksaan="{{ $sites->id }}"
                                                        data-tujuan-pemeriksaan="{{ $sites->tujuan_pemeriksaan }}"
                                                        class="btn-editDocument edit-tujuanPemeriksaan text-warning"
                                                        title="Edit Tujuan Pemeriksaan">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td><strong>Lingkup Pemeriksaan</strong></td>
                                                <td>{!! $sites->lingkup_pemeriksaan !!}</td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-id-lingkup-pemeriksaan="{{ $sites->id }}"
                                                        data-lingkup-pemeriksaan="{{ $sites->lingkup_pemeriksaan }}"
                                                        class="btn-editDocument edit-lingkupPemeriksaan text-warning"
                                                        title="Edit Lingkup Pemeriksaan">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td><strong>Dasar Hukum</strong></td>
                                                <td>{!! $sites->dasar_hukum !!}</td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-id-dasar-hukum="{{ $sites->id }}"
                                                        data-dasar-hukum="{{ $sites->dasar_hukum }}"
                                                        class="btn-editDocument edit-dasarHukum text-warning"
                                                        title="Edit Dasar Hukum">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td><strong>Batasan Pemeriksaan</strong></td>
                                                <td>{!! $sites->batasan_pemeriksaan !!}</td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-id-batasan-masalah="{{ $sites->id }}"
                                                        data-current-text-batasan-masalah="{{ $sites->batasan_pemeriksaan }}"
                                                        class="btn-editDocument edit-buttonBatasan text-warning"
                                                        title="Edit Batasan Masalah">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td><strong>Metode Pemeriksaan</strong></td>
                                                <td>{!! $sites->metode_pemeriksaan !!}</td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-id-metode-pemeriksaan="{{ $sites->id }}"
                                                        data-metode-pemeriksaan="{{ $sites->metode_pemeriksaan }}"
                                                        class="btn-editDocument edit-metodePemeriksaan text-warning"
                                                        title="Edit Metode Pemeriksaan">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td><strong>Pengorganisasian Tim Audit</strong></td>
                                                <td>{!! $sites->pengorganisasian_tim_audit !!}</td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" data-id-pengorganisasian="{{ $sites->id }}"
                                                        data-pengorganisasian="{{ $sites->pengorganisasian_tim_audit }}"
                                                        class="btn-editDocument edit-pengorganisasian text-warning"
                                                        title="Edit pengorganisasian tim audit">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Edit Kata Pengantar-->
            <div class="modal fade" id="editKataPengantarModal" tabindex="-1" role="dialog"
                aria-labelledby="editKataPengantarLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editKataPengantarLabel">Edit Kata Pengantar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="editKataPengantarForm" method="POST"
                            action="{{ route('site.update', ['id' => $sites->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="kataPengantar">Kata Pengantar</label>
                                    <textarea class="form-control" id="kataPengantar" name="kata_pengantar" rows="4">{{ $sites->kata_pengantar }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Edit Daftar Isi-->
            <div class="modal fade" id="editDaftarIsiModal" tabindex="-1" role="dialog"
                aria-labelledby="editDaftarIsiLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDaftarIsiLabel">Edit Daftar Isi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="editDaftarIsiForm" method="POST"
                            action="{{ route('daftarisi.update', ['id' => $sites->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="daftarIsi">Daftar Isi</label>
                                    <textarea class="form-control" id="daftarIsi" name="daftar_isi" rows="4">{{ $sites->daftar_isi }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Edit Latar Belakang-->
            <div class="modal fade" id="editLatarBelakangModal" tabindex="-1" role="dialog"
                aria-labelledby="editLatarBelakangLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editLatarBelakangLabel">Edit Latar Belakang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="editLatarBelakangForm" method="POST"
                            action="{{ route('latarbelakang.update', ['id' => $sites->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="latarBelakang">Latar Belakang</label>
                                    <textarea class="form-control" id="latarBelakang" name="latar_belakang" rows="4">{{ $sites->daftar_isi }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Edit Tujuan Pemeriksaan-->
            <div class="modal fade" id="editTujuanPemeriksaanModal" tabindex="-1" role="dialog"
                aria-labelledby="editTujuanPemeriksaanLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTujuanPemeriksaanLabel">Edit Tujuan Pemeriksaan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="editTujuanPemeriksaanForm" method="POST"
                            action="{{ route('tujuanpemeriksaan.update', ['id' => $sites->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="tujuanPemeriksaan">Tujuan Pemeriksaan</label>
                                    <textarea class="form-control" id="tujuanPemeriksaan" name="tujuan_pemeriksaan" rows="4">{{ $sites->daftar_isi }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Edit Lingkup Pemeriksaan-->
            <div class="modal fade" id="editLingkupPemeriksaanModal" tabindex="-1" role="dialog"
                aria-labelledby="editLingkupPemeriksaanLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editLingkupPemeriksaanLabel">Edit Lingkup Pemeriksaan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="editLingkupPemeriksaanForm" method="POST"
                            action="{{ route('lingkuppemeriksaan.update', ['id' => $sites->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="lingkupPemeriksaan">Lingkup Pemeriksaan</label>
                                    <textarea class="form-control" id="lingkupPemeriksaan" name="lingkup_pemeriksaan" rows="4">{{ $sites->daftar_isi }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Edit Dasar Hukum-->
            <div class="modal fade" id="editDasarHukumModal" tabindex="-1" role="dialog"
                aria-labelledby="editDasarHukumLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDasarHukumLabel">Edit Dasar Hukum</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="editDasarHukumForm" method="POST"
                            action="{{ route('dasarhukum.update', ['id' => $sites->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="dasarHukum">Dasar Hukum</label>
                                    <textarea class="form-control" id="dasarHukum" name="dasar_hukum" rows="4">{{ $sites->daftar_isi }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Edit Batasan Pemeriksaan --}}
            <div class="modal fade" id="editBatasanMasalahModal" tabindex="-1"
                aria-labelledby="editBatasanMasalahModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="editBatasanMasalahForm" method="POST"
                            action="{{ route('site.update-batasan', ['id' => $sites->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editBatasanMasalahModalLabel">Edit Batasan Masalah</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="batasanMasalah">Batasan Masalah</label>
                                    <textarea class="form-control" id="batasanMasalah" name="batasan_masalah" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Edit MetodeMetodePemeriksaan Pemeriksaan --}}
            <div class="modal fade" id="editMetodePemeriksaanModal" tabindex="-1"
                aria-labelledby="editMetodePemeriksaanLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="editMetodePemeriksaanForm" method="POST"
                            action="{{ route('metodepemeriksaan.update', ['id' => $sites->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editMetodePemeriksaanLabel">Edit Metode Pemeriksaan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="metodePemeriksaan">Metode Pemeriksaan</label>
                                    <textarea class="form-control" id="metodePemeriksaan" name="metode_pemeriksaan" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Edit Pengorganisasian Tim Audit --}}
            <div class="modal fade" id="editPengorganisasianModal" tabindex="-1"
                aria-labelledby="editPengorganisasianLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="editPengorganisasianForm" method="POST"
                            action="{{ route('pengorganisasian.update', ['id' => $sites->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPengorganisasianLabel">Edit Pengorganisasian Tim Audit
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="pengorganisasian">Pengorganisasian Tim Audit</label>
                                    <textarea class="form-control" id="pengorganisasian" name="pengorganisasian" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Event listener untuk tombol Edit Kata Pengantar
                    const editButtonsKataPengantar = document.querySelectorAll('.edit-katapengantar');
                    const modalKataPengantar = document.getElementById('editKataPengantarModal');
                    const formKataPengantar = document.getElementById('editKataPengantarForm');
                    const textareaKataPengantar = document.getElementById('kataPengantar');

                    editButtonsKataPengantar.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Ambil data dari atribut tombol
                            const siteId = this.getAttribute('data-id');
                            const currentText = this.getAttribute('data-current-text');

                            // Perbarui form action dan isi textarea
                            formKataPengantar.action = `/site/${siteId}/update`;

                            if (tinymce.get('kataPengantar')) {
                                tinymce.get('kataPengantar').remove();
                            }

                            textareaKataPengantar.value = currentText;

                            // Tampilkan modal
                            $(modalKataPengantar).modal('show');

                            tinymce.init({
                                selector: '#kataPengantar',
                                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                toolbar: 'fullscreen preview bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                                menubar: false,
                                height: 300,
                                relative_urls: false,
                            });

                        });
                    });

                    $('#editKataPengantarModal').on('hidden.bs.modal', function() {
                        if (tinymce.get('kataPengantar')) {
                            tinymce.get('kataPengantar').remove();
                        }
                    });

                });


                document.addEventListener('DOMContentLoaded', function() {
                    // Event listener untuk tombol Edit Batasan Masalah
                    const editButtonsBatasan = document.querySelectorAll('.edit-buttonBatasan');
                    const modalBatasan = document.getElementById('editBatasanMasalahModal');
                    const formBatasan = document.getElementById('editBatasanMasalahForm');
                    const textareaBatasan = document.getElementById('batasanMasalah');

                    editButtonsBatasan.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Ambil data dari atribut tombol
                            const siteId2 = this.getAttribute('data-id-batasan-masalah');
                            const currentText2 = this.getAttribute('data-current-text-batasan-masalah');

                            // Perbarui form action dan isi textarea
                            formBatasan.action = `/site/${siteId2}/update-batasan`;

                            if (tinymce.get('batasanMasalah')) {
                                tinymce.get('batasanMasalah').remove();
                            }


                            textareaBatasan.value = currentText2;

                            // Tampilkan modal
                            $(modalBatasan).modal('show');

                            tinymce.init({
                                selector: '#batasanMasalah',
                                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                toolbar: 'fullscreen preview bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                                menubar: false,
                                height: 300,
                                relative_urls: false,
                            });
                        });
                    });

                    $('#editBatasanMasalahModal').on('hidden.bs.modal', function() {
                        if (tinymce.get('batasanMasalah')) {
                            tinymce.get('batasanMasalah').remove();
                        }
                    });
                });
                document.addEventListener('DOMContentLoaded', function() {
                    // Event listener untuk tombol Edit 
                    const editButtonsDaftarIsi = document.querySelectorAll('.edit-daftarIsi');
                    const modalDaftarIsi = document.getElementById('editDaftarIsiModal');
                    const formDaftarIsi = document.getElementById('editDaftarIsiForm');
                    const textareaDaftarIsi = document.getElementById('daftarIsi');

                    editButtonsDaftarIsi.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Ambil data dari atribut tombol
                            const siteIdDaftarIsi = this.getAttribute('data-id-daftar-isi');
                            const currentTextDaftarIsi = this.getAttribute('data-daftar-isi');

                            // Perbarui form action dan isi textarea
                            formDaftarIsi.action = `/site/${siteIdDaftarIsi}/update-daftar-isi`;

                            if (tinymce.get('daftarIsi')) {
                                tinymce.get('daftarIsi').remove();
                            }

                            textareaDaftarIsi.value = currentTextDaftarIsi;

                            // Tampilkan modal
                            $(modalDaftarIsi).modal('show');

                            tinymce.init({
                                selector: '#daftarIsi',
                                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                toolbar: 'fullscreen preview bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                                menubar: false,
                                height: 300,
                                relative_urls: false,
                            });
                        });
                    });

                    $('#editDaftarIsiModal').on('hidden.bs.modal', function() {
                        if (tinymce.get('daftarIsi')) {
                            tinymce.get('daftarIsi').remove();
                        }
                    });

                });
                document.addEventListener('DOMContentLoaded', function() {
                    // Event listener untuk tombol Edit 
                    const editButtonsLatarBelakang = document.querySelectorAll('.edit-latarBelakang');
                    const modalLatarBelakang = document.getElementById('editLatarBelakangModal');
                    const formLatarBelakang = document.getElementById('editLatarBelakangForm');
                    const textareaLatarBelakang = document.getElementById('latarBelakang');

                    editButtonsLatarBelakang.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Ambil data dari atribut tombol
                            const siteIdLatarBelakang = this.getAttribute('data-id-latar-belakang');
                            const currentTextLatarBelakang = this.getAttribute('data-latar-belakang');

                            // Perbarui form action dan isi textarea
                            formLatarBelakang.action = `/site/${siteIdLatarBelakang}/update-latar-belakang`;

                            if (tinymce.get('latarBelakang')) {
                                tinymce.get('latarBelakang').remove();
                            }

                            textareaLatarBelakang.value = currentTextLatarBelakang;

                            // Tampilkan modal
                            $(modalLatarBelakang).modal('show');

                            tinymce.init({
                                selector: '#latarBelakang',
                                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                toolbar: 'fullscreen preview bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                                menubar: false,
                                height: 300,
                                relative_urls: false,
                            });
                        });
                    });

                    $('#editLatarBelakangModal').on('hidden.bs.modal', function() {
                        if (tinymce.get('latarBelakang')) {
                            tinymce.get('latarBelakang').remove();
                        }
                    });
                });
                document.addEventListener('DOMContentLoaded', function() {
                    // Event listener untuk tombol Edit 
                    const editButtonsTujuanPemeriksaan = document.querySelectorAll('.edit-tujuanPemeriksaan');
                    const modalTujuanPemeriksaan = document.getElementById('editTujuanPemeriksaanModal');
                    const formTujuanPemeriksaan = document.getElementById('editTujuanPemeriksaanForm');
                    const textareaTujuanPemeriksaan = document.getElementById('tujuanPemeriksaan');

                    editButtonsTujuanPemeriksaan.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Ambil data dari atribut tombol
                            const siteIdTujuanPemeriksaan = this.getAttribute('data-id-tujuan-pemeriksaan');
                            const currentTextTujuanPemeriksaan = this.getAttribute(
                                'data-tujuan-pemeriksaan');

                            // Perbarui form action dan isi textarea
                            formTujuanPemeriksaan.action =
                                `/site/${siteIdTujuanPemeriksaan}/update-tujuan-pemeriksaan`;

                            if (tinymce.get('tujuanPemeriksaan')) {
                                tinymce.get('tujuanPemeriksaan').remove();
                            }

                            textareaTujuanPemeriksaan.value = currentTextTujuanPemeriksaan;

                            // Tampilkan modal
                            $(modalTujuanPemeriksaan).modal('show');

                            tinymce.init({
                                selector: '#tujuanPemeriksaan',
                                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                toolbar: 'fullscreen preview bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                                menubar: false,
                                height: 300,
                                relative_urls: false,
                            });
                        });
                    });

                    $('#editTujuanPemeriksaanModal').on('hidden.bs.modal', function() {
                        if (tinymce.get('tujuanPemeriksaan')) {
                            tinymce.get('tujuanPemeriksaan').remove();
                        }
                    });

                });
                document.addEventListener('DOMContentLoaded', function() {
                    // Event listener untuk tombol Edit 
                    const editButtonsLingkupPemeriksaan = document.querySelectorAll('.edit-lingkupPemeriksaan');
                    const modalLingkupPemeriksaan = document.getElementById('editLingkupPemeriksaanModal');
                    const formLingkupPemeriksaan = document.getElementById('editLingkupPemeriksaanForm');
                    const textareaLingkupPemeriksaan = document.getElementById('lingkupPemeriksaan');

                    editButtonsLingkupPemeriksaan.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Ambil data dari atribut tombol
                            const siteIdLingkupPemeriksaan = this.getAttribute(
                                'data-id-lingkup-pemeriksaan');
                            const currentTextLingkupPemeriksaan = this.getAttribute(
                                'data-lingkup-pemeriksaan');

                            // Perbarui form action dan isi textarea
                            formLingkupPemeriksaan.action =
                                `/site/${siteIdLingkupPemeriksaan}/update-lingkup-pemeriksaan`;

                            if (tinymce.get('lingkupPemeriksaan')) {
                                tinymce.get('lingkupPemeriksaan').remove();
                            }


                            textareaLingkupPemeriksaan.value = currentTextLingkupPemeriksaan;

                            // Tampilkan modal
                            $(modalLingkupPemeriksaan).modal('show');

                            tinymce.init({
                                selector: '#lingkupPemeriksaan',
                                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                toolbar: 'fullscreen preview bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                                menubar: false,
                                height: 300,
                                relative_urls: false,
                            });
                        });
                    });

                    $('#editLingkupPemeriksaanModal').on('hidden.bs.modal', function() {
                        if (tinymce.get('lingkupPemeriksaan')) {
                            tinymce.get('lingkupPemeriksaan').remove();
                        }
                    });
                });
                document.addEventListener('DOMContentLoaded', function() {
                    // Event listener untuk tombol Edit 
                    const editButtonsDasarHukum = document.querySelectorAll('.edit-dasarHukum');
                    const modalDasarHukum = document.getElementById('editDasarHukumModal');
                    const formDasarHukum = document.getElementById('editDasarHukumForm');
                    const textareaDasarHukum = document.getElementById('dasarHukum');

                    editButtonsDasarHukum.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Ambil data dari atribut tombol
                            const siteIdDasarHukum = this.getAttribute(
                                'data-id-dasar-hukum');
                            const currentTextDasarHukum = this.getAttribute(
                                'data-dasar-hukum');

                            // Perbarui form action dan isi textarea
                            formDasarHukum.action =
                                `/site/${siteIdDasarHukum}/update-dasar-hukum`;

                            if (tinymce.get('dasarHukum')) {
                                tinymce.get('dasarHukum').remove();
                            }

                            textareaDasarHukum.value = currentTextDasarHukum;

                            // Tampilkan modal
                            $(modalDasarHukum).modal('show');

                            tinymce.init({
                                selector: '#dasarHukum',
                                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                toolbar: 'fullscreen preview bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                                menubar: false,
                                height: 300,
                                relative_urls: false,
                            });
                        });
                    });

                    $('#editDasarHukumModal').on('hidden.bs.modal', function() {
                        if (tinymce.get('dasarHukum')) {
                            tinymce.get('dasarHukum').remove();
                        }
                    });

                });
                document.addEventListener('DOMContentLoaded', function() {
                    // Event listener untuk tombol Edit 
                    const editButtonsMetodePemeriksaan = document.querySelectorAll('.edit-metodePemeriksaan');
                    const modalMetodePemeriksaan = document.getElementById('editMetodePemeriksaanModal');
                    const formMetodePemeriksaan = document.getElementById('editMetodePemeriksaanForm');
                    const textareaMetodePemeriksaan = document.getElementById('metodePemeriksaan');

                    editButtonsMetodePemeriksaan.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Ambil data dari atribut tombol
                            const siteIdMetodePemeriksaan = this.getAttribute(
                                'data-id-metode-pemeriksaan');
                            const currentTextMetodePemeriksaan = this.getAttribute(
                                'data-metode-pemeriksaan');

                            // Perbarui form action dan isi textarea
                            formMetodePemeriksaan.action =
                                `/site/${siteIdMetodePemeriksaan}/update-metode-pemeriksaan`;

                            if (tinymce.get('metodePemeriksaan')) {
                                tinymce.get('metodePemeriksaan').remove();
                            }

                            textareaMetodePemeriksaan.value = currentTextMetodePemeriksaan;

                            // Tampilkan modal
                            $(modalMetodePemeriksaan).modal('show');

                            tinymce.init({
                                selector: '#metodePemeriksaan',
                                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                toolbar: 'fullscreen preview bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                                menubar: false,
                                height: 300,
                                relative_urls: false,
                            });
                        });
                    });

                    $('#editMetodePemeriksaanModal').on('hidden.bs.modal', function() {
                        if (tinymce.get('metodePemeriksaan')) {
                            tinymce.get('metodePemeriksaan').remove();
                        }
                    });
                });
                document.addEventListener('DOMContentLoaded', function() {
                    // Event listener untuk tombol Edit 
                    const editButtonsPengorganisasian = document.querySelectorAll('.edit-pengorganisasian');
                    const modalPengorganisasian = document.getElementById('editPengorganisasianModal');
                    const formPengorganisasian = document.getElementById('editPengorganisasianForm');
                    const textareaPengorganisasian = document.getElementById('pengorganisasian');

                    editButtonsPengorganisasian.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Ambil data dari atribut tombol
                            const siteIdPengorganisasian = this.getAttribute(
                                'data-id-pengorganisasian');
                            const currentTextPengorganisasian = this.getAttribute(
                                'data-pengorganisasian');

                            // Perbarui form action dan isi textarea
                            formPengorganisasian.action =
                                `/site/${siteIdPengorganisasian}/update-pengorganisasian`;

                            if (tinymce.get('pengorganisasian')) {
                                tinymce.get('pengorganisasian').remove();
                            }

                            textareaPengorganisasian.value = currentTextPengorganisasian;

                            // Tampilkan modal
                            $(modalPengorganisasian).modal('show');

                            tinymce.init({
                                selector: '#pengorganisasian',
                                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                toolbar: 'fullscreen preview bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                                menubar: false,
                                height: 300,
                                relative_urls: false,
                            });
                        });
                    });

                    $('#editPengorganisasianModal').on('hidden.bs.modal', function() {
                        if (tinymce.get('pengorganisasian')) {
                            tinymce.get('pengorganisasian').remove();
                        }
                    });

                });
            </script>
        </div>
    @endif
@endsection

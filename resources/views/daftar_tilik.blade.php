@extends('layouts.master')

@section('title', 'Admin | DaftarTilik')

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
                            <h5 class="card-title">
                                Daftar Tilik
                            </h5>
                            @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                <button data-toggle="modal" data-target="#tambahPertanyaanDaftarTilik"
                                    class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Pertanyaan
                                </button>
                            @endif
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-borderless px-4">
                                    <tbody>
                                        <tr style="font-weight: bold;">
                                            <td style="width: 30%;"> Nama Dokumen</td>
                                            <td style="width: 2%;">:</td>
                                            <td>{{ $document->judul_audit }}</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td> Dokumen Acuan </td>
                                            <td>:</td>
                                            <td>{{ $standart->dokumen_acuan }}</td>
                                        </tr>
                                        <br>
                                        <tr>
                                            <td> MY (Minor Yes)</td>
                                            <td>:</td>
                                            <td>Temuan kecil atau minor yang perlu diperbaiki tetapi tidak memiliki
                                                dampak
                                                besar terhadap sistem atau proses.</td>
                                        </tr>
                                        <tr>
                                            <td> MB (Minor But)</td>
                                            <td>:</td>
                                            <td>Temuan minor, tetapi membutuhkan perhatian khusus untuk memastikan
                                                tidak
                                                berkembang menjadi masalah besar.</td>
                                        </tr>
                                        <tr>
                                            <td>M (Major)</td>
                                            <td>:</td>
                                            <td>Temuan besar atau signifikan yang dapat memengaruhi sistem, proses, atau
                                                hasil
                                                audit secara keseluruhan. Harus segera ditangani.</td>
                                        </tr>
                                        <tr>
                                            <td>MP (Major Problem)</td>
                                            <td>:</td>
                                            <td>Masalah besar yang ditemukan selama audit dan membutuhkan tindakan
                                                korektif yang mendesak.</td>
                                        </tr>
                                        <tr>
                                            <td>OB (Observasi)</td>
                                            <td>:</td>
                                            <td>Catatan atas kondisi yang ditemukan, tetapi tidak dianggap sebagai
                                                ketidaksesuaian. Namun, perlu diperhatikan untuk perbaikan atau pengembangan
                                                lebih lanjut.</td>
                                        </tr>
                                        <tr>
                                            <td>KTS (Ketidaksesuaian)</td>
                                            <td>:</td>
                                            <td>Kondisi yang tidak sesuai dengan standar atau prosedur yang ditetapkan dan
                                                memerlukan tindakan koreksi.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive px-2">
                            <form action="{{ route('daftartilik.update', [$document->id, $standart->id]) }}" method="POST">
                                @csrf
                                @method('put')
                                <table class="table table-bordered">
                                    <thead class=" text-white bg-primary" style="border: 1px solid #dee2e6;">
                                        <tr>
                                            <th rowspan="2" class="text-center">No</th>
                                            <th rowspan="2" class="text-center">Pertanyaan Audit</th>
                                            <th rowspan="2" class="text-center">Tanggapan Auditee</th>
                                            <th rowspan="2" class="text-center">Dokumen Pendukung</th>
                                            <th rowspan="2" class="text-center">Hasil Observasi</th>
                                            <th colspan="4" class="text-center">Temuan</th>
                                            <th rowspan="2" class="text-center">Rekomendasi</th>
                                            <th rowspan="2" class="text-center">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th class="bg-success text-center">MY*</th>
                                            <th class="bg-warning text-center">MB*</th>
                                            <th class="bg-danger text-center">M*</th>
                                            <th class="bg-info text-center">MP*</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($DaftartilikData as $key => $daftarTilik)
                                            <tr class="text-center">
                                                @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-left">{{ $daftarTilik->pertanyaan_tilik }}</td>
                                                    <td>
                                                        <textarea name="tanggapan_audit[{{ $daftarTilik->id }}]" id="tanggapan_audit-{{ $daftarTilik->id }}" class="form-control" daftarTilik="1">{{ $daftarTilik->tanggapan_audit }}</textarea>
                                                    </td>
                                                    <td>
                                                        <textarea name="dokumen_terkait_tilik[{{ $daftarTilik->id }}]" id="dokumen_terkait_tilik-{{ $daftarTilik->id }}" class="form-control" daftarTilik="1" placeholder="cth : https://drive.com/">{{ $daftarTilik->dokumen_terkait_tilik }}</textarea>
                                                    </td>
                                                    <td>
                                                        <textarea name="hasil_audit[{{ $daftarTilik->id }}]" id="hasil_audit-{{ $daftarTilik->id }}" class="form-control" daftarTilik="1">{{ $daftarTilik->hasil_audit }}</textarea>
                                                    </td>
                                                    <!-- Checkbox untuk MY, MB, M, MP -->
                                                    <td>
                                                        <input type="checkbox" name="my_tilik[{{ $daftarTilik->id }}]"
                                                            {{ $daftarTilik->my_tilik ? 'checked' : '' }}>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="mb_tilik[{{ $daftarTilik->id }}]"
                                                            {{ $daftarTilik->mb_tilik ? 'checked' : '' }}>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="m_tilik[{{ $daftarTilik->id }}]"
                                                            {{ $daftarTilik->m_tilik ? 'checked' : '' }}>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="mp_tilik[{{ $daftarTilik->id }}]"
                                                            {{ $daftarTilik->mp_tilik ? 'checked' : '' }}>
                                                    </td>
                                                    <!-- Catatan & Penanggung Jawab-->
                                                    <td>
                                                        <textarea name="rekomendasi[{{ $daftarTilik->id }}]" id="rekomendasi-{{ $daftarTilik->id }}" class="form-control" daftarTilik="1">{{ $daftarTilik->rekomendasi }}</textarea>
                                                    </td>
                                                    <td>
                                                        <button class="btn-link text-danger btn-sm open-delete-modal"
                                                            data-id="{{ $daftarTilik->id }}"
                                                            data-nama="{{ $daftarTilik->pertanyaan_tilik }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                @endif
                                                @if ($user->role === 'Auditee')
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-left">{{ $daftarTilik->pertanyaan_tilik }}</td>
                                                    <td>
                                                        <textarea name="tanggapan_audit[{{ $daftarTilik->id }}]" id="tanggapan_audit-{{ $daftarTilik->id }}" class="form-control" daftarTilik="1">{{ $daftarTilik->tanggapan_audit }}</textarea>
                                                    </td>
                                                    <td>
                                                        <textarea name="dokumen_terkait_tilik[{{ $daftarTilik->id }}]" id="dokumen_terkait_tilik-{{ $daftarTilik->id }}" class="form-control" daftarTilik="1" placeholder="cth : https://drive.com/">{{ $daftarTilik->dokumen_terkait_tilik }}</textarea>
                                                    </td>
                                                    <td>
                                                        <textarea name="hasil_audit[{{ $daftarTilik->id }}]" class="form-control" daftarTilik="1" disabled> {{ str_replace('&nbsp;', ' ', strip_tags($daftarTilik->hasil_audit)) }}</textarea>
                                                    </td>
                                                    <!-- Checkbox untuk MY, MB, M, MP -->
                                                    <td>
                                                        <input type="checkbox" name="my_tilik[{{ $daftarTilik->id }}]"
                                                            {{ $daftarTilik->my_tilik ? 'checked' : '' }} disabled>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="mb_tilik[{{ $daftarTilik->id }}]"
                                                            {{ $daftarTilik->mb_tilik ? 'checked' : '' }} disabled>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="m_tilik[{{ $daftarTilik->id }}]"
                                                            {{ $daftarTilik->m_tilik ? 'checked' : '' }} disabled>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="mp_tilik[{{ $daftarTilik->id }}]"
                                                            {{ $daftarTilik->mp_tilik ? 'checked' : '' }} disabled>
                                                    </td>
                                                    <!-- Catatan & Penanggung Jawab-->
                                                    <td>
                                                        <textarea name="rekomendasi[{{ $daftarTilik->id }}]" class="form-control" daftarTilik="1" disabled> {{ str_replace('&nbsp;', ' ', strip_tags($daftarTilik->rekomendasi)) }}</textarea>
                                                    </td>
                                                    <td>
                                                        -
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <!-- Pastikan colspan disesuaikan dengan jumlah kolom di thead -->
                                                <td colspan="10" class="text-center">Pertanyaan Belum Ditambahkan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="col-md-12 justify-content-end d-flex">
                                    <a href="{{ route('standart', $document->id) }}" class="btn btn-secondary mt-3 "><i
                                            class="fas fa-xmark"></i>
                                        Close</a>
                                    @if ($user->role === 'Auditor' || $user->role === 'Admin' || $user->role === 'Auditee')
                                        <button type="submit" class="btn btn-success mt-3 "><i
                                                class="fas fa-floppy-disk"></i>
                                            Simpan
                                            Perubahan</button>
                                    @endif

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambahPertanyaanDaftarTilik" tabindex="-1" role="dialog"
        aria-labelledby="tambahPertanyaanDaftarTilikLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPertanyaanDaftarTilikLabel">Tambah Pertanyaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('daftartilik.store', [$document->id, $standart->id]) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="document_id" id="document_id" value="{{ $document->id }}">
                        <input type="hidden" name="standart_id" id="standart_id" value="{{ $standart->id }}">

                        <div class="form-group">
                            <label for="pertanyaan_DaftarTilik" class="col-form-label">Masukkan Pertanyaan Baru</label>
                            <textarea class="form-control" id="pertanyaan_DaftarTilik"
                                name="pertanyaan_DaftarTilik" required></textarea>
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

    {{-- Modal Delete  --}}
    <div class="modal fade" id="Hapusdaftartilik" tabindex="-1" role="dialog" aria-labelledby="HapusdaftartilikLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="HapusdaftartilikLabel">Anda Yakin Ingin Menghapus Pertanyaan Ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('daftartilik.destroy', $daftarTilik->id ?? 0) }}" method="POST"
                        id="HapusPertanyaan">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="hapus_pertanyaan_id" id="hapus_pertanyaan_id">
                        <div class="form-group">
                            <textarea type="text" class="form-control" id="hapus_pertanyaan_nama" name="hapus_pertanyaan_nama" readonly></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => { // Beri jeda agar semua elemen dimuat
            document.querySelectorAll('textarea[daftarTilik="1"]').forEach(textarea => {
                if (textarea.id && !tinymce.get(textarea.id)) { 
                    tinymce.init({
                        selector: '#' + textarea.id,
                        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                        toolbar: 'fullscreen preview bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                        menubar: false,
                        height: 250,
                        relative_urls: false,
                    });
                }
            });
        }, 500); // Jeda 500ms agar semua elemen tersedia sebelum diinisialisasi
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusToggles = document.querySelectorAll('.status-toggle');

            statusToggles.forEach(function(toggle) {
                toggle.addEventListener('change', function() {
                    const group = this.dataset.group;
                    const otherToggles = document.querySelectorAll(
                        `.status-toggle[data-group="${group}"]`);

                    otherToggles.forEach(function(otherToggle) {
                        if (otherToggle !== toggle) {
                            otherToggle.checked =
                                false; // Hapus centang di checkbox lainnya
                        }
                    });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Pilih semua tombol edit
            const hapusButtons = document.querySelectorAll('.open-delete-modal');
            const hapusForm = document.getElementById('HapusPertanyaan');

            hapusButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    event.preventDefault(); // Mencegah aksi default (navigasi link)

                    // Ambil data dari atribut tombol
                    const id = button.dataset.id; // Case-sensitive
                    const nama = button.dataset.nama; // Case-sensitive

                    // Isi data ke dalam form modal
                    document.getElementById('hapus_pertanyaan_id').value = id || '';
                    document.getElementById('hapus_pertanyaan_nama').value = nama || '';

                    // Update URL action form
                    hapusForm.action = `/daftartilik/${id}`;

                    // Tampilkan modal
                    $('#Hapusdaftartilik').modal('show');
                });
            });
        });
    </script>
@endsection

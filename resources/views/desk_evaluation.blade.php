@extends('layouts.master')

@section('title', 'Admin | DeskEvaluation')

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
                                Hasil Desk Evaluation
                            </h5>
                            @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                <button data-toggle="modal" data-target="#tambahPertanyaanDeskEvaluation"
                                    class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Penilaian
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
                        <div class="card-body">
                            <div class="table-responsive px-2">
                                <form action="{{ route('deskEvaluation.update', [$document->id, $standart->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <table class="table table-bordered text-center">
                                        <thead style="border: 1px solid #dee2e6; color:white;">
                                            <tr>
                                                <th rowspan="2" class="bg-primary text-center">No</th>
                                                <th rowspan="2" class="bg-primary text-center">Dokumen Terkait</th>
                                                <th colspan="4" class="bg-primary text-center">Kondisi Dokumen</th>
                                                <th colspan="2" class="bg-primary text-center">Kategori Temuan</th>
                                                {{-- <th colspan="2" class="bg-primary text-center">Status Temuan</th> --}}
                                                <th rowspan="2" class="bg-primary text-center">Catatan</th>
                                                <th rowspan="2" class="bg-primary text-center">Penanggung Jawab</th>
                                                <th rowspan="2" class="bg-primary text-center">Aksi</th>
                                            </tr>
                                            <tr>
                                                <th class="bg-success text-center">MY*</th>
                                                <th class="bg-warning text-center">MB*</th>
                                                <th class="bg-danger text-center">M*</th>
                                                <th class="bg-info text-center">MP*</th>
                                                <th class="bg-warning text-center">OB*</th>
                                                <th class="bg-danger text-center">KTS*</th>
                                                {{-- <th class="bg-success text-center">OPEN</th>
                                                <th class="bg-danger text-center">CLOSE</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($deskEvaluationData as $key => $row)
                                                <tr>
                                                    @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $row->dokumen_terkait }}</td>
                                                        <!-- Checkbox untuk MY, MB, M, MP -->
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kondisi_dokumen_my[{{ $row->id }}]"
                                                                {{ $row->my ? 'checked' : '' }}>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kondisi_dokumen_mb[{{ $row->id }}]"
                                                                {{ $row->mb ? 'checked' : '' }}>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kondisi_dokumen_m[{{ $row->id }}]"
                                                                {{ $row->m ? 'checked' : '' }}>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kondisi_dokumen_mp[{{ $row->id }}]"
                                                                {{ $row->mp ? 'checked' : '' }}>
                                                        </td>
                                                        <!-- Checkbox untuk OB & KTS-->
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kategori_temuan_ob[{{ $row->id }}]"
                                                                {{ $row->ob ? 'checked' : '' }}>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kategori_temuan_kts[{{ $row->id }}]"
                                                                {{ $row->kts ? 'checked' : '' }}>
                                                        </td>

                                                        <!-- Checkbox untuk OPEN CLOSE-->
                                                        {{-- <td>
                                                            <input type="checkbox" name="status_open[{{ $row->id }}]"
                                                                class="status-toggle"
                                                                data-group="status-{{ $row->id }}"
                                                                {{ $row->OPEN == 1 ? 'checked' : '' }}>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="status_close[{{ $row->id }}]"
                                                                class="status-toggle"
                                                                data-group="status-{{ $row->id }}"
                                                                {{ $row->CLOSE == 1 ? 'checked' : '' }}>
                                                        </td> --}}

                                                        <!-- Catatan & Penanggung Jawab-->
                                                        <td>
                                                           <textarea name="catatan[{{ $row->id }}]" id="catatan-{{ $row->id }}" class="form-control" rows="1">{{ $row->catatan }}</textarea>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                name="penanggung_jawab[{{ $row->id }}]"
                                                                value="{{ $row->penanggung_jawab }}" class="form-control">
                                                        </td>
                                                        <td>
                                                            <button
                                                                class="btn-link text-danger btn-sm open-delete-modalDesk"
                                                                data-id="{{ $row->id }}"
                                                                data-nama="{{ $row->dokumen_terkait }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    @endif
                                                    @if ($user->role === 'Auditee')
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $row->dokumen_terkait }}</td>
                                                        <!-- Checkbox untuk MY, MB, M, MP -->
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kondisi_dokumen_my[{{ $row->id }}]"
                                                                {{ $row->my ? 'checked' : '' }} disabled>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kondisi_dokumen_mb[{{ $row->id }}]"
                                                                {{ $row->mb ? 'checked' : '' }} disabled>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kondisi_dokumen_m[{{ $row->id }}]"
                                                                {{ $row->m ? 'checked' : '' }} disabled>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kondisi_dokumen_mp[{{ $row->id }}]"
                                                                {{ $row->mp ? 'checked' : '' }} disabled>
                                                        </td>
                                                        <!-- Checkbox untuk OB & KTS-->
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kategori_temuan_ob[{{ $row->id }}]"
                                                                {{ $row->ob ? 'checked' : '' }} disabled>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                name="kategori_temuan_kts[{{ $row->id }}]"
                                                                {{ $row->kts ? 'checked' : '' }} disabled>
                                                        </td>

                                                        <!-- Checkbox untuk OPEN CLOSE-->
                                                        {{-- <td>
                                                            <input type="checkbox" name="status_open[{{ $row->id }}]"
                                                                class="status-toggle"
                                                                data-group="status-{{ $row->id }}"
                                                                {{ $row->OPEN == 1 ? 'checked' : '' }} disabled>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="status_close[{{ $row->id }}]"
                                                                class="status-toggle"
                                                                data-group="status-{{ $row->id }}"
                                                                {{ $row->CLOSE == 1 ? 'checked' : '' }} disabled>
                                                        </td> --}}

                                                        <!-- Catatan & Penanggung Jawab-->
                                                        <td>
                                                            <textarea name="catatan[{{ $row->id }}]" id="catatan-{{ $row->id }}" class="form-control" rows="1">{{ $row->catatan }}</textarea>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                name="penanggung_jawab[{{ $row->id }}]"
                                                                value="{{ $row->penanggung_jawab }}" class="form-control"
                                                                disabled>
                                                        </td>
                                                        <td>
                                                            -
                                                        </td>
                                                    @endif
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="13">Pertanyaan Belum Ditambahkan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="col-md-12 justify-content-end d-flex">
                                        <a href="{{ route('standart', $document->id) }}" class="btn btn-secondary mt-3 "><i
                                                class="fas fa-xmark"></i>
                                            Close</a>
                                        @if ($user->role === 'Auditor' || $user->role === 'Admin')
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
        <div class="modal fade" id="tambahPertanyaanDeskEvaluation" tabindex="-1" role="dialog"
            aria-labelledby="tambahPertanyaanDeskEvaluationLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPertanyaanDeskEvaluationLabel">Tambah Uraian Temuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('deskEvaluation.store', [$document->id, $standart->id]) }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="document_id" id="document_id" value="{{ $document->id }}">
                            <input type="hidden" name="standart_id" id="standart_id" value="{{ $standart->id }}">

                            <div class="form-group">
                                <label for="pertanyaan_DeskEvaluation" class="col-form-label">Masukkan Uraian Temuan / Deskripsi / Dokumen Terkait :
                                    </label>
                                <textarea class="form-control" id="pertanyaan_DeskEvaluation" name="pertanyaan_DeskEvaluation" rows="5"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>
                                Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Delete --}}
        <div class="modal fade" id="HapusDesk" tabindex="-1" role="dialog" aria-labelledby="HapusDeskLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="HapusDeskLabel">Anda Yakin Ingin Menghapus Pertanyaan Ini?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('DeskEvaluation.destroy', $row->id ?? 0) }}" method="POST"
                            id="HapusDeskEvaluation">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="hapus_desk_id" id="hapus_desk_id">
                            <div class="form-group">
                                <textarea type="text" class="form-control" id="hapus_desk_nama" name="hapus_desk_nama" readonly></textarea>
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
            // Inisialisasi TinyMCE untuk semua textarea yang ada pada halaman
            const textareas = document.querySelectorAll('textarea[name^="catatan["]');

            textareas.forEach(textarea => {
                // Pastikan TinyMCE hanya diinisialisasi pada textarea yang belum ada instance TinyMCE-nya
                if (!tinymce.get(textarea.id)) {
                    tinymce.init({
                        selector: '#' + textarea.id,
                        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                        toolbar: 'fullscreen preview bold italic alignleft aligncenter alignright bullist numlist outdent indent',
                        menubar: false,
                        height: 170,
                        relative_urls: false,
                    });
                }
            });
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
                const hapusButtons = document.querySelectorAll('.open-delete-modalDesk');
                const hapusForm = document.getElementById('HapusDeskEvaluation');

                hapusButtons.forEach(button => {
                    button.addEventListener('click', (event) => {
                        event.preventDefault(); // Mencegah aksi default (navigasi link)

                        // Ambil data dari atribut tombol
                        const id = button.dataset.id; // Case-sensitive
                        const nama = button.dataset.nama; // Case-sensitive

                        // Isi data ke dalam form modal
                        document.getElementById('hapus_desk_id').value = id || '';
                        document.getElementById('hapus_desk_nama').value = nama || '';

                        // Update URL action form
                        hapusForm.action = `/DeskEvaluation/${id}`;

                        // Tampilkan modal
                        $('#HapusDesk').modal('show');
                    });
                });
            });
        </script>
    @endsection

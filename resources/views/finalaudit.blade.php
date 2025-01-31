@extends('layouts.master')

@section('title', 'Admin | Hasil Audit')

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
                                Hasil Audit
                            </h5>
                            <div class="row px-2">
                                @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                    <button data-toggle="modal" data-target="#tambahHasilAudit" class="btn"
                                        style="background-color: #001A6E;">
                                        <i class="fas fa-plus"></i> Isi Data Hasil Audit
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
                                    <th>Tanggal Penilaian</th>
                                    <th>Periode</th>
                                    <th>Jangka Waktu Perbaikan</th>
                                    <th>Auditee</th>
                                    <th>Lihat Hasil Audit</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @forelse ($hasilaudit as $key => $hasilaudits)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td><?= formatTanggalIndonesia($hasilaudits->tanggal_desk) ?></td>
                                            <td><?= $hasilaudits->periode ?></td>
                                            <td><?= $hasilaudits->jangka_waktu_perbaikan ?> hari</td>
                                            <td><?= $hasilaudits->auditee ?></td>
                                            <td>
                                                <a href="{{ route('HasilAudit.detail', $hasilaudits->id) }}"
                                                    style="width: 30%; height: 40px; color:black;"><i
                                                        class="fas fa-eye pr-2"></i> View</a>
                                            </td>
                                            @if ($user->role === 'Auditor' || $user->role === 'Admin')
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <a href="#" class="btn-editHasilAudit text-warning"
                                                        data-id="{{ $hasilaudits->id }}"
                                                        data-direktur="{{ $hasilaudits->direktur }}"
                                                        data-daftarhadir="{{ $hasilaudits->daftar_hadir }}"
                                                        data-beritaacara="{{ $hasilaudits->berita_acara }}"
                                                        data-tahunpelaksanaan="{{ $hasilaudits->tahun_pelaksanaan }}"
                                                        data-lembaga="{{ $hasilaudits->lembaga }}"
                                                        data-tanggallaporan="{{ $hasilaudits->tanggal_laporan }}"
                                                        data-koordinatornama="{{ $hasilaudits->koordinator_nama }}"
                                                        data-koordinatornip="{{ $hasilaudits->koordinator_nip }}"
                                                        data-periode="{{ $hasilaudits->periode }}"
                                                        data-waktupelaksanaan="{{ $hasilaudits->waktu_pelaksanaan }}"
                                                        data-tempatkegiatan="{{ $hasilaudits->tempat_kegiatan }}"
                                                        data-ketuaauditor="{{ $hasilaudits->ketua_auditor }}"
                                                        data-sekretarisauditor="{{ $hasilaudits->sekretaris_auditor }}"
                                                        data-auditee="{{ $hasilaudits->auditee }}"
                                                        data-dokumentasi="{{ $hasilaudits->dokumentasi }}"
                                                        data-tanggaldesk="{{ $hasilaudits->tanggal_desk }}"
                                                        data-jangkawaktuperbaikan="{{ $hasilaudits->jangka_waktu_perbaikan }}">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <!-- Tombol Delete -->
                                                    <form action="{{ route('hasilaudithapus.destroy', $hasilaudits->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-link text-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data  ini?');">
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
                                            <td colspan="7" class="text-center">Hasil Audit Belum Ditambahkan.</td>
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

    <div class="modal fade" id="tambahHasilAudit" tabindex="-1" role="dialog" aria-labelledby="tambahHasilAudit2Label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahHasilAudit2Label">Tambah Data Hasil Audit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hasilaudit.tambah') }}" method="POST" enctype="multipart/form-data">
                        <p class="text-center"><strong>PENGESAHAN</strong></p>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Auditor 1 :</label>
                                    <input type="text" name="ketua_auditor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Auditor 2 :</label>
                                    <input type="text" name="sekretaris_auditor" class="form-control" placeholder="(kosongkan jika tidak ada)">
                                </div>
                                 <div class="form-group">
                                    <label>Nama Auditee :</label>
                                    <input type="text" name="auditee" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Koordinator Audit Mutu Internal :</label>
                                    <input type="text" name="koordinator_nama" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>NRK / NIP Koordinator :</label>
                                    <input type="text" name="koordinator_nip" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Direktur Politeknik Prasetiya Mandiri</label>
                                    <input type="text" name="direktur" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <p class="text-center pt-4"><strong>WAKTU DAN PELAKSANAAN AUDIT</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Pelaksanaan AMI :</label>
                                    <input type="number" name="tahun_pelaksanaan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Lembaga :</label>
                                    <input type="text" name="lembaga" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Periode :</label>
                                    <input type="text" name="periode" class="form-control"
                                        placeholder="cth : 2024 / 2025" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Waktu Pelaksanaan :</label>
                                    <input type="text" name="waktu_pelaksanaan" class="form-control"
                                        placeholder="cth : 08.00 - 10.00" required>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Kegiatan Audit :</label>
                                    <input type="text" name="tempat_kegiatan" class="form-control" required>
                                </div>  
                            </div>
                        </div>

                        <p class="text-center pt-4"><strong>BAB II DAFTAR TEMUAN AMI</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Penilaian/ Pelaksanaan Audit :</label>
                                    <input type="date" name="tanggal_desk" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pembuatan Laporan :</label>
                                    <input type="date" name="tanggal_laporan" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jangka Waktu Perbaikan :</label>
                                    <input type="number" name="jangka_waktu_perbaikan" class="form-control"
                                        placeholder="Masukkan jangka waktu perbaikan dalam hitungan hari (contoh: 7)"
                                        required>
                                </div>
                            </div>

                        </div>

                        <p class="text-center pt-4"><strong>DOKUMEN</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row mx-1">
                                        <label for="surat_pengesahan" style="left: 0;"> Daftar Hadir :</label>
                                    </div>
                                    <label class="btn btn-primary">
                                        Upload
                                        <input type="file" name="daftar_hadir" class="form-control"
                                            accept=".jpg,.jpeg,.png" required
                                            onchange="showFileName(this, 'daftar-hadir-name')">
                                    </label>
                                    <span id="daftar-hadir-name" class="text-muted">Belum ada file yang dipilih</span>
                                </div>
                                <div class="form-group">
                                    <div class="row mx-1">
                                        <label for="surat_pengesahan" style="left: 0;"> Berita Acara :</label>
                                    </div>
                                    <label class="btn btn-primary">
                                        Upload
                                        <input type="file" name="berita_acara" class="form-control"
                                            accept=".jpg,.jpeg,.png" required
                                            onchange="showFileName(this, 'berita-acara-name')">
                                    </label>
                                    <span id="berita-acara-name" class="text-muted">Belum ada file yang dipilih</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row mx-1">
                                        <label for="surat_pengesahan" style="left: 0;"> Dokumentasi :</label>
                                    </div>
                                    <label class="btn btn-primary">
                                        Upload
                                        <input type="file" name="dokumentasi" class="form-control"
                                            accept=".jpg,.jpeg,.png" required
                                            onchange="showFileName(this, 'dokumentasi-name')">
                                    </label>
                                    <span id="dokumentasi-name" class="text-muted">Belum ada file yang dipilih</span>
                                </div>
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
    </div>

    <div class="modal fade" id="editHasilAudit" tabindex="-1" role="dialog" aria-labelledby="editHasilAuditLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHasilAuditLabel">Edit Data Hasil Audit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hasilauditedit.update', $hasilaudits->id ?? 0) }}" method="POST"
                        enctype="multipart/form-data" id="editHasilAuditForm">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="edit_hasil_audit_id" id="edit_hasil_audit_id">

                        <p class="text-center"><strong>PENGESAHAN</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Auditor 1 :</label>
                                    <input type="text" name="ketua_auditor_edit" id="ketua_auditor_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Auditor 2 :</label>
                                    <input type="text" name="sekretaris_auditor_edit" id="sekretaris_auditor_edit" placeholder="*kosongkan bila tidak ada"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nama Auditee :</label>
                                    <input type="text" name="auditee_edit" id="auditee_edit" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Koordinator Audit Mutu Internal :</label>
                                    <input type="text" name="koordinator_nama_edit" id="koordinator_nama_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>NRK / NIP Koordinator :</label>
                                    <input type="text" name="koordinator_nip_edit" id="koordinator_nip_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Direktur Politeknik Prasetiya Mandiri :</label>
                                    <input type="text" name="direktur_edit" id="direktur_edit"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <p class="text-center"><strong>WAKTU DAN PELAKSANAAN AUDIT</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Pelaksanaan AMI :</label>
                                    <input type="number" name="tahun_pelaksanaan_edit" id="tahun_pelaksanaan_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Lembaga :</label>
                                    <input type="text" name="edit_lembaga" id="edit_lembaga" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Periode :</label>
                                    <input type="text" name="edit_periode" id="edit_periode" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Waktu Pelaksanaan :</label>
                                    <input type="text" name="waktu_pelaksanaan_edit" id="waktu_pelaksanaan_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Kegiatan Audit :</label>
                                    <input type="text" name="tempat_kegiatan_edit" id="tempat_kegiatan_edit"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <p class="text-center pt-4"><strong>BAB II DAFTAR TEMUAN AMI</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Penilaian/ Pelaksanaan Audit :</label>
                                    <input type="date" name="tanggal_desk_edit" id="tanggal_desk_edit"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pembuatan Laporan :</label>
                                    <input type="date" name="tanggal_laporan_edit" id="tanggal_laporan_edit"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jangka Waktu Perbaikan :</label>
                                    <input type="number" name="jangka_waktu_perbaikan_edit"
                                        id="jangka_waktu_perbaikan_edit" class="form-control"
                                        placeholder="Masukkan jangka waktu perbaikan dalam hitungan hari (contoh: 7)"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian File -->
                        <p class="text-center pt-4"><strong>DOKUMEN</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surat_pengesahan_edit">Lembar Pengesahan:</label>
                                    <div>
                                        <input type="file" name="surat_pengesahan_edit" id="surat_pengesahan_edit"
                                            class="form-control me-2">
                                        <button type="button" id="btn_upload_surat_pengesahan" class="btn btn-primary">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        <span id="file_name_display" class="text-muted mt-2 d-block">File saat ini: Tidak
                                            ada file</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="daftar_hadir_edit">Daftar Hadir:</label>
                                    <div>
                                        <input type="file" name="daftar_hadir_edit" id="daftar_hadir_edit"
                                            class="form-control me-2">
                                        <button type="button" id="btn_upload_surat_pengesahan" class="btn btn-primary">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        <span id="file_name_display2" class="text-muted mt-2 d-block">File saat ini: Tidak
                                            ada file</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="berita_acara_edit">Berita Acara:</label>
                                        <div>
                                            <input type="file" name="berita_acara_edit" id="berita_acara_edit"
                                                class="form-control me-2">
                                            <button type="button" id="btn_upload_surat_pengesahan"
                                                class="btn btn-primary">
                                                <i class="fas fa-upload"></i> Upload
                                            </button>
                                            <span id="file_name_display3" class="text-muted mt-2 d-block">File saat ini:
                                                Tidak
                                                ada file</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dokumentasi_edit">Dokumentasi:</label>
                                        <div>
                                            <input type="file" name="dokumentasi_edit" id="dokumentasi_edit"
                                                class="form-control me-2">
                                            <button type="button" id="btn_upload_surat_pengesahan"
                                                class="btn btn-primary">
                                                <i class="fas fa-upload"></i> Upload
                                            </button>
                                            <span id="file_name_display4" class="text-muted mt-2 d-block">File saat ini:
                                                Tidak
                                                ada file</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save
                                    Changes</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showFileName(input, targetId) {
            const fileName = input.files[0]?.name || 'Belum ada file yang dipilih';
            document.getElementById(targetId).innerText = fileName;
        };
        $(document).ready(function() {
            // Ketika tombol edit diklik
            $('.btn-editHasilAudit').on('click', function() {
                // Ambil data dari tombol yang diklik
                var id = $(this).data('id');
                var direktur = $(this).data('direktur');
                var daftarHadir = $(this).data('daftarhadir');
                var beritaAcara = $(this).data('beritaacara');
                var tahunPelaksanaan = $(this).data('tahunpelaksanaan');
                var lembaga = $(this).data('lembaga');
                var tanggalLaporan = $(this).data('tanggallaporan');
                var koordinatorNama = $(this).data('koordinatornama');
                var koordinatorNip = $(this).data('koordinatornip');
                var periode = $(this).data('periode');
                var waktuPelaksanaan = $(this).data('waktupelaksanaan');
                var tempatKegiatan = $(this).data('tempatkegiatan');
                var ketuaAuditor = $(this).data('ketuaauditor');
                var sekretarisAuditor = $(this).data('sekretarisauditor');
                var auditee = $(this).data('auditee');
                var dokumentasi = $(this).data('dokumentasi');
                var tanggalDesk = $(this).data('tanggaldesk');
                var jangkaWaktuPerbaikan = $(this).data('jangkawaktuperbaikan');

                // Set data ke modal
                $('#edit_hasil_audit_id').val(id);
                $('#tahun_pelaksanaan_edit').val(tahunPelaksanaan);
                $('#direktur_edit').val(direktur);
                $('#edit_lembaga').val(lembaga);
                $('#edit_periode').val(periode);
                $('#tanggal_laporan_edit').val(tanggalLaporan);
                $('#koordinator_nama_edit').val(koordinatorNama);
                $('#koordinator_nip_edit').val(koordinatorNip);
                $('#waktu_pelaksanaan_edit').val(waktuPelaksanaan);
                $('#tempat_kegiatan_edit').val(tempatKegiatan);
                $('#ketua_auditor_edit').val(ketuaAuditor);
                $('#sekretaris_auditor_edit').val(sekretarisAuditor);
                $('#auditee_edit').val(auditee);
                $('#tanggal_desk_edit').val(tanggalDesk);
                $('#jangka_waktu_perbaikan_edit').val(jangkaWaktuPerbaikan);

                // Jika ada file yang sudah ada, tampilkan informasi file saat ini
                // Misalnya, jika file sudah ada di server
                // if (suratPengesahan) {
                //     $('#surat_pengesahan_edit').siblings('span').text('File saat ini: ' + suratPengesahan);
                // }
                if (daftarHadir) {
                    $('#daftar_hadir_edit').siblings('span').text('File saat ini: ' + daftarHadir);
                }
                if (beritaAcara) {
                    $('#berita_acara_edit').siblings('span').text('File saat ini: ' + beritaAcara);
                }
                if (dokumentasi) {
                    $('#dokumentasi_edit').siblings('span').text('File saat ini: ' + dokumentasi);
                }
                // Tampilkan modal
                $('#editHasilAudit').modal('show');
            });
        });

        // document.getElementById('surat_pengesahan_edit').addEventListener('change', function() {
        //     var fileInput = this;
        //     var fileNameDisplay = document.getElementById('file_name_display');

        //     if (fileInput.files && fileInput.files.length > 0) {
        //         var fileName = fileInput.files[0].name;
        //         fileNameDisplay.textContent = 'File saat ini: ' + fileName;
        //     } else {
        //         fileNameDisplay.textContent = 'File saat ini: Tidak ada file';
        //     }
        // });
        document.getElementById('daftar_hadir_edit').addEventListener('change', function() {
            var fileInput = this;
            var fileNameDisplay = document.getElementById('file_name_display2');

            if (fileInput.files && fileInput.files.length > 0) {
                // Ambil nama file yang dipilih
                var fileName = fileInput.files[0].name;
                // Tampilkan nama file di elemen <span>
                fileNameDisplay.textContent = 'File saat ini: ' + fileName;
            } else {
                // Jika tidak ada file yang dipilih
                fileNameDisplay.textContent = 'File saat ini: Tidak ada file';
            }
        });
        document.getElementById('berita_acara_edit').addEventListener('change', function() {
            var fileInput = this;
            var fileNameDisplay = document.getElementById('file_name_display3');

            if (fileInput.files && fileInput.files.length > 0) {
                // Ambil nama file yang dipilih
                var fileName = fileInput.files[0].name;
                // Tampilkan nama file di elemen <span>
                fileNameDisplay.textContent = 'File saat ini: ' + fileName;
            } else {
                // Jika tidak ada file yang dipilih
                fileNameDisplay.textContent = 'File saat ini: Tidak ada file';
            }
        });
        document.getElementById('dokumentasi_edit').addEventListener('change', function() {
            var fileInput = this;
            var fileNameDisplay = document.getElementById('file_name_display4');

            if (fileInput.files && fileInput.files.length > 0) {
                // Ambil nama file yang dipilih
                var fileName = fileInput.files[0].name;
                // Tampilkan nama file di elemen <span>
                fileNameDisplay.textContent = 'File saat ini: ' + fileName;
            } else {
                // Jika tidak ada file yang dipilih
                fileNameDisplay.textContent = 'File saat ini: Tidak ada file';
            }
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

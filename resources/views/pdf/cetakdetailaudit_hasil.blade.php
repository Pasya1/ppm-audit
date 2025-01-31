<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Audit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .bg-cover {
            width: 100px;
            height: 1000px;
        }

        .cover-page {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .cover-page h1 {
            font-size: 28px;
            font-weight: bold;
        }

        .cover-page img {
            width: 200px;
            height: auto;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .table-head {
            background-color: #f2f2f2;
            text-align: center;
            color: #000000;
        }


        .header {
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        p {
            font-size: 12px;
            text-align: justify;
            line-height: 1.5;
        }

        pre {
            font-size: 12px;
            text-align: left;
            white-space: pre-wrap;
            /* Membungkus teks panjang */
        }
    </style>
</head>

<body>
    <!-- Cover Page -->
    <div class="cover-page">
        <!-- Display Cover Image -->
        <img src="{{ public_path('AdminStyle/img/cover.png') }}" class="bg-cover"
            style="width: 800px; height: 1000px; margin-top: -50px;" alt="Cover">
    </div>

    <div class="content" style="margin: 0 3cm 3cm 4cm;">
        <div style="page-break-before: always;">
            <h2 style="text-align: center;">LEMBAR PENGESAHAN</h2><br>
            <table>
                <thead>
                    <tr class="table-head text-center">
                        <th colspan="3" style="text-align: center; vertical-align: middle;">PENANGGUNG JAWAB</th>
                        <th rowspan="2" style="text-align: center;vertical-align: middle;">TANDA TANGAN</th>
                    </tr>
                    <tr class="table-head text-center">
                        <th></th>
                        <th>NAMA</th>
                        <th>JABATAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Penyusun</td>
                        <td>{{ $hasilAudit->auditee }}</td>
                        <td>Auditee</td>
                        @if ($validasi && $validasi->tanda_tangan_auditee)
                            <td style="width: 50%; text-align: left;">
                                <img src="{{ public_path('storage/' . $validasi->tanda_tangan_auditee) }}"
                                    alt="Tanda Tangan Auditor" style="width: 150px; height: auto;" />
                            </td>
                        @else
                            <td>

                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td>Pemeriksa</td>
                        <td>{{ $hasilAudit->ketua_auditor }}</td>
                        <td>Auditor 1</td>
                        @if ($validasi && $validasi->tanda_tangan_auditor)
                            <td style="width: 50%; text-align: left;">
                                <img src="{{ public_path('storage/' . $validasi->tanda_tangan_auditor) }}"
                                    alt="Tanda Tangan Auditor" style="width: 150px; height: auto;" />
                            </td>
                        @else
                            <td>

                            </td>
                        @endif
                    </tr>
                    @if (!empty($hasilAudit->sekretaris_auditor))
                    <tr>
                        <td>Pemeriksa ke-2</td>
                        <td>{{ $hasilAudit->sekretaris_auditor }}</td>
                        <td>Auditor 2</td>
                        @if ($validasi && $validasi->tanda_tangan_auditor2)
                            <td style="width: 50%; text-align: left;">
                                <img src="{{ public_path('storage/' . $validasi->tanda_tangan_auditor2) }}"
                                    alt="Tanda Tangan Auditor" style="width: 150px; height: auto;" />
                            </td>
                        @else
                            <td>

                            </td>
                        @endif
                    </tr>
                    @endif
                    <tr>
                        <td>Mengetahui</td>
                        <td>{{ $hasilAudit->koordinator_nama }}</td>
                        <td>Koordinator</td>
                        @if ($validasi && $validasi->tanda_tangan_koordinator)
                            <td style="width: 50%; text-align: left;">
                                <img src="{{ public_path('storage/' . $validasi->tanda_tangan_koordinator) }}"
                                    alt="Tanda Tangan Auditor" style="width: 150px; height: auto;" />
                            </td>
                        @else
                            <td>

                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td>Mengetahui</td>
                        <td>{{ $hasilAudit->direktur }}</td>
                        <td>Direktur Politeknik Prasetiya Mandiri</td>
                         @if ($validasi && $validasi->tanda_tangan_direktur)
                            <td style="width: 50%; text-align: left;">
                                <img src="{{ public_path('storage/' . $validasi->tanda_tangan_direktur) }}"
                                    alt="Tanda Tangan Auditor" style="width: 150px; height: auto;" />
                            </td>
                        @else
                            <td>

                            </td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="page-break-before: always;">
            <h2 style="text-align: center;">KATA PENGANTAR</h2><br>
            <p>{!! $site->kata_pengantar !!}</p>
        </div>
        <div style="page-break-before: always;">
            <h2 style="text-align: center;">DAFTAR ISI</h2><br>
            @php
                $daftar_isi = explode("\n", $site->daftar_isi);
                $nomor_halaman = 1;
            @endphp

            @foreach ($daftar_isi as $item)
                @if (trim($item) != '')
                    <p>{!! $item !!}</p>
                @endif
            @endforeach
        </div>
        <div style="page-break-before: always;">
            <h2 style="text-align: center;">BAB I</h2>
            <h2 style="text-align: center;">PENDAHULUAN</h2><br>
            <h5>1.1 Latar Belakang</h5>
            <p style="margin-top: -20px;">{!! $site->latar_belakang !!}</p><br>
            <h5>1.2 Tujuan Pemeriksaan</h5>
            <p style="margin-top: -20px;">{!! $site->tujuan_pemeriksaan !!}</p><br>
            <h5>1.3 Lingkup Pemeriksaan</h5>
            <p style="margin-top: -20px;">{!! $site->lingkup_pemeriksaan !!}</p><br>
            <h5>1.4 Dasar Hukum / Aturan yang Digunakan</h5>
            <p style="margin-top: -20px;">{!! $site->dasar_hukum !!}</p><br>
            <h5>1.5 Batasan Pemeriksaan</h5>
            <p style="margin-top: -20px;">{!! $site->batasan_pemeriksaan !!}</p><br>
            <h5>1.6 Metode Pemeriksaan</h5>
            <p style="margin-top: -20px;">{!! $site->metode_pemeriksaan !!}</p><br>
            <h5>1.7 Pengorganisasian Tim Audit</h5>
            <p style="margin-top: -20px;">{!! $site->pengorganisasian_tim_audit !!}</p>
        </div>

        <div style="page-break-before: always;">
            <h2 style="text-align: center;">BAB II </h2>
            <h2 style="text-align: center;">HASIL PEMERIKSAAN</h2><br>
            <h5>2.1 Hasil Temuan AMI</h5>
            <table style="width: 100%; border-collapse: collapse; border: none; margin-top: 10px;">
                <tr>
                    <td style="width: 30%; border: none;">Lembaga</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ $hasilAudit->lembaga }}</td>
                </tr>
                <tr>
                    <td style="width: 30%; border: none;">Periode</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ $hasilAudit->periode }}</td>
                </tr>
                <tr>
                    <td style="width: 30%; border: none;">Tahun Pelaksanaan</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ $hasilAudit->tahun_pelaksanaan }}</td>
                </tr>
                <tr>
                    <td style="width: 30%; border: none;">Tanggal Laporan</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ formatTanggalIndonesia($hasilAudit->tanggal_laporan) }}</td>
                </tr>
            </table>

            <table style="width: 100%; border-collapse: collapse; border: none; margin-top: 10px;">
                <tr>
                    <td style="width: 30%; border: none;"><strong>PELAKSANA :</strong></td>
                    <td style="width: 2%; border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
                <tr>
                    <td style="width: 30%; border: none;">Koordinator</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ $hasilAudit->koordinator_nama }}
                        ({{ $hasilAudit->koordinator_nip }})</td>
                </tr>
                <tr>
                    <td style="width: 30%; border: none;">Auditor 1</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ $hasilAudit->ketua_auditor }}</td>
                </tr>
                @if (!empty($hasilAudit->sekretaris_auditor))
                <tr>
                    <td style="width: 30%; border: none;">Auditor 2</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ $hasilAudit->sekretaris_auditor }}</td>
                </tr>
                @endif
            </table>

            <table style="width: 100%; border-collapse: collapse; border: none; margin-top: 10px;">
                <tr>
                    <td style="width: 30%; border: none;"><strong>DILAKSANAKAN :</strong></td>
                    <td style="width: 2%; border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
                <tr>
                    <td style="width: 30%; border: none;">Tanggal Pelaksanaan</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ formatTanggalIndonesia($hasilAudit->tanggal_desk) }}</td>
                </tr>
                <tr>
                    <td style="width: 30%; border: none;">Waktu Pelaksanaan</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ $hasilAudit->waktu_pelaksanaan }}</td>
                </tr>
                <tr>
                    <td style="width: 30%; border: none;">Tempat Kegiatan</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ $hasilAudit->tempat_kegiatan }}</td>
                </tr>
            </table>

            <!-- Detail Table -->
            <table>
                <thead>
                    <tr class="table-head">
                        <th>No</th>
                        <th>Dokumen Acuan</th>
                        <th>Deskripsi Temuan</th>
                        <th>Minor</th>
                        <th>Major</th>
                        <th>Observasi</th>
                        <th>Permintaan Tindakan Koreksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($detailHasilAudit as $index => $detail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $detail->dokumen_acuan }}</td>
                            <td>{!! $detail->deskripsi_temuan !!}</td>
                            <td style="text-align: center;">
                                <input type="checkbox" {{ $detail->OPEN ? 'checked' : '' }} disabled />
                            </td>
                            <td style="text-align: center;">
                                <input type="checkbox" {{ $detail->CLOSE ? 'checked' : '' }} disabled />
                            </td>
                            <td style="text-align: center;">
                                <input type="checkbox" {{ $detail->OB ? 'checked' : '' }} disabled />
                            </td>
                            <td>{!! $detail->permintaan_tindakan_koreksi !!}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">Data Hasil Temuan Tidak Ada</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <br>
            <table style="width: 100%; page-break-inside: avoid;">
                <tr>
                    <td>Auditor</td>
                    <td>Auditee {{ $hasilAudit->auditee }}</td>
                </tr>
                <tr>
                    <!-- Gambar di kiri -->
                    @if ($validasi && $validasi->tanda_tangan_auditor)
                        <td style="width: 50%; text-align: left;">
                            <img src="{{ public_path('storage/' . $validasi->tanda_tangan_auditor) }}"
                                alt="Tanda Tangan Auditor" style="width: 150px; height: auto;" />
                        </td>
                    @else
                        <td>

                        </td>
                    @endif
                    <!-- Gambar di kanan -->
                    @if ($validasi && $validasi->tanda_tangan_auditee)
                        <td style="width: 50%; text-align: left;">
                            <img src="{{ public_path('storage/' . $validasi->tanda_tangan_auditee) }}"
                                alt="Tanda Tangan Auditee" style="width: 150px; height: auto;" />
                        </td>
                    @else
                        <td>

                        </td>
                    @endif
                </tr>
            </table>
        </div>
        @if ($selectedDocument)
            <div style="page-break-before: always;">
                <h2 style="text-align: center;">PENILAIAN DOKUMEN</h2><br>
                <p class="dokumen"><strong>NAMA DOKUMEN :</strong> {{ $selectedDocument->judul_audit }}</p>

                <table class="table table-borderless px-4">
                    <tbody>
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

                @foreach ($standarts as $standart)
                    <br>
                    <p class="content" style="margin-left: -1cm; margin-right: auto;"><strong>{{ $loop->iteration }}.
                            {{ $standart->dokumen_acuan }}</strong></p>
                    @php
                        $desk = $deskEvaluation->where('standart_id', $standart->id)->first();
                    @endphp
                    <p class="content" style="margin-left: -1cm; margin-right: auto;">Desk Evaluation :</p>
                    <table class="table-pdf" style="margin-left: -1cm; margin-right: auto;">
                        <thead style="border: 1px solid #dee2e6; color:white;">
                            <tr>
                                <th rowspan="2" class="table-head">No</th>
                                <th rowspan="2" class="table-head">Dokumen Terkait</th>
                                <th colspan="4" class="table-head">Kondisi Dokumen</th>
                                <th colspan="2" class="table-head">Kategori Temuan</th>
                                <th rowspan="2" class="table-head">Catatan</th>
                                <th rowspan="2" class="table-head">Penanggung Jawab</th>
                            </tr>
                            <tr>
                                <th class="bg-success text-center" style="background-color: #f2f2f2; color:#000000;">
                                    MY*</th>
                                <th class="bg-warning text-center" style="background-color: #f2f2f2; color:#000000;">
                                    MB*</th>
                                <th class="bg-danger text-center" style="background-color: #f2f2f2; color:#000000;">M*
                                </th>
                                <th class="bg-info text-center" style="background-color: #f2f2f2; color:#000000;">MP*
                                </th>
                                <th class="bg-warning text-center" style="background-color: #f2f2f2; color:#000000;">
                                    OB*</th>
                                <th class="bg-danger text-center" style="background-color: #f2f2f2; color:#000000;">
                                    KTS*</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deskEvaluation->where('standart_id', $standart->id) as $key => $desk)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $desk->dokumen_terkait }}</td>
                                    <!-- Kondisi Dokumen -->
                                    <td style="text-align: center;">
                                        <input type="checkbox" {{ $desk->my ? 'checked' : '' }} disabled />
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="checkbox" {{ $desk->mb ? 'checked' : '' }} disabled />
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="checkbox" {{ $desk->m ? 'checked' : '' }} disabled />
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="checkbox" {{ $desk->mp ? 'checked' : '' }} disabled />
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="checkbox" {{ $desk->ob ? 'checked' : '' }} disabled />
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="checkbox" {{ $desk->kts ? 'checked' : '' }} disabled />
                                    </td>
                                    <!-- Catatan dan Penanggung Jawab -->
                                    <td>{!! $desk->catatan !!}</td>
                                    <td>{{ $desk->penanggung_jawab }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" style="text-align: center;">Belum Ada Penilaian</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="table-container" style=" page-break-inside: avoid;">
                        <p class="content" style="margin-left: -4cm; margin-right: auto;">Daftar Tilik :</p>
                        <table class="table-pdf"
                            style="margin-left: -4cm; margin-right: auto; width: 100%;  page-break-inside: avoid; border-collapse: collapse;">
                            <thead style="border: 1px solid #dee2e6; color:white;">
                                <tr>
                                    <th class="table-head">No</th>
                                    <th class="table-head">Pertanyaan Audit</th>
                                    <th class="table-head">Tanggapan Auditee</th>
                                    <th class="table-head">Dokumen Pendukung</th>
                                    <th class="table-head">Hasil Observasi/Audit/Visitasi</th>
                                    <th class="table-head">MY*</th>
                                    <th class="table-head">MB*</th>
                                    <th class="table-head">M*</th>
                                    <th class="table-head">MP*</th>
                                    <th class="table-head">Rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($daftarTilik->where('standart_id', $standart->id) as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->pertanyaan_tilik }}</td>
                                        <td>{!! $item->tanggapan_audit !!}</td>
                                        <td>{!! $item->dokumen_terkait_tilik !!}</td>
                                        <td>{!! $item->hasil_audit !!}</td>
                                        <!-- Checkbox untuk MY, MB, M, MP -->
                                        <td>
                                            <input type="checkbox" name="my_tilik[{{ $item->id }}]"
                                                {{ $item->my_tilik ? 'checked' : '' }} disabled>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="mb_tilik[{{ $item->id }}]"
                                                {{ $item->mb_tilik ? 'checked' : '' }} disabled>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="m_tilik[{{ $item->id }}]"
                                                {{ $item->m_tilik ? 'checked' : '' }} disabled>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="mp_tilik[{{ $item->id }}]"
                                                {{ $item->mp_tilik ? 'checked' : '' }} disabled>
                                        </td>
                                        <td>{!! $item->rekomendasi !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" style="text-align: center;">Tidak Ada Pertanyaan Yang
                                            Dibuat
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endforeach

            </div>
        @endif

        {{-- TINDAK PERBAIKAN --}}
        <div style="page-break-before: always;">
            <h5>2.2 Tindakan Perbaikan</h5>
            <!-- Detail Table -->
            <table>
                <thead>
                    <tr class="table-head">
                        <th>No</th>
                        <th>Deskripsi Tindakan Perbaikan</th>
                        <th>Link Dokumen</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($detailTindakLanjut as $index => $detailTindakLanjuts)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{!! $detailTindakLanjuts->tindak_lanjut !!}</td>
                            <td>{{ $detailTindakLanjuts->link_drive }}</td>
                            <td>{{ $detailTindakLanjuts->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">Tidak Ada Tindakan Perbaikan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <br>
            <table style="width: 100%; page-break-inside: avoid;">
                <tr>
                    <td>Auditor</td>
                    <td>Auditee {{ $hasilAudit->auditee }}</td>
                </tr>
                <tr>
                    <!-- Gambar di kiri -->
                    @if ($validasi && $validasi->tanda_tangan_auditor)
                        <td style="width: 50%; text-align: left;">
                            <img src="{{ public_path('storage/' . $validasi->tanda_tangan_auditor) }}"
                                alt="Tanda Tangan Auditor" style="width: 150px; height: auto;" />
                        </td>
                    @else
                        <td>

                        </td>
                    @endif
                    <!-- Gambar di kanan -->
                    @if ($validasi && $validasi->tanda_tangan_auditee)
                        <td style="width: 50%; text-align: left;">
                            <img src="{{ public_path('storage/' . $validasi->tanda_tangan_auditee) }}"
                                alt="Tanda Tangan Auditee" style="width: 150px; height: auto;" />
                        </td>
                    @else
                        <td>

                        </td>
                    @endif
                </tr>
            </table>
        </div>

        <div style="page-break-before: always;">
            <h2 style="text-align: center;">LAMPIRAN</h2>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr class="table-head" style="text-align: center;">
                        <th>Berita Acara</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            @if ($hasilAudit->berita_acara)
                                <img src="{{ public_path('storage/' . $hasilAudit->berita_acara) }}"
                                    alt="Lampiran Berita Acara" style="width: 150px; height: auto;" />
                            @else
                                Tidak Ada Gambar
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr class="table-head" style="text-align: center;">
                        <th>Daftar Hadir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            @if ($hasilAudit->daftar_hadir)
                                <img src="{{ public_path('storage/' . $hasilAudit->daftar_hadir) }}"
                                    alt="Lampiran Daftar Hadir" style="width: 150px; height: auto;" />
                            @else
                                Tidak Ada Gambar
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr class="table-head" style="text-align: center;">
                        <th>Dokumentasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            @if (file_exists(public_path('storage/' . $hasilAudit->dokumentasi)))
                                <img src="{{ public_path('storage/' . $hasilAudit->dokumentasi) }}"
                                    alt="Lampiran Dokumentasi" style="width: 150px; height: auto;" />
                            @else
                                <p>File tidak ditemukan</p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>





    </div>



    </div>
</body>

</html>
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

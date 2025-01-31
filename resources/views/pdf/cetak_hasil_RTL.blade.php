<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Rencana Tindak Lanjut</title>
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
        <img src="{{ public_path('AdminStyle/img/TINDAK LANJUT COVER.png') }}" class="bg-cover"
            style="width: 800px; height: 1000px; margin-top: -50px;" alt="Cover">
    </div>

    <div class="content" style="margin: 0 3cm 3cm 4cm;">
        <div style="page-break-before: always;">
            <h2 style="text-align: center;">PENGESAHAN</h2><br>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr class="table-head" style="text-align: center;">
                        <th>Lembar Pengesahan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            {{-- @if ($hasilAudit->surat_pengesahan)
                                <img src="{{ public_path('storage/' . $hasilAudit->surat_pengesahan) }}"
                                    alt="Lampiran Surat Pengesahan" style="width: 500px; height: auto;" />
                            @else
                                Tidak Ada Gambar
                            @endif --}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="page-break-before: always;">
            <h2 style="text-align: center;">KATA PENGANTAR</h2><br>
            <p>{!! $site->kata_pengantar !!}</p>
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
            <h2 style="text-align: center;">HASIL RENCANA TINDAK LANJUT</h2><br>
            <h5>2.1 Hasil RTL</h5>
            <table style="width: 100%; border-collapse: collapse; border: none; margin-top: 10px;">
                <tr>
                    <td style="width: 30%; border: none;">Tanggal Laporan</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ formatTanggalIndonesia($HasilRTL->tanggal_laporan) }}</td>
                </tr>
                <tr>
                    <td style="width: 30%; border: none;">Referensi Hasil AMI</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">
                        @if ($HasilRTL->hasil_audit_id == null)
                            Tidak Ada
                        @else
                            Auditee :
                            <?= $HasilRTL->hasilAudit->auditee ?> (
                            <?= formatTanggalIndonesia($HasilRTL->hasilAudit->tanggal_desk) ?>
                            Periode : <?= $HasilRTL->hasilAudit->periode ?> )
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%; border: none;">Jadwal Perbaikan</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">{{ $HasilRTL->jadwal_perbaikan }}</td>
                </tr>
                <tr>
                    <td style="width: 30%; border: none;">Status</td>
                    <td style="width: 2%; border: none;">:</td>
                    <td style="border: none;">
                        @if ($HasilRTL->Minor == 1)
                            Minor
                        @elseif ($HasilRTL->Major == 1)
                            Major
                        @elseif ($HasilRTL->OB == 1)
                            Observasi
                        @elseif ($HasilRTL->KTS == 1)
                            Ketidaksesuaian
                        @endif
                    </td>
                </tr>
            </table>

            <!-- Detail Table -->
            <table>
                <thead>
                    <tr class="table-head">
                        <th>No</th>
                        <th>Pernyataan Standar</th>
                        <th>Keterangan Hasil AMI</th>
                        <th>Rencana Tindak Lanjut</th>
                        <th>Sumber Daya</th>
                        <th>Hasil RTL</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($detailRTL as $index => $details)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{!! $details->pernyataan_standar !!}</td>
                            <td>{!! $details->keterangan_hasil_AMI !!}</td>
                            <td>{!! $details->rencana_tindak_lanjut !!}</td>
                            <td>{!! $details->sumber_daya !!}</td>
                            <td>{!! $details->hasil_RTL !!}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">Data Hasil Rencana Tindak Lanjut Tidak Ada
                            </td>
                        </tr>
                    @endforelse
                </tbody>
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
                            {{-- @if ($hasilAudit->berita_acara)
                                <img src="{{ public_path('storage/' . $hasilAudit->berita_acara) }}"
                                    alt="Lampiran Berita Acara" style="width: 150px; height: auto;" />
                            @else
                                Tidak Ada Gambar
                            @endif --}}
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
                            {{-- @if ($hasilAudit->daftar_hadir)
                                <img src="{{ public_path('storage/' . $hasilAudit->daftar_hadir) }}"
                                    alt="Lampiran Daftar Hadir" style="width: 150px; height: auto;" />
                            @else
                                Tidak Ada Gambar
                            @endif --}}
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
                            {{-- @if (file_exists(public_path('storage/' . $hasilAudit->dokumentasi)))
                                <img src="{{ public_path('storage/' . $hasilAudit->dokumentasi) }}"
                                    alt="Lampiran Dokumentasi" style="width: 150px; height: auto;" />
                            @else
                                <p>File tidak ditemukan</p>
                            @endif --}}
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Evaluasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
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
            text-align: justify;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .table-head {
            background-color: gray;
            text-align: center;
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
    <div class="cover-page">
        <!-- Display Cover Image -->
        <img src="{{ public_path('AdminStyle/img/PENILAIAN DOKUMEN COVER.png') }}" class="bg-cover"
            style="width: 800px; height: 1000px; margin-top: -50px;" alt="Cover">
    </div>
    <div class="content" style="margin: 0 1cm 1cm 1cm;">
        <div style="page-break-before: always;">
            <h2 style="text-align: center;">PENILAIAN DOKUMEN</h2><br>
            <p class="dokumen"><strong>NAMA DOKUMEN :</strong> {{ $dokumen->judul_audit }}</p>

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
                <div class="desk" style="page-break-inside: avoid;">
                    <br>
                    <p class="content"><strong>{{ $loop->iteration }}. {{ $standart->dokumen_acuan }}</strong></p>
                    @php
                        $desk = $deskEvaluation->where('standart_id', $standart->id)->first();
                    @endphp
                    <p class="content">Desk Evaluation :</p>
                    <table class="table-pdf" style="page-break-inside: avoid;">
                        <thead style="border: 1px solid #dee2e6; color:white; ">
                            <tr>
                                <th rowspan="2" class="table-head">No</th>
                                <th rowspan="2" class="table-head">Dokumen Terkait</th>
                                <th colspan="4" class="table-head">Kondisi Dokumen</th>
                                <th colspan="2" class="table-head">Kategori Temuan</th>
                                <th rowspan="2" class="table-head">Catatan</th>
                                <th rowspan="2" class="table-head">Penanggung Jawab</th>
                            </tr>
                            <tr>
                                <th class="bg-success text-center" style="background-color: gray;">MY*</th>
                                <th class="bg-warning text-center" style="background-color: gray;">MB*</th>
                                <th class="bg-danger text-center" style="background-color: gray;">M*</th>
                                <th class="bg-info text-center" style="background-color: gray;">MP*</th>
                                <th class="bg-warning text-center" style="background-color: gray;">OB*</th>
                                <th class="bg-danger text-center" style="background-color: gray;">KTS*</th>
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
                </div>
                <div class="daftar-tilik" style="page-break-inside: avoid;">
                    <p class="content" >Daftar Tilik :</p>
                    <table class="table-pdf" style="page-break-inside: avoid;">
                        <thead style="border: 1px solid #dee2e6; color:white; ">
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
                                    <td colspan="10" style="text-align: center;">Tidak Ada Pertanyaan Yang Dibuat</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endforeach

        </div>
    </div>

</body>

</html>

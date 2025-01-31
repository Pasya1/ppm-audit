<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sites')->insert([
            [
                'kata_pengantar' => '<p>Puji syukur kami panjatkan kehadirat Tuhan Yang Maha Kuasa sehingga &rdquo;Laporan Audit Mutu Internal Politeknik Prasetiya Mandiri Tahun 2024 ini dapat diselesaikan. Laporan ini disusun sebagai laporan hasil audit oleh Tim Audit Mutu Internal berdasarkan Surat Tugas Direktur Nomor 556/KPTS/PPM/D/X/2024 tanggal 26 Oktober tentang Audit Mutu Internal 2024.</p>
                                        <p>Berdasarkan hasil audit terdapat beberapa kondisi yang keseluruhannya sudah mendapat tanggapan dari pihak Auditee. Harapan kami kondisi tersebut dapat segera ditindaklanjuti sehingga dapat meningkatkan kualitas dan kinerja.</p>
                                        <p>Apresiasi kami sampaikan kepada auditi yang telah berkooperatif dalam pelaksanaan kegiatan audit ini. Ucapan terima kasih kami berikan bagi semua pihak yang telah membantu terlaksananya kegiatan.</p>
                                        <p>&nbsp;</p>
                                        <p style="text-align: right;">Bogor, Januari 2025</p>
                                        <p style="text-align: right;">&nbsp;</p>
                                        <p style="text-align: right;">&nbsp;</p>
                                        <p style="text-align: right;">Lembaga Penjaminan Mutu</p>',
                'daftar_isi' => '<p><strong>Pengesahan</strong></p>
                                    <p><strong>Kata Pengantar</strong></p>
                                    <p><strong>Daftar Isi</strong></p>
                                    <p><strong>Bab I Pendahuluan</strong></p>
                                    <p>1.1. Latar Belakang</p>
                                    <p>1.2. Tujuan Pemeriksaan</p>
                                    <p>1.3. Lingkup Pemeriksaan</p>
                                    <p>1.4. Dasar Hukum/Aturan yang Digunakan</p>
                                    <p>1.5. Batasan Pemeriksaan</p>
                                    <p>1.6. Metode Pemeriksaan</p>
                                    <p>1.7. Pengorganisasian Tim Audit</p>
                                    <p><strong>Bab II. Hasil Pemeriksaan</strong></p>
                                    <p>2.1. Hasil Temuan AMI</p>
                                    <p>2.2. Tindakan Perbaikan</p>
                                    <p><strong>Lampiran</strong></p>',
                'latar_belakang' => '<p>Audit Mutu Internal (AMI) adalah proses pengujian yang sistemik, mandiri, dan terdokumentasi untuk memastikan pelaksanaan kegiatan di Perguruan Tinggi sesuai prosedur dan hasilnya telah sesuai dengan standar untuk mencapai tujuan institusi. Dengan demikian, AMI bukanlah asesmen/penilaian melainkan pencocokan kesesuaian antara pelaksanaan dengan perencanaan suatu kegiatan atau pogram. Audit Mutu Internal merupakan salah satu persyaratan yang harus dipenuhi oleh Perguruan Tinggi sebagai bentuk refleksi evaluasi diri yang dilakukan oleh institusi itu sendiri. Audit Mutu internal ini dimaksudkan untuk meninjau tingkat kesesuaian dan efektifitas penerapan Sistem Penjaminan Mutu Internal (SPMI) yang telah ditetapkan dan menjadi dasar arah strategi dan sasaran mutu yang ingin dicapai dan tertuang dalam Dokumen Mutu SPMI. Salah satu sasaran dari aktivitas pengimplementasian SPMI di PPM adalah untuk mendorong terwujudnya akreditasi prodi yang lebih baik. Akreditasi prodi merupakan proses evaluasi dan penilaian secara komprehensif atas komitmen prodi terhadap mutu dan kapasitas penyelenggaraan program Tridharma Perguruan Tinggi. Oleh karena itu, untuk mendukung implementasi sistem penjaminan mutu yang sesuai dengan harapan tersebut perlu dilakukan penilaian kinerja di lingkup Politeknik Prasetiya Mandiri (PPM) melalui Audit Mutu Internal PPM (AMI-PPM). Audit Mutu Internal PPM dilaksanakan oleh Lembaga Penjaminan Mutu PPM. Lembaga Penjaminan Mutu melaksanakan AMI secara bertahap dan sistematis. AMIPPM dilakukan dengan maksud untuk mengevaluasi kinerja setiap unit kerja yang ada di lingkungan PPM. Dengan evaluasi yang dilakukan secara sistematis, menyeluruh, dan berkesinambungan melalui AMI- PPM, Setiap Unit Kerja di lingkungan PPM akan dapat mengetahui potret dirinya, baik kekurangan dan kelebihan yang dimiliki, kemudian memperbaiki kinerjanya sehingga memiliki kesiapan yang lebih baik dalam akreditiasi. Selai itu, evaluasi ini juga sebagai wujud penerapan konsep perbaikan kualitas secara terusmenerus (continous quality improvement) dapat dijadikan pegangan dalam memberikan layanan akademik yang lebih baik dan profesional.</p>',
                'tujuan_pemeriksaan' => '<p>1. Meneliti kepatuhan/ketaatan penjaminan mutu unit kerja internal tingkat Departemen terhadap kebijakan akademik, standar dan sasaran mutu, manual mutu internal tingkat Program Studi dan Institut.</p>
                                            <p>2. Meneliti kesesuaian arah dan pelaksanaan penjaminan mutu akademik internal tingkat Departemen terhadap kebijakan akademik, standar dan sasaran mutu, dan manual mutu internal tingkat Program Studi dan Institut.</p>
                                            <p>3. Meneliti kepastian bahwa lulusan memiliki kompetensi sesuai dengan yang ditetapkan oleh Departemen.</p>
                                            <p>4. Untuk memastikan konsistensi penjabaran kurikulum dengan kompetensi Departemen.</p>
                                            <p>5. Untuk memastikan kepatuhan pelaksanaan proses pembelajaran di Departemen terhadap prosedur operasional baku dan Instruksi Kerja Departemen.</p>
                                            <p>6. Untuk memastikan konsistensi pelaksanaan proses pembelajaran Departemen terhadap pencapaian kompetensi lulusan Departemen.</p>',
                'lingkup_pemeriksaan' => '<p>a. Sasaran Pemeriksaan</p>
                                            <p>Keandalan Sistem Pengendalian Internal atas administrasi bidang akademik di Program Studi.</p>
                                            <p>b. Periode yang Diperiksa</p>
                                            <p>Pelaksanaan akademik semester genap dan ganjil periode tahun 2024 sampai dengan tahun 2024.</p>',
                'dasar_hukum' => '<p>1. Undang-Undang No. 20 Tahun 2003 tentang Sistem Pendidikan Nasional.</p>
                                    <p>2. Peraturan Pemerintah No. 19 Tahun 2005 tentang Standar Nasional Pendidikan.</p>
                                    <p>3. Undang-Undang No. 12 Tahun 2012 tentang Perguruan Tinggi.</p>
                                    <p>4. Permendikbud No. 49 Tahun 2014 tentang Standar Nasional Pendidikan Tinggi.</p>
                                    <p>5. Permenristekdikti No. 53 Tahun 2023 Penjaminan Mutu Pendidikan Tinggi.</p>
                                    <p>6. Peraturan BAN-PT Nomor 59 Tahun 2018 tentang Panduan Penyusunan Laporan Evaluasi Diri</p>
                                    <p>7. Panduan Penyusunan Laporan Kinerja Perguruan Tinggi.</p>
                                    <p>8. Permendikbud 3 Tahun 2020 tentang Standar Nasional Pendidikan Tinggi</p>
                                    <p>9. Permendikbud No. 5 Tahun 2020 tentang Akreditasi Prodidan Perguruan Tinggi.</p>',
                'batasan_pemeriksaan' => '<p>1. Semua informasi tentang pengelolaan akademik Program Studi Tahun Akademik 2024.</p>
                                            <p>2. Pemeriksaan meliputi prosedur-prosedur yang dirancang untuk memberikan keyakinan yang memadai dalam mendeteksi adanya ketidaksesuaian dari pelaksanaan akademik yang berpengaruh terhadap pelayanan mutu Program Studi.</p>',
                'metode_pemeriksaan' => '<p>Dilakukan pemeriksaan dokumen dan peninjauan Data dan informasi selanjutnya dianalisis hingga diperoleh hasilnya. Pembahasan dilakukan untuk verifikasi serta untuk mendapatkan tanggapan dan komitmen tindak lanjut dari auditi.&nbsp;</p>',
                'pengorganisasian_tim_audit' => '<p>Susunan Tim Audit Mutu Internal telah ditetapkan berdasarkan Surat Keputusan No. 556/KPTS/PPM/D/X/2024.</p>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

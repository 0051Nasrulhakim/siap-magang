<!-- DEBUG-VIEW START 1 APPPATH/Views/surat.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

    <title>Laporan</title>

    <style>
        @media print {
            .pagebreak {
                clear: both !important;
                page-break-after: always !important;
            }
        }

        .logo-kab {
            width: 70px;
            left: 0;
        }

        .judul_surat {
            text-transform: uppercase;
        }

        #kop_surat {
            padding: 0.5em 1em;
            margin-bottom: 1em;
        }

        .paragraph {
            padding-bottom: 10px;
        }

        .ttd {
            margin-top: 5em;
            margin-right: 2.5em;
        }
    </style>
</head>

<body onload="print()">
    <section class="sheet padding-10mm">
        <div id="kop_surat" class="d-flex position-relative justify-content-center align-items-center border-bottom border-3 border-dark">
            <div class="logo-kab position-absolute">
                <img src="/assets/logo.png" class="" style="width: 100%;" alt="main_logo">
            </div>
            <div class="text-center">
                <h4 class="mb-0">LAPORAN KEGIATAN PRAKERIN</h4>
                <h3 class="mb-0">SMK MUHAMMADIYAH TALUN</h3>
                <p style="line-height: 10pt !important; font-size:10pt;">Donowangun, Kec. Talun, Kabupaten Pekalongan, Jawa Tengah 51192</p>
            </div>
        </div>
        <div class="text-center mb-4">
            <h5 class="judul_surat m-0">
                LAPORAN KEGIATAN PRAKERIN SISWA
            </h5>
        </div>
        <div class="isi_surat">
            <p class="mb-3" style="text-align: justify;">
                Berdasarkan hasil dari kegiatan prakerin yang dilakukan oleh siswa <b>SMK Muhammadiyah Talun</b>, yang dilakukan pada tahun <b><?= $tahun_selected ?></b> dengan rincian sebagai berikut :
            </p>

            <p class="mb-3" style="text-align: justify;">
                Jumlah siswa yang mengikuti kegiatan prakerin sebanyak <b><?= COUNT($data) ?></b> siswa, dengan rincian per kelas seperti pada tabel dibawah ini.
            </p>

            <table class="table table-bordered table-sm table-striped text-center">
                <tbody>
                    <tr style="border-bottom: 1px solid #333;">
                        <th style="width:40%;">KELAS</th>
                        <th>JUMLAH SISWA</th>
                    </tr>
                    <?php foreach ($kelas as $k => $v) : ?>
                        <tr>
                            <th><?= $k ?></th>
                            <td><?= $v ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <p class="mb-3" style="text-align: justify;">
                Dari hasil kegiatan prakerin tersebut, didapati bahwa status siswa yang mengikuti kegiatan prakerin adalah sebagai berikut.
            </p>

            <table class="table table-bordered table-sm table-striped text-center">
                <tbody>
                    <tr style="border-bottom: 1px solid #333;">
                        <th style="width:40%;">STATUS</th>
                        <th>JUMLAH SISWA</th>
                    </tr>
                    <?php foreach ($status as $k => $v) : ?>
                        <tr>
                            <th><?= $k ?></th>
                            <td><?= $v ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <p class="mb-3" style="text-align: justify;">
                Adapun nama-nama siswa yang mengikuti kegiatan prakerin terlampir pada lampiran surat ini. <br>
                Demikian surat keterangan ini kami buat untuk dapat dipergunakan sebagaimana mestinya.
            </p>


            <div class="ttd">
                <p class="text-center mb-3">
                    Pekalongan, <?= date("d F Y") ?> <br>
                    <b>Mengetahui :</b>
                </p>
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <div class="text-center">
                        <p>Ketua Kegiatan Magang</p>


                        <!-- Nama Kepala Desa -->
                        <p style="margin-top: 100px;"><strong>----------------------</strong></p>
                    </div>

                    <div class="text-center">
                        <p>Kepala Sekolah</p>


                        <!-- Nama Kepala Desa -->
                        <p style="margin-top: 100px;"><strong>Nur Afni Indasari, S.Pd</strong></p>
                    </div>
                </div>
            </div>

            <div class="pagebreak"> </div>

            <div class="mt-5">
                <p>
                    Lampiran 1
                </p>
                <h5 class="mb-0 text-center">DAFTAR NAMA SISWA PRAKERIN</h5>
                <h6 class="mb-3 text-center"><b>Tahun</b> : <?= $tahun_selected ?> | <b>Jurusan</b> : <?= $jurusan_selected == "" ? "Semua" : $jurusan_selected ?></h6>

                <table class="table table-bordered table-sm table-striped">
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;">
                            <th class="text-center">No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Pembimbing</th>
                            <th>Kelas</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                        </tr>
                        <?php $no = 1; ?>
                        <?php foreach ($data as $d) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $d->nis ?></td>
                                <td><?= $d->nama ?></td>
                                <td><?= $d->nama_pembimbing ?></td>
                                <td><?= $d->kelas ?></td>
                                <td><?= $d->angkatan ?></td>
                                <td>
                                    <?php if ($d->laporan == null && date("Y-m-d") > $d->tgl_selesai) : ?>
                                        unfinished
                                    <?php else : ?>
                                        <?= strtolower($d->status) == 'selesai' ? 'finished' : strtolower($d->status) ?>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>
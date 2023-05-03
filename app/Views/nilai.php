<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-md-7">
        <div class="card">
            <div class="card-header pb-0 mb-0">
                <h6>Capaian Hasil Kegiatan Magang</h6>
            </div>
            <div class="card-body pt-0 mt-2">
                <?php if ($nilai) : ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-normal mb-0 pb-0">Kedisiplinan</h6>
                        <h6 class="text-success mb-0 pb-0"><?= $nilai->n_disiplin ?></h6>
                    </div>
                    <hr class="dark horizontal my-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-normal mb-0 pb-0">Kemauan Kerja / Motivasi</h6>
                        <h6 class="text-success mb-0 pb-0"><?= $nilai->n_motivasi ?></h6>
                    </div>
                    <hr class="dark horizontal my-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-normal mb-0 pb-0">Kehadiran</h6>
                        <h6 class="text-success mb-0 pb-0"><?= $nilai->n_kehadiran ?></h6>
                    </div>
                    <hr class="dark horizontal my-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-normal mb-0 pb-0">Inisiatif dan kreatifitas</h6>
                        <h6 class="text-success mb-0 pb-0"><?= $nilai->n_kreatifitas ?></h6>
                    </div>
                    <hr class="dark horizontal my-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-normal mb-0 pb-0">Kejujuran dan Tanggung Jawab</h6>
                        <h6 class="text-success mb-0 pb-0"><?= $nilai->n_kejujuran ?></h6>
                    </div>
                    <hr class="dark horizontal my-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-normal mb-0 pb-0">Kesopanan dan Personalia</h6>
                        <h6 class="text-success mb-0 pb-0"><?= $nilai->n_kesopanan ?></h6>
                    </div>
                    <hr class="dark horizontal my-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-normal mb-0 pb-0">Kerjasama</h6>
                        <h6 class="text-success mb-0 pb-0"><?= $nilai->n_kerjasama ?></h6>
                    </div>
                <?php else : ?>
                    <div class="badge badge-info border border-info w-100 p-3" style="text-align: left; white-space: normal !important;">
                        <div class="font-weight-normal" style="line-height: 0.48cm; font-size: 14px; text-transform: capitalize;">
                            Capaian hasil kegiatan magang anda belum keluar, mohon tunggu beberapa hari kedepan. Jika hal ini sudah berlangsung lama, silahkan hubungi pembimbing magang anda.
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-5">
        <div class="card">
            <div class="card-header pb-0 mb-0">
                <h6>
                    Informasi Nilai
                </h6>
            </div>
            <div class="card-body pt-0 mt-0">
                <b>Sertifikat magang</b> dan <b>surat hasil magang</b> dapat diambil di Kantor TU atau bisa meminta kepada pembimbing magang.
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
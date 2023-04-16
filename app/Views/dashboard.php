<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-6 col-12">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-header p-3 py-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons text-white opacity-10">
                                account_circle
                            </i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Siswa (angkatan)</p>
                            <h4 class="mb-0"><?= count($siswa) ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-xs">
                            Jumlah keseluruhan siswa
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-header p-3 py-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons text-white opacity-10">
                                business
                            </i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Tempat Magang</p>
                            <h4 class="mb-0"><?= count($tempat) ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-xs">
                            Jumlah tempat magang yang terdaftar
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header p-3 py-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons text-white opacity-10">
                            business
                            </i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Tempat Buka</p>
                            <h4 class="mb-0"><?= $tempat_buka ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-xs">
                            Jumlah tempat magang buka
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                <div class="card">
                    <div class="card-header p-3 py-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons text-white opacity-10">
                            business
                            </i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Tempat Tutup</p>
                            <h4 class="mb-0"><?= $tempat_tutup ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-xs">
                            Jumlah tempat magang tutup
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12 mt-4 mt-lg-0">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Tambah Informasi / Pengumuman</h6>
            </div>
            <div class="card-body pb-0 p-3">
                <!-- TODO : tambahkan form tambah informasi  -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
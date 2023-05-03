<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-lg-4">
        <div class="card card-body">
            <h6 class="m-0 p-0">Daftar Siswa Magang</h6>

            <div class="mt-3">
                <?php foreach ($siswas as $s) : ?>
                    <a href="/logbook/<?= $idt ?>/<?= str_replace('.', '', $s->nis) ?>" <?= getStatusSiswa($s->sid) == 'selesai' ? 'data-bs-toggle="tooltip" title="selesai"' : '' ?>>
                        <div class="card card-body p-2 bg-gray-200 shadow-none rounded px-4 mb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <div class="mb-0 <?= getStatusSiswa($s->sid) == 'selesai' ? 'text-info' : '' ?>"><b><?= $s->nama ?></b></div>
                                    <span class="text-sm <?= getStatusSiswa($s->sid) == 'selesai' ? 'text-info' : '' ?>"><?= $s->nis ?></span>
                                </div>
                                <div>
                                    <div class="text-sm <?= getStatusSiswa($s->sid) == 'selesai' ? 'text-info' : '' ?>"><?= $s->kelas ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
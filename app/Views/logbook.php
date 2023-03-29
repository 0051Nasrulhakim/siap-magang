<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-lg-4">
        <div class="card card-body">
            <h6>Daftar Siswa Magang</h6>

            <div class="mt-3">
                <?php foreach ($siswa as $s) : ?>
                    <a href="/logbook/<?= $idt ?>/<?= str_replace('.', '', $s->nis) ?>">
                        <div class="card card-body p-2 bg-gray-200 rounded px-4 mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <div class="mb-0"><b><?= $s->nama ?></b></div>
                                    <span class="text-sm"><?= $s->nis ?></span>
                                </div>
                                <div>
                                    <div class="text-sm"><?= $s->kelas ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
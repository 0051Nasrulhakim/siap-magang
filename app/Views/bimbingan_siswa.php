<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-md-4 mb-3">
        <div class="card card-body pb-1">
            <a href="/bimbingan/<?= $idt ?>" class="d-flex gap-3 mb-1">
                <i class="fa fa-arrow-left" style="margin-top: 4px;"></i>
                <div><strong>Daftar Siswa Magang</strong></div>
            </a>

            <div class="mt-3">
                <?php foreach ($siswa as $s) : ?>
                    <a href="/bimbingan/<?= $idt ?>/<?= str_replace('.', '', $s->nis) ?>">
                        <div class="card card-body p-2 bg-gray-200 shadow-none rounded px-4 mb-2">
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
    <div class="col-12 col-md-8 mb-3">
        <div class="card card-body">
            <div class="text-dark mb-3"><strong>Daftar Kegiatan Siswa</strong></div>
            <div class="text-dark">
                <?php $clog = count($logbooks);
                $i = 1; ?>
                <div class="accordion" id="logAccordion">
                    <?php foreach ($logbooks as $idx => $log) : ?>
                        <div class="accordion-item mb-2 text-dark">
                            <div class="accordion-header" id="hla<?= $log->id ?>">
                                <div class="card card-body p-2 bg-gray-200 shadow-none rounded px-4 mb-2" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#la<?= $log->id ?>" aria-expanded="false" aria-controls="la<?= $log->id ?>">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <div class="mb-0"><b><?= $log->tanggal ?></b></div>
                                            <div class="text-xs"><?= badgeKehadiran($log->keterangan) ?></div>
                                        </div>
                                        <div class="d-flex flex-column align-items-end">
                                            <div class="text-xs mb-1"><?= badgeStatusApplication($log->status) ?></div>
                                            <div class="text-xs"><?= $log->jam_masuk ?> - <?= $log->jam_keluar ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="la<?= $log->id ?>" class="accordion-collapse collapse" aria-labelledby="hla<?= $log->id ?>" data-bs-parent="#logAccordion" style="">
                                <?php $i++ ?>
                                <div class="accordion-body card card-body py-3 bg-gray-200 shadow-none rounded px-3 text-sm opacity-8 <?= $i == $clog ? 'mb-3' : '' ?>">
                                    <?= $log->kegiatan ?>
                                    <div class="d-flex justify-content-end align-items-center mt-3 gap-1">
                                        <button class="badge badge-danger border border-danger text-danger" title="Reject Log Book"><i class="fa fa-times m-0 p-0"></i></button>
                                        <button class="badge badge-success border border-success text-success" title="Approve Log Book"><i class="fa fa-check m-0 p-0"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-md-4 mb-3">
        <div class="card card-body pb-1">
            <a href="/logbook/<?= $idt ?>" class="d-flex gap-3">
                <i class="fa fa-arrow-left" style="margin-top: 4px;"></i>
                <div><strong>Daftar Siswa Magang</strong></div>
            </a>

            <div class="mt-3">
                <?php foreach ($siswas as $s) : ?>
                    <a href="/logbook/<?= $idt ?>/<?= $s->nis ?>" <?= getStatusSiswa($s->sid) == 'selesai' ? 'data-bs-toggle="tooltip" title="selesai"' : '' ?>>
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
    <div class="col-12 col-md-8 mb-3">
        <?php if (getStatusSiswa($siswa->id) == 'selesai' && $siswa->laporan) : ?>
            <div class="card card-body mb-3 bg-info text-white border-info">
                Kegiatan magang siswa ini sudah selesai. diharapkan untuk segera memproses nilai.
                <div class="mt-2 mb-0">
                    <?php if (nilaiAvailable($siswa->id)) : ?>
                        <button class="btn btn-sm bg-gradient-success mb-0" data-bs-toggle="modal" data-bs-target="#mdnilai">DETAIL NILAI</button>
                    <?php else : ?>
                        <button class="btn btn-sm bg-gradient-info mb-0 me-2" data-bs-toggle="modal" data-bs-target="#manilai">INPUT NILAI</button>
                        <?php if ($siswa->laporan) : ?>
                            <a href="/assets/laporan/<?= $siswa->laporan ?>" target="_blank" class="btn btn-sm bg-gradient-success mb-0">LIHAT LAPORAN</a>
                        <?php endif ?>
                    <?php endif ?>
                </div>
            </div>

            <?php if (nilaiAvailable($siswa->id)) : ?>
                <?php $nilai = getNilaiSiswa($siswa->id) ?>
                <!-- modal detail nilai -->
                <div class="modal fade" id="mdnilai" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="mdnilai" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="m-0">Capaian Hasil Kegiatan Magang</h6>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="font-weight-normal text-sm mb-0 pb-0">Kedisiplinan</h6>
                                        <h6 class="text-success mb-0 pb-0 text-sm"><?= $nilai->n_disiplin ?></h6>
                                    </div>
                                    <hr class="dark horizontal my-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="font-weight-normal text-sm mb-0 pb-0">Kemauan Kerja / Motivasi</h6>
                                        <h6 class="text-success mb-0 pb-0 text-sm"><?= $nilai->n_motivasi ?></h6>
                                    </div>
                                    <hr class="dark horizontal my-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="font-weight-normal text-sm mb-0 pb-0">Kehadiran</h6>
                                        <h6 class="text-success mb-0 pb-0 text-sm"><?= $nilai->n_kehadiran ?></h6>
                                    </div>
                                    <hr class="dark horizontal my-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="font-weight-normal text-sm mb-0 pb-0">Inisiatif dan kreatifitas</h6>
                                        <h6 class="text-success mb-0 pb-0 text-sm"><?= $nilai->n_kreatifitas ?></h6>
                                    </div>
                                    <hr class="dark horizontal my-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="font-weight-normal text-sm mb-0 pb-0">Kejujuran dan Tanggung Jawab</h6>
                                        <h6 class="text-success mb-0 pb-0 text-sm"><?= $nilai->n_kejujuran ?></h6>
                                    </div>
                                    <hr class="dark horizontal my-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="font-weight-normal text-sm mb-0 pb-0">Kesopanan dan Personalia</h6>
                                        <h6 class="text-success mb-0 pb-0 text-sm"><?= $nilai->n_kesopanan ?></h6>
                                    </div>
                                    <hr class="dark horizontal my-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="font-weight-normal text-sm mb-0 pb-0">Kerjasama</h6>
                                        <h6 class="text-success mb-0 pb-0 text-sm"><?= $nilai->n_kerjasama ?></h6>
                                    </div>
                                    <hr class="dark horizontal my-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="font-weight-normal text-sm mb-0 pb-0">Laporan</h6>
                                        <h6 class="text-success mb-0 pb-0 text-sm"><?= $nilai->n_laporan ?></h6>
                                    </div>
                                    <div class="mt-4 d-flex gap-2 justify-content-between items-center">
                                        <div>
                                            <button class="badge badge-danger border border-danger btn-hapus-nilai" data-id="<?= $nilai->id ?>"><i class="fa fa-trash text-xxs"></i></button>
                                            <button class="badge badge-info border border-info btn-edit-nilai" data-bs-toggle="modal" data-bs-target="#menilai">EDIT NILAI</button>
                                        </div>
                                        <button type="button" class="badge badge-secondary border border-secondary btn-close-modal" data-bs-dismiss="modal">CLOSE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal detail nilai end -->
                <!-- modal edit nilai -->
                <div class="modal fade" id="menilai" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="menilai" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h5 class="m-0 p-0">Edit Nilai siswa</h5>
                                        <small class="m-0 p-0">Form ini dipergunakan untuk mengganti nilai siswa yang masih belum sesuai</small>
                                    </div>
                                    <div class="card-body">
                                        <form class="formeditnilai">
                                            <input type="hidden" name="id" value="<?= $nilai->id ?>">
                                            <input type="hidden" name="idt" value="<?= $idt ?>">
                                            <input type="hidden" name="ids" value="<?= $siswa->id ?>">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_disiplin" class="form-label">Kedisiplinan</label>
                                                        <input type="number" class="form-control" name="n_disiplin" value="<?= $nilai->n_disiplin ?>" id="n_disiplin" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_motivasi" class="form-label">Kemauan Kerja / Motivasi</label>
                                                        <input type="number" class="form-control" name="n_motivasi" value="<?= $nilai->n_motivasi ?>" id="n_motivasi" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_kehadiran" class="form-label">Kehadiran</label>
                                                        <input type="number" class="form-control" name="n_kehadiran" value="<?= $nilai->n_kehadiran ?>" id="n_kehadiran" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_kreatifitas" class="form-label">Inisiatif dan kreatifitas</label>
                                                        <input type="number" class="form-control" name="n_kreatifitas" value="<?= $nilai->n_kreatifitas ?>" id="n_kreatifitas" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_kejujuran" class="form-label">Kejujuran dan Tanggung Jawab</label>
                                                        <input type="number" class="form-control" name="n_kejujuran" value="<?= $nilai->n_kejujuran ?>" id="n_kejujuran" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_kesopanan" class="form-label">Kesopanan dan Personalia</label>
                                                        <input type="number" class="form-control" name="n_kesopanan" value="<?= $nilai->n_kesopanan ?>" id="n_kesopanan" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_kerjasama" class="form-label">Kerjasama</label>
                                                        <input type="number" class="form-control" name="n_kerjasama" value="<?= $nilai->n_kerjasama ?>" id="n_kerjasama" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_laporan" class="form-label">Nilai Laporan</label>
                                                        <input type="number" class="form-control" name="n_laporan" value="<?= $nilai->n_laporan ?>" id="n_laporan" min="0" max="100">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <button type="button" class="btn btn-sm bg-gradient-secondary shadow mb-0 btn-close-modal" data-bs-dismiss="modal">BATAL</button>
                                                <button type="submit" class="btn btn-sm bg-gradient-info shadow mb-0">SIMPAN</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal edit nilai end -->
            <?php else : ?>
                <!-- modal tambah nilai -->
                <div class="modal fade" id="manilai" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="manilai" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h5 class="m-0 p-0">Tambah Nilai siswa</h5>
                                        <small class="m-0 p-0">Nilai yang ditambahkan sesuai dengan hasil yang diberikan oleh perusahaan / instansi tempat siswa magang</small>
                                    </div>
                                    <div class="card-body">
                                        <form class="formaddnilai">
                                            <input type="hidden" name="idt" value="<?= $idt ?>">
                                            <input type="hidden" name="ids" value="<?= $siswa->id ?>">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_disiplin" class="form-label">Kedisiplinan</label>
                                                        <input type="number" class="form-control" name="n_disiplin" id="n_disiplin" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_motivasi" class="form-label">Kemauan Kerja / Motivasi</label>
                                                        <input type="number" class="form-control" name="n_motivasi" id="n_motivasi" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_kehadiran" class="form-label">Kehadiran</label>
                                                        <input type="number" class="form-control" name="n_kehadiran" id="n_kehadiran" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_kreatifitas" class="form-label">Inisiatif dan kreatifitas</label>
                                                        <input type="number" class="form-control" name="n_kreatifitas" id="n_kreatifitas" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_kejujuran" class="form-label">Kejujuran dan Tanggung Jawab</label>
                                                        <input type="number" class="form-control" name="n_kejujuran" id="n_kejujuran" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_kesopanan" class="form-label">Kesopanan dan Personalia</label>
                                                        <input type="number" class="form-control" name="n_kesopanan" id="n_kesopanan" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_kerjasama" class="form-label">Kerjasama</label>
                                                        <input type="number" class="form-control" name="n_kerjasama" id="n_kerjasama" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="input-group input-group-outline mb-3">
                                                        <label for="n_laporan" class="form-label">Nilai Laporan</label>
                                                        <input type="number" class="form-control" name="n_laporan" id="n_laporan" min="0" max="100">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <button type="button" class="btn btn-sm bg-gradient-secondary shadow mb-0 btn-close-modal" data-bs-dismiss="modal">BATAL</button>
                                                <button type="submit" class="btn btn-sm bg-gradient-info shadow mb-0">SIMPAN</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal tambah nilai end -->
            <?php endif ?>
        <?php else : ?>
            <?php if (date("Y-m-d") > $siswa->tgl_selesai) : ?>
                <div class="card card-body mb-3 bg-warning text-dark border-warning">
                    Siswa ini belum mengunggah laporan akhir magang. nilai tidak dapat diinputkan sebelum siswa mengunggah laporan akhir magang.
                </div>
            <?php endif ?>
        <?php endif ?>
        <div class="card card-body">
            <div class="text-dark mb-3"><strong>Daftar Kegiatan Siswa</strong></div>
            <div class="text-dark">
                <?php $clog = count($logbooks);
                $i = 1; ?>
                <div class="accordion accLog" id="logAccordion">
                    <?php foreach ($logbooks as $idx => $log) : ?>
                        <div class="accordion-item mb-2 text-dark">
                            <div class="accordion-header" id="hla<?= $log->id ?>">
                                <div class="card card-body p-2 bg-gray-200 shadow-none rounded px-4 mb-2" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#la<?= $log->id ?>" aria-expanded="false" aria-controls="la<?= $log->id ?>">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <div class="mb-0"><b><?= $log->tanggal ?></b></div>
                                            <div class="text-xs"><?= genBadgeKehadiran($log->keterangan) ?></div>
                                        </div>
                                        <div class="d-flex flex-column align-items-end">
                                            <div class="text-xs mb-1 d-flex gap-2 flex-row">
                                                <?php if ($log->telat) : ?>
                                                    <span class="badge badge-danger border border-danger">Telat diisi</span>
                                                <?php endif ?>
                                                <?= genBadgeStatusApplication($log->status) ?>
                                            </div>
                                            <div class="text-sm"><?= $log->jam_masuk ?> - <?= $log->jam_keluar ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="la<?= $log->id ?>" class="accordion-collapse collapse" aria-labelledby="hla<?= $log->id ?>" data-bs-parent="#logAccordion" style="">
                                <?php $i++ ?>
                                <div class="accordion-body card card-body py-3 bg-gray-200 shadow-none rounded px-3 text-sm opacity-8 <?= $i == $clog ? 'mb-3' : '' ?>">
                                    <?= $log->kegiatan ?>
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-1">
                                        <a target="_blank" href="/assets/img/logbook/<?= $log->bukti ?>" class="badge badge-info border border-info" title="Lihat bukti kegiatan"><i class="fa fa-search m-0 p-0"></i></a>
                                        <div>
                                            <button class="badge badge-danger border border-danger btn-reject" data-stts="rejected" title="Reject Log Book"><i class="fa fa-times m-0 p-0"></i></button>
                                            <button <?= $log->status == "approved" ? 'disabled style="cursor: not-allowed; pointer-events: all !important;"' : '' ?> class="badge badge-success border border-success text-success btn-approve <?= $log->status == "approved" ? 'opacity-5' : '' ?>" data-stts="approved" title="Approve Log Book"><i class="fa fa-check m-0 p-0"></i></button>
                                        </div>
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

<?= $this->section('bottomsc'); ?>
<script src="/assets/js/plugins/sweetalert.min.js"></script>

<?php if (getStatusSiswa($siswa->id) == 'selesai') : ?>
    <script>
        $(document).ready(function() {
            $('.btn-close-modal').on('click', function() {
                $('#fejurusan').trigger('reset');
            });

            $('.formaddnilai').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var data = new FormData(this);
                $.ajax({
                    cache: false,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    url: '/nilai/store',
                    data: data,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.responseText);
                        console.log(thrownError);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseText,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
        });
    </script>
<?php endif; ?>

<?php if (nilaiAvailable($siswa->id)) : ?>
    <script>
        $(document).ready(function() {
            $(".btn-edit-nilai").click(function() {
                $("#menilai").modal('show');
            });

            // btn-hapus-nilai on click post data to 
            $('.btn-hapus-nilai').on('click', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Nilai akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "/nilai/destroy/" + id,
                            dataType: "JSON",
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                console.log(xhr.responseText);
                                console.log(thrownError);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: xhr.responseText,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        });
                    }
                });
            });

            $('.formeditnilai').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var data = new FormData(this);
                $.ajax({
                    cache: false,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    url: '/nilai/update',
                    data: data,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.responseText);
                        console.log(thrownError);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseText,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('.btn-approve').on('click', function() {
            let id = $(this).closest('.accordion-item').find('.accordion-header').attr('id').replace('hla', '');
            let stts = $(this).data('stts');
            Swal.fire({
                title: "Approve Log Book",
                text: "Apakah anda yakin ingin menyetujui log book ini?",
                icon: "warning",
                buttons: true,
                showCancelButton: true,
                dangerMode: true,
            }).then(e => {
                e.isConfirmed ? $.ajax({
                    url: '/logbook/status/update',
                    type: 'POST',
                    data: {
                        id: id,
                        status: stts
                    },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Log Book berhasil disetujui",
                                icon: "success",
                                timer: 2000,
                                buttons: false,
                                showConfirmButton: false,
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Gagal!", "Log Book gagal disetujui", "error");
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        Swal.fire("Gagal!", "Log Book gagal disetujui", "error");
                    }
                }) : '';
            });
        });

        $('.btn-reject').on('click', function() {
            let id = $(this).closest('.accordion-item').find('.accordion-header').attr('id').replace('hla', '');
            let stts = $(this).data('stts');
            Swal.fire({
                title: "Reject Log Book",
                text: "Apakah anda yakin ingin menolak log book ini?",
                icon: "warning",
                dangerMode: true,
                showCancelButton: true,
                showConfirmButton: true,
            }).then(e => {
                e.isConfirmed ? $.ajax({
                    url: '/logbook/status/update',
                    type: 'POST',
                    data: {
                        id: id,
                        status: stts
                    },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Log Book berhasil ditolak",
                                icon: "success",
                                timer: 2000,
                                buttons: false,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Gagal!", "Log Book gagal ditolak", "error");
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        Swal.fire("Gagal!", "Log Book gagal ditolak", "error");
                    }
                }) : '';
            });
        });
    });
</script>
<?= $this->endSection(); ?>
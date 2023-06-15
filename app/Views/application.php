<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-body py-3 px-4">
            <?php if (in_groups('admin') || in_groups('pembimbing')) : ?>
                <div class="d-flex justify-content-between align-items-center px-2">
                    <div>
                        <span class="h5 mb-0 pb-0">Daftar Pendaftaran Siswa</span> <br>
                        Dafatar berikut merupakan Lamaran siswa yang telah mendaftar di tempat magang.
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6 col-md-4">
                        <div class="input-group input-group-outline mb-3">
                            <label for="filstatus" class="form-label">Status</label>
                            <select name="filstatus" id="filstatus" class="form-control">
                                <option value=""></option>
                                <option value="accepted">Accepted</option>
                                <option value="selesai">Finished</option>
                                <option value="unfinish">Unfinish</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="input-group input-group-outline mb-3">
                            <label for="filjurusan" class="form-label">Kelas</label>
                            <select name="filjurusan" id="filjurusan" class="form-control">
                                <option value=""></option>
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="XI <?= $k->nama_jurusan ?>">XI <?= $k->nama_jurusan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="input-group input-group-outline mb-3">
                            <label for="filangkatan" class="form-label">Angkatan</label>
                            <select name="filangkatan" id="filangkatan" class="form-control">
                                <option value=""></option>
                                <?php foreach ($angkatan as $a) : ?>
                                    <option value="<?= $a->nama ?>">XI <?= $a->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="input-group input-group-outline mb-3">
                            <label for="fillaporan" class="form-label">Laporan</label>
                            <select name="fillaporan" id="fillaporan" class="form-control">
                                <option value=""></option>
                                <option value="lihat">Sudah</option>
                                <option value="belum">Belum</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="input-group input-group-outline mb-3">
                            <label for="filsearch" class="form-label">Cari Data</label>
                            <input type="text" name="filsearch" id="filsearch" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-stripped" id="tbapplications">
                        <thead>
                            <tr>
                                <th class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIS</th>
                                <th class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                                <th class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                <th class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Angkatan</th>
                                <th class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Instansi</th>
                                <th class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Laporan</th>
                                <th class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach ($applications as $application) : ?>
                                <?php $instansi = $application->id_tempat == null ? $application->custom_tempat : getNamaInstansi($application->id_tempat) ?>
                                <tr>
                                    <td class="ps-3 text-xs font-weight-bold"><?= $no++ ?></td>
                                    <td class="ps-3 text-xs font-weight-bold">
                                        <?php if ($application->laporan == null && (date('Y-m-d') > $application->tgl_selesai)) : ?>
                                            <span class="badge badge-warning border border-warning">unfinish</span>
                                        <?php else : ?>
                                            <?= genBadgeStatusApplication($application->status) ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="ps-3 text-xs font-weight-bold">
                                        <div class="badge badge-secondary"><?= $application->nis ?></div>
                                    </td>
                                    <td class="ps-3 text-xs font-weight-bold"><?= $application->kelas ?></td>
                                    <td class="ps-3 text-xs font-weight-bold"><?= $application->nama ?></td>
                                    <td class="ps-3 text-xs font-weight-bold"><?= $application->angkatan ?></td>
                                    <td class="ps-3 text-xs font-weight-bold"><?= isVerifiedInstansi($application->id_tempat) ?><span class="iname"><?= $instansi ?></span></td>
                                    <td class="ps-3 text-xs font-weight-bold">
                                        <?php if ($application->laporan) : ?>
                                            <a href="/assets/laporan/<?= $application->laporan ?>" target="_blank" class="badge badge-info border border-info">LIHAT</a>
                                        <?php else : ?>
                                            <a href="#" class="badge badge-dark border border-dark" style="cursor: not-allowed !important; pointer-events: all !important;">BELUM</a>
                                        <?php endif ?>
                                    </td>
                                    <td class="ps-3 text-xs font-weight-bold">
                                        <button <?= $application->status != 'pending' ? 'disabled style="opacity: 0.6;"' : '' ?> class="badge border border-1 border-danger text-danger btn-destroy" title="Hapus data" data-item="<?= $application->id; ?>"><i class="fas fa-trash"></i></button>
                                        <button <?= $application->status == 'reject by system' ? 'disabled style="opacity: 0.6;"' : '' ?> class="badge border border-1 border-warning text-warning btn-edit-status" title="Update Status" data-stts="<?= $application->status ?>" data-item="<?= $application->id; ?>"><i class="fas fa-tag"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="d-flex justify-content-between align-items-center px-2 mb-4">
                    <div>
                        <span class="h5 mb-0 pb-0">Status pendaftaran anda</span> <br>
                        daftar berikut merupakan status pendaftaran anda di tempat magang.
                    </div>
                    <a class="btn btn-sm btn-dark" href="/tempat">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>

                <div>
                    <?php foreach ($applications as $app) : ?>
                        <div class="card card-body rounded bg-gray-200 p-2 px-4 mb-3 liInstansi">
                            <div class="d-flex justify-content-between align-items-center">
                                <div data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $app->created_at ?>" data-container="body" data-animation="true">
                                    <div class="h6 mb-0 pb-0"><?= $app->instansi ?></div>
                                    <div class="text-xs"><?= $app->alamat ?></div>
                                </div>
                                <div style="text-align: end !important;">
                                    <div class="mb-2">
                                        <?php if ($app->laporan == null && (date('Y-m-d') > $app->tgl_selesai)) : ?>
                                            <span class="badge badge-warning border border-warning">unfinish</span>
                                        <?php else : ?>
                                            <?= genBadgeStatusApplication($app->status) ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-xs"><?= $app->updated_at ?></div>
                                </div>
                            </div>

                            <table class="mt-2 table-compact table-bordered">
                                <tr>
                                    <th class="p-2 text-sm" style="width:20%;">Nama Pembimbing</th>
                                    <td class="p-2 text-sm"><a href="#"><?= $app->nama_pembimbing ?></a></td>
                                </tr>
                                <tr>
                                    <th class="p-2 text-sm" style="width:20%;">No Pembimbing</th>
                                    <td class="p-2 text-sm"><a href="tel:+<?= $app->hp_pembimbing ?>"><?= $app->hp_pembimbing ?></a></td>
                                </tr>
                                <tr>
                                    <th class="p-2 text-sm" style="width:20%;">Email Pembimbing</th>
                                    <td class="p-2 text-sm"><a href="mailto:<?= $app->email_pembimbing ?>"><?= $app->email_pembimbing ?></a></td>
                                </tr>
                            </table>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('topsc'); ?>
<link rel="stylesheet" href="/assets/css/dataTables.bootstrap5.min.css">
<?= $this->endSection(); ?>



<?= $this->section('bottomsc'); ?>
<script src="/assets/js/plugins/sweetalert.min.js"></script>

<?php if (in_groups('admin') || in_groups('pembimbing')) : ?>
    <script src="/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            var tbApplication = $("#tbapplications").DataTable({
                dom: '<"row"<"col-12"tr>><"row mt-2 px-3"<"col-12 col-md-6"i><"col-12 col-md-6"p>>',
                pageLength: 10,
                language: {
                    paginate: {
                        next: '<i class="fas fa-angle-right"></i>',
                        previous: '<i class="fas fa-angle-left"></i>'
                    }
                },
            });
            
            // fil status
            $('#filstatus').on('change', function() {
                $(this).val() == "" ? $(this).parent().removeClass('is-filled') : $(this).parent().addClass('is-filled');
                tbApplication.columns(1).search(this.value).draw();
            });

            // fil jurusan
            $('#filjurusan').on('change', function() {
                $(this).val() == "" ? $(this).parent().removeClass('is-filled') : $(this).parent().addClass('is-filled');
                console.log(this.value);
                tbApplication.columns(3).search(this.value).draw();
            });

            // fillaporan
            $('#fillaporan').on('change', function() {
                $(this).val() == "" ? $(this).parent().removeClass('is-filled') : $(this).parent().addClass('is-filled');
                if (this.value == 'lihat') {
                    tbApplication.columns(7).search('LIHAT').draw();
                } else if (this.value == 'belum') {
                    tbApplication.columns(7).search('BELUM').draw();
                } else {
                    tbApplication.columns(7).search('').draw();
                }
            });

            // fil angkatan
            $('#filangkatan').on('change', function() {
                $(this).val() == "" ? $(this).parent().removeClass('is-filled') : $(this).parent().addClass('is-filled');
                tbApplication.columns(5).search(this.value).draw();
            });

            // fil search
            $('#filsearch').on('keyup', function() {
                $(this).val() == "" ? $(this).parent().removeClass('is-filled') : $(this).parent().addClass('is-filled');
                tbApplication.search(this.value).draw();
            });

            $("#tbapplications tbody").on('click', '.btn-destroy', function(s) {
                const t = $(this).data('item');
                const nama = $(this).parent().parent().find('td:eq(4)').text();
                const instansi = $(this).parent().parent().find('td:eq(6) .iname').text();

                Swal.fire({
                    icon: "warning",
                    title: "Hapus Data",
                    html: `Apakah anda yakin ingin menghapus data pendaftaran siswa <b>${nama}</b> di <b><i>${instansi}</i></b> ?`,
                    showCancelButton: !0,
                    confirmButtonText: "Ya, Hapus"
                }).then(e => {
                    e.isConfirmed && $.ajax({
                        url: "/application/destroy/" + t,
                        type: "delete",
                        dataType: "json",
                        success: function(t) {
                            t.success ? Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: t.message,
                                showConfirmButton: !1,
                                timer: 1500
                            }).then(t => {
                                location.reload()
                            }) : Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: t.message,
                                showConfirmButton: !0
                            }).then(t => {
                                t.isConfirmed && location.reload()
                            })
                        }
                    })
                })
            })

            $("#tbapplications tbody").on('click', '.btn-edit-status', function(s) {
                const t = $(this).data('item');
                const nama = $(this).parent().parent().find('td:eq(4)').text();
                const instansi = $(this).parent().parent().find('td:eq(6) .iname').text();
                Swal.fire({
                    icon: "warning",
                    title: "Update Status",
                    html: `Anda akan mengubah status pendaftaran siswa <b>${nama}</b> di <b><i>${instansi}</i></b> ?`,
                    input: 'select',
                    inputPlaceholder: 'Pilih Status',
                    inputValue: $(this).data('stts'),
                    inputOptions: {
                        // 'pending': 'Pending',
                        'accepted': 'Accepted',
                        // 'rejected': 'Rejected',
                        'selesai': 'Finished',
                        'unfinish': 'Unfinished',
                    },
                    showCancelButton: !0,
                    confirmButtonText: "Ya, Update"
                }).then(e => {
                    e.isConfirmed ? $.ajax({
                        url: "/application/status/update",
                        type: "post",
                        dataType: "json",
                        data: {
                            item: t,
                            status: e.value
                        },
                        success: function(t) {
                            t.success ? Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: t.message,
                                showConfirmButton: !1,
                                timer: 1500
                            }).then(t => {
                                location.reload()
                            }) : Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: t.message,
                                showConfirmButton: !0
                            }).then(t => {
                                t.isConfirmed && location.reload()
                            })
                        }
                    }) : null
                })
            })
        });
    </script>
<?php endif ?>
<?= $this->endSection(); ?>
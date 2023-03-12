<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-body py-3 px-4">
            <div class="d-flex justify-content-between align-items-center px-2">
                <div>
                    <span class="h5 mb-0 pb-0">Daftar Pendaftaran Siswa</span> <br>
                    Dafatar berikut merupakan Lamaran siswa yang telah mendaftar di tempat magang.
                </div>

                <button class="btn btn-sm btn-dark" id="btnAddPengelola" data-bs-toggle="modal" data-bs-target="#mtlamaran">
                    <i class="fas fa-plus"></i>
                </button>
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
                            <th class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($applications as $application) : ?>
                            <?php $instansi = $application->id_tempat == null ? $application->custom_tempat : getInstansi($application->id_tempat) ?>
                            <tr>
                                <td class="ps-3 text-xs font-weight-bold"><?= $no++ ?></td>
                                <td class="ps-3 text-xs font-weight-bold"><?= bageStatusApplication($application->status) ?></td>
                                <td class="ps-3 text-xs font-weight-bold">
                                    <div class="badge badge-secondary"><?= $application->nis ?></div>
                                </td>
                                <td class="ps-3 text-xs font-weight-bold"><?= $application->kelas ?></td>
                                <td class="ps-3 text-xs font-weight-bold"><?= $application->nama ?></td>
                                <td class="ps-3 text-xs font-weight-bold"><?= $application->tahun ?></td>
                                <td class="ps-3 text-xs font-weight-bold"><?= genIconInstansi($application->id_tempat) ?><span class="iname"><?= $instansi ?></span></td>
                                <td class="ps-3 text-xs font-weight-bold">
                                    <button class="badge border border-1 border-danger text-danger btn-destroy" title="Hapus data" data-item="<?= $application->id; ?>"><i class="fas fa-trash"></i></button>
                                    <button class="badge border border-1 border-warning text-warning btn-edit-status" title="Update Status" data-stts="<?= $application->status ?>" data-item="<?= $application->id; ?>"><i class="fas fa-tag"></i></button>
                                    <!-- <a href="/application/edit/<?= $application->id ?>" class="badge border border-1 border-dark text-dark btn-edit" title="Edit Data"><i class="fas fa-edit"></i></a> -->
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal #mtlamaran -->
<div class="modal fade" id="mtlamaran" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="mtlamaran" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0">
                        <span class="h5" id="modalTitle">Tambah Data Pendaftaran Magang</span>
                    </div>
                    <div class="card-body">
                        <!-- checkbox -->
                        <div class="h6">TODOS:</div>
                        <div class="form-check px-1">
                            <input class="form-check-input" type="checkbox" id="fcustomCheck1" disabled>
                            <label class="custom-control-label" for="fcustomCheck1">Tambah pendaftaran siswa magang perlu dibuat</label>
                        </div>
                        <div class="form-check px-1">
                            <input class="form-check-input" type="checkbox" id="fcustomCheck2" disabled>
                            <label class="custom-control-label" for="fcustomCheck2">Form tambah pendaftaran siswa magang perlu dikaji lebih lanjut</label>
                        </div>
                        <div class="form-check px-1">
                            <input class="form-check-input" type="checkbox" id="fcustomCheck3" disabled>
                            <label class="custom-control-label" for="fcustomCheck3">Pengkajian ulang perlu atau tidaknya edit data siswa magang</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('bottomsc'); ?>
<script src="/assets/js/plugins/datatables.js"></script>
<script src="/assets/js/plugins/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        const dataTableBasic = new simpleDatatables.DataTable("#tbapplications", {
            searchable: false,
            fixedHeight: true
        });

        $("#tbapplications tbody").on('click', '.btn-destroy', function(s) {
            const t = $(this).data('item');
            const nama = $(this).parent().parent().find('td:eq(4)').text();
            const instansi = $(this).parent().parent().find('td:eq(6) .iname').text();
            console.log(instansi);
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
                    'pending': 'Pending',
                    'accepted': 'Accepted',
                    'rejected': 'Rejected',
                    'selesai': 'Finished',
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
                }) : location.reload()
            })
        })
    });
</script>
<?= $this->endSection(); ?>
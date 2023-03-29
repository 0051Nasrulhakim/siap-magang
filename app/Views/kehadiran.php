<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h5>Form Kehadiran dan Log Book</h5>
                </div>
                <form class="form-absen" method="post">
                    <input type="hidden" name="sid" value="<?= getSid(user_id()) ?>">
                    <input type="hidden" name="pid" value="<?= $tempat->pid ?>">
                    <input type="hidden" name="tid" value="<?= $tempat->tid ?>">
                    <div class="mb-3">
                        <label class="form-label mb-1" for="tanggal">Tanggal Kegiatan</label>
                        <div class="input-group input-group-outline">
                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-1" for="keterangan">Keterangan</label>
                        <div class="input-group input-group-outline mb-3 is-filled">
                            <select name="keterangan" id="keterangan" class="form-control">
                                <option value="">-- Pilih Keterangan --</option>
                                <option value="hadir">Hadir</option>
                                <option value="izin">izin</option>
                                <option value="sakit">sakit</option>
                                <option value="alfa">alfa</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label class="form-label mb-1" for="jam_masuk">Jam Masuk</label>
                            <div class="input-group input-group-outline">
                                <input type="time" class="form-control" name="jam_masuk" id="jam_masuk" max="<?= date('H:i'); ?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label mb-1" for="jam_keluar">Jam Keluar</label>
                            <div class="input-group input-group-outline">
                                <input type="time" class="form-control" name="jam_keluar" id="jam_keluar" max="<?= date('H:i'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-1" for="kegiatan">Kegiatan yang dilakukan</label>
                        <div class="input-group input-group-outline mb-3">
                            <textarea name="kegiatan" id="kegiatan" rows="4" class="form-control" placeholder="kegiatan hari ini"></textarea>
                        </div>
                    </div>
                    <!-- button with background gradient-dark -->
                    <button type="submit" class="btn bg-gradient-dark btn-block">Absen</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="card">
            <div class="card-body">
                <div class="mb-1">
                    <h5>Daftar Kehadiran Anda</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableLogBook">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($logbooks as $log) : ?>
                                <tr>
                                    <td class="text-xs ps-4 font-weight-bold"><?= $i++ ?></td>
                                    <td class="text-xs ps-4 font-weight-bold"><?= $log->tanggal ?></td>
                                    <td class="text-xs ps-4 font-weight-bold"><?= $log->keterangan ?></td>
                                    <td class="text-xs ps-4 font-weight-bold">
                                        <div class="d-flex flex-column gap-1">
                                            <?= badgeStatusApplication($log->status) ?>
                                            <?php if ($log->telat) : ?>
                                                <span class="badge badge-danger border border-danger">Telat diisi</span>
                                            <?php endif ?>
                                        </div>
                                    </td>
                                    <td class="text-xs ps-4 font-weight-bold">
                                        <?php if ($log->status == 'rejected') : ?>
                                            <a href="/kehadiran/<?= $log->id ?>" class="badge border border-1 border-dark text-dark btn-edit" title="Edit Data"><i class="fas fa-edit"></i></a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
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
        const dataTableBasic = new simpleDatatables.DataTable("#tableLogBook", {
            searchable: false,
            fixedHeight: true
        });

        $('#keterangan').change(function() {
            if ($(this).val() != 'hadir') {
                $('#jam_keluar').attr('disabled', true);
                $('#kegiatan').attr('disabled', true);
                $('#jam_masuk').attr('disabled', true);
            } else {
                $('#jam_keluar').attr('disabled', false);
                $('#kegiatan').attr('disabled', false);
                $('#jam_masuk').attr('disabled', false);
            }
        });

        $('.form-absen').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/kehadiran/store',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    data.success ? Swal.fire({
                        title: 'Berhasil!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    }) : Swal.fire({
                        title: 'Gagal!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>
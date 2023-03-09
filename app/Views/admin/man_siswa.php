<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row mb-5">
    <div class="col-12">
        <div class="card card-body p-3">
            <div class="d-flex justify-content-between align-items-center px-2">
                <h6>
                    Table Siswa
                </h6>
                <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#mtsiswa">
                    <i class="fas fa-plus me-1"></i>
                    Siswa
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-stripped" id="tbsiswa">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIS</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Angkatan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($siswa as $s) : ?>
                            <?php if (in_array('siswa', $s->getRoles())) : ?>
                                <tr>
                                    <td class="text-xs ps-4 font-weight-bold"><?= $no++; ?></td>
                                    <td class="text-xs ps-4 font-weight-bold"><div class="badge badge-dark"><?= $s->nis; ?></div></td>
                                    <td class="text-xs ps-4 font-weight-bold"><?= $s->nama; ?></td>
                                    <td class="text-xs ps-4 font-weight-bold"><?= $s->kelas; ?></td>
                                    <td class="text-xs ps-4 font-weight-bold"><?= $s->angkatan; ?></td>
                                    <td class="text-xs ps-4 font-weight-bold">
                                        <button class="badge border border-1 border-danger text-danger btn-destroy" data-item="<?= $s->id; ?>"><i class="fas fa-trash"></i></button>
                                        <a href="/siswa/edit/<?= $s->username ?>" class="badge border border-1 border-dark text-dark"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal Tambah Siswa -->
<div class="modal fade" id="mtsiswa" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="mtsiswa" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0">
                        <span class="h5">Tambah Siswa</span><br>
                        Tambah data siswa magang
                    </div>
                    <div class="card-body">
                        <form role="form text-left" id="fasiswa">
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group input-group-outline mb-3" data-bs-toggle="tooltip" title="NIS siswa akan terisi otomatis ketika memilih angkatan" data-container="body" data-animation="true">
                                        <label for="nis" class="form-label">NIS</label>
                                        <input type="text" name="nis" id="nis" class="form-control form-control-muted" value="0" readonly>
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="hp" class="form-label">Nomor Hp/Wa</label>
                                        <input type="number" name="hp" id="hp" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="kelas" class="form-label">Kelas</label>
                                        <select name="kelas" id="kelas" class="form-control">
                                            <option value=""></option>
                                            <?php foreach ($jurusan as $j) : ?>
                                                <option value="<?= "XI " . $j->nama_jurusan ?>">XI <?= $j->nama_jurusan ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="angkatan" class="form-label">Angkatan</label>
                                        <select name="angkatan" id="angkatan" class="form-control">
                                            <option value=""></option>
                                            <?php foreach ($angkatan as $a) : ?>
                                                <option data-tahun="<?= $a->tahun ?>" value="<?= $a->id ?>"><?= $a->tahun ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group input-group-outline mb-3">
                                        <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Alamat Lengkap"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center gap-3 d-flex align-items-center justify-content-end mt-4">
                                <button type="button" class="btn btn-round bg-gradient-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-round bg-gradient-dark" required>Simpan</button>
                            </div>
                        </form>
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
        const dataTableBasic = new simpleDatatables.DataTable("#tbsiswa", {
            searchable: false,
            fixedHeight: true,
        });

        $('#fasiswa #angkatan').on('change', function() {
            if ($(this).val() != "") {
                $(this).parent().addClass('is-filled');
                $('#fasiswa #nis').parent().addClass('is-filled');
                const year = $(this).find(':selected').data('tahun').toString().substr(2, 2);
                const random = Math.floor(100000 + Math.random() * 900000);
                
                $('#fasiswa #nis').val(year + "." + random);
            } else {
                $(this).parent().removeClass('is-filled');
                $('#fasiswa #nis').val('');
                $('#fasiswa #nis').parent().removeClass('is-filled');
            }
        });

        $('#fasiswa #kelas').on('change', function() {
            if ($(this).val() != "") {
                $(this).parent().addClass('is-filled');
            } else {
                $(this).parent().removeClass('is-filled');
            }
        });

        // fasiswa submit
        $("#fasiswa").on("submit", function(s) {
            s.preventDefault(), $.ajax({
                url: "/siswa/store",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(s) {
                    s.success ? Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: s.message,
                        showConfirmButton: !1,
                        timer: 1500
                    }).then(s => {
                        $("#mtsiswa").modal("hide"), $("#fasiswa")[0].reset(), $("#kelas").siblings("label").removeClass("d-none"), $("#angkatan").siblings("label").removeClass("d-none"), location.reload()
                    }) : Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: s.message,
                        showConfirmButton: !0
                    }).then(s => {
                        s.isConfirmed && ($("#mtsiswa").modal("hide"), $("#fasiswa")[0].reset(), $("#kelas").siblings("label").removeClass("d-none"), $("#angkatan").siblings("label").removeClass("d-none"), location.reload())
                    })
                }
            })
        });

        // tbsiswa btn-destroy
        $("#tbsiswa tbody").on("click", ".btn-destroy", function() {
            let t = $(this).data("item");
            Swal.fire({
                icon: "warning",
                title: "Hapus Data",
                text: "Apakah anda yakin ingin menghapus data ini?",
                showCancelButton: !0,
                confirmButtonText: "Ya, Hapus"
            }).then(e => {
                e.isConfirmed && $.ajax({
                    url: "/siswa/destroy/" + t,
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
        });
    });
</script>
<?= $this->endSection(); ?>
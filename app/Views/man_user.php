<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row mb-5">
    <div class="col-12">
        <div class="card card-body p-3">
            <div class="d-flex justify-content-between align-items-center px-2">
                <h6>
                    Table Pengelola
                </h6>
                <button class="btn btn-sm btn-dark" id="btnAddPengelola" data-bs-toggle="modal" data-bs-target="#mtPengelola">
                    <i class="fas fa-plus me-1"></i>
                    Pengelola
                </button>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-md-6">
                    <div class="input-group input-group-outline mb-3">
                        <label for="filroles" class="form-label">Group</label>
                        <select name="filroles" id="filroles" class="form-control">
                            <option value=""></option>
                            <option value="pembimbing">Pembimbing</option>
                            <option value="admin">Admin</option>
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
                <table class="table table-hover table-stripped" id="tbPengelola">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hp</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Group</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($user as $u) : ?>
                            <tr>
                                <td class="text-xs ps-4 font-weight-bold"><?= $i++ ?></td>
                                <td class="text-xs ps-4 font-weight-bold"><?= $u->nama ?></td>
                                <td class="text-xs ps-4 font-weight-bold"><?= $u->username ?></td>
                                <td class="text-xs ps-4 font-weight-bold"><?= $u->no_hp ?></td>
                                <td class="text-xs ps-4 font-weight-bold">
                                    <a class="opacity-7" href="mailto:<?= $u->email ?>"><?= $u->email ?> <i class="ps-1 far fa-envelope"></i></a>
                                </td>
                                <td class="text-xs ps-4 font-weight-bold"><?= implode(", ", $u->getRoles()) ?></td>
                                <td class="text-xs ps-4 font-weight-bold">
                                    <button class="badge border border-1 border-danger text-danger btn-destroy" data-item="<?= $u->id; ?>"><i class="fas fa-trash"></i></button>
                                    <button class="badge border border-1 border-dark text-dark btn-edit" data-item="<?= $u->id; ?>"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal Tambah Pengelola -->
<div class="modal fade" id="mtPengelola" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="mtPengelola" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0">
                        <span class="h5" id="modalTitle">Tambah Pengelola</span><br>
                        <span id="modalSubTitle">Tambah data Pengelola magang</span>
                    </div>
                    <div class="card-body">
                        <form role="form text-left" data-action="" id="fauser">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" id="username" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="hp" class="form-label">Nomor Hp/Wa</label>
                                        <input type="number" name="hp" id="hp" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center gap-3 d-flex align-items-center justify-content-end mt-4">
                                <button type="button" class="btn btn-round bg-gradient-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-round bg-gradient-info" required>Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('topsc') ;?>
<link rel="stylesheet" href="/assets/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ;?>



<?= $this->section('bottomsc'); ?>
<script src="/assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
<script src="/assets/js/plugins/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        var tbPengelola = $("#tbPengelola").DataTable({
            dom: '<"row"<"col-12"tr>><"row mt-2 px-3"<"col-12 col-md-6"i><"col-12 col-md-6"p>>',
            pageLength: 10,
            language: {
                paginate: {
                    next: '<i class="fas fa-angle-right"></i>',
                    previous: '<i class="fas fa-angle-left"></i>'
                }
            },
        });

        $('#filroles').on('change', function() {
            $(this).val() == "" ? $(this).parent().removeClass('is-filled') : $(this).parent().addClass('is-filled');
            tbPengelola.columns(5).search($(this).val()).draw();
        });

        $('#filsearch').on('keyup', function() {
            tbPengelola.search($(this).val()).draw();
        });

        $("#btnAddPengelola").on('click', function() {
            $("#modalTitle").text("Tambah Pengelola");
            $("#modalSubTitle").text("Tambah data Pengelola magang");

            $("#fauser")[0].reset();
            $("#fauser").find('.form-control').each(function() {
                $(this).parent().removeClass('is-filled');
            })

            $("#fauser").data('action', 'store');
        })

        // fauser submit
        $("#fauser").on('submit', function(s) {
            s.preventDefault(),
                $.ajax({
                    url: $(this).data('action') == 'store' ? "/user/store" : $(this).data('action') == 'update' ? "/user/update" : "",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(s) {
                        console.log(s);
                        s.success ? Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: s.message,
                            showConfirmButton: !1,
                            timer: 1500
                        }).then(s => {
                            location.reload()
                        }) : Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: s.message,
                            showConfirmButton: !1,
                            timer: 1500
                        })
                    }
                })
        })

        $("#tbPengelola tbody").on('click', '.btn-edit', function() {
            $("#fauser").data('action', 'update');

            const item = $(this).data('item');
            const nama = $(this).parent().parent().find('td:eq(1)').text();
            const user = $(this).parent().parent().find('td:eq(2)').text();
            const hp = $(this).parent().parent().find('td:eq(3)').text();
            const email = $(this).parent().parent().find('td:eq(4)').text();

            // Modal
            $("#modalTitle").text("Edit Pengelola");
            $("#modalSubTitle").text("Edit data Pengelola magang");
            $("#mtPengelola").modal('show');

            // Form
            $("#fauser input[name='nama']").val(nama);
            $("#fauser input[name='nama']").parent().addClass('is-filled');
            $("#fauser input[name='username']").val(user);
            $("#fauser input[name='username']").parent().addClass('is-filled bg-gray-300');
            $("#fauser input[name='username']").attr('readonly', true);
            $("#fauser input[name='hp']").val(hp);
            $("#fauser input[name='hp']").parent().addClass('is-filled');
            $("#fauser input[name='email']").val(email);
            $("#fauser input[name='email']").parent().addClass('is-filled');
            $("#fauser").append(`<input type="hidden" name="item" value="${item}">`);
            $("#fauser").append(`<input type="hidden" name="old_email" value="${email}">`);
        })

        // tbPengelola btn-destroy
        $("#tbPengelola tbody").on("click", ".btn-destroy", function() {
            let t = $(this).data("item");
            Swal.fire({
                icon: "warning",
                title: "Hapus Data",
                text: "Apakah anda yakin ingin menghapus data ini?",
                showCancelButton: !0,
                confirmButtonText: "Ya, Hapus"
            }).then(e => {
                e.isConfirmed && $.ajax({
                    url: "/user/destroy/" + t,
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
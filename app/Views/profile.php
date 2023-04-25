<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<style>
    li.errors:not(:last-child) {
        margin-bottom: 7px;
    }

    li.errors {
        text-transform: capitalize;
        font-size: 14px;
    }
</style>
<div class="row mb-5">
    <div class="col-lg-3">
        <div class="card position-sticky top-3">
            <ul class="nav flex-column bg-white border-radius-lg p-3">
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex" data-scroll="" href="#profile">
                        <i class="material-icons text-lg me-2">person</i>
                        <span class="text-sm">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex" data-scroll="" href="#password">
                        <i class="material-icons text-lg me-2">key</i>
                        <span class="text-sm">Password</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php $data = in_groups('admin') || in_groups('pembimbing') ? getPembimbingData(user_id()) : getSiswaData(user_id()) ?>
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card card-body p-4 mb-4" id="profile">
            <div class="mb-3">
                <h4 class="m-0 p-0 d-flex align-items-center gap-2"><?= $data->nama ?> <span class="text-sm" title="Username" data-bs-toggle="tooltip">( <?= $data->username ?> )</span></h4>
                <div class="text-gray-400 text-xs"><abbr title="waktu akun dibuat"><?= $data->created_at ?></abbr></div>
            </div>

            <?php if (in_groups('siswa')) : ?>
                <div class="mb-2 d-flex gap-2 align-items-center text-sm">
                    <i class="fa fa-user"></i>
                    <div class="text-gray-800"><?= $data->nis ?></div>
                </div>
            <?php endif ?>

            <div class="mb-2 d-flex gap-2 align-items-center text-sm">
                <i class="fa fa-user-cog"></i>
                <div class="text-gray-800"><?= implode(',', user()->getRoles()) ?></div>
            </div>

            <div class="mb-2 d-flex gap-2 align-items-center text-sm">
                <i class="fa fa-envelope"></i>
                <div class="text-gray-800"><?= $data->uemail ?></div>
            </div>

            <div class="mb-2 d-flex gap-2 align-items-center text-sm">
                <i class="fa fa-phone"></i>
                <div class="text-gray-800"><?= $data->no_hp ?></div>
            </div>

            <?php if (in_groups('siswa')) : ?>
                <div class="mb-2 d-flex gap-2 align-items-center text-sm">
                    <i class="fa fa-home"></i>
                    <div class="text-gray-800"><?= $data->alamat ?></div>
                </div>
            <?php endif ?>

            <div class="mt-4 d-flex justify-content-end mb-0">
                <button class="btn btn-sm bg-gradient-dark m-0" data-bs-toggle="modal" data-bs-target="#userEdit">EDIT</button>
            </div>
        </div>

        <div class="card card-body p-4 mb-4" id="password">
            <div class="mb-4">
                <h4 class="m-0 p-0">Password</h4>
                <div class="text-gray-400 text-sm">Ubah password akun anda</div>
            </div>

            <?php if (session('errors')) : ?>
                <div class="badge border badge-danger border-danger w-100 mb-3" style="text-align: left;">
                    <ul class="list-unstyled mb-0 p-2">
                        <?php foreach (session('errors') as $error) : ?>
                            <li class="errors"><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <?php if (session('error')) : ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
            <?php endif ?>

            <form method="post">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="input-group input-group-outline">
                            <label for="email" class="form-label"><?= lang('Auth.email') ?></label>
                            <input type="text" id="email" readonly class="form-control" name="email" value="<?= user()->email ?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="input-group input-group-outline">
                            <label for="password" class="form-label"><?= lang('Auth.password') ?></label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="input-group input-group-outline">
                            <label for="password_confirm" class="form-label"><?= lang('Auth.repeatPassword') ?></label>
                            <input type="password" class="form-control" id="password_confirm" name="pass_confirm">
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm bg-gradient-dark m-0">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal userEdit -->
<div class="modal fade" id="userEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="mejurusan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h5 class="m-0 p-0">Edit Data</h5>
                        <p class="mb-0 p-0 text-xs">Edit detail user</p>
                    </div>
                    <div class="card-body">
                        <div class="badge badge-info border border-info w-100 mb-3" style="white-space: normal !important; text-align: left; text-transform: capitalize; font-size: 14px;">
                            <div class="p-2">
                                <div class="d-flex gap-2 mb-2">
                                    <i class="fa fa-info"></i>
                                    PERHATIAN !
                                </div>
                                <div style="font-weight: 400; line-height: .45cm;" class="mb-2">
                                    Jika terdapat kesalahan data, silahkan menggantinya dengan form dibawah ini, dengan mengisi data yang benar. <br>
                                </div>
                                <div style="font-weight: 400;">
                                    Jika <strong>NIS</strong> dan <strong>angkatan</strong> tidak sesuai, silahkan hubungi admin.
                                </div>
                            </div>
                        </div>
                        <form method="post" id="fedetail">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="input-group input-group-outline">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data->nama ?>" required>
                                    </div>
                                </div>

                                <div class="<?= !in_groups('siswa') ? 'col-md-12' : 'col-md-6' ?> mb-3">
                                    <div class="input-group input-group-outline">
                                        <label for="hp" class="form-label">Nomor HP</label>
                                        <input type="text" class="form-control" id="hp" name="no_hp" value="<?= $data->no_hp ?>" required>
                                    </div>
                                </div>
                                <div class="<?= !in_groups('siswa') ? 'col-md-12' : 'col-md-6' ?> mb-3">
                                    <div class="input-group input-group-outline">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $data->uemail ?>" required>
                                    </div>
                                </div>
                                <?php if (in_groups('siswa')) : ?>
                                    <div class="col-12 mb-3">
                                        <div class="input-group input-group-outline">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <select name="kelas" id="kelas" class="form-control" required>
                                                <option value=""></option>
                                                <?php foreach ($jurusan as $j) : ?>
                                                    <option <?= in_array($j->nama_jurusan, explode(" ", $data->kelas)) ? 'selected' : '' ?> value="<?= "XI " . $j->nama_jurusan ?>">XI <?= $j->nama_jurusan ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="input-group input-group-outline">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control" rows="3" required><?= $data->alamat ?></textarea>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-sm bg-gradient-secondary shadow m-0" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-sm bg-gradient-dark m-0">SIMPAN</button>
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
<script src="/assets/js/plugins/sweetalert.min.js"></script>
<?php if (session('success')) : ?>
    <script>
        Swal.fire({
            title: 'Sukses!',
            icon: 'success',
            text: '<?= session("success") ?>',
            buttons: false,
        });
    </script>
<?php endif ?>

<script>
    $(document).ready(function() {
        // fedetail
        $("#fedetail").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= in_groups('admin') || in_groups('pembimbing') ? '/user/profile/update' : (in_groups('siswa') ? '/siswa/profile/update' : '') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                dataType: "json",
                success: function(s) {
                    s.success ? Swal.fire({
                        title: 'Sukses!',
                        icon: 'success',
                        text: s.message,
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(() => {
                        location.reload();
                    }) : Swal.fire({
                        title: 'Gagal!',
                        icon: 'error',
                        text: s.message,
                    });
                },
                error: function(data) {
                    Swal.fire({
                        title: 'Gagal!',
                        icon: 'error',
                        text: 'Terjadi kesalahan, silahkan coba lagi',
                    });
                }
            });
        });

        // if nama not empty
        if ($('#kelas').val() != '') {
            $('#kelas').parent().addClass('is-filled');
        }

        // kelas on change
        $('#kelas').on('change', function() {
            if ($(this).val() != '') {
                $(this).parent().addClass('is-filled');
            } else {
                $(this).parent().removeClass('is-filled');
            }
        });

        // if alamat not empty
        if ($('#alamat').val() != '') {
            $('#alamat').parent().addClass('is-filled');
        }

        // alamat on change
        $('#alamat').on('change', function() {
            if ($(this).val() != '') {
                $(this).parent().addClass('is-filled');
            } else {
                $(this).parent().removeClass('is-filled');
            }
        });
    });
</script>
<?= $this->endSection(); ?>
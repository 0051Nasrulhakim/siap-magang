<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row mb-5">
    <div class="col-lg-3">
        <div class="card position-sticky top-3">
            <ul class="nav flex-column bg-white border-radius-lg p-3">
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex" data-scroll="" href="#jurusan">
                        <i class="material-icons text-lg me-2">bookmark</i>
                        <span class="text-sm">Jurusan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark d-flex" data-scroll="" href="#angkatan">
                        <i class="material-icons text-lg me-2">123</i>
                        <span class="text-sm">Angkatan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card card-body p-4 mb-4" id="jurusan">
            <div class="row">
                <div class="col-12 col-md-4">
                    <h6>Manajemen Jurusan</h6>
                    <form role="form text-left" id="fajurusan">
                        <div class="">
                            <div class="input-group input-group-outline">
                                <label class="form-label" for="njurusan">Nama Jurusan</label>
                                <input type="text" class="form-control" id="njurusan" name="jurusan">
                            </div>
                            <div class="text-center pt-2">
                                <button type="submit" class="btn btn-round bg-dark text-white w-100" required>Tambahkan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-8">
                    <div class="table-responsive">
                        <table id="tblJurusan" class="table table-hover align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="material-icons d-flex justify-content-end">tag</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($jurusan as $j) : ?>
                                    <tr>
                                        <td class="text-xs ps-4 font-weight-bold"><?= $no++; ?></td>
                                        <td class="text-xs ps-4 font-weight-bold"><?= $j->nama_jurusan; ?></td>
                                        <td class="text-xs ps-4 font-weight-bold gap-1 d-flex justify-content-end">
                                            <button class="badge border border-1 border-danger text-danger btn-destroy" data-item="<?= $j->id ?>"><i class="fa fa-trash"></i></button>
                                            <button class="badge border border-1 border-dark text-dark btn-edit" data-item="<?= $j->id ?>" data-iname="<?= $j->nama_jurusan ?>" data-bs-toggle="modal" data-bs-target="#mejurusan"><i class="fa fa-pen"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body p-4 mb-4" id="angkatan">
            <div class="row">
                <div class="col-12 col-md-4">
                    <h6>Manajemen Angkatan</h6>
                    <form role="form text-left" id="faangkatan">
                        <div class="">
                            <div class="input-group input-group-outline">
                                <label class="form-label" for="angkatan">Angkatan</label>
                                <input type="number" min="0" class="form-control" id="angkatan" name="angkatan">
                            </div>
                            <div class="text-center pt-2">
                                <button type="submit" class="btn btn-round bg-dark text-white w-100" required>Tambahkan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-8">
                    <div class="table-responsive">
                        <table id="tblAngkatan" class="table table-hover align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">tahun</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="material-icons d-flex justify-content-end">tag</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($angkatan as $a) : ?>
                                    <tr>
                                        <td class="text-xs ps-4 font-weight-bold"><?= $no++; ?></td>
                                        <td class="text-xs ps-4 font-weight-bold"><?= $a->tahun; ?></td>
                                        <td class="text-xs ps-4 font-weight-bold gap-1 d-flex justify-content-end">
                                            <button class="badge border border-1 border-danger text-danger btn-destroy" data-item="<?= $a->id ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Jurusan -->
<div class="modal fade" id="mejurusan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="mejurusan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h5 class="">Tambah Jurusan</h5>
                        <p class="mb-0">
                            Tambahkan jurusan baru untuk kelas yang akan dibuat
                        </p>
                    </div>
                    <div class="card-body">
                        <form role="form text-left" id="fejurusan">
                            <input type="hidden" class="form-control" id="ijurusan" name="ijurusan">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label" for="njurusan">Nama Jurusan</label>
                                <input type="text" class="form-control" id="njurusan" name="jurusan">
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100" required>Simpan</button>
                                <button type="button" class="btn btn-round bg-gradient-light btn-lg w-100" data-bs-dismiss="modal">Batal</button>
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

<script>
    $(document).ready(function() {
        $('#fajurusan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('jurusan/store'); ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Jurusan berhasil ditambahkan',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Jurusan gagal ditambahkan',
                            showConfirmButton: true,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                }
            });
        });
        
        $('#faangkatan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('angkatan/store'); ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Tahun angkatan berhasil ditambahkan',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Tahun angkatan gagal ditambahkan',
                            showConfirmButton: true,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                }
            });
        });

        // tblJurusan tbody tr td button.btn-destroy
        $("#tblJurusan tbody").on('click', 'button.btn-destroy', (function() {
            var items = $(this).data('item');
            // delete request
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('jurusan/destroy/'); ?>" + items,
                        type: "DELETE",
                        data: {
                            item: items
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Jurusan berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Jurusan gagal dihapus',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            }
                        }
                    });
                }
            });
        }));


        $("#tblJurusan tbody").on('click', 'button.btn-edit', (function() {
            const itemsName = $(this).data('iname');
            const items = $(this).data('item');

            $('#fejurusan #njurusan').val(itemsName);
            $('#fejurusan #ijurusan').val(items);

            $('#fejurusan').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= base_url('jurusan/update'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Jurusan berhasil diubah',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                $('#mejurusan').modal('hide');
                                $('#fejurusan')[0].reset();
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Jurusan gagal diubah',
                                showConfirmButton: true,
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    }
                });
            });
        }));

        // tblJurusan tbody tr td button.btn-destroy
        $("#tblAngkatan tbody").on('click', 'button.btn-destroy', (function() {
            var items = $(this).data('item');
            // delete request
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('angkatan/destroy/'); ?>" + items,
                        type: "DELETE",
                        data: {
                            item: items
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Tahun angkatan berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Tahun angkatan gagal dihapus',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            }
                        }
                    });
                }
            });
        }));
    });
</script>
<?= $this->endSection(); ?>
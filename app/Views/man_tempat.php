<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row mb-5">
    <div class="col-12">
        <div class="card card-body p-3">
            <div class="d-flex justify-content-between align-items-center px-2">
                <h6>
                    Table Tempat Magang
                </h6>
                <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#mtTempatMagang">
                    <i class="fas fa-plus me-1"></i>
                    Tempat Magang
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-stripped" id="tbTempatMagang">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Instansi</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kontak</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kuota</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pembimbing</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($tempat as $t) : ?>
                            <tr>
                                <td class="text-xs ps-4 font-weight-bold"><?= $i++ ?></td>
                                <td class="text-xs ps-4 font-weight-bold"><?= $t->nama ?></td>
                                <td class="text-xs ps-4 font-weight-bold">
                                    <a href="mailto:<?= $t->email ?>" class="opacity-7 bg-gray-300 px-3 py-1 rounded-pill">Mail<i class="far fa-envelope ms-1"></i></a>
                                    <a href="telp:<?= $t->hp ?>" class="opacity-7 bg-gray-300 px-3 py-1 rounded-pill">phone<i class="fas fa-phone ms-1"></i></a>
                                </td>
                                <td class="text-xs ps-4 font-weight-bold capitalize text-center">
                                    <div class="badge badge-<?= $t->status == 'buka' ? 'success' : 'secondary' ?>"><?= strtoupper($t->status) ?></div>
                                </td>
                                <td class="text-xs ps-4 font-weight-bold text-center"><?= $t->kuota ?></td>
                                <td class="text-xs ps-4 font-weight-bold"><?= $t->pembimbing ?></td>
                                <td class="text-xs ps-4 font-weight-bold">
                                    <button class="badge border border-1 border-danger text-danger btn-destroy" title="Hapus data" data-item="<?= $t->id; ?>"><i class="fas fa-trash"></i></button>
                                    <button class="badge border border-1 border-warning text-warning btn-edit-status" title="Update Status" data-stts="<?= $t->status == 'buka' ? 'tutup' : 'buka' ?>" data-item="<?= $t->id; ?>"><i class="fas fa-tag"></i></button>
                                    <a href="/tempat/edit/<?= $t->id ?>" class="badge border border-1 border-dark text-dark btn-edit" title="Edit Data"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal update status -->
<div class="modal fade" id="mustatus" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="mtTempat Magang" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0">
                        <span class="h5">Update Status Tempat Magang</span><br>
                        Ubah status tempat magang, buka atau tutup
                    </div>
                    <div class="card-body">
                        <form role="form text-left" id="festatus" enctype="multipart/form-data">
                            <div class="input-group input-group-outline mb-3 is-filled">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="buka">Buka</option>
                                    <option value="tutup">Tutup</option>
                                </select>
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

<!-- modal Tambah Tempat Magang -->
<div class="modal fade" id="mtTempatMagang" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="mtTempat Magang" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0">
                        <span class="h5">Tambah Tempat Magang</span><br>
                        Tambah data Tempat Magang magang
                    </div>
                    <div class="card-body">
                        <form role="form text-left" id="fatempat" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-outline mb-3">
                                                <label for="kontak" class="form-label">Hp / Wa</label>
                                                <input type="text" name="kontak" id="kontak" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-outline mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" id="email" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6 col-md-3">
                                            <div class="input-group input-group-outline mb-3">
                                                <label for="kuota" class="form-label">Kuota</label>
                                                <input type="number" value="0" min="0" max="100" name="kuota" id="kuota" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="input-group input-group-outline mb-3 is-filled">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="buka">Buka</option>
                                                    <option value="tutup">Tutup</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="hidden" name="pembimbing" id="pemval">
                                            <div class="input-group input-group-outline mb-3">
                                                <label for="pembimbing" class="form-label">Pembimbing</label>
                                                <input type="text" name="autopem" id="autopem" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-outline mb-3">
                                                <textarea name="alamat" id="alamat" rows="4" class="form-control" placeholder="Alamat"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-outline mb-3">
                                                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" placeholder="Deskripsi Singkat"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="quildes mb-3"></div>
                                        <textarea name="deskripsi" id="tadess" class="form-control d-none" style="display: none !important; visibility: hidden !important;"></textarea>
                                    </div>
                                </div>

                                <!-- <div class="col-12">
                                    <div class="input-group input-group-outline mb-3">
                                        <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" placeholder="Deskripsi Lengkap (Jobdesk, gaji, dll ...)"></textarea>
                                    </div>
                                </div> -->
                                <div class="col-12">
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
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


<?= $this->section('topsc'); ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<?= $this->endSection(); ?>



<?= $this->section('bottomsc'); ?>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="/assets/js/plugins/datatables.js"></script>
<script src="/assets/js/plugins/sweetalert.min.js"></script>
<script src="/assets/js/plugins/quill.min.js"></script>

<script>
    $(document).ready(function() {
        const dataTableBasic = new simpleDatatables.DataTable("#tbTempatMagang", {
            searchable: false,
            fixedHeight: true
        });

        const pem = <?= $pembimbing_json; ?>; 

        $("#autopem").autocomplete({
            appendTo: "#mtTempatMagang",
            source: pem,
            minLength: 0,
            select: function(event, ui) {
                $('#pemval').val(ui.item.num);
            },
        });

        var quill = new Quill('.quildes', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'align': []
                    }],
                    ['clean']
                ]
            }
        });

        $('#fatempat').on('submit', function(e) {
            e.preventDefault();
            if (quill.root.innerHTML == '<p><br></p>' || quill.root.innerHTML == '<p></p>') {
                Swal.fire({
                    title: "Perhatian",
                    icon: "warning",
                    text: "Keterangan tidak boleh kosong",
                    showConfirmButton: 1,
                });
                return false;
            } else {
                $("#tadess").val(quill.root.innerHTML);
            }

            var data = new FormData(this);

            $.ajax({
                url: '/tempat/store',
                method: 'post',
                data: data,
                processData: false,
                contentType: false,
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
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $("#tbTempatMagang tbody").on('click', '.btn-destroy', function() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                html: `Anda akan menghapus data tempat magang <code>${$(this).parents('tr').find('td').eq(1).text()}</code>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/tempat/destroy/' + $(this).data('item'),
                        method: 'delete',
                        data: {
                            item: $(this).data('item')
                        },
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
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            })
        })

        $("#tbTempatMagang tbody").on('click', '.btn-edit-status', function() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                html: `Anda akan merubah status tempat magang <code>${$(this).parents('tr').find('td').eq(1).text()}</code> menjadi <b>${$(this).data('stts')}</b>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/tempat/status/update',
                        method: 'post',
                        data: {
                            item: $(this).data('item'),
                            status: $(this).data('stts')
                        },
                        success: function(s) {
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
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            })
        })
    });
</script>
<?= $this->endSection(); ?>
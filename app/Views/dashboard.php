<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<style>
    .t-w:hover,
    .t-w:active,
    .t-w:focus,
    .t-w a:active {
        color: white !important;
    }
</style>
<div class="row">
    <div class="col-lg-6 col-12 mb-3 mt-3 mb-lg-0 mt-lg-0">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-header p-3 py-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons text-white opacity-10">
                                account_circle
                            </i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Siswa (angkatan)</p>
                            <h4 class="mb-0"><?= count($siswa) ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-xs">
                            Jumlah keseluruhan siswa
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-header p-3 py-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons text-white opacity-10">
                                business
                            </i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Tempat Magang</p>
                            <h4 class="mb-0"><?= count($tempat) ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-xs">
                            Jumlah tempat magang yang terdaftar
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header p-3 py-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons text-white opacity-10">
                                business
                            </i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Tempat Buka</p>
                            <h4 class="mb-0"><?= $tempat_buka ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-xs">
                            Jumlah tempat magang buka
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                <div class="card">
                    <div class="card-header p-3 py-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons text-white opacity-10">
                                business
                            </i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Tempat Tutup</p>
                            <h4 class="mb-0"><?= $tempat_tutup ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-xs">
                            Jumlah tempat magang tutup
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12 mt-lg-0">
        <div class="card h-100" title="form tambah pengumuman" data-bs-toggle="tooltip">
            <div class="card-body pb-2">
                <form method="post" id="formPengumuman" enctype="multipart/form-data">
                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" required>
                    </div>

                    <div id="quilket" class="mb-3"></div>
                    <textarea name="keterangan" id="taket" class="form-control d-none" style="display: none !important; visibility: hidden !important;" rows="3"></textarea>

                    <div class="input-group input-group-outline mb-3">
                        <input type="file" class="form-control" name="file" accept="application/pdf,image/*">
                        <input type="hidden" name="oid" value="<?= user_id() ?>">
                    </div>

                    <div class="d-flex justify-content-end align-items-center w-100">
                        <button type="submit" class="btn btn-sm bg-gradient-dark">KIRIM</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card card-body">
            <h5 class="px-4 pt-2">Dafar Pengumuman / Informasi Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-hover table-stripped" id="table_pengumuman">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xs font-weight-bold opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bold opacity-7">Judul</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bold opacity-7">Oleh</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bold opacity-7">dibuat</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bold opacity-7">lampiran</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bold opacity-7">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pengumuman as $p) : ?>
                            <tr data-iin="<?= $p->id ?>">
                                <td class="text-sm ps-4"><?= $i++ ?></td>
                                <td class="text-sm ps-4"><?= $p->judul ?></td>
                                <td class="text-sm ps-4"><?= $p->pembimbing ?></td>
                                <td class="text-xs ps-4"><?= $p->created_at ?></td>
                                <td class="text-xs ps-4">
                                    <?php if (!is_null($p->lampiran)) : ?>
                                        <?php if (filter_var($p->lampiran, FILTER_VALIDATE_URL)) : ?>
                                            <a href="<?= $p->lampiran ?>" target="_blank" class="badge border border-1 border-secondary badge-secondary t-w">Lihat</a>
                                        <?php else : ?>
                                            <a href="<?= base_url('assets/lampiran/' . $p->lampiran) ?>" target="_blank" class="badge border border-1 border-secondary badge-secondary t-w">Lihat</a>
                                        <?php endif ?>
                                    <?php endif ?>
                                </td>
                                <td class="text-xs ps-4">
                                    <button class="badge badge-danger border border-danger btn-destroy" data-num="<?= $p->id ?>"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal detail pengumuman -->
<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body m-0 px-4 pt-4 pb-2">
                <div class="mb-4">
                    <div class="judul h5 font-weight-bold mb-1"></div>
                    <div class="isi">
                        <div class="d-flex align-items-center gap-1">
                            <span class="text-sm mb-2 oleh opacity-7 font-weight-bold"></span>
                            <span class="text-sm mb-2 sep opacity-7"></span>
                            <span class="text-sm mb-2 tanggal opacity-7"></span>
                        </div>
                        <div class="keterangan text-dark"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div class="lampiranmodal"></div>
                    <button type="button" class="btn btn-sm bg-gradient-secondary shadow" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('bottomsc'); ?>
<script src="/assets/js/plugins/datatables.js"></script>
<script src="/assets/js/plugins/sweetalert.min.js"></script>
<script src="../../assets/js/plugins/quill.min.js"></script>

<script>
    $(document).ready(function() {
        const dataTableBasic = new simpleDatatables.DataTable("#table_pengumuman", {
            searchable: true,
            fixedHeight: true,
            perPage: 5,
        });

        var quill = new Quill('#quilket', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'script': 'sub'}, {'script': 'super'}],
                    [{'color': []}, {'background': []}],
                    [{'align': []}],
                    ['clean']
                ]
            }
        });

        $('#table_pengumuman').on('click', 'tbody tr td:not(:last-child):not(:nth-last-child(2))', function() {
            const id = $(this).parent().data('iin');

            $('.judul').text(''), $('.oleh').text(''), $('.sep').text(""), $('.tanggal').text(''), $('.keterangan').html(''), $('.lampiranmodal').html('');

            $.ajax({
                url: '/pengumuman/get/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    $('.judul').text('Loading ...');
                    $('#modalDetail').modal('show');
                    setTimeout(() => {
                        $('.judul').text(res.judul);
                        $('.oleh').text(res.pembimbing);
                        $('.sep').text("|");
                        $('.tanggal').text(res.created_at);
                        $('.keterangan').html(res.isi);

                        if (res.lampiran != null) {
                            if (res.lampiran.includes('http') || res.lampiran.includes('https')) {
                                $('.lampiranmodal').html(`<a href="${res.lampiran}" target="_blank" class="btn btn-sm bg-gradient-info shadow">Lihat Lampiran</a>`);
                            } else {
                                $('.lampiranmodal').html(`<a href="<?= base_url('assets/lampiran/') ?>${res.lampiran}" target="_blank" class="btn btn-sm bg-gradient-info shadow">Lihat Lampiran</a>`);
                            }
                        } else {
                            $('.lampiranmodal').html('');
                        }
                    }, 1000);
                },
            });
        });

        $("#table_pengumuman").on('click', '.btn-destroy', function() {
            Swal.fire({
                title: "Perhatian",
                icon: "warning",
                text: "Apakah anda yakin ingin menghapus pengumuman ini?",
                showCancelButton: 1,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.isConfirmed) {
                    const id = $(this).data('num');
                    $.ajax({
                        url: '/pengumuman/destroy/' + id,
                        type: 'DELETE',
                        dataType: 'JSON',
                        success: function(res) {
                            if (res.status == 200) {
                                Swal.fire({
                                    title: "Berhasil",
                                    icon: "success",
                                    text: res.message,
                                    showConfirmButton: !1,
                                    timer: 1500,
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal",
                                    icon: "error",
                                    text: res.message,
                                    showConfirmButton: 1,
                                });
                            }
                        },
                    });
                }
            });
        });

        $('#formPengumuman').on('submit', function(e) {
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
                $("#taket").val(quill.root.innerHTML);
            }
            
            const form = $(this);
            const data = new FormData(this);

            $.ajax({
                url: '/pengumuman/store',
                data: data,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    form.find('button[type=submit]').attr('disabled', true);
                    form.find('button[type=submit]').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading ...');
                },
                success: function(res) {
                    if (res.success) {
                        Swal.fire({
                            title: "Berhasil",
                            icon: "success",
                            text: res.message,
                            showConfirmButton: !1,
                            timer: 1500
                        }).then((value) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            icon: "error",
                            text: res.message,
                            showConfirmButton: !1,
                            timer: 1500
                        }).then((value) => {
                            location.reload()
                        });
                    }
                },
            });
        });

        // takerangan textarea
        // const ta = $('#taketerangan').find('textarea');
        // ta.on('focus', function() {
        //     $(this).parent().addClass('is-filled');
        // });

        // ta.on('focusout', function() {
        //     if ($(this).val() == '') {
        //         $(this).parent().removeClass('is-filled');
        //     }
        // });
    });
</script>
<?= $this->endSection(); ?>
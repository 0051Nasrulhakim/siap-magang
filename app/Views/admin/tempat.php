<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>

<!-- filter -->
<div class="mb-4 card card-body ">
    <h6>Filter Tempat Magang</h6>
    <div class="row">
        <div class="col-12 col-sm-5 col-md-4">
            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" role="tablist" id="filterStatus">
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 text-success active" data-bs-toggle="tab" href="javascript;;" data-status="buka" role="tab" aria-controls="preview" aria-selected="true">
                            <span class="material-icons align-middle mb-1 me-1">
                                done
                            </span>
                            Buka
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 text-danger" data-bs-toggle="tab" href="javascript;;" data-status="tutup" role="tab" aria-controls="code" aria-selected="false">
                            <span class="material-icons align-middle mb-1 me-1">
                                close
                            </span>
                            Tutup
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-12 col-sm-7 col-md-8">
            <div class="input-group input-group-outline">
                <input type="text" class="form-control" placeholder="Cari tempat magang" aria-label="Cari tempat magang" aria-describedby="button-addon2" id="search">
            </div>
        </div>
    </div>
</div>

<div class="row mb-5 row-instansi" data-masonry='{"percentPosition": true }'>
    <?php foreach ($tempat as $t) : ?>
        <?php
        if (filter_var($t->foto, FILTER_VALIDATE_URL)) {
            $foto = $t->foto;
        } else {
            $foto = '/assets/img/tempat_magang/' . $t->foto;
        }
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-xxl-3 mb-4 cardInstansi <?= $t->status ?>">
            <div class="card mt-4" data-animation="<?= empty(getApplicationSiswa(getSid(user_id()))) ? 'true' : 'false' ?>">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <a class="d-block blur-shadow-image">
                        <img src="<?= $foto ?>" alt="img-blur-shadow" height="200px" class="img-fluid shadow border-radius-lg">
                    </a>
                    <div class="colored-shadow" style="background-image: url(&quot;<?= $foto ?>&quot;);"></div>
                </div>
                <div class="card-body text-center">
                    <div class="<?= empty(getApplicationSiswa(getSid(user_id()))) ? 'mt-n6' : 'mt-n4' ?> mx-auto">
                        <?php if (empty(getApplicationSiswa(getSid(user_id())))) : ?>
                            <button class="btn bg-gradient-primary btn-sm mb-0 me-2 btn-daftar" data-instansi="<?= $t->nama ?>" data-uid="<?= getSid(user_id()) ?>" data-tid="<?= $t->id ?>" type="button" <?= $t->status == 'tutup' ? 'disabled' : '' ?>>Daftar</button>
                        <?php endif ?>
                    </div>
                    <h6 class="font-weight-normal mt-4"><?= $t->nama ?></h6>
                    <p class="mb-0"><?= $t->deskripsi ?></p>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div class="text-sm font-weight-normal my-auto" title="Kuota"><i class="fa fa-id-badge pe-1"></i> <?= $t->kuota ?></div>
                    <div class="text-sm my-auto"><?= $t->pembimbing ?></div>
                    <div class="badge badge-sm <?= $t->status == 'buka' ? 'badge-success' : 'badge-danger' ?>"><?= $t->status ?></div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection(); ?>

<?= $this->section('bottomsc'); ?>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" async></script>
<script src="/assets/js/plugins/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        var status = 'buka';
        sh(status);

        $('#search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('.cardInstansi').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            initMsnry();
        });

        $('#filterStatus a').on('click', function() {
            status = $(this).data('status');
            sh(status);
        });

        function sh(status) {
            $('.cardInstansi').each(function() {
                if ($(this).hasClass(status)) {
                    $(this).removeClass('d-none');
                } else {
                    $(this).addClass('d-none');
                }
            });
            initMsnry();
        }

        function initMsnry() {
            $('.row-instansi').masonry({
                itemSelector: '.cardInstansi',
                columnWidth: 0.5,
                percentPosition: true
            });
        }

        // btn-daftar onClick
        $('.btn-daftar').on('click', function() {
            var instansi = $(this).data('instansi');
            var uid = $(this).data('uid');
            var tid = $(this).data('tid');

            Swal.fire({
                title: 'Daftar Magang',
                text: "Apakah anda yakin ingin mendaftar magang di " + $(this).data('instansi') + "?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Daftar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/tempat/daftar',
                        type: 'post',
                        data: {
                            uid: uid,
                            tid: tid
                        },
                        success: function(data) {
                            data.success ? Swal.fire({
                                title: 'Berhasil',
                                text: "Anda berhasil mendaftar magang di " + instansi,
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/application';
                                }
                            }) : Swal.fire({
                                title: 'Gagal',
                                text: "Anda gagal mendaftar magang di " + instansi,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            })
                        }
                    })
                }
            })
        })
    })
</script>
<?= $this->endSection(); ?>
<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="mt-2">
    <div class="page-header min-height-300 border-radius-xl" style="background-image: url('/assets/img/tempat_magang/<?= $tempat->foto ?>');">
        <span class="mask bg-gradient-dark opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6 p-4">
        <div class="mb-4">
            <span class="h5">Edit Tempat Magang</span><br>
            Edit data Tempat Magang magang
        </div>
        <form role="form text-left" id="fetempat" enctype="multipart/form-data">
            <input type="hidden" name="old_foto" value="<?= $tempat->foto ?>">
            <input type="hidden" name="item" value="<?= $tempat->id ?>">
            <div class="row">
                <div class="col-12">
                    <div class="input-group input-group-outline mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $tempat->nama ?>">
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label for="kontak" class="form-label">Hp / Wa</label>
                                <input type="text" name="kontak" id="kontak" class="form-control" value="<?= $tempat->hp ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= $tempat->email ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3">
                                <label for="kuota" class="form-label">Kuota</label>
                                <input type="number" min="0" max="100" name="kuota" id="kuota" class="form-control" value="<?= $tempat->kuota ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3 is-filled">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option <?= $tempat->status == 'buka' ? 'selected' : ''  ?> value="buka">Buka</option>
                                    <option <?= $tempat->status == 'tutup' ? 'selected' : ''  ?> value="tutup">Tutup</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="alamat" id="alamat" rows="4" class="form-control" placeholder="Alamat"><?= $tempat->alamat ?></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" placeholder="Deskripsi"><?= $tempat->deskripsi ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group input-group-outline mb-3">
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                </div>
            </div>
            <div class="text-center gap-3 d-flex align-items-center justify-content-end mt-4">
                <a href="/man/tempat" class="btn btn-round bg-gradient-light">Batal</a>
                <button type="submit" class="btn btn-round bg-gradient-info" required>Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('bottomsc'); ?>
<script src="/assets/js/plugins/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.min.js"></script>

<script>
    $(document).ready(function() {
        $('#fetempat').on('submit', function(e) {
            e.preventDefault();
            var data = new FormData(this);

            $.ajax({
                url: '/tempat/update',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(s) {
                    s.success ? Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: s.message,
                        showConfirmButton: !1,
                        timer: 1500
                    }).then(s => {
                        window.location.href = '/man/tempat'
                    }) : Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: s.message,
                        showConfirmButton: 1,
                    })
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>
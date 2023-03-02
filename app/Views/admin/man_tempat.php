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
            <table class="table table-hover table-stripped" id="tbTempatMagang">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Instansi</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kuota</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kontak</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal Tambah Tempat Magang -->
<div class="modal fade" id="mtTempatMagang" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="mtTempat Magang" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0">
                        <span class="h5">Tambah Tempat Magang</span><br>
                        Tambah data Tempat Magang magang
                    </div>
                    <div class="card-body">
                        <form role="form text-left" id="fejurusan">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="hp" class="form-label">Hp / Wa</label>
                                        <input type="text" name="hp" id="hp" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="kuota" class="form-label">Kuota</label>
                                        <input type="number" min="0" max="100" name="kuota" id="kuota" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea name="alamat" id="alamat" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="file" name="foto" id="foto" class="form-control">
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

<?= $this->section('bottomsc'); ?>
<script src="/assets/js/plugins/datatables.js"></script>

<script>
    $(document).ready(function() {
        const dataTableBasic = new simpleDatatables.DataTable("#tbTempatMagang", {
            searchable: false,
            fixedHeight: true
        });
    });
</script>
<?= $this->endSection(); ?>
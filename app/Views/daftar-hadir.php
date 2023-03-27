<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h5>Form Absensi</h5>
                </div>
                <form class="form-absen" method="post">
                    <input type="hidden" name="uid" value="<?= user_id() ?>">
                    <div class="mb-3">
                        <div class="input-group input-group-outline">
                            <input readonly type="datetime-local" class="form-control bg-gray-300" name="tanggal" id="tanggal" value="<?= date('Y-m-d\TH:i'); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
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
                    <div class="mb-3">
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
                <div class="mb-4">
                    <h5>Daftar Kehadiran Anda</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
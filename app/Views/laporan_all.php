<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card card-body">
            <div class="mb-4">
                <span class="h5 mb-0 pb-0">Buat Laporan</span> <br>
                Generator laporan keseluruhan siswa magang
            </div>
            <div>
                <form action="/laporan/show" method="post">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-outline mb-3">
                                <label for="filtahun" class="form-label">Tahun</label>
                                <select name="tahun" id="filtahun" class="form-control">
                                    <option value=""></option>
                                    <?php foreach ($tahun as $a) : ?>
                                        <option value="<?= $a->tahun ?>"><?= $a->tahun ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-outline mb-3">
                                <label for="filangkatan" class="form-label">Angkatan</label>
                                <select name="angkatan" id="filangkatan" class="form-control">
                                    <option value=""></option>
                                    <?php foreach ($angkatan as $a) : ?>
                                        <option value="<?= $a->nama ?>"><?= $a->nama ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-outline mb-3">
                                <label for="filjurusan" class="form-label">Jurusan</label>
                                <select name="jurusan" id="filjurusan" class="form-control">
                                    <option value=""></option>
                                    <?php foreach ($jurusan as $j) : ?>
                                        <option value="<?= $j->nama_jurusan ?>"><?= $j->nama_jurusan ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-sm btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>


<?php $this->section('bottomsc') ?>
<!-- ready -->
<script>
    $(document).ready(function() {
        $('#filjurusan').val() == "" ? $('#filjurusan').parent().removeClass('is-filled') : $('#filjurusan').parent().addClass('is-filled');
        $('#filangkatan').val() == "" ? $('#filangkatan').parent().removeClass('is-filled') : $('#filangkatan').parent().addClass('is-filled');
        $('#filtahun').val() == "" ? $('#filstatus').parent().removeClass('is-filled') : $('#filstatus').parent().addClass('is-filled');

        $('#filjurusan').on('change', function() {
            $(this).val() == "" ? $(this).parent().removeClass('is-filled') : $(this).parent().addClass('is-filled');
        });

        $('#filangkatan').on('change', function() {
            $(this).val() == "" ? $(this).parent().removeClass('is-filled') : $(this).parent().addClass('is-filled');
        });

        $('#filtahun').on('change', function() {
            $(this).val() == "" ? $(this).parent().removeClass('is-filled') : $(this).parent().addClass('is-filled');
        });
    });
</script>
<?php $this->endSection(); ?>
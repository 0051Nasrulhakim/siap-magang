<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <span class="h5">Edit Data Siswa</span><br>
                Edut data siswa magang
            </div>
            <div class="card-body">
                <form role="form text-left" id="fesiswa">
                    <input type="hidden" name="items" value="<?= $siswa->id ?>">
                    <input type="hidden" name="old_nis" value="<?= $siswa->nis ?>">
                    <input type="hidden" name="old_email" value="<?= $siswa->email ?>">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3" data-bs-toggle="tooltip" title="NIS siswa akan terisi otomatis ketika memilih angkatan" data-container="body" data-animation="true">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" name="nis" id="nis" class="form-control" value="<?= $siswa->nis ?>" readonly required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= $siswa->email ?>" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label for="hp" class="form-label">Nomor Hp/Wa</label>
                                <input type="number" name="hp" id="hp" class="form-control" value="<?= $siswa->no_hp ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $siswa->nama ?>" required>
                            </div>
                            <div class="input-group input-group-outline mb-3 is-filled">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control" required>
                                    <option value=""></option>
                                    <?php foreach ($jurusan as $j) : ?>
                                        <option <?= $siswa->kelas == ("XI " . $j->nama_jurusan) ? 'selected' : '' ?> value="<?= "XI " . $j->nama_jurusan ?>">XI <?= $j->nama_jurusan ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <input type="hidden" name="angkatan" id="angval" value="<?= $siswa->num ?>">

                            <div class="input-group input-group-outline mb-3">
                                <label for="angkatan" class="form-label">Gelombang / Angkatan</label>
                                <input type="text" name="autoang" id="angkatan" class="form-control" value="<?= $siswa->angkatan . " - " . $siswa->tahun ?>" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Alamat Lengkap" required><?= $siswa->alamat ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center gap-3 d-flex align-items-center justify-content-end mt-4">
                        <a href="/man/siswa" class="btn btn-round bg-gradient-light">Batal</a>
                        <button type="submit" class="btn btn-round bg-gradient-dark" required>Simpan</button>
                    </div>
                </form>
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

<script>
    $(document).ready(function() {
        const nis_lama = $('#fesiswa input[name="old_nis"]').val();
        const year = nis_lama.substr(0, 2);
        const BASE_URL = "<?= base_url() ?>";

        $('#fesiswa #kelas').on('change', function() {
            if ($(this).val() != "") {
                $(this).parent().addClass('is-filled');
            } else {
                $(this).parent().removeClass('is-filled');
            }
        });

        function cekNis(nis) {
            $.ajax({
                url: "/siswa/ceknis",
                type: "POST",
                data: {
                    nis: nis
                },
                dataType: "JSON",
                success: function(data) {
                    return data.assigned;
                }
            });
        }

        $("#angkatan").autocomplete({
            source: `${BASE_URL}/angkatan/getangkatan`,
            autoFocus: true,
            select: function(event, ui) {
                $('#fesiswa #angval').val(ui.item.no);
                if (ui.item.tahun.substr(2, 2) == year) {
                    $('#fesiswa #nis').val(nis_lama);
                } else {
                    let nis = ui.item.tahun.substr(2, 2) + "." + Math.floor(100000 + Math.random() * 900000);
                    if (cekNis(nis)) {
                        while (cekNis(nis)) {
                            nis = ui.item.tahun.substr(2, 2) + "." + Math.floor(100000 + Math.random() * 900000);
                        }
                        $('#fesiswa #nis').val(nis);
                        $('#fesiswa #nis').parent().addClass('is-filled');
                    } else {
                        $('#fesiswa #nis').val(nis);
                        $('#fesiswa #nis').parent().addClass('is-filled');
                    }
                }
            },
        });

        // const nis = $('#fesiswa #nis').val();
        // const year = $('#fesiswa #angkatan').find(':selected').data('tahun');

        // $('#fesiswa #angkatan').on('change', function() {
        //     if ($(this).val() != "") {
        //         $(this).parent().addClass('is-filled');
        //         $('#fesiswa #nis').parent().addClass('is-filled');
        //         const thnBaru = $(this).find(':selected').data('tahun');

        //         if (thnBaru == year) {
        //             $('#fesiswa #nis').val(nis);
        //         } else {
        //             const thnBaru = $(this).find(':selected').data('tahun').toString().substr(2, 2);
        //             const random = Math.floor(100000 + Math.random() * 900000);
        //             $('#fesiswa #nis').val(thnBaru + "." + random);
        //         }
        //     } else {
        //         $(this).parent().removeClass('is-filled');
        //         $('#fesiswa #nis').val('');
        //         $('#fesiswa #nis').parent().removeClass('is-filled');
        //     }
        // });

        $("#fesiswa").on('submit', function(s) {
            s.preventDefault(), 
            $.ajax({
                url: "/siswa/update",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(s) {
                    s.success ? Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: s.message,
                        showConfirmButton: !1,
                        timer: 1500
                    }).then(s => {
                        window.location.href = '/man/siswa'
                    }) : Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: s.message,
                        showConfirmButton: !0
                    });
                }
            });
        })
    });
</script>
<?= $this->endSection(); ?>
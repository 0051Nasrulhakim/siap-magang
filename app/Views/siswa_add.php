<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-plain">
            <div class="card-header pb-0">
                <span class="h5">Tambah Siswa</span><br>
                Tambah data siswa magang
            </div>
            <div class="card-body bg-white">
                <form role="form text-left" id="fasiswa">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3" data-bs-toggle="tooltip" title="NIS siswa akan terisi otomatis ketika memilih angkatan" data-container="body" data-animation="true">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" name="nis" id="nis" class="form-control" readonly required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label for="hp" class="form-label">Nomor Hp/Wa</label>
                                <input type="number" name="hp" id="hp" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control" required>
                                    <option value=""></option>
                                    <?php foreach ($jurusan as $j) : ?>
                                        <option value="<?= "XI " . $j->nama_jurusan ?>">XI <?= $j->nama_jurusan ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <input type="hidden" name="angkatan" id="angval">

                            <div class="input-group input-group-outline mb-3">
                                <label for="angkatan" class="form-label">Gelombang / Angkatan</label>
                                <input type="text" name="autoang" id="angkatan" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Alamat Lengkap" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center gap-3 d-flex align-items-center justify-content-end mt-4">
                        <button type="button" class="btn btn-round bg-gradient-light btn-cancle">Batal</button>
                        <button type="submit" class="btn btn-round bg-gradient-dark" required>Simpan</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>


<?= $this->section('topsc'); ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<?= $this->endSection(); ?>


<?= $this->section('bottomsc'); ?>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="/assets/js/plugins/datatables.js"></script>
<script src="/assets/js/plugins/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        const BASE_URL = "<?= base_url() ?>";

        $(".btn-cancle").on("click", function() {
            window.history.back();
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
                $('#fasiswa #angval').val(ui.item.no);
                let nis = ui.item.tahun.substr(2, 2) + "." + Math.floor(100000 + Math.random() * 900000);
                if (cekNis(nis)) {
                    while (cekNis(nis)) {
                        nis = ui.item.tahun.substr(2, 2) + "." + Math.floor(100000 + Math.random() * 900000);
                    }
                    $('#fasiswa #nis').val(nis);
                    $('#fasiswa #nis').parent().addClass('is-filled');
                } else {
                    $('#fasiswa #nis').val(nis);
                    $('#fasiswa #nis').parent().addClass('is-filled');
                }
            },
        });

        $('#fasiswa #kelas').on('change', function() {
            if ($(this).val() != "") {
                $(this).parent().addClass('is-filled');
            } else {
                $(this).parent().removeClass('is-filled');
            }
        });

        // fasiswa submit
        $("#fasiswa").on("submit", function(s) {
            s.preventDefault(), $.ajax({
                url: "/siswa/store",
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
                        $("#mtsiswa").modal("hide"), $("#fasiswa")[0].reset(), $("#kelas").siblings("label").removeClass("d-none"), $("#angkatan").siblings("label").removeClass("d-none"), window.history.back()
                    }) : Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: s.message,
                        showConfirmButton: !0
                    }).then(s => {
                        s.isConfirmed && ($("#mtsiswa").modal("hide"), $("#fasiswa")[0].reset(), $("#kelas").siblings("label").removeClass("d-none"), $("#angkatan").siblings("label").removeClass("d-none"), location.reload())
                    })
                }
            })
        });
    });
</script>

<?= $this->endSection(); ?>
<?= $this->extend('backend/layout'); ?>

<?= $this->section('content'); ?>
<div class="card p-3">
    <div class="card-body">
        <?php $errors = validation_errors(); ?>
        <form action="<?= base_url() ?>ladmin/testimoni/update" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="id_testimoni" id="id_testimoni" value="<?= $testimoni->id_testimoni ?>">
            <input type="hidden" name="thumbnail_l" id="thumbnail_l" value="<?= $testimoni->thumbnail ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="klien" class="form-label">Klien <span class="text-danger">*</span></label>
                    <?php if (isset($errors['klien'])) {
                        $error_k = "is-invalid";
                    } else {
                        $error_k = "";
                    } ?>
                    <?php $klien = 'class="form-select ' . $error_k . '" id="klien" placeholder="Klien"'; ?>
                    <?php echo form_dropdown('klien', $get_all_combobox_klien, $testimoni->klien_id, $klien) ?>
                    <div class="invalid-feedback"><?= (isset($errors['klien'])) ? $errors['klien'] : ''; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="pesan" class="form-label">Pesan Testimoni <span class="text-danger">*</span></label>
                    <textarea class="form-control  <?= (isset($errors['pesan'])) ? 'is-invalid' : ''; ?>" id="pesan" name="pesan" rows="3" required><?= $testimoni->pesan ?></textarea>
                    <div class="invalid-feedback"><?= (isset($errors['pesan'])) ? $errors['pesan'] : ''; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="foto" class="form-label">Thumbnail</label>
                    <input type="file" class="form-control" id="foto" name="foto" onchange="photoPreview(this,'preview')" accept="image/*">
                    <?php if (!empty($testimoni->thumbnail)) { ?>
                        <img src="/assets/img/testimoni/<?= $testimoni->thumbnail; ?>" alt="" style="max-height:100px;" id="preview_l"><a href="javascript:void(0)" id="txt_hapus_l" class="text-danger" onclick="hapus_l(<?= $testimoni->id_testimoni ?>)"><small>Hapus (x)</small></a>
                    <?php } ?>
                    <img id="preview" style="max-height:100px; display:none;" class="img-thumbnail mt-2" /><a href="javascript:void(0)" style="display: none;" id="txt_hapus" class="text-danger" onclick="hapus()">Hapus (x)</a>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <button type="submit" class="btn btn-sm btn-primary me-2 mb-3"><i class="ri-save-line"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-warning me-2 mb-3"><i class="ri-reset-left-line"></i> Reset</button>
                    <a href="<?= base_url() ?>ladmin/testimoni" class="btn btn-sm btn-secondary mb-3"><i class="ri-arrow-go-back-line"></i> Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<link href="<?= base_url() ?>assets/vendor/sweetalert2@9.17.2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<script src="<?= base_url() ?>assets/vendor/sweetalert2@9.17.2/sweetalert2.min.js"></script>
<script>
    // --- preview foto ---
    function photoPreview(photo, idpreview) {
        var gb = photo.files;
        for (var i = 0; i < gb.length; i++) {
            var gbPreview = gb[i];
            var imageType = /image.*/;
            var preview = document.getElementById(idpreview);
            var reader = new FileReader();
            if (gbPreview.type.match(imageType)) {
                //jika tipe data sesuai
                preview.file = gbPreview;
                reader.onload = (function(element) {
                    return function(e) {
                        element.src = e.target.result;
                    };
                })(preview);
                //membaca data URL gambar
                reader.readAsDataURL(gbPreview);
                $('#preview').show();
                $('#txt_hapus').show();
                $('#txt_hapus_l').hide();
                $('#preview_l').hide();
            } else {
                //jika tipe data tidak sesuai
                $('#foto').val('');
                Swal.fire({
                    icon: "error",
                    title: "Tipe file tidak sesuai",
                    text: "Gambar harus bertipe .png, .gif atau .jpg.",
                });
            }
        }
    }

    // fungsi hapus foto
    function hapus() {
        $('#foto').val('');
        $('#preview').hide();
        $('#txt_hapus').hide();
        $('#preview_l').show();
        $('#txt_hapus_l').show();
    }

    // fungsi hapus foto lama
    function hapus_l(id) {
        $.ajax({
            url: "<?= base_url() ?>ladmin/testimoni/delete_thumbnail/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('#preview_l').hide();
                $('#txt_hapus_l').hide();
                $('#thumbnail').val('');
            }
        });
    }
</script>
<?= $this->endSection(); ?>
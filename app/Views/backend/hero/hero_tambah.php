<?= $this->extend('backend/layout'); ?>

<?= $this->section('content'); ?>
<div class="card p-3">
    <div class="card-body">
        <?php $errors = validation_errors(); ?>
        <form action="<?= base_url() ?>ladmin/hero/simpan" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= (isset($errors['judul'])) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul') ?>" required>
                    <div class="invalid-feedback"><?= (isset($errors['judul'])) ? $errors['judul'] : ''; ?></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="sub_judul" class="form-label">Sub Judul</label>
                    <input type="text" class="form-control" id="sub_judul" name="sub_judul" value="<?= old('sub_judul') ?>">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                    <textarea class="form-control  <?= (isset($errors['keterangan'])) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" rows="3" required><?= old('keterangan') ?></textarea>
                    <div class="invalid-feedback"><?= (isset($errors['keterangan'])) ? $errors['keterangan'] : ''; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="video" class="form-label">Video Youtube</label>
                    <input type="text" class="form-control" id="video" name="video" value="<?= old('video') ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" onchange="photoPreview(this,'preview')" accept="image/*">
                </div>
                <div class="col-md-2 mb-3">
                    <img id="preview" style="max-height:100px; display:none;" class="img-thumbnail mt-2" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <button type="submit" class="btn btn-sm btn-primary me-2 mb-3"><i class="ri-save-line"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-warning me-2 mb-3"><i class="ri-reset-left-line"></i> Reset</button>
                    <a href="<?= base_url() ?>ladmin/hero" class="btn btn-sm btn-secondary mb-3"><i class="ri-arrow-go-back-line"></i> Batal</a>
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
</script>
<?= $this->endSection(); ?>
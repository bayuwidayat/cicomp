<?= $this->extend('backend/layout'); ?>

<?= $this->section('content'); ?>
<div class="card p-3">
    <div class="card-body">
        <?php $errors = validation_errors(); ?>
        <form action="<?= base_url() ?>ladmin/tim/simpan" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nm_tim" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= (isset($errors['nm_tim'])) ? 'is-invalid' : ''; ?>" id="nm_tim" name="nm_tim" value="<?= old('nm_tim') ?>">
                    <div class="invalid-feedback"><?= (isset($errors['nm_tim'])) ? $errors['nm_tim'] : ''; ?></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= (isset($errors['jabatan'])) ? 'is-invalid' : ''; ?>" id="jabatan" name="jabatan" value="<?= old('jabatan') ?>">
                    <div class="invalid-feedback"><?= (isset($errors['jabatan'])) ? $errors['jabatan'] : ''; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="lokasi" class="form-label">Lokasi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= (isset($errors['lokasi'])) ? 'is-invalid' : ''; ?>" id="lokasi" name="lokasi" value="<?= old('lokasi') ?>">
                    <div class="invalid-feedback"><?= (isset($errors['lokasi'])) ? $errors['lokasi'] : ''; ?></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="avatar" class="form-label">Avatar <span class="text-danger">*</span> (<small class="text-muted">File: jpg, png, gif. Maksimal 512kb</small>)</label>
                    <input type="file" class="form-control <?= (isset($errors['avatar'])) ? 'is-invalid' : ''; ?>" id="avatar" name="avatar" onchange="photoPreview(this,'preview')" accept="image/*">
                    <div class="invalid-feedback"><?= (isset($errors['avatar'])) ? $errors['avatar'] : ''; ?></div>
                    <img id="preview" style="max-height:100px; display:none;" class="img-thumbnail mt-2" /> <a href="javascript:void(0)" style="display: none;" id="txt_hapus" class="text-danger" onclick="hapus()">Hapus (x)</a>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <button type="submit" class="btn btn-sm btn-primary me-2 mb-3"><i class="ri-save-line"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-warning me-2 mb-3"><i class="ri-reset-left-line"></i> Reset</button>
                    <a href="<?= base_url() ?>ladmin/tim" class="btn btn-sm btn-secondary mb-3"><i class="ri-arrow-go-back-line"></i> Batal</a>
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
    // --- preview avatar ---
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
            } else {
                //jika tipe data tidak sesuai
                $('#avatar').val('');
                Swal.fire({
                    icon: "error",
                    title: "Tipe file tidak sesuai",
                    text: "Gambar harus bertipe .png, .gif atau .jpg.",
                });
            }
        }
    }

    // fungsi hapus avatar
    function hapus() {
        $('#avatar').val('');
        $('#preview').hide();
        $('#txt_hapus').hide();
    }
</script>
<?= $this->endSection(); ?>
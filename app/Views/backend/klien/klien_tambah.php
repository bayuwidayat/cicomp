<?= $this->extend('backend/layout'); ?>

<?= $this->section('content'); ?>
<div class="card p-3">
    <div class="card-body">
        <?php $errors = validation_errors(); ?>
        <form action="<?= base_url() ?>ladmin/klien/simpan" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nm_klien" class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= (isset($errors['nm_klien'])) ? 'is-invalid' : ''; ?>" id="nm_klien" name="nm_klien" value="<?= old('nm_klien') ?>">
                    <div class="invalid-feedback"><?= (isset($errors['nm_klien'])) ? $errors['nm_klien'] : ''; ?></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= (isset($errors['pekerjaan'])) ? 'is-invalid' : ''; ?>" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan') ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="avatar" class="form-label">Avatar <span class="text-danger">*</span></label>
                    <input type="file" class="form-control <?= (isset($errors['avatar'])) ? 'is-invalid' : ''; ?>" id="avatar" name="avatar" onchange="photoPreview_a(this,'preview_a')" accept="image/*">
                    <img id="preview_a" style="max-height:100px; display:none;" class="img-thumbnail mt-2" /> <a href="javascript:void(0)" style="display: none;" id="txt_hapus_a" class="text-danger" onclick="hapus_a()"><small>Hapus (x)</small></a>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="logo" class="form-label">Logo Perusahaan <span class="text-danger">*</span></label>
                    <input type="file" class="form-control <?= (isset($errors['logo'])) ? 'is-invalid' : ''; ?>" id="logo" name="logo" onchange="photoPreview(this,'preview')" accept="image/*">
                    <img id="preview" style="max-height:100px; display:none;" class="img-thumbnail mt-2" /> <a href="javascript:void(0)" style="display: none;" id="txt_hapus" class="text-danger" onclick="hapus()"><small>Hapus (x)</small></a>
                </div>
                <div class="col-md-2 mb-3">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <button type="submit" class="btn btn-sm btn-primary me-2 mb-3"><i class="ri-save-line"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-warning me-2 mb-3"><i class="ri-reset-left-line"></i> Reset</button>
                    <a href="<?= base_url() ?>ladmin/klien" class="btn btn-sm btn-secondary mb-3"><i class="ri-arrow-go-back-line"></i> Batal</a>
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
    // --- preview foto avatar ---
    function photoPreview_a(photo, idpreview) {
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
                $('#preview_a').show();
                $('#txt_hapus_a').show();
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

    // --- preview foto logo---
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
                $('#logo').val('');
                Swal.fire({
                    icon: "error",
                    title: "Tipe file tidak sesuai",
                    text: "Gambar harus bertipe .png, .gif atau .jpg.",
                });
            }
        }
    }

    // fungsi hapus foto avatar
    function hapus_a() {
        $('#avatar').val('');
        $('#preview_a').hide();
        $('#txt_hapus_a').hide();
    }

    // fungsi hapus foto logo
    function hapus() {
        $('#logo').val('');
        $('#preview').hide();
        $('#txt_hapus').hide();
    }
</script>
<?= $this->endSection(); ?>
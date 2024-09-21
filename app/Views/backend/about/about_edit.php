<?= $this->extend('backend/layout'); ?>

<?= $this->section('content'); ?>
<div class="card p-3">
    <div class="card-body">
        <?php $errors = validation_errors(); ?>
        <form action="<?= base_url() ?>ladmin/about/update" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="id_about" id="id_about" value="<?= $about->id_about ?>">
            <input type="hidden" name="thumbnail_l" id="thumbnail_l" value="<?= $about->thumbnail ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nm_about" class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= (isset($errors['nm_about'])) ? 'is-invalid' : ''; ?>" id="nm_about" name="nm_about" value="<?= $about->nm_about ?>">
                    <div class="invalid-feedback"><?= (isset($errors['nm_about'])) ? $errors['nm_about'] : ''; ?></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tipe" class="form-label">Tipe <span class="text-danger">*</span></label>
                    <select name="tipe" id="tipe" class="form-select <?= (isset($errors['tipe'])) ? 'is-invalid' : ''; ?>">
                        <option value="visi" <?= ($about->tipe == 'visi') ? 'selected' : ''; ?>>Visi</option>
                        <option value="misi" <?= ($about->tipe == 'misi') ? 'selected' : ''; ?>>Misi</option>
                    </select>
                    <div class="invalid-feedback"><?= (isset($errors['nm_about'])) ? $errors['nm_about'] : ''; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                    <textarea class="form-control <?= (isset($errors['keterangan'])) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" rows="3"><?= $about->keterangan ?></textarea>
                    <div class="invalid-feedback"><?= (isset($errors['keterangan'])) ? $errors['keterangan'] : ''; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail (<small class="text-muted">File: jpg, png, gif. Maksimal 512kb</small>)</label>
                    <input type="file" class="form-control <?= (isset($errors['thumbnail'])) ? 'is-invalid' : ''; ?>" id="thumbnail" name="thumbnail" onchange="photoPreview(this,'preview')" accept="image/*">
                    <div class="invalid-feedback"><?= (isset($errors['thumbnail'])) ? $errors['thumbnail'] : ''; ?></div>
                    <?php if (!empty($about->thumbnail)) { ?>
                        <img src="/assets/img/about/<?= $about->thumbnail; ?>" alt="" style="max-height:100px;" id="preview_l"><a href="javascript:void(0)" id="txt_hapus_l" class="text-danger" onclick="hapus_l(<?= $about->id_about ?>)"><small>Hapus (x)</small></a>
                    <?php } ?>
                    <img id="preview" style="max-height:100px; display:none;" class="img-thumbnail mt-2" /><a href="javascript:void(0)" style="display: none;" id="txt_hapus" class="text-danger" onclick="hapus()">Hapus (x)</a>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <button type="submit" class="btn btn-sm btn-primary me-2 mb-3"><i class="ri-save-line"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-warning me-2 mb-3"><i class="ri-reset-left-line"></i> Reset</button>
                    <a href="<?= base_url() ?>ladmin/about" class="btn btn-sm btn-secondary mb-3"><i class="ri-arrow-go-back-line"></i> Batal</a>
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
    // --- preview thumbnail ---
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
                $('#thumbnail').val('');
                Swal.fire({
                    thumbnail: "error",
                    title: "Tipe file tidak sesuai",
                    text: "Gambar harus bertipe .png, .gif atau .jpg.",
                });
            }
        }
    }

    // fungsi hapus thumbnail
    function hapus() {
        $('#thumbnail').val('');
        $('#preview').hide();
        $('#txt_hapus').hide();
        $('#preview_l').show();
        $('#txt_hapus_l').show();
    }

    // fungsi hapus thumbnail lama
    function hapus_l(id) {
        $.ajax({
            url: "<?= base_url() ?>ladmin/about/delete_thumbnail/" + id,
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
<?= $this->extend('backend/layout'); ?>

<?= $this->section('content'); ?>
<div class="card p-3">
    <div class="card-body">
        <?php $errors = validation_errors(); ?>
        <form action="<?= base_url() ?>ladmin/blog/simpan" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= (isset($errors['judul'])) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul') ?>">
                    <div class="invalid-feedback"><?= (isset($errors['judul'])) ? $errors['judul'] : ''; ?></div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="judul" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <?php if (isset($errors['kategori'])) {
                        $error_k = "is-invalid";
                    } else {
                        $error_k = "";
                    } ?>
                    <?php $kategori = 'class="form-select ' . $error_k . '" id="kategori" placeholder="Klien"'; ?>
                    <?php echo form_dropdown('kategori', $get_all_combobox_kategori, '', $kategori) ?>
                    <div class="invalid-feedback"><?= (isset($errors['kategori'])) ? $errors['kategori'] : ''; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col- mb-3">
                    <label for="isi_blog" class="form-label">Isi Blog <span class="text-danger">*</span></label>
                    <textarea <?= (isset($errors['isi_blog'])) ? 'class="is-invalid"' : ''; ?> id="isi_blog" name="isi_blog"><?= old('isi_blog') ?></textarea>
                    <div class="invalid-feedback"><?= (isset($errors['isi_blog'])) ? $errors['isi_blog'] : ''; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="banner" class="form-label">Banner <span class="text-danger">*</span> (<small class="text-muted">File: jpg, png, gif. Maksimal 512kb</small>)</label>
                    <input type="file" class="form-control <?= (isset($errors['banner'])) ? 'is-invalid' : ''; ?>" id="banner" name="banner" onchange="photoPreview(this,'preview')" accept="image/*">
                    <div class="invalid-feedback"><?= (isset($errors['banner'])) ? $errors['banner'] : ''; ?></div>
                    <img id="preview" style="max-height:100px; display:none;" class="img-thumbnail mt-2" /> <a href="javascript:void(0)" style="display: none;" id="txt_hapus" class="text-danger" onclick="hapus()">Hapus (x)</a>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <button type="submit" class="btn btn-sm btn-primary me-2 mb-3"><i class="ri-save-line"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-warning me-2 mb-3"><i class="ri-reset-left-line"></i> Reset</button>
                    <a href="<?= base_url() ?>ladmin/blog" class="btn btn-sm btn-secondary mb-3"><i class="ri-arrow-go-back-line"></i> Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<link href="<?= base_url() ?>assets/vendor/summernote/summernote.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/vendor/summernote/summernote-lite.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/vendor/sweetalert2@9.17.2/sweetalert2.min.css" rel="stylesheet" type="text/css">

<script src="<?= base_url() ?>assets/vendor/summernote/summernote-lite.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/sweetalert2@9.17.2/sweetalert2.min.js"></script>
<script>
    jQuery(document).ready(function() {
        $('#isi_blog').summernote({
            tabSize: 2,
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                },
                onMediaDelete: function(target) {
                    deleteImage(target[0].src);
                }
            }
        });

        function uploadImage(image) {
            var formData = new FormData();
            formData.append("img", image);
            formData.append("dir", 'blog');
            $.ajax({
                url: "<?= site_url('ladmin/upload_image') ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: "POST",
                success: function(url) {
                    $('#isi_blog').summernote("insertImage", url);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function deleteImage(src) {
            $.ajax({
                data: {
                    src: src,
                },
                type: "POST",
                url: "<?= base_url('ladmin/delete_image') ?>",
                cache: false,
                success: function(response) {
                    console.log(response);
                }
            });
        }
    });

    // --- preview banner ---
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
                $('#banner').val('');
                Swal.fire({
                    banner: "error",
                    title: "Tipe file tidak sesuai",
                    text: "Gambar harus bertipe .png, .gif atau .jpg.",
                });
            }
        }
    }

    // fungsi hapus banner
    function hapus() {
        $('#banner').val('');
        $('#preview').hide();
        $('#txt_hapus').hide();
    }
</script>
<?= $this->endSection(); ?>
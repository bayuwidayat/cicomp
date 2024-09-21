<?= $this->extend('backend/layout'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-7">
        <div class="card p-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="<?= base_url() ?>assets/img/users/<?= $user[0]->foto ?>" alt="" class="img-thumbnail">
                    </div>
                    <div class="col-sm-9">
                        <form id="form" method="POST" action="<?= base_url(); ?>ladmin/update_profile" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" value="<?= $user[0]->session_id ?>" id="session_id" name="session_id">
                            <input type="hidden" value="<?= $user[0]->foto ?>" id="foto_lm" name="foto_lm">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Username" value="<?= $user[0]->username ?>" disabled>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                    <div class="ketpassword"></div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" id="nm_lengkap" name="nm_lengkap" class="form-control" placeholder="Nama Lengkap" value="<?= $user[0]->nm_lengkap ?>" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?= $user[0]->email ?>" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kelas" class="col-sm-3 col-form-label">Level</label>
                                <div class="col-sm-9">
                                    <button class="btn btn-info btn-sm"><?= $user[0]->level; ?></button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Upload Foto</label>
                                <div class="col-sm-6">
                                    <img id="preview" style="max-height:100px; display:none;" class="img-thumbnail mb-2" />
                                    <input id="foto" name="foto" type="file" class="form-control" onchange="photoPreview(this,'preview')" placeholder="Foto">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-sm btn-success" id="btnSimpan">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
<?= $this->extend('backend/layout'); ?>

<?= $this->section('content'); ?>
<div class="card p-3">
    <div class="card-body">
        <form action="<?= base_url() ?>ladmin/setting/update" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" id="id_setting" name="id_setting" value="<?= $setting->id_setting ?>">
            <input type="hidden" id="favicon_l" name="favicon_l" value="<?= $setting->favicon ?>">
            <input type="hidden" id="logo_l" name="logo_l" value="<?= $setting->logo ?>">
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3 bg-body-secondary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="true">General</button>
                    <button class="nav-link" id="v-pills-kontak-tab" data-bs-toggle="pill" data-bs-target="#v-pills-kontak" type="button" role="tab" aria-controls="v-pills-kontak" aria-selected="false">Kontak</button>
                    <button class="nav-link" id="v-pills-sosmed-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sosmed" type="button" role="tab" aria-controls="v-pills-sosmed" aria-selected="false">Sosial Media</button>
                    <button class="nav-link" id="v-pills-logo-tab" data-bs-toggle="pill" data-bs-target="#v-pills-logo" type="button" role="tab" aria-controls="v-pills-logo" aria-selected="false">Logo</button>
                </div>

                <div class="tab-content flex-fill" id="v-pills-tabContent">
                    <!-- Tab General -->
                    <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nm_website" class="col-form-label">Nama Website</label>
                                <input type="text" class="form-control" placeholder="Nama Website atau Perusahaan" id="nm_website" name="nm_website" value="<?= $setting->nm_website ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="slogan" class="col-form-label">Slogan</label>
                                <input type="text" class="form-control" placeholder="slogan" id="slogan" name="slogan" value="<?= $setting->slogan ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="meta_deskripsi" class="col-form-label">Meta Deskripsi</label>
                                <input type="text" class="form-control" placeholder="Nama Website atau Perusahaan" id="meta_deskripsi" name="meta_deskripsi" value="<?= $setting->meta_deskripsi ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_keyword" class="col-form-label">Meta Keyword</label>
                                <input type="text" class="form-control" placeholder="meta_keyword" id="meta_keyword" name="meta_keyword" value="<?= $setting->meta_keyword ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="profil" class="col-form-label">Profil Singkat</label>
                                <textarea name="profil" id="profil" class="form-control" rows="3"><?= $setting->profil; ?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Kontak -->
                    <div class="tab-pane fade" id="v-pills-kontak" role="tabpanel" aria-labelledby="v-pills-kontak-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="alamat" class="col-form-label">Alamat</label>
                                <input type="text" class="form-control" placeholder="Alamat Perusahaan" id="alamat" name="alamat" value="<?= $setting->alamat ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_telp" class="col-form-label">No Telp</label>
                                <input type="text" class="form-control" placeholder="No Telp" id="no_telp" name="no_telp" value="<?= $setting->no_telp ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="text" class="form-control" placeholder="Email Perusahaan" id="email" name="email" value="<?= $setting->email ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_wa" class="col-form-label">No Whatsapp</label>
                                <input type="text" class="form-control" placeholder="No Whatsapp" id="no_wa" name="no_wa" value="<?= $setting->no_wa ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="gmaps" class="col-form-label">Google Maps</label>
                                <textarea name="gmaps" id="gmaps" class="form-control" rows="5"><?= $setting->gmaps; ?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Sosial Media -->
                    <div class="tab-pane fade" id="v-pills-sosmed" role="tabpanel" aria-labelledby="v-pills-sosmed-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="facebook" class="col-form-label">Facebook</label>
                                <input type="text" class="form-control" placeholder="url facebook" id="facebook" name="facebook" value="<?= $setting->facebook ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="twitter" class="col-form-label">Twitter / X</label>
                                <input type="text" class="form-control" placeholder="url twitter" id="twitter" name="twitter" value="<?= $setting->twitter ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="instagram" class="col-form-label">Instagram</label>
                                <input type="text" class="form-control" placeholder="url instagram" id="instagram" name="instagram" value="<?= $setting->instagram ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="youtube" class="col-form-label">Youtube</label>
                                <input type="text" class="form-control" placeholder="url youtube" id="youtube" name="youtube" value="<?= $setting->youtube ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="linkedin" class="col-form-label">Linkedin</label>
                                <input type="text" class="form-control" placeholder="url linkedin" id="linkedin" name="linkedin" value="<?= $setting->linkedin ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tiktok" class="col-form-label">Tiktok</label>
                                <input type="text" class="form-control" placeholder="url tiktok" id="tiktok" name="tiktok" value="<?= $setting->tiktok ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Logo -->
                    <div class="tab-pane fade" id="v-pills-logo" role="tabpanel" aria-labelledby="v-pills-sosmed-logo" tabindex="0">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="favicon" class="form-label">Favicon</label>
                                <input type="file" class="form-control mb-2 <?= (isset($errors['favicon'])) ? 'is-invalid' : ''; ?>" id="favicon" name="favicon" onchange="photoPreview_a(this,'preview_a')" accept="image/*">

                                <?php if (!empty($setting->favicon)) { ?>
                                    <img src="/assets/img/<?= $setting->favicon; ?>" alt="" style="max-height:100px;" id="preview_a_l"> <a href="javascript:void(0)" id="txt_hapus_a_l" class="text-danger" onclick="hapus_l(<?= $setting->id_setting ?>,'favicon')"><small>Hapus (x)</small></a>
                                <?php } ?>

                                <img id="preview_a" style="max-height:100px; display:none;" /> <a href="javascript:void(0)" style="display: none;" id="txt_hapus_a" class="text-danger" onclick="hapus_a()"><small>Hapus (x)</small></a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="logo" class="form-label">Logo</label>
                                <input type="file" class="form-control mb-2 <?= (isset($errors['logo'])) ? 'is-invalid' : ''; ?>" id="logo" name="logo" onchange="photoPreview(this,'preview')" accept="image/*">

                                <?php if (!empty($setting->logo)) { ?>
                                    <img src="/assets/img/<?= $setting->logo; ?>" alt="" style="max-height:100px;" id="preview_l"> <a href="javascript:void(0)" id="txt_hapus_l" class="text-danger" onclick="hapus_l(<?= $setting->id_setting ?>,'logo')"><small>Hapus (x)</small></a>
                                <?php } ?>

                                <img id="preview" style="max-height:100px; display:none;" /> <a href="javascript:void(0)" style="display: none;" id="txt_hapus" class="text-danger" onclick="hapus()"><small>Hapus (x)</small></a>
                            </div>
                            <div class="col-md-2 mb-3">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-primary me-2 mb-3"><i class="ri-save-line"></i> Simpan</button>
                        </div>
                    </div>
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
    // --- preview foto favicon ---
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
                $('#txt_hapus_a_l').hide();
                $('#preview_a_l').hide();
            } else {
                //jika tipe data tidak sesuai
                $('#favicon').val('');
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
                $('#txt_hapus_l').hide();
                $('#preview_l').hide();
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

    // fungsi hapus foto favicon
    function hapus_a() {
        $('#favicon').val('');
        $('#preview_a').hide();
        $('#txt_hapus_a').hide();
        $('#preview_a_l').show();
        $('#txt_hapus_a_l').show();
    }

    // fungsi hapus foto logo
    function hapus() {
        $('#logo').val('');
        $('#preview').hide();
        $('#txt_hapus').hide();
        $('#preview_l').show();
        $('#txt_hapus_l').show();
    }



    // fungsi hapus foto lama
    function hapus_l(id, field) {
        $.ajax({
            url: "<?= base_url() ?>ladmin/setting/delete_gambar/" + id + "/" + field,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (field == 'favicon') {
                    $('#preview_a_l').hide();
                    $('#txt_hapus_a_l').hide();
                    $('#favicon_l').val('');
                } else {
                    $('#preview_l').hide();
                    $('#txt_hapus_l').hide();
                    $('#logo_l').val('');
                }
            }
        });
    }
</script>
<?= $this->endSection(); ?>
<?= $this->extend('frontend/' . templates()->folder . '/layout'); ?>

<?= $this->section('content'); ?>

<section class="bg-primary-subtle mb-5">
    <div class="container">
        <div class="row">
            <div class="col text-center p-5">
                <h1 class="fw-bold"><?= $title; ?></h1>
            </div>
        </div>
    </div>
</section>

<section>
    <!-- <div class="container d-flex justify-content-center"> -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center py-5 mb-3">
                <h3>Jika Anda memiliki pertanyaan, silakan tulis pada form berikut ini</h3>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="container">
        <div class="row gx-5 mb-5">
            <div class="col-md-7 col-sm-12 mb-5">
                <!-- Alert -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php $errors = validation_errors(); ?>
                <form action="<?= base_url() ?>kontak" method="post">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="nama" id="nama" class="form-control px-3 py-2 <?= (isset($errors['nama'])) ? 'is-invalid' : ''; ?>" placeholder="Nama Lengkap *" value="<?= old('nama') ?>" required>
                            <div class="invalid-feedback"><?= (isset($errors['nama'])) ? $errors['nama'] : ''; ?></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" name="email" id="email" class="form-control px-3 py-2 <?= (isset($errors['email'])) ? 'is-invalid' : ''; ?>" placeholder="Email *" value="<?= old('email') ?>" required>
                            <div class="invalid-feedback"><?= (isset($errors['email'])) ? $errors['email'] : ''; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="no_wa" id="no_wa" class="form-control px-3 py-2 <?= (isset($errors['no_wa'])) ? 'is-invalid' : ''; ?>" placeholder="No Whatsapp *" value="<?= old('no_wa') ?>" required>
                            <div class="invalid-feedback"><?= (isset($errors['no_wa'])) ? $errors['no_wa'] : ''; ?></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" name="subjek" id="subjek" class="form-control px-3 py-2 <?= (isset($errors['subjek'])) ? 'is-invalid' : ''; ?>" placeholder="Subjek *" value="<?= old('subjek') ?>" required>
                            <div class="invalid-feedback"><?= (isset($errors['subjek'])) ? $errors['subjek'] : ''; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <textarea name="pesan" id="pesan" class="form-control px-3 py-2 <?= (isset($errors['pesan'])) ? 'is-invalid' : ''; ?>" placeholder="Pesan/Pertanyaan *" rows="3" required><?= old('pesan') ?></textarea>
                            <div class="invalid-feedback"><?= (isset($errors['pesan'])) ? $errors['pesan'] : ''; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <input type="submit" class="form-control px-3 py-2 btn btn-primary" value="Kirim">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-5 col-sm-12">
                <?php if (!empty(setting()->alamat)) { ?>
                    <p><i class="ri-map-pin-fill"></i> <?= setting()->alamat; ?></p>
                <?php } ?>
                <?php if (!empty(setting()->no_telp)) { ?>
                    <p><i class="ri-phone-fill"></i> <?= setting()->no_telp; ?></p>
                <?php } ?>
                <?php if (!empty(setting()->no_wa)) { ?>
                    <p><i class="ri-whatsapp-fill"></i> <?= setting()->no_wa; ?></p>
                <?php } ?>
                <?php if (!empty(setting()->email)) { ?>
                    <p><i class="ri-mail-fill"></i> <?= setting()->email; ?></p>
                <?php } ?>
            </div>
        </div>

        <?php if (!empty(setting()->gmaps)) { ?>
            <div class="row mb-5">
                <div class="col d-block text-center">
                    <?= setting()->gmaps; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<?= $this->endSection(); ?>
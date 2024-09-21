<?= $this->extend('backend/layout'); ?>

<?= $this->section('content'); ?>
<div class="card p-3">
    <div class="card-body">
        <?php $errors = validation_errors(); ?>
        <form action="<?= base_url() ?>ladmin/kategori/simpan" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nm_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= (isset($errors['nm_kategori'])) ? 'is-invalid' : ''; ?>" id="nm_kategori" name="nm_kategori" value="<?= old('nm_kategori') ?>">
                    <div class="invalid-feedback"><?= (isset($errors['nm_kategori'])) ? $errors['nm_kategori'] : ''; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <button type="submit" class="btn btn-sm btn-primary me-2 mb-3"><i class="ri-save-line"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-warning me-2 mb-3"><i class="ri-reset-left-line"></i> Reset</button>
                    <a href="<?= base_url() ?>ladmin/kategori" class="btn btn-sm btn-secondary mb-3"><i class="ri-arrow-go-back-line"></i> Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
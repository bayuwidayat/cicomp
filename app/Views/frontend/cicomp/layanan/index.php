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

<section class="my-4">
    <div class="container">
        <div class="row g-5">
            <?php foreach ($layanan as $a) { ?>
                <div class="col-md-6">
                    <div class="rounded shadow p-4">
                        <?php if (!empty($a->icon)) { ?>
                            <img src="<?= base_url() ?>assets/img/layanan/<?= $a->icon ?>" alt="<?= $a->nm_layanan ?>" class="mb-3">
                        <?php } ?>
                        <h2 class="my-3 fw-bold"><?= $a->nm_layanan; ?></h2>
                        <p><?= substr(strip_tags($a->keterangan), 0, 150); ?>..</p>
                        <a href="<?= base_url() ?>layanan/<?= $a->slug_layanan ?>" class="btn btn-sm btn-primary rounded-pill">Selengkapnya <i class="ri-arrow-right-line"></i></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="bg-primary my-5">
    <div class="container">
        <div class="row">
            <div class="col text-center text-white my-5 p-5">
                <h2 class="fs-1">Tertarik dengan produk/jasa kami?</h2>
                <a href="<?= base_url() ?>kontak" class="btn btn-lg btn-warning py-2 px-5 rounded-pill fw-bold mt-4">HUBUNGI KAMI</a>
            </div>
        </div>
    </div>
</section>

<section id="klien">
    <div class=" container">
        <h4 class="text-center fw-bold mb-4">Klien Terpercaya</h4>
        <div class="row justify-content-center gx-4">
            <?php foreach ($klien as $k) { ?>
                <div class="col-md-2 mb-3">
                    <div class="text-center p-2">
                        <img src="<?= base_url() ?>assets/img/klien/<?= $k->logo ?>" alt="<?= $k->nm_klien ?>" style="max-height: 30px;">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
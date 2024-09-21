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
    <div class="container">
        <p class="text-center my-4 pb-4"><?= setting()->profil; ?></p>

        <?php
        $i = 0;
        foreach ($about as $a) {
            $i++;
        ?>
            <div class="row my-5 gx-5">
                <div class="col-md-5 <?= (($i % 2) == 1) ? 'order-1' : 'order-2'; ?>">
                    <?php if (!empty($a->thumbnail)) { ?>
                        <img src="<?= base_url() ?>assets/img/about/<?= $a->thumbnail ?>" alt="<?= $a->nm_about ?>" class="img-thumbnail mb-3">
                    <?php } ?>
                </div>
                <div class="col-md-7 <?= (($i % 2) == 1) ? 'order-2' : 'order-1'; ?>">
                    <h4><span class="badge bg-primary-subtle text-primary rounded-pill text-uppercase"><?= $a->tipe; ?></span></h4>
                    <h2 class="my-3 fw-bold"><?= $i . '. ' . $a->nm_about; ?></h2>
                    <p><?= $a->keterangan; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<section id="tim">
    <div class="container">
        <h2 class="fs-1 text-center fw-bold mb-5">Tim Andalan Kami</h2>
        <div class="row justify-content-center gx-4">
            <?php foreach ($tim as $t) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="rounded text-center">
                        <img src="<?= base_url() ?>assets/img/tim/<?= $t->avatar ?>" alt="" class="d-block w-100">
                        <div class="bg-primary p-3 text-start text-white rounded-bottom">
                            <h4 class="mt-0"><?= $t->nm_tim; ?></h4>
                            <?= $t->jabatan; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
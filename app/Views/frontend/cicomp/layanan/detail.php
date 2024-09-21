<?= $this->extend('frontend/' . templates()->folder . '/layout'); ?>

<?= $this->section('content'); ?>

<?php if (empty($layanan)) { ?>
    Data tidak ditemukan
<?php } else { ?>

    <section class="my-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-8 offset-md-2">
                    <div class="layanan-item rounded shadow mb-5">
                        <div class="layanan-content p-4 rounded-bottom">
                            <?php if (!empty($layanan[0]->icon)) { ?>
                                <img src="<?= base_url() ?>assets/img/layanan/<?= $layanan[0]->icon ?>" alt="<?= $layanan[0]->nm_layanan ?>" class="d-block rounded-top">
                            <?php } ?>
                            <h1 class="fs-2 mt-2"><?= $layanan[0]->nm_layanan; ?></h1>
                            <div class="d-flex mb-3">
                                <div class="small me-3"><i class="ri-calendar-fill text-primary"></i> <?= tgl_indo($layanan[0]->created_at); ?></div>
                            </div>
                            <?= $layanan[0]->keterangan; ?>
                        </div>
                    </div>

                    <?php if (!empty($layanan_lain)) { ?>
                        <div class="row">
                            <h3 class="mb-3">Layanan Lainnya</h3>
                            <?php foreach ($layanan_lain as $a) { ?>
                                <div class="col-sm-4">
                                    <?php if (!empty($a->icon)) { ?>
                                        <img src="<?= base_url() ?>assets/img/layanan/<?= $a->icon ?>" alt="<?= $a->nm_layanan ?>" class="w-50 mb-3">
                                    <?php } ?>
                                    <h4 class="my-3"><a href="<?= base_url() ?>layanan/<?= $a->slug_layanan ?>"><?= $a->nm_layanan; ?></a></h4>
                                    <p><?= substr(strip_tags($a->keterangan), 0, 50); ?>..</p>
                                    <a href="<?= base_url() ?>layanan/<?= $a->slug_layanan ?>" class="btn btn-sm btn-primary rounded-pill">Selengkapnya <i class="ri-arrow-right-line"></i></a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>

<?php } ?>

<?= $this->endSection(); ?>
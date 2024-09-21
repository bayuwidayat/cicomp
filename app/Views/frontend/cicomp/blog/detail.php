<?= $this->extend('frontend/' . templates()->folder . '/layout'); ?>

<?= $this->section('content'); ?>

<?php if (empty($blog)) { ?>
    Data tidak ditemukan
<?php } else { ?>

    <section class="my-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-8 offset-md-2">
                    <div class="blog-item rounded shadow mb-5">
                        <?php if (!empty($blog[0]->banner)) { ?>
                            <img src="<?= base_url() ?>assets/img/blog/<?= $blog[0]->banner ?>" alt="<?= $blog[0]->judul ?>" class="d-block w-100 rounded-top">
                        <?php } ?>
                        <div class="blog-content p-4 rounded-bottom">
                            <h1 class="fs-2 mt-2"><?= $blog[0]->judul; ?></h1>
                            <div class="d-flex mb-3">
                                <div class="small me-3"><i class="ri-calendar-fill text-primary"></i> <?= tgl_indo($blog[0]->created_at); ?></div>
                                <div class="small"><i class="ri-folder-fill text-primary"></i> <a href="<?= base_url() ?>kategori/<?= $blog[0]->slug_kategori; ?>"><?= $blog[0]->nm_kategori; ?></a></div>
                            </div>
                            <?= $blog[0]->isi_blog; ?>
                        </div>
                    </div>

                    <?php if (!empty($blog_lain)) { ?>
                        <div class="row">
                            <h3 class="mb-3">Blog Lainnya</h3>
                            <?php foreach ($blog_lain as $a) { ?>
                                <div class="col-sm-4">
                                    <?php if (!empty($a->banner)) { ?>
                                        <img src="<?= base_url() ?>assets/img/blog/<?= $a->banner ?>" alt="<?= $a->judul ?>" class="w-100 mb-3 rounded-top">
                                    <?php } ?>
                                    <h5><a href="<?= base_url() ?>blog/<?= $a->slug_blog ?>"><?= $a->judul; ?></a></h5>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

<?php } ?>

<?= $this->endSection(); ?>
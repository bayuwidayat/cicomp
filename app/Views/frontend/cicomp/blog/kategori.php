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

<section class="my-5">
    <div class="container">
        <div class="row g-4">
            <?php if (empty($blog)) { ?>
                <div class="text-center">
                    Data tidak ditemukan
                </div>
            <?php } else { ?>
                <?php foreach ($blog as $b) { ?>
                    <div class="col-md-4">
                        <div class="blog-item rounded shadow">
                            <?php if (!empty($b['banner'])) { ?>
                                <img src="<?= base_url() ?>assets/img/blog/<?= $b['banner'] ?>" alt="<?= $b['judul'] ?>" class="d-block w-100 rounded-top">
                            <?php } ?>
                            <div class="blog-content p-4 rounded-bottom">
                                <div class="d-flex justify-content-between">
                                    <div class="small"><i class="ri-calendar-fill text-primary"></i> <?= $b['created_at']; ?></div>
                                    <div class="small"><i class="ri-folder-fill text-primary"></i> <?= $b['nm_kategori']; ?></div>
                                </div>
                                <h4 class="fs-5 mt-2">
                                    <a href="<?= base_url() ?>blog/<?= $b['slug_blog'] ?>"><?= $b['judul']; ?></a>
                                </h4>
                                <p><?= substr(strip_tags($b['isi_blog']), 0, 100); ?>..</p>
                                <a href="<?= base_url() ?>blog/<?= $b['slug_blog'] ?>" class="btn btn-sm btn-primary rounded-pill">Selengkapnya <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col mt-5">
                <?= $pager->links('blog', 'lintang_pagination') ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
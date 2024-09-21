<?= $this->extend('frontend/' . templates()->folder . '/layout'); ?>

<?= $this->section('content'); ?>
<section id="hero" class="bg-primary">
    <div class="container">
        <div class="hero-carousel owl-carousel">
            <?php foreach ($hero as $h) { ?>
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <?php if (!empty($h->sub_judul)) { ?>
                            <h4 class="mb-4"><span class="badge bg-white text-primary"><?= $h->sub_judul; ?></span></h4>
                        <?php } ?>
                        <h1 class="text-white mb-4"><?= $h->judul; ?></h1>
                        <p class="mb-5 fs-5"><?= $h->keterangan; ?>
                        </p>
                        <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                            <?php if (!empty($h->video)) { ?>
                                <button type="button" class="btn btn-light rounded-pill py-2 px-3 me-2 video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/<?= $h->video ?>" data-bs-target="#myModal"><i class="ri-play-circle-fill"></i> Video</button>
                            <?php } ?>
                            <?php if (!empty($h->link)) { ?>
                                <a class="btn border-light border-2 text-light rounded-pill p-3 ms-2" href="<?= $h->link ?>">Selengkapnya</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img src="<?= base_url() ?>assets/img/hero/<?= $h->banner ?>" class="d-block w-100" alt="<?= $h->judul ?>">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section id="layanan">
    <div class="container">
        <h2 class="fs-1 fw-bold text-center mb-4">Layanan Kami</h2>
        <div class="row">
            <?php foreach ($layanan as $l) { ?>
                <div class="col-md-4 text-center p-4">
                    <img src="<?= base_url() ?>assets/img/layanan/<?= $l->icon ?>" alt="<?= $l->nm_layanan ?>">
                    <h3 class="fs-4 my-3"><?= $l->nm_layanan ?></h3>
                    <p><?= substr(strip_tags($l->keterangan), 0, 140); ?></p>
                    <a href="<?= base_url() ?>layanan/<?= $l->slug_layanan ?>" class="btn btn-primary rounded-pill">Selengkapnya</a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section id="about" class="bg-primary-subtle">
    <div class="container">
        <div class="row">
            <div class="col-md-7 pe-3">
                <div class="p-4 rounded">
                    <h2 class="fs-1 fw-bold mb-4">Tentang Kami</h2>
                    <p><?= setting()->profil; ?></p>
                    <a href="<?= base_url() ?>about" class="btn btn-primary rounded-pill mt-3">Selengkapnya..</a>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row gx-4 p-4">
                    <?php foreach ($statistik as $s) { ?>
                        <div class="col-sm-6">
                            <div class="px-3 pt-3 mb-3 bg-light rounded text-center">
                                <div>
                                    <img src="<?= base_url() ?>assets/img/statistik/<?= $s->icon ?>" alt="<?= $s->nm_statistik ?>" style="height: 50px;">
                                </div>
                                <span class="text-muted"><?= $s->nm_statistik; ?></span>
                                <h3 class="fw-bold fs-1"><?= $s->goal; ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="tim">
    <div class="container">
        <h2 class="fs-1 text-center fw-bold mb-5">Tim Kami</h2>
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

<section id="testimoni">
    <div class="container">
        <h2 class="fs-1 text-center fw-bold mb-4">Testimoni</h2>
        <div class="testimoni-carousel owl-carousel">
            <?php foreach ($testimoni as $ts) { ?>
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <?php if (!empty($ts->logo)) { ?>
                            <div>
                                <img src="<?= base_url() ?>assets/img/klien/<?= $ts->logo ?>" style="max-height: 30px;" alt="<?= $ts->nm_klien ?>" class="mb-4">
                            </div>
                        <?php } ?>
                        <div class="position-relative">
                            <div class="position-absolute top-0 left-0 z-n1">
                                <img src="/assets/img/quote.svg" alt="icon">
                            </div>
                            <h3 class="fw-bold mb-4 lh-lg p-4 z-1"><?= $ts->pesan; ?></h3>
                        </div>
                        <img src="<?= base_url() ?>assets/img/klien/<?= $ts->avatar ?>" class="img rounded-circle float-start me-3" style="height: 60px;" alt="<?= $ts->nm_klien ?>">
                        <strong><?= $ts->nm_klien; ?></strong><br>
                        <small class="text-muted"><?= $ts->pekerjaan; ?></small>
                    </div>
                    <div class="col-md-5">
                        <img src="<?= base_url() ?>assets/img/testimoni/<?= $ts->thumbnail ?>" alt="Testimoni <?= $ts->nm_klien ?>" class="gambar">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section id="blog">
    <div class="container">
        <h2 class="fs-1 fw-bold text-center mb-5">Blog Terbaru</h2>
        <div class="row">
            <?php foreach ($blog as $b) { ?>
                <div class="col-md-4">
                    <div class="blog-item rounded">
                        <img src="<?= base_url() ?>assets/img/blog/<?= $b->banner ?>" alt="<?= $b->judul ?>" class="d-block w-100 rounded-top">
                        <div class="blog-content p-3 bg-primary-subtle rounded-bottom">
                            <div class="d-flex justify-content-between">
                                <div class="small"><i class="ri-calendar-fill text-primary"></i> <?= $b->created_at; ?></div>
                                <div class="small"><i class="ri-folder-fill text-primary"></i> <a href="<?= base_url() ?>kategori/<?= $b->slug_kategori; ?>"><?= $b->nm_kategori; ?></a></div>
                            </div>
                            <h4 class="fs-5 mt-2">
                                <a href="<?= base_url() ?>blog/<?= $b->slug_blog ?>"><?= $b->judul; ?></a>
                            </h4>
                            <p><?= substr(strip_tags($b->isi_blog), 0, 100); ?>..</p>
                            <a href="<?= base_url() ?>blog/<?= $b->slug_blog ?>" class="btn btn-sm btn-primary rounded-pill">Selengkapnya <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section id="klien">
    <div class="container">
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
                </button>
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<link href="<?= base_url() ?>assets/vendor/owlcarousel/owl.carousel.min.css" rel="stylesheet">
<script src="<?= base_url() ?>assets/vendor/owlcarousel/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/popup-video.js"></script>

<script>
    $(document).ready(function() {
        $('.hero-carousel').owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            dots: true,
            nav: true,
            navText: [
                '<i class="ri-arrow-left-s-line"></i>',
                '<i class="ri-arrow-right-s-line"></i>',
            ],
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true
        });

        $('.testimoni-carousel').owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            nav: true,
            navText: [
                '<i class="ri-arrow-left-line"></i>',
                '<i class="ri-arrow-right-line"></i>',
            ],
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true
        });
    });
</script>
<?= $this->endSection(); ?>
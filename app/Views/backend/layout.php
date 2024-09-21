<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= isset($title) ? $title : ''; ?> | <?= setting()->nm_website; ?></title>
    <meta content="Dashboard" name="description" />
    <meta content="Bayu Widayat" name="author" />
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/<?= setting()->favicon; ?>">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/remixicon.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style-admin.css" />
</head>

<body class="d-flex flex-column min-vh-100 bg-body-tertiary">
    <nav class="navbar navbar-expand-lg shadow sticky-sm-top z-3 bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url() ?>ladmin/dashboard"><img src="<?= base_url() ?>assets/img/<?= setting()->logo; ?>" alt="logo" style="max-height: 35px;" class="me-5"></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-lg-flex" id="navbarNavDropdown">
                <ul class="navbar-nav col-lg-9">
                    <li class="nav-item me-4">
                        <a class="nav-link" aria-current="page" href="<?= base_url() ?>ladmin/dashboard">Home</a>
                    </li>
                    <li class="nav-item dropdown me-4">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Landing Page</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url() ?>ladmin/hero">Hero</a></li>
                            <li><a class="dropdown-item" href="<?= base_url() ?>ladmin/layanan">Layanan</a></li>
                            <li><a class="dropdown-item" href="<?= base_url() ?>ladmin/statistik">Statistik Perusahaan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown me-4">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Stori</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url() ?>ladmin/klien">Klien</a></li>
                            <li><a class="dropdown-item" href="<?= base_url() ?>ladmin/testimoni">Testimoni</a></li>
                        </ul>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="<?= base_url() ?>ladmin/tim">Tim</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="<?= base_url() ?>ladmin/about">About</a>
                    </li>
                    <li class="nav-item dropdown me-4">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Blog</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url() ?>ladmin/blog">Semua Blog</a></li>
                            <li><a class="dropdown-item" href="<?= base_url() ?>ladmin/blog/tambah">Tambah Blog</a></li>
                            <li><a class="dropdown-item" href="<?= base_url() ?>ladmin/kategori">Kategori</a></li>
                        </ul>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="<?= base_url() ?>ladmin/setting">Setting</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="<?= base_url() ?>ladmin/hubungi">Pesan</a>
                    </li>
                </ul>
                <ul class="navbar-nav col-lg-3 justify-content-lg-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url() ?>assets/img/users/<?= session()->get('foto') ?>" alt="<?= session()->get('nama_lengkap') ?>" class="rounded-circle" style="height: 30px;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= base_url() ?>ladmin/profile">Profile</a></li>
                            <li><a class="dropdown-item" href="<?= base_url() ?>logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="my-3 p-3 flex-shrink-0">
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <div class="col-sm-6">
                    <h4 class="page-title"><?= isset($title) ? $title : ''; ?></h4>
                </div>
                <div class="col-sm-6 text-end">
                    <?= isset($btn) ? $btn : ''; ?>
                </div>
            </div>

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

            <?= $this->renderSection('content'); ?>
        </div>
    </main>

    <footer class="py-3 mt-auto">
        <div class="container text-center">
            <small>
                &copy; 2024 <b><?= setting()->nm_website; ?></b>. All rights reserved. Made with ❤️ <a href="https://lintangdigital.com" target="_blank">LintangDigital</a>
            </small>
        </div>
    </footer>

    <script src="<?= base_url() ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('script'); ?>
</body>

</html>
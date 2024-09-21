<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= isset($title) ? $title : ''; ?> | <?= setting()->nm_website; ?></title>
    <meta content="Dashboard" name="description" />
    <meta content="Bayu Widayat" name="author" />
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/<?= setting()->favicon; ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/remixicon.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css" />
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg shadow-sm sticky-sm-top z-3 py-3 bg-white">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/img/<?= setting()->logo; ?>" alt="logo" style="max-height: 40px;" class="me-5"></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-lg-flex  justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="<?= base_url() ?>about">About</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="<?= base_url() ?>layanan">Layanan</a>
                    </li>
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle" href="<?= base_url() ?>blog" role="button" data-bs-toggle="dropdown" aria-expanded="false">Blog</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url() ?>kategori/nasional">Nasional</a></li>
                            <li><a class="dropdown-item" href="<?= base_url() ?>kategori/internasional">Internasional</a></li>
                            <li><a class="dropdown-item" href="<?= base_url() ?>kategori/olahraga">Olahraga</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="<?= base_url() ?>kontak">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content'); ?>

    <footer class="py-3 mt-auto">
        <div class="container text-center">
            <div>
                <?php if (!empty(setting()->facebook)) { ?>
                    <a href="<?= setting()->facebook ?>" target="_blank"><i class="ri-facebook-circle-fill"></i></a>
                <?php } ?>
                <?php if (!empty(setting()->twitter)) { ?>
                    <a href="<?= setting()->twitter ?>" target="_blank"><i class="ri-twitter-x-fill"></i></a>
                <?php } ?>
                <?php if (!empty(setting()->instagram)) { ?>
                    <a href="<?= setting()->instagram ?>" target="_blank"><i class="ri-instagram-fill"></i></a>
                <?php } ?>
                <?php if (!empty(setting()->youtube)) { ?>
                    <a href="<?= setting()->youtube ?>" target="_blank"><i class="ri-youtube-fill"></i></a>
                <?php } ?>
                <?php if (!empty(setting()->linkedin)) { ?>
                    <a href="<?= setting()->linkedin ?>" target="_blank"><i class="ri-linkedin-box-fill"></i></a>
                <?php } ?>
                <?php if (!empty(setting()->tiktok)) { ?>
                    <a href="<?= setting()->tiktok ?>" target="_blank"><i class="ri-tiktok-fill"></i></a>
                <?php } ?>
            </div>
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
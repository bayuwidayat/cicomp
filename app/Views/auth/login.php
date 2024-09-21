<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <meta content="Login Dashboard" name="description" />
    <meta content="Bayu Widayat" name="author" />
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/<?= setting()->favicon; ?>">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style-admin.css" />
</head>

<body>
    <section class="w-100 h-100 p-3 mx-auto text-center position-absolute d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <img src="<?= base_url() ?>assets/img/<?= setting()->logo ?>" alt="logo" class="mb-4" style="max-height: 60px;">
                    <div class="card shadow">
                        <div class="row g-0">
                            <div class="col-lg">
                                <div class="d-flex flex-column h-100 p-4">
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

                                    <form action="<?= base_url() ?>do_login" method="post">
                                        <?= csrf_field(); ?>
                                        <p>Silahkan masukkan username & password</p>
                                        <div class="mb-3">
                                            <input type="text" name="username" placeholder="Username" class="form-control" required />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" name="password" placeholder="Password" class="form-control" required />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" class="btn btn-sm btn-primary mb-2" value="Log In" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="<?= base_url() ?>"><small>&laquo; Back to Home</small></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
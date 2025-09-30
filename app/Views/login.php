<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Panggil Bootstrap 5 CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS tambahan untuk memposisikan card di tengah halaman */
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #9AD0C2;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Login SMITH</h4>
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('errors')) : ?>
                            <div>
                                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                    <p class="text-danger"><?= esc($error) ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')) : ?>
                            <div>
                                <p class="text-danger"><?= session()->getFlashdata('error') ?></p>
                            </div>
                        <?php endif; ?>
                        <form action="<?= route_to('login.authenticate') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="username" name="email" class="form-control" required value="<?= old('email') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block" style="font-size: 20px;">Login</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p>Don't have an account? <a href="<?= base_url('register') ?>">Register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panggil Bootstrap 5 JS dan library lainnya dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
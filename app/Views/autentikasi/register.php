<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url('/css/style.css'); ?>">
</head>

<body class="auth">
    <div class="container-auth">
        <div class="auth-form">
            <div class="row">
                <div class="col">
                    <?= csrf_field(); ?>

                    <!-- Registration Form -->
                    <form id="register-form" action="<?= base_url('autentikasi/register') ?>" method="POST">
                        <div style="display: flex; align-items: center; justify-content: center;">
                        </div>
                        <div class="form-tittle">
                            <h1 style="display: flex; align-items: center; justify-content: center;">Register</h1>
                        </div>

                        <?php if (session()->getFlashdata('pesansukses')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('pesansukses') ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-group mt-3">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control <?= validation_show_error('Username') ? 'is-invalid' : ''; ?>" aria-describedby="emailHelp" placeholder="Masukkan Username" name="Username" value="<?= old('Username') ?>" autofocus class="form-control">
                            <?php if (validation_show_error('Username')) : ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('Username') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mt-3">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control <?= validation_show_error('Email') ? 'is-invalid' : ''; ?>" aria-describedby="EmailHelp" placeholder="Masukkan Email" name="Email" value="<?= old('Email') ?>" autofocus class="form-control">
                            <?php if (validation_show_error('Email')) : ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('Email') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mt-3">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control <?= validation_show_error('Password') ? 'is-invalid' : ''; ?>" placeholder="Masukkan Password" value="<?= old('Password') ?>" name="Password" class="form-control">
                            <?php if (validation_show_error('Password')) : ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('Password') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-dark mt-4" id="submit-btn">Sign Up</button>
                            <p style="margin-top: 6px">Sudah punya akun? <a href="<?= base_url('autentikasi/halamanlogin'); ?>">Login</a></p>
                        </div>
                    </form>

                    <!-- jQuery AJAX script -->
                    <script>
                        $(document).ready(function() {
                            $('#register-form').submit(function(e) {
                                e.preventDefault();
                                var formData = $(this).serialize();

                                $.ajax({
                                    type: 'POST',
                                    url: $(this).attr('action'),
                                    data: formData,
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.status == 'success') {
                                            alert('Registration successful!');
                                            window.location.href = '<?= base_url('autentikasi/halamanlogin') ?>';
                                        } else {
                                            alert('Registration failed: ' + response.message);
                                        }
                                    },
                                    error: function(xhr, status, error) {

                                        alert('Registration failed: ' + xhr.responseText);
                                    }
                                });
                            });
                        });
                    </script>

                    <!-- Bootstrap JS and dependencies -->
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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

                    <!-- Login Form -->
                    <form id="login-form" action="/autentikasi/login" method="POST">
                        <div class="form-title">
                            <h1 style="display: flex; align-items: center; justify-content: center;">Login</h1>
                        </div>

                        <div id="error-message" class="alert alert-danger" style="display: none;"></div>

                        <div class="form-group mt-3">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" placeholder="Enter Username" name="Username" value="<?= old('Username') ?>" autofocus>
                        </div>

                        <div class="form-group mt-3">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" placeholder="Enter Password" name="Password">
                        </div>

                        <div class="text-center">
                            <input type="submit" name="login" class="btn btn-dark mt-4" value="Login">
                            <p style="margin-top: 6px">Don't have an account? <a href="<?= base_url('autentikasi/halamanregister'); ?>">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#login-form').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                // Serialize form data
                var formData = $(this).serialize();

                // Submit form via AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            alert('Login successful!');
                            window.location.href = response.redirect; // Redirect to dashboard or any other page
                        } else {
                            // Login failed, show error message
                            $('#error-message').addClass('alert alert-danger').text(response.message).show();
                        }
                    },
                    error: function(xhr, status, error) {
                        // AJAX error
                        alert('Login failed: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
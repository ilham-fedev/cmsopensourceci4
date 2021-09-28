<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CMS Open Source</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("cms/css/bootstrap.css") ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url("cms/css/app.css") ?>">
    <link rel="stylesheet" href="<?= base_url("cms/css/pages/auth.css") ?>">
</head>

<body>
    <div id="auth" class="container">

        <div class="row justify-content-md-center">
            <div class="col-lg-6 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Login</h1>
                    <?php if(session()->has("_error")): ?>
                        <div class="alert alert-danger"><?= session()->get("_error") ?></div>
                    <?php endif ?>
                    <form action="/auth-check" method="POST">
                        <?= csrf_field() ?>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Username" name="username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                       
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                   
                </div>
            </div>
        </div>

    </div>
</body>

</html>
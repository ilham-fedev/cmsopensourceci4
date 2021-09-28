<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard CMS</title>
    <?= csrf_meta() ?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("cms/css/bootstrap.css") ?>">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.2/css/perfect-scrollbar.min.css" integrity="sha512-ygIxOy3hmN2fzGeNqys7ymuBgwSCet0LVfqQbWY10AszPMn2rB9JY0eoG0m1pySicu+nvORrBmhHVSt7+GI9VA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url("cms/css/app.css") ?>">
    <?= $this->renderSection("cssScript") ?>

    <link rel="shortcut icon" href="/images/logo/favicon.png" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <?= $this->include("cms/_menu") ?>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <!-- Start Content -->
            <?= $this->renderSection("content") ?>
            <!-- End Section Content -->
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p><?= date("Y") ?> &copy; CMS Open Source</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://idteknokita.com">Tekno Kita .Id</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <input type="hidden" class="baseUrl" value="<?= base_url("panel") ?>"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.2/perfect-scrollbar.min.js" integrity="sha512-byagY9YdfRsmvM/9ld4XQ9mvd9uNhNOaMzvCYpPw1CLuoIXAdWR8/6rHjRwuWy0Pi+JGWjDHiE7tVGhtPd21ZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url("cms/js/main.js") ?>"></script>
    <script>
        const btnLogout = document.querySelector(".confirm-logout");
        btnLogout.addEventListener("click", (e)=>{
            e.preventDefault();
            Swal.fire({
              title: 'Keluar Panel?',
              showCancelButton: true,
              confirmButtonText: `Oke`,
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                window.location.href = e.target.href;
              }
            })
            return false;
        });
    </script>
    <?= $this->renderSection("postScript") ?>
</body>

</html>
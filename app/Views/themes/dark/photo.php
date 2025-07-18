<?= $this->extend('themes/dark/_layout') ?>
<?= $this->section('content') ?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title"><?= $galeri->jdl_album ?></h1>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/galeri">Galeri</a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
    <!-- End Hero Area -->

    <!-- Start Services Area -->
    <section id="pricing" class="pricing-table section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="row">
                            <?php foreach($photos as $photo): ?>
                            <div class="col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay=".1s">
                                <!-- Single Table -->
                                <div class="single-service one news-items">
                                    <?php
                                        $image = checkImageFolder($photo->gbr_galeri, 'galeri');
                                        $files = explode("/",$image);
                                        $has   = $files[count($files)-1];
                                        $dataPhoto = $image;
                                        $image = base_url("images/faces/" .$has);
                                        if($has <> 'none.jpg')
                                        {
                                            $image = base_url("images/galeri/medium_" . $has);
                                        }

                                    ?>
                                    <a href="<?= base_url("photo/" . $photo->galeri_seo) ?>" data-title="<?= $photo->jdl_galeri ?>" data-photo="<?= base_url($dataPhoto) ?>" class="btn-photos">
                                        <img src="<?= base_url($image) ?>" alt="" loading="lazy">
                                    </a>
                                    <h3><?= $photo->jdl_galeri ?></h3>
                                </div>
                                <!-- End Single Table-->
                            </div>
                            <?php endforeach ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <?= $this->include('themes/classic/_sidebar') ?>
                </div>
            </div>
        </div>
    </section>
    <!-- /End Services Area -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Photo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="photo-image"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Start Call Action Area -->
    <?= $this->include('themes/classic/_social') ?>

    <!-- End Call Action Area -->
    <?= $this->endSection() ?>

    <?= $this->section('postScript') ?>
    <script>
        const photoTitle = document.querySelector('#staticBackdropLabel');
        const photoFrame = document.querySelector('.photo-image');

        options = {
            keyboard: false,
            backdrop: 'static'
        }
        var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), options);
        const btnPhotos = document.querySelectorAll(".btn-photos");
        btnPhotos.forEach(btn => {
            btn.addEventListener("click", async (e)=>{
               e.preventDefault();
               
                photoTitle.innerHTML = e.currentTarget.getAttribute('data-title');
                photoFrame.innerHTML = `<img src='${e.currentTarget.getAttribute('data-photo')}' loading='lazy'/>`;
                myModal.show();

               return false;
            })
        })
    </script>
    <?= $this->endSection() ?>

<?= $this->extend('themes/classic/_layout') ?>
<?= $this->section('content') ?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Daftar Galeri</h1>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Galeri</li>
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
                            <?php foreach($galeries as $galeri): ?>
                            <div class="col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay=".1s">
                                <!-- Single Table -->
                                <div class="single-service one news-items">
                                    <?php
                                        $image = checkImageFolder($galeri->gbr_album);
                                        $files = explode("/",$image);
                                        $has   = $files[count($files)-1];
                                        $image = base_url("images/faces/" .$has);
                                        if($has <> 'none.jpg')
                                        {
                                            $image = base_url("images/album/medium_" . $has);
                                        }

                                    ?>
                                    <a href="<?= base_url("galeri-detail/" . $galeri->album_seo) ?>">
                                        <img src="<?= base_url($image) ?>" alt="" loading="lazy">
                                    </a>
                                    <h3><?= $galeri->jdl_album ?></h3>
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


    <!-- Start Call Action Area -->
    <?= $this->include('themes/classic/_social') ?>

    <!-- End Call Action Area -->
    <?= $this->endSection() ?>


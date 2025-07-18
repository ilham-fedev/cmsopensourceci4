<?= $this->extend('themes/dark/_layout') ?>
<?= $this->section('content') ?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title"><?= $tag ?></h1>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Tags</li>
                </ul>
            </div>

        </div>
    </div>
</div>
    <!-- End Hero Area -->

    <!-- Start Services Area -->
    <section class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="row">
                        <?php foreach($news as $item): ?>
                        <div class="col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay=".1s">
                            <div class="single-service one news-items">
                                <img src="/images/berita/<?= $item->gambar ?>" alt="<?= $item->judul ?>" srcset="">
                                <h3><?= $item->judul ?></h3>
                                <span class="small_tile">
                                    <i class="lni lni-users"></i> <?= $item->username ?> <i class="lni lni-calendar"></i> <?= dateConvert($item->tanggal, "d M Y") ?>
                                </span>
                                <p><?= shortNews($item->isi_berita) ?> ....</p>
                                <a href="/baca/<?= $item->judul_seo ?>">Learn More <i class="lni lni-arrow-right"></i></a>
                            </div>
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
    <section class="call-action">
        <div class="container">
            <div class="inner-content">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="text">
                            <h2>Tetap Terhubung <br /> dengan Kami</h2>
                            <p style="color: #fff;" class="mt-20">Kamu dapat mengikuti aktifitas kami, <br />dengan cara bersosial media.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="social-media-frame">
                            <img src="/images/social/facebook.jpg" alt="">
                            <div class="high-up">
                                <i class="lni lni-facebook-filled"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="social-media-frame">
                            <img src="/images/social/instagram.jpg" alt="">
                            <div class="high-up">
                                <i class="lni lni-instagram-original"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="social-media-frame">
                            <img src="/images/social/twitter.jpg" alt="">
                            <div class="high-up">
                                <i class="lni lni-twitter-original"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="social-media-frame">
                            <img src="/images/social/youtube.jpg" alt="">
                            <div class="high-up">
                                <i class="lni lni-youtube"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Call Action Area -->
    <?= $this->endSection() ?>
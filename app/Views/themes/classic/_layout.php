<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?= $meta->site_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="index, follow">
    <meta name="description" content="<?= $meta->site_description ?>">
    <meta name="keywords" content="<?= $meta->site_keyword ?>">
    <meta name="author" content="id Tekno Kita">
    <meta name="language" content="Indonesia">
    <meta name="revisit-after" content="7">
    <meta name="webcrawlers" content="all">
    <meta name="rating" content="general">
    <meta name="spiders" content="all">
    <meta http-equiv="imagetoolbar" content="no">

    <meta property="og:type" content="website">
	<meta property="og:url" content="<?= $meta->site_url ?>">
	<meta property="og:title" content="<?= $meta->site_title ?>">
	<meta property="og:description" content="<?= $meta->site_description ?>">
	<meta property="og:image" content="<?= $meta->site_image ?>">
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="<?= $meta->site_url ?>">
	<meta property="twitter:title" content="<?= $meta->site_title ?>">
	<meta property="twitter:description" content="<?= $meta->site_description ?>">
	<meta property="twitter:image" content="<?= $meta->site_image ?>">

    <link rel="shortcut icon" type="image/x-icon" href="/images/logo/favicon.png" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="/themes/classic/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/themes/classic/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="/themes/classic/css/animate.css" />
    <link rel="stylesheet" href="/themes/classic/css/tiny-slider.css" />
    <link rel="stylesheet" href="/themes/classic/css/glightbox.min.css" />
    <link rel="stylesheet" href="/themes/classic/css/main.css" />
    <link rel="stylesheet" href="/themes/classic/css/custom.css" />

</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <?= $this->include('themes/classic/_menu') ?>
    <!-- End Header Area -->
    <?= $this->renderSection('content') ?>
    <!-- Start Hero Area -->

    <!-- Start Footer Area -->
    <footer class="footer section">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-about">
                                <div class="logo">
                                    <a href="/">
                                        <img src="/images/logo/logo.png" alt="#">
                                    </a>
                                </div>
                                <?php $identity = service('identity');?>
                                <p>Making the world a better place through constructing elegant hierarchies.</p>
                                <p class="copyright-text"><span>© <?= date('Y') . ' ' . $identity->nama_website ?> .</span>Designed and Developed by <b>idteko.com</b></p>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-2 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Frames</h3>
                                <ul>
                                    <li><a href="/berita">Berita</a></li>
                                    <li><a href="/agenda">Agenda</a></li>
                                    <li><a href="/download">Download</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-2 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Bantuan</h3>
                                <ul>
                                    <li><a href="/hubungi">Hubungi Kami</a></li>
                                    <li><a href="/">Sosial Media</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer newsletter">
                            <?php $statistik = service('statistik');?>
                                <h3>Kunjungan</h3>
                                <div><i class="lni lni-pulse"></i> <small>Total Kunjungan</small> : <b><?= $statistik['days'] ?></b></div>
                                <div><i class="lni lni-target-customer"></i> <small>Bulan Ini</small> : <b><?= $statistik['month'] ?></b></div>
                                <div><i class="lni lni-users"></i> <small>Hari Ini</small> : <b><?= $statistik['all'] ?></b></div>
                                <br />
                                <br />
                            </div>
                            <div class="single-footer newsletter">
                                <h3>Subscribe</h3>
                                <form action="#" method="get" target="_blank" class="newsletter-form" style="margin-top:-20px">
                                    <input name="EMAIL" placeholder="Email address" required="required" type="email">
                                    <div class="button">
                                        <button class="sub-btn"><i class="lni lni-envelope"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                           
                            <!-- End Single Widget -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Footer Top -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="/themes/classic/js/bootstrap.min.js"></script>
    <script src="/themes/classic/js/wow.min.js"></script>
    <script src="/themes/classic/js/tiny-slider.js"></script>
    <script src="/themes/classic/js/glightbox.min.js"></script>
    <script src="/themes/classic/js/count-up.min.js"></script>
    <script src="/themes/classic/js/main.js"></script>

    <?= $this->renderSection('postScript') ?>
</body>

</html>
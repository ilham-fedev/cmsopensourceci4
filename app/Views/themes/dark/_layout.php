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
    <link rel="stylesheet" href="/themes/dark/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/themes/dark/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="/themes/dark/css/animate.css" />
    <link rel="stylesheet" href="/themes/dark/css/tiny-slider.css" />
    <link rel="stylesheet" href="/themes/dark/css/glightbox.min.css" />
    <link rel="stylesheet" href="/themes/dark/css/main.css" />
    <link rel="stylesheet" href="/themes/dark/css/custom.css" />
    <style>
        /* Dark Theme Overrides */
        body {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
        }

        /* Headers and Navigation */
        .header {
            background-color: #1b1b1b !important;
        }

        .navbar {
            background-color: #1b1b1b !important;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        .navbar-brand {
            color: #ffffff !important;
        }

        .navbar-brand img,
        .logo img {
            filter: invert(1) !important;
        }

        .dropdown-menu {
            background-color: #333333 !important;
            border-color: #444444 !important;
        }

        .dropdown-item {
            color: #ffffff !important;
        }

        .dropdown-item:hover {
            background-color: #444444 !important;
        }

        /* Content areas */
        .section {
            background-color: #1a1a1a !important;
        }

        .hero-area {
            background-color: #2d2d2d !important;
        }

        .breadcrumbs {
            background-color: #2d2d2d !important;
        }

        .breadcrumbs .breadcrumb-item {
            color: #ffffff !important;
        }

        .breadcrumbs .breadcrumb-item a {
            color: #4dabf7 !important;
        }

        /* Cards and containers */
        .card {
            background-color: #333333 !important;
            border-color: #444444 !important;
            color: #ffffff !important;
        }

        .card-header {
            background-color: #2d2d2d !important;
            border-color: #444444 !important;
            color: #ffffff !important;
        }

        .card-body {
            background-color: #333333 !important;
            color: #ffffff !important;
        }

        .card-footer {
            background-color: #2d2d2d !important;
            border-color: #444444 !important;
            color: #ffffff !important;
        }

        /* Lists and content */
        .list-group-item {
            background-color: #333333 !important;
            border-color: #444444 !important;
            color: #ffffff !important;
        }

        .list-group-item:hover {
            background-color: #444444 !important;
        }

        /* Forms */
        .form-control {
            background-color: #333333 !important;
            border-color: #444444 !important;
            color: #ffffff !important;
        }

        .form-control:focus {
            background-color: #333333 !important;
            border-color: #4dabf7 !important;
            color: #ffffff !important;
        }

        .form-select {
            background-color: #333333 !important;
            border-color: #444444 !important;
            color: #ffffff !important;
        }

        .form-label {
            color: #ffffff !important;
        }

        /* Buttons */
        .btn-primary {
            background-color: #4dabf7 !important;
            border-color: #4dabf7 !important;
        }

        .btn-secondary {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
        }

        .btn-outline-primary {
            border-color: #4dabf7 !important;
            color: #4dabf7 !important;
        }

        .btn-outline-primary:hover {
            background-color: #4dabf7 !important;
            color: #ffffff !important;
        }

        /* Tables */
        .table {
            color: #ffffff !important;
        }

        .table th {
            background-color: #2d2d2d !important;
            color: #ffffff !important;
            border-color: #444444 !important;
        }

        .table td {
            background-color: #333333 !important;
            color: #ffffff !important;
            border-color: #444444 !important;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #2d2d2d !important;
        }

        /* Modals */
        .modal-content {
            background-color: #333333 !important;
            color: #ffffff !important;
        }

        .modal-header {
            background-color: #2d2d2d !important;
            border-color: #444444 !important;
        }

        .modal-footer {
            background-color: #2d2d2d !important;
            border-color: #444444 !important;
        }

        /* Alerts */
        .alert {
            border-color: #444444 !important;
        }

        .alert-primary {
            background-color: #1a4d7a !important;
            border-color: #4dabf7 !important;
            color: #ffffff !important;
        }

        .alert-secondary {
            background-color: #383d41 !important;
            border-color: #6c757d !important;
            color: #ffffff !important;
        }

        .alert-success {
            background-color: #155724 !important;
            border-color: #28a745 !important;
            color: #ffffff !important;
        }

        .alert-danger {
            background-color: #721c24 !important;
            border-color: #dc3545 !important;
            color: #ffffff !important;
        }

        .alert-warning {
            background-color: #664d03 !important;
            border-color: #ffc107 !important;
            color: #ffffff !important;
        }

        .alert-info {
            background-color: #0c5460 !important;
            border-color: #17a2b8 !important;
            color: #ffffff !important;
        }

        /* Footer */
        .footer {
            background-color: #2d2d2d !important;
            color: #ffffff !important;
        }

        .footer a {
            color: #4dabf7 !important;
        }

        .footer h1,
        .footer h2,
        .footer h3,
        .footer h4,
        .footer h5,
        .footer h6 {
            color: #ffffff !important;
        }

        /* Sidebar */
        .sidebar {
            background-color: #2d2d2d !important;
        }

        .sidebar .widget {
            background-color: #333333 !important;
            border-color: #444444 !important;
        }

        .sidebar .widget-title {
            color: #ffffff !important;
        }

        .sidebar .widget-body {
            color: #ffffff !important;
        }

        .sidebar .widget-body a {
            color: #4dabf7 !important;
        }

        /* Text elements */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #ffffff !important;
        }

        p {
            color: #ffffff !important;
        }

        span {
            color: #ffffff !important;
        }

        div {
            color: #ffffff !important;
        }

        /* Links */
        a {
            color: #4dabf7 !important;
        }

        a:hover {
            color: #74c0fc !important;
        }

        /* Badges */
        .badge {
            color: #ffffff !important;
        }

        .badge-primary {
            background-color: #4dabf7 !important;
        }

        .badge-secondary {
            background-color: #6c757d !important;
        }

        /* Pagination */
        .pagination .page-link {
            background-color: #333333 !important;
            border-color: #444444 !important;
            color: #ffffff !important;
        }

        .pagination .page-link:hover {
            background-color: #444444 !important;
        }

        .pagination .page-item.active .page-link {
            background-color: #4dabf7 !important;
            border-color: #4dabf7 !important;
        }

        /* Override any white backgrounds */
        .bg-white {
            background-color: #333333 !important;
        }

        .bg-light {
            background-color: #2d2d2d !important;
        }

        .text-dark {
            color: #ffffff !important;
        }

        .text-muted {
            color: #adb5bd !important;
        }

        /* News and content areas */
        .news-item {
            background-color: #333333 !important;
            border-color: #444444 !important;
        }

        .news-title {
            color: #ffffff !important;
        }

        .news-content {
            color: #ffffff !important;
        }

        .news-meta {
            color: #adb5bd !important;
        }

        /* Search results */
        .search-result {
            background-color: #333333 !important;
            border-color: #444444 !important;
        }

        .search-result-title {
            color: #ffffff !important;
        }

        .search-result-content {
            color: #ffffff !important;
        }

        /* Additional Bootstrap utility overrides */
        .bg-primary {
            background-color: #4dabf7 !important;
        }

        .bg-secondary {
            background-color: #6c757d !important;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }

        .bg-warning {
            background-color: #ffc107 !important;
        }

        .bg-info {
            background-color: #17a2b8 !important;
        }

        .bg-dark {
            background-color: #2d2d2d !important;
        }

        /* Text colors */
        .text-primary {
            color: #4dabf7 !important;
        }

        .text-secondary {
            color: #6c757d !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .text-info {
            color: #17a2b8 !important;
        }

        .text-light {
            color: #f8f9fa !important;
        }

        .text-white {
            color: #ffffff !important;
        }

        /* Content blocks */
        .content-block {
            background-color: #333333 !important;
            color: #ffffff !important;
        }

        .content-wrapper {
            background-color: #1a1a1a !important;
        }

        .main-content {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
        }

        /* Any remaining white elements */
        .white-bg {
            background-color: #333333 !important;
        }

        .light-bg {
            background-color: #2d2d2d !important;
        }

        /* Specific container overrides */
        .container,
        .container-fluid {
            background-color: transparent !important;
        }

        .row {
            background-color: transparent !important;
        }

        .col,
        .col-1,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-10,
        .col-11,
        .col-12,
        .col-sm,
        .col-md,
        .col-lg,
        .col-xl,
        .col-xxl {
            background-color: transparent !important;
        }

        /* Additional specific class overrides */
        .single-service {
            background-color: #333333 !important;
            color: #ffffff !important;
            border-color: #444444 !important;
        }

        .single-service h3 {
            color: #ffffff !important;
        }

        .single-service p {
            color: #ffffff !important;
        }

        .single-service .service-icon {
            color: #4dabf7 !important;
        }

        .pricing-table .single-table {
            background-color: #333333 !important;
            color: #ffffff !important;
            border-color: #444444 !important;
        }

        .pricing-table .single-table .table-head {
            background-color: #2d2d2d !important;
            color: #ffffff !important;
        }

        .pricing-table .single-table .table-head h4 {
            color: #ffffff !important;
        }

        .pricing-table .single-table .table-head p {
            color: #ffffff !important;
        }

        .pricing-table .single-table .table-content {
            background-color: #333333 !important;
            color: #ffffff !important;
        }

        .pricing-table .single-table .table-content ul li {
            color: #ffffff !important;
        }

        .pricing-table .single-table .table-bottom {
            background-color: #2d2d2d !important;
        }

        .call-action {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
            margin-bottom: 4rem;
        }

        .call-action h2 {
            color: #ffffff !important;
        }

        .call-action p {
            color: #ffffff !important;
        }

        .call-action .btn {
            color: #ffffff !important;
        }

        .navbar-nav .nav-item .sub-menu {
            background-color: #333333 !important;
            border-color: #444444 !important;
        }

        .navbar-nav .nav-item .sub-menu li {
            background-color: #333333 !important;
        }

        .navbar-nav .nav-item .sub-menu li a {
            color: #ffffff !important;
            background-color: #333333 !important;
        }

        .navbar-nav .nav-item .sub-menu li a:hover {
            background-color: #444444 !important;
            color: #ffffff !important;
        }

        .navbar-nav .nav-item .sub-menu li:hover {
            background-color: #444444 !important;
        }

        /* Additional common classes that might have white backgrounds */
        .feature-item {
            background-color: #333333 !important;
            color: #ffffff !important;
            border-color: #444444 !important;
        }

        .feature-item h3 {
            color: #ffffff !important;
        }

        .feature-item p {
            color: #ffffff !important;
        }

        .testimonial-item {
            background-color: #333333 !important;
            color: #ffffff !important;
            border-color: #444444 !important;
        }

        .testimonial-item .testimonial-content {
            color: #ffffff !important;
        }

        .testimonial-item .testimonial-author {
            color: #ffffff !important;
        }

        .blog-item {
            background-color: #333333 !important;
            color: #ffffff !important;
            border-color: #444444 !important;
        }

        .blog-item .blog-content {
            background-color: #333333 !important;
            color: #ffffff !important;
        }

        .blog-item .blog-content h3 {
            color: #ffffff !important;
        }

        .blog-item .blog-content p {
            color: #ffffff !important;
        }

        .service-box {
            background-color: #333333 !important;
            color: #ffffff !important;
            border-color: #444444 !important;
        }

        .service-box h3 {
            color: #ffffff !important;
        }

        .service-box p {
            color: #ffffff !important;
        }

        .team-item {
            background-color: #333333 !important;
            color: #ffffff !important;
            border-color: #444444 !important;
        }

        .team-item .team-content {
            background-color: #333333 !important;
            color: #ffffff !important;
        }

        .team-item .team-content h3 {
            color: #ffffff !important;
        }

        .team-item .team-content p {
            color: #ffffff !important;
        }
    </style>

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
    <?= $this->include('themes/dark/_menu') ?>
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
                                <?php $identity = service('identity'); ?>
                                <p>Making the world a better place through constructing elegant hierarchies.</p>
                                <p class="copyright-text"><span>© <?= date('Y') . ' ' . $identity->nama_website ?>
                                        .</span>Designed and Developed by <b>idteko.com</b></p>
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
                                <?php $statistik = (new \App\Models\Cms)->getKunjungan(); ?>
                                <h3>Kunjungan</h3>
                                <div><i class="lni lni-pulse"></i> <small>Total Kunjungan</small> :
                                    <b><?= $statistik['days'] ?? '0' ?></b></div>
                                <div><i class="lni lni-target-customer"></i> <small>Bulan Ini</small> :
                                    <b><?= $statistik['month'] ?? '0' ?></b></div>
                                <div><i class="lni lni-users"></i> <small>Hari Ini</small> :
                                    <b><?= $statistik['all'] ?? '0' ?></b></div>
                                <br />
                                <br />
                            </div>
                            <div class="single-footer newsletter">
                                <h3>Subscribe</h3>
                                <form action="#" method="get" target="_blank" class="newsletter-form"
                                    style="margin-top:-20px">
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
    <script src="/themes/dark/js/bootstrap.min.js"></script>
    <script src="/themes/dark/js/wow.min.js"></script>
    <script src="/themes/dark/js/tiny-slider.js"></script>
    <script src="/themes/dark/js/glightbox.min.js"></script>
    <script src="/themes/dark/js/count-up.min.js"></script>
    <script src="/themes/dark/js/main.js"></script>

    <?= $this->renderSection('postScript') ?>
</body>

</html>
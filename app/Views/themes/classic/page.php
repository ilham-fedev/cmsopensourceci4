<?= $this->extend('themes/classic/_layout') ?>
<?= $this->section('content') ?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title"><?= $page->judul ?></h1>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Page</li>
                </ul>
            </div>

        </div>
    </div>
</div>
<section class="services section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12">
                <div class="single-service one news-items">
                    <?php if($page->gambar): ?>
                        <img src="/images/galeri/<?= $page->gambar ?>" alt="<?= $page->judul ?>" srcset="">
                    <?php endif ?>
                    <h3><?= $page->judul ?></h3>
                    <p><?= $page->isi_halaman ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <?= $this->include('themes/classic/_sidebar') ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->extend('themes/classic/_layout') ?>
<?= $this->section('content') ?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Hubungi Kami</h1>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Hubungi</li>
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
                    <p>
                        <?= $item->deskripsi ?>
                    </p>
                    <iframe src="<?= $item->map ?>" style="border:0;border-radius:15px;width:100%;height:300px" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <?= $this->include('themes/classic/_sidebar') ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
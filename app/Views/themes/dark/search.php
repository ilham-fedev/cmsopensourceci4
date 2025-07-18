<?= $this->extend('themes/dark/_layout') ?>
<?= $this->section('content') ?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Pencarian "<?= $word ?>"</h1>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Pencarian</li>
                </ul>
            </div>

        </div>
    </div>
</div>
<section class="services section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12">
                <div class="row">
                    <?php foreach($items as $item): ?>
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
<?= $this->endSection() ?>
<?= $this->extend('themes/dark/_layout') ?>
<?= $this->section('content') ?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title"><?= $item->judul ?></h1>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Berita</li>
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
                    <?php if($item->gambar): ?>
                        <img src="/images/berita/<?= $item->gambar ?>" alt="<?= $item->judul ?>" srcset="" load="lazy">
                    <?php endif ?>
                    <h3><?= $item->judul ?></h3>
                    <span class="small_tile">
                        <i class="lni lni-users"></i> <?= $item->username ?> <i class="lni lni-calendar"></i> <?= dateConvert($item->tanggal, "d M Y") ?>
                    </span>
                    <p><?= $item->isi_berita ?></p>
                </div>

                <div class="single-service">
                    <div id="disqus_thread"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <?= $this->include('themes/classic/_sidebar') ?>
            </div>
        </div>
    </div>
</section>

<input type="hidden" class="page_url" value="<?= base_url('baca/'.$item->judul_seo) ?>" />
<input type="hidden" class="page_identifier" value="berita_<?= $item->id ?>" />
<?= $this->endSection() ?>

<?= $this->section('postScript') ?>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    
    var disqus_config = function () {
        const PAGE_URL = document.querySelector('.page_url').value
        const PAGE_IDENTIFIER = document.querySelector('.page_identifier').value
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://teknokita.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<?= $this->endSection() ?>
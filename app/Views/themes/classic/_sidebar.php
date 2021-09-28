<!-- Search Widget -->
<div class="row">
    <div class="col-12  wow fadeInUp" data-wow-delay=".1s">
        <div class="single-service one bg-sidebar sidebar">
            <div class="service-icon">
                <i class="lni lni-search"></i>
            </div>
            <h3>Pencarian</h3>
            <p>
                <form action="/search" method="GET">
                  <input name="search" type="text" class="form-control form-control-lg search border border-white" placeholder="Cari.." aria-label="Recipient's username" aria-describedby="button-addon2">
                </form>
            </p>
        </div>
    </div>
</div>

<!-- Popular Post -->
<div class="row">
    <div class="col-12  wow fadeInUp" data-wow-delay=".4s">
        <div class="single-service one bg-sidebar sidebar">
            <div class="service-icon">
                <i class="lni lni-pointer-top"></i>
            </div>
            <h3>Popular Post</h3>
            <?php 
                $populars = new \App\Models\Cms;
                $populars->limit = 6;
                $populars->order = [
                    'order_by' => 'dibaca',
                    'sort'     => 'DESC'
                ];

                foreach($populars->getNews() as $popular):
            ?>
            <p class="w-80">
                <b><a href="/baca/<?= $popular->judul_seo ?>"><?= $popular->judul ?></a></b>
                <span><i class="lni lni-calendar"></i> <?= dateConvert($popular->tanggal, 'd M Y') ?></span>
            </p>
            <hr />
            <?php endforeach ?>
        </div>
    </div>
</div>

<!-- Categoiries -->
<div class="row">
    <div class="col-12  wow fadeInUp" data-wow-delay=".1s">
        <div class="single-service one bg-sidebar sidebar">
            <div class="service-icon">
                <i class="lni lni-list"></i>
            </div>
            <h3>Kategori</h3>
            <?php 
                $categories = new \App\Models\Cms;
                $categories->limit = 6;

                foreach($categories->getCategories() as $category):
            ?>
            <a href="/kategori/<?= $category->kategori_seo ?>"><?= $category->nama_kategori ?></a>
            <?php endforeach ?>
        </div>
    </div>
</div>

<!-- Tags -->
<div class="row">
    <div class="col-12  wow fadeInUp" data-wow-delay=".1s">
        <div class="single-service one bg-sidebar sidebar">
            <div class="service-icon">
                <i class="lni lni-paperclip"></i>
            </div>
            <h3>Tags</h3>
            <?php 
                $tags = new \App\Models\Cms;
                $tags->limit = 15;

                foreach($tags->getTags() as $tag):
            ?>
            <a href="/tags/<?= $tag->tag_seo ?>" class="btn btn-sm btn-outline-primary tags"><?= $tag->nama_tag ?></a>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Banner Slider</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Banner</h4>
                    </div>
                    <div class="card-body">
                        <a href="<?= base_url("panel/banner/new") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                            <i class="bi bi-file-plus-fill"></i>
                            Tambah Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <?php foreach($items as $item): ?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <?php
                                $image = checkImageFolder('medium_' .$item->gambar, 'galeri');
                            ?>
                            <img class="image-banner" src="/<?= $image ?>" alt="<?= $item->gambar ?>" loading="lazy" />
                            <br>
                            <b><?= $item->judul ?></b>
                            <div class="row">
                                <div class="col-12">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="<?= base_url("panel/banner/".$item->id."/edit") ?>" class="btn btn-outline-secondary"><i class="bi bi-pen"></i></a>
                                        <a href="<?= base_url("panel/banner/". $item->id) ?>" class="btn btn-outline-dark btn-delete"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section("cssScript") ?>
<style>
    .image-banner{
        width:100%;
        border-radius: 15px
    }
</style>
<?php $this->endSection() ?>
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
                        <h4>Edit Banner</h4>
                        <a href="<?= base_url("panel/banner/") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/banner/" . $item->id) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <?= method("PUT") ?>
                            <div class="mb-3">
                              <label class="form-label">Judul</label>
                              <input type="text" class="form-control" name="judul" value="<?= $item->judul ?>" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Gambar</label>
                              <?php if($item->gambar): $image = thumb($item->gambar); ?>
                                    <div class="m-3">
                                    <img src="<?= $image ?>" alt="">
                                    </div>
                              <?php endif ?>
                              <input type="file" class="form-control file-upload-image" onchange="checkImage(this)" name="gambar"/>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary btn-lg">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section("postScript") ?>
<script src="<?= base_url('cms/js/upload.js') ?>"></script>
<?= $this->endSection() ?>
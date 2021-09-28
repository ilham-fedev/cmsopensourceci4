<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Hubungi Kami</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Hubungi Kami</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/hubungi") ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $item->id ?>" />
                            <div class="mb-3">
                              <label class="form-label">Email</label>
                              <input type="text" class="form-control" name="email" value="<?= $item->email ?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Maps</label>
                              <textarea class="form-control" name="map" rows="2"><?= $item->map ?></textarea>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Deskripsi</label>
                              <textarea class="form-control" id="editor" name="deskripsi" rows="3"><?= $item->deskripsi ?></textarea>
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

<?= $this->section("cssScript") ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section("postScript") ?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="<?= base_url('cms/js/upload.js') ?>"></script>
<?= $this->endSection() ?>
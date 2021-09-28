<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Pinned</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Pinned</h4>
                        <a href="<?= base_url("panel/pinned") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/pinned/" . $item->id) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <?= method("PUT") ?>
                            <div class="mb-3">
                              <label class="form-label">Title</label>
                              <input type="text" class="form-control" name="title" value="<?= $item->title ?>" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Sub Title</label>
                              <input type="text" class="form-control" name="subtitle" value="<?= $item->subtitle ?>" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Link</label>
                              <input type="text" class="form-control" name="link" value="<?= $item->link ?>" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Gambar</label>
                              <div class="m-3">
                                  <img src="<?= base_url("images/social/" . $item->image) ?>" loading="lazy" style="width:128px" alt="" srcset="">
                              </div>
                              <input type="file" class="form-control file-upload-image" onchange="checkImage(this)" name="image"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Aktif</label>
                              <select name="aktif" class="form-select">
                                  <?php if($item->aktif == 'Y'): ?>
                                  <option value="Y" selected>Ya</option>
                                  <option value="N">Tidak</option>
                                  <?php else: ?>
                                  <option value="Y">Ya</option>
                                  <option value="N" selected>Tidak</option>
                                  <?php endif ?>
                              </select>
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="<?= base_url('cms/js/upload.js') ?>"></script>
<?= $this->endSection() ?>
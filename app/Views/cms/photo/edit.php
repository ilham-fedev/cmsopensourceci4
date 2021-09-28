<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Photo</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Photo</h4>
                        <a href="<?= base_url("panel/photo") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/photo/". $item->id) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <?= method('PUT') ?>
                            <div class="mb-3">
                              <label class="form-label">Album</label>
                              <select name="id_album" class="form-select">
                              <option value="0">-- Pilih Album --</option>
                                <?php 
                                foreach($albums as $album): 
                                $selected = ($album->id == $item->id_album) ? 'selected' : '';
                                ?>
                                  <option value="<?= $album->id ?>" <?= $selected ?>><?= $album->jdl_album ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Judul</label>
                              <input type="text" class="form-control" name="jdl_galeri" value="<?= $item->jdl_galeri ?>" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Gambar</label>
                              <div class="m-3">
                                  <?php
                                    if($item->gbr_galeri):
                                        $image = thumb($item->gbr_galeri);
                                  ?>
                                    <img src="<?= $image ?>" alt="" srcset="">
                                  <?php endif ?>
                              </div>
                              <input type="file" class="form-control file-upload-image" onchange="checkImage(this)" name="gbr_galeri"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Keterangan</label>
                              <textarea class="form-control" id="editor" name="keterangan" rows="3"><?= $item->keterangan ?></textarea>
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
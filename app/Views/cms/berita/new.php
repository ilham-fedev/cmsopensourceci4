<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Berita</h3>
</div>
<div class="page-content">
    <section class="row">
            <form action="<?= base_url("panel/berita") ?>" method="post" enctype="multipart/form-data" class="row">
            <?= csrf_field() ?>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Berita</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                          <label class="form-label">Judul</label>
                          <input type="text" class="form-control" name="judul" required/>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Gambar</label>
                          <input type="file" class="form-control file-upload-image" onchange="checkImage(this)" name="gambar"/>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Isi berita</label>
                          <textarea class="form-control" id="editor" name="isi_berita" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <a href="<?= base_url("panel/berita") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                          <label class="form-label">Kategori</label>
                          <select name="id_kategori" class="form-select">
                              <option value="0">-- Pilih Kategori --</option>
                              <?php foreach($kategori as $cat): ?>
                                <option value="<?= $cat->id ?>"><?= $cat->nama_kategori ?></option>
                              <?php endforeach ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Tag</label>
                          <select name="tag[]" class="form-select form-select-lg form-tag" multiple>
                              <?php foreach($tags as $tag): ?>
                                <option value="<?= $tag->tag_seo ?>"><?= $tag->nama_tag ?></option>
                              <?php endforeach ?>
                          </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary btn-lg">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section("cssScript") ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section("postScript") ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="<?= base_url('cms/js/upload.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('.form-tag').select2();
</script>
<?= $this->endSection() ?>
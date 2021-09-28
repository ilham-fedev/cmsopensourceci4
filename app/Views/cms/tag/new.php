<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Tags</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Tag</h4>
                        <a href="<?= base_url("panel/tag") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/tag") ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                              <label class="form-label">Nama Tag</label>
                              <input type="text" class="form-control" name="nama_tag" required/>
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
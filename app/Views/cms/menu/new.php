<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Menu Utama</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Menu</h4>
                        <a href="<?= base_url("panel/menu") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/menu") ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                              <label class="form-label">Nama Menu</label>
                              <input type="text" class="form-control" name="nama_menu" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Link</label>
                              <input type="text" class="form-control" name="link" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Aktif</label>
                              <select name="aktif" class="form-select">
                                  <option value="Y">Ya</option>
                                  <option value="N">Tidak</option>
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
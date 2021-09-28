<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Sub Menu</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Sub Menu</h4>
                        <a href="<?= base_url("panel/submenu") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/submenu") ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                              <label class="form-label">Menu Utama</label>
                              <select name="id_main" class="form-select">
                                  <option value="0">-- Pilih Menu --</option>
                                  <?php foreach($menu as $main): ?>
                                  <option value="<?= $main->id ?>"><?= $main->nama_menu ?></option>
                                  <?php endforeach ?>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Nama SUb Menu</label>
                              <input type="text" class="form-control" name="nama_sub" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Link</label>
                              <input type="text" class="form-control" name="link_sub" required/>
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
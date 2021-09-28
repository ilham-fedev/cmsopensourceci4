<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Poling</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Poling</h4>
                        <a href="<?= base_url("panel/polls") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/polls") ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                              <label class="form-label">Pilihan</label>
                              <input type="text" class="form-control" name="pilihan" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Status</label>
                              <select name="status" class="form-select">
                                  <option value="Jawaban">Jawaban</option>
                                  <option value="Pertanyaan">Pertanyaan</option>
                              </select>
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
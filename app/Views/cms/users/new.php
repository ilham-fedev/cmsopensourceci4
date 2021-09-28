<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>User</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah User</h4>
                        <a href="<?= base_url("panel/user") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/user") ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                              <label class="form-label">Username</label>
                              <input type="text" class="form-control" name="username" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Password</label>
                              <input type="text" class="form-control" name="password" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Identitas</label>
                              <input type="text" class="form-control" name="nama_lengkap" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Email</label>
                              <input type="text" class="form-control" name="email" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">No Telpon</label>
                              <input type="text" class="form-control" name="no_telp" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Blokir</label>
                              <select name="blokir" class="form-select">
                                  <option value="N">Tidak</option>
                                  <option value="Y">Ya</option>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Level</label>
                              <select name="level" class="form-select">
                                  <option value="admin">Administrator</option>
                                  <option value="user">User</option>
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
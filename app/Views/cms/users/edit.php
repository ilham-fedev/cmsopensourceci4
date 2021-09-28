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
                        <h4>Edit User</h4>
                        <a href="<?= base_url("panel/user") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/user/". $item->id) ?>" method="post">
                            <?= csrf_field() ?>
                            <?= method('PUT') ?>
                            <div class="mb-3">
                              <label class="form-label">Username</label>
                              <input type="text" class="form-control" name="username" value="<?= $item->username ?>" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Password (kosongi jika tidak di ubah)</label>
                              <input type="text" class="form-control" name="password"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Identitas</label>
                              <input type="text" class="form-control" name="nama_lengkap" value="<?= $item->nama_lengkap ?>" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Email</label>
                              <input type="text" class="form-control" name="email" value="<?= $item->email ?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">No Telpon</label>
                              <input type="text" class="form-control" name="no_telp" value="<?= $item->no_telp ?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Blokir</label>
                              <select name="blokir" class="form-select">
                                  <?Php if($item->blokir == "Y"): ?>
                                  <option value="N">Tidak</option>
                                  <option value="Y" selected>Ya</option>
                                  <?php else: ?>
                                  <option value="N" selected>Tidak</option>
                                  <option value="Y">Ya</option>
                                  <?php endif ?>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Level</label>
                              <select name="level" class="form-select">
                                <?Php if($item->level == "admin"): ?>
                                  <option value="admin" selected>Administrator</option>
                                  <option value="user">User</option>
                                <?php else: ?>
                                  <option value="admin">Administrator</option>
                                  <option value="user" selected>User</option>
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
<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Edit Akun</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Akun <?= session()->get("cms.nama") ?></h4>
                    </div>
                    <div class="card-body">
                        <?php if(session()->has("message")): ?>
                            <div class="alert alert-info"><?= session()->get("message") ?></div>
                        <?php endif ?>
                        <form action="<?= base_url("panel/akun/save") ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= session()->get('cms.id') ?>" />
                            <div class="mb-3">
                              <label class="form-label">Username</label>
                              <input type="text" class="form-control" name="username" value="<?= session()->get("cms.initial") ?>" readonly/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Nama Lengkap</label>
                              <input type="text" class="form-control" name="nama_lengkap" value="<?= session()->get("cms.nama") ?>" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Email</label>
                              <input type="text" class="form-control" name="email" value="<?= session()->get("cms.email") ?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Phone</label>
                              <input type="text" class="form-control" name="no_telp" value="<?= session()->get("cms.phone") ?>"/>
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
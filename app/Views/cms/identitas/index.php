<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Identitas Website</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Identitas Website</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/identitas") ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $item->id ?>" />
                            <div class="mb-3">
                              <label class="form-label">Nama Website</label>
                              <input type="text" class="form-control" name="nama_website" value="<?= $item->nama_website ?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Alamat Website</label>
                              <input type="text" class="form-control" name="alamat_website" value="<?= $item->alamat_website ?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Meta Keyword</label>
                              <input type="text" class="form-control" name="meta_keyword" value="<?= $item->meta_keyword ?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Meta Deskripsi</label>
                              <textarea class="form-control" name="meta_deskripsi"   rows="3"><?= $item->meta_deskripsi ?></textarea>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Facebook</label>
                              <input type="text" class="form-control" name="facebook" value="<?= $item->facebook ?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Twitter</label>
                              <input type="text" class="form-control" name="twitter" value="<?= $item->twitter ?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Instagram</label>
                              <input type="text" class="form-control" name="instagram" value="<?= $item->instagram ?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Youtube</label>
                              <input type="text" class="form-control" name="youtube" value="<?= $item->youtube ?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Logo (png)</label>
                              <?php if($item->logo) { ?>
                                  <div class="p-3"><img src="/images/logo/logo.png" alt="" srcset=""></div>
                              <?php } ?>
                              <input type="file" class="form-control" name="logo" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Favicon (80px * 80px) (png)</label>
                              <?php if($item->favicon) { ?>
                                  <div class="p-3"><img src="/images/logo/favicon.png" alt="" srcset=""></div>
                              <?php } ?>
                              <input type="file" class="form-control" name="favicon" />
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
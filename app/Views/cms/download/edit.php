<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Download</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Download</h4>
                        <a href="<?= base_url("panel/download") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/download/" . $item->id) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <?= method("PUT") ?>
                            <div class="mb-3">
                              <label class="form-label">Judul</label>
                              <input type="text" class="form-control" value="<?= $item->judul ?>" name="judul" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">File <span class="badge bg-info">upload file di lokal folder</span></label>
                              <div class="m-3">
                                  <?php if($item->nama_file): ?>
                                    <a href="<?= base_url("downloads/" . $item->nama_file) ?>" target="_blank" class="btn btn-sm btn-primary">download</a>
                                  <?php endif ?>
                              </div>
                              <input type="file" class="form-control" name="nama_file"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Direct Link <span class="badge bg-info">download dari (dropbox / drive / one drive atau lainnya)</span></label>
                              <input type="text" class="form-control" name="direct_link" value="<?= $item->direct_link ?>"/>
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
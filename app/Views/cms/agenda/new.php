<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Agenda</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Agenda</h4>
                        <a href="<?= base_url("panel/agenda") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                          <i class="bi bi-arrow-left"></i>
                          Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url("panel/agenda") ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                              <label class="form-label">Tema</label>
                              <input type="text" class="form-control" name="tema" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tempat</label>
                              <input type="text" class="form-control" name="tempat" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Penyelenggara</label>
                              <input type="text" class="form-control" name="pengirim"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tanggal Mulai</label>
                              <input type="text" autocomplete="false" data-toggle="datepicker" class="form-control" name="tgl_mulai" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tanggal Selesai</label>
                              <input type="text" autocomplete="false" data-toggle="datepicker" class="form-control" name="tgl_selesai" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Jam</label>
                              <input type="text" class="form-control" name="jam" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Isi agenda</label>
                              <textarea class="form-control" id="editor" name="isi_agenda" rows="3"></textarea>
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

<?= $this->section("cssScript") ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@chenfengyuan/datepicker@1.0.10/dist/datepicker.min.css">
<?= $this->endSection() ?>

<?= $this->section("postScript") ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@chenfengyuan/datepicker@1.0.10/dist/datepicker.min.js"></script>

<script src="<?= base_url('cms/js/upload.js') ?>"></script>
<script>
    $('[data-toggle="datepicker"]').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>
<?= $this->endSection() ?>
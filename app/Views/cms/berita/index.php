<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Berita</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Berita</h4>
                    </div>
                    <div class="card-body">
                        <a href="<?= base_url("panel/berita/new") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                            <i class="bi bi-file-plus-fill"></i>
                            Tambah Baru
                        </a>
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <th>No</th>
                                <th>Judul</th>
                                <th>Link</th>
                                <th>di Baca</th>
                                <th>Uploaded</th>
                                <th>#</th>
                            </thead>
                            <tbody>
                                <?php foreach($items as $item): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->judul ?></td>
                                        <td><span class="badge bg-primary"><?= $item->judul_seo ?></span></td>
                                        <td><span class="badge bg-primary"><?= $item->dibaca ?></span></td>
                                        <td><?= dateConvert($item->created_at, "d M Y") ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url("panel/berita/".$item->id."/edit") ?>" class="btn btn-outline-secondary"><i class="bi bi-pen"></i></a>
                                                <a href="<?= base_url("panel/berita/". $item->id) ?>" class="btn btn-outline-dark btn-delete"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                        <div class="m-3">
                        <?= $pager->links() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
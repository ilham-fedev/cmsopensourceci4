<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Users</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Users</h4>
                    </div>
                    <div class="card-body">
                        <a href="<?= base_url("panel/user/new") ?>" class="btn btn-outline-secondary mb-2 position-absolute top-0 end-0">
                            <i class="bi bi-file-plus-fill"></i>
                            Tambah Baru
                        </a>
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <th>No</th>
                                <th>Identitas</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>#</th>
                            </thead>
                            <tbody>
                                <?php foreach($items as $item): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->nama_lengkap ?></td>
                                        <td><?= $item->username ?></td>
                                        <td><span class="badge bg-primary"><?= $item->level ?></span></td>
                                        <td><span class="badge bg-info"><?= $item->blokir ?></span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url("panel/user/".$item->id."/edit") ?>" class="btn btn-outline-secondary"><i class="bi bi-pen"></i></a>
                                                <a href="<?= base_url("panel/user/". $item->id) ?>" class="btn btn-outline-dark btn-delete"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </section>
</div>
<?= $this->endSection() ?>
<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="bi bi-file-binary-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Kunjungan</h6>
                                    <h6 class="font-extrabold mb-0"><?= $statistik ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="bi bi-files"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Page</h6>
                                    <h6 class="font-extrabold mb-0"><?= $halaman ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="bi bi-card-text"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Berita</h6>
                                    <h6 class="font-extrabold mb-0"><?= $berita ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="bi bi-file-earmark-image"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Galeri</h6>
                                    <h6 class="font-extrabold mb-0"><?= $galeri ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistik Kunjungan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" style="width:100%;max-height:300px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Berita</h4>
                        </div>
                        <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Created</th>
                                                <th>Di Baca</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($items as $item): ?>
                                            <tr>
                                                <td class="col-1">
                                                    <?= $no++ ?>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0"><?= $item->judul ?></p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0"><?= dateConvert($item->created_at, "d F Y") ?></p>
                                                </td>
                                                <td class="col-auto">
                                                    <h2><?= $item->dibaca ?></h2>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class=" align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="/images/faces/ac.png" alt="Face 1">
                        </div> <br />
                        <div class="ms-3 name">
                            <h5 class="font-bold"><?= session()->get("cms.nama") ?></h5>
                            <small class="text-muted mb-0"><?= session()->get("cms.email") ?></small>
                        </div>
                    </div>
                    <div class="col-12">
                    <button data-href="<?= base_url("cms-logout") ?>" class='btn btn-block btn-xl btn-light-primary font-bold mt-3 confirm-logout-dashboard'>Log Out</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Pintasan</h4>
                </div>
                <div class="card-content pb-4">
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <button data-href="<?= base_url("panel/berita/new") ?>" type="button" class="btn btn-light btn-lg btn-shortcut">
                                <i class="bi bi-arrow-up-right-square"></i>
                            </button>
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Berita</h5>
                            <h6 class="text-muted mb-0">Tambah Berita</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <button data-href="<?= base_url("panel/halaman/new") ?>" type="button" class="btn btn-light btn-lg btn-shortcut">
                                <i class="bi bi-arrow-up-right-square"></i>
                            </button>
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Halaman</h5>
                            <h6 class="text-muted mb-0">Tambah Halaman</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <button data-href="<?= base_url("panel/album/new") ?>" type="button" class="btn btn-light btn-lg btn-shortcut">
                                <i class="bi bi-arrow-up-right-square"></i>
                            </button>
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Album</h5>
                            <h6 class="text-muted mb-0">Tambah Album</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <button data-href="<?= base_url("panel/agenda/new") ?>" type="button" class="btn btn-light btn-lg btn-shortcut">
                                <i class="bi bi-arrow-up-right-square"></i>
                            </button>
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Agenda</h5>
                            <h6 class="text-muted mb-0">Tambah Agenda</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <button data-href="<?= base_url("panel/download/new") ?>" type="button" class="btn btn-light btn-lg btn-shortcut">
                                <i class="bi bi-arrow-up-right-square"></i>
                            </button>
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Dokumen</h5>
                            <h6 class="text-muted mb-0">Tambah Dokumen</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
<?= $this->section("postScript") ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = [
  'Januari',
  'Februari',
  'Maret',
  'April',
  'Mei',
  'Juni',
  'Juli',
  'Agustus',
  'September',
  'Oktober',
  'November',
  'Desember'
];

const baseUrl = document.querySelector(".baseUrl").value;
let statistikData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]

fetch(`${baseUrl}/dashboard-api`)
.then( res => res.json())
.then((items)=>{
    const statistik = items.data;
    statistik.forEach(item => {
        statistikData.splice(parseFloat(item.bulan)-1,1, parseFloat(item.id))
    })
    
    const data = {
      labels: labels,
      datasets: [{
        label: 'Kunjungan',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: statistikData,
      }]
    };
    const config = {
      type: 'line',
      data,
      options: {}
    };
    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    const btnLogout = document.querySelector(".confirm-logout-dashboard");
    btnLogout.addEventListener("click", (e)=>{
        Swal.fire({
          title: 'Keluar Panel?',
          showCancelButton: true,
          confirmButtonText: `Oke`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            targetHref = e.target.getAttribute("data-href");
            window.location.href = targetHref;
          }
        })
        return false;
    });
})

const btnShortcut = document.querySelectorAll('.btn-shortcut');
btnShortcut.forEach((item)=>{
    item.addEventListener("click",(e)=>{
        const u = e.currentTarget.getAttribute("data-href");
        window.location.href = u
    })
});
</script>
<?= $this->endSection() ?>

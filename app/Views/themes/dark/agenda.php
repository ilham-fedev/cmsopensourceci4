<?= $this->extend('themes/dark/_layout') ?>
<?= $this->section('content') ?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Daftar Agenda</h1>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Agenda</li>
                </ul>
            </div>

        </div>
    </div>
</div>
    <!-- End Hero Area -->

    <!-- Start Services Area -->
    <section id="pricing" class="pricing-table section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="row">
                            <?php foreach($agendas as $agenda): ?>
                            <div class="col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay=".1s">
                                <!-- Single Table -->
                                <div class="single-table agenda-margin">
                                    <!-- Table Head -->
                                    <div class="table-head">
                                        <h4 class="title"><i class="lni lni-calendar"></i> <?= dateConvert($agenda->tgl_mulai, 'd M Y') ?></h4>
                                        <p>
                                            <b><?= $agenda->tema ?></b>
                                        </p>
                                        <div class="price">
                                            <i class="lni lni-blackboard"></i> <?= $agenda->tempat ?>
                                        </div>
                                    </div>
                                    <!-- End Table Head -->
                                    <div class="button">
                                        <a href="<?= base_url('agenda-detail/'.$agenda->tema_seo)  ?>" class="btn btn-sm btn-detail-agenda">Lihat Agenda <i class="lni lni-arrow-right"></i></a>
                                    </div>
                                </div>
                                <!-- End Single Table-->
                            </div>
                            <?php endforeach ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <?= $this->include('themes/classic/_sidebar') ?>
                </div>
            </div>
        </div>
    </section>
    <!-- /End Services Area -->


    <!-- Start Call Action Area -->
    <?= $this->include('themes/classic/_social') ?>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Agenda Title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <td><b>Deskripsi</b></td>
                    <td class='agenda-isi'></td>
                </tr>
                <tr>
                    <td><b>Lokasi</b></td>
                    <td><span class='agenda-lokasi'></span></td>
                </tr>
                <tr>
                    <td><b>Tanggal Pelaksanaan</b></td>
                    <td><span class='agenda-tanggal'></span></td>
                </tr>
                <tr>
                    <td><b>Jam</b></td>
                    <td><span class='agenda-jam'></span></td>
                </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <!-- End Call Action Area -->
    <?= $this->endSection() ?>
    <?= $this->section('postScript') ?>
    <script>
        const agendaTitle = document.querySelector('#staticBackdropLabel');
        const agendaIsi = document.querySelector('.agenda-isi');
        const agendaLokasi = document.querySelector('.agenda-lokasi');
        const agendaTanggal = document.querySelector('.agenda-tanggal');
        const agendaJam = document.querySelector('.agenda-jam');

        const btnAgenda = document.querySelectorAll(".btn-detail-agenda");
        options = {
            keyboard: false,
            backdrop: 'static'
        }
        var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), options);
        btnAgenda.forEach(btn => {
            btn.addEventListener("click", async (e)=>{
                e.preventDefault();

                const detail = e.currentTarget.getAttribute('href');
                const req = (await fetch(`${detail}`)).json();
                const { item, success } = await req;
                if(success)
                {
                    agendaTitle.innerHTML = item.tema;
                    agendaIsi.innerHTML = item.isi_agenda;
                    agendaLokasi.innerHTML = item.tempat;
                    agendaJam.innerHTML = item.jam;
                    agendaTanggal.innerHTML = `${convertDate(item.tgl_mulai)} -sd- ${convertDate(item.tgl_selesai)}`;
                    
                    myModal.show();
                }
            })
        })

        function convertDate(b)
        {
            return b.split('-').reverse().join('/');
        }
    </script>
    <?= $this->endSection() ?>

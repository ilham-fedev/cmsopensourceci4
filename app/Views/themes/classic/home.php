<?= $this->extend('themes/classic/_layout') ?>
<?= $this->section('content') ?>
<section class="hero-area bg-light carousel slide carousel-dark" data-bs-ride="carousel" id="carouselExampleControls">
    <div class="container carousel-inner">
        <?php 
        $no = 1;
        foreach($banners as $banner): 
        $active = ($no == 1) ? 'active': '';
        $no++;
        ?>
        <div class="carousel-item <?= $active ?>">
            <div class="row align-items-center">
                <div class="col-lg-12 col-12">
                    <div class="app-image">
                        <img src="<?= base_url("images/galeri/".$banner->gambar) ?>" alt="#" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</section>
    <!-- End Hero Area -->

    <!-- Start Services Area -->
    <section class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="row">
                        <?php foreach($news as $item): ?>
                        <div class="col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay=".1s">
                            <div class="single-service one news-items">
                                <?php 
                                $image = checkImageExist($item->gambar, "images/berita/medium_", "images/berita/");
                                ?>
                                <img src="/<?= $image ?>" alt="<?= $item->judul ?>" srcset="" loading="lazy">
                                <h3><?= $item->judul ?></h3>
                                <span class="small_tile">
                                    <i class="lni lni-users"></i> <?= $item->username ?> <i class="lni lni-calendar"></i> <?= dateConvert($item->tanggal, "d M Y") ?>
                                </span>
                                <p><?= shortNews($item->isi_berita) ?> ....</p>
                                <a href="/baca/<?= $item->judul_seo ?>">Learn More <i class="lni lni-arrow-right"></i></a>
                            </div>
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

    <!-- Start Pricing Table Area -->
    <section id="pricing" class="pricing-table section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12 agenda">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title agenda-margin">
                                <h3 class="wow zoomIn" data-wow-delay=".1s"><i class="lni lni-calendar"></i></h3>
                                <h2 class="wow fadeInUp" data-wow-delay=".1s">Agenda</h2>
                                <p class="wow fadeInUp" data-wow-delay=".1s">Ikuti agenda yang terdapat di panel bawah ini.</p>
                            </div>
                        </div>
                        <div class="agenda-slide">
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
                </div>
                <div class="col-lg-4 col-md-4 col-12 agenda">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title agenda-margin">
                                <h3 class="wow zoomIn" data-wow-delay=".1s"><i class="lni lni-popup"></i></h3>
                                <h2 class="wow fadeInUp" data-wow-delay=".1s">Pinned</h2>
                                <p class="wow fadeInUp" data-wow-delay=".1s">Lihat daftar pin hari ini.</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12 wow fadeInUp " data-wow-delay=".4s">
                            <!-- Single Table -->
                            <div class="single-table bg-sidebar agenda-margin">
                                <!-- Table Head -->
                                <div class="table-head">
                                    <h4 class="title text-white"><?= $pinned->title ?></h4>
                                    <p class="text-white"><?= $pinned->subtitle ?></p>
                                    <div class="price">
                                        <img src="/images/social/<?= $pinned->image ?>" style="width:128px" loading="lazy">
                                    </div>
                                </div>
                                <!-- End Table Head -->
                                <div class="button">
                                    <a href="<?= $pinned->link ?>" class="btn">Baca Pinned</a>
                                </div>
                            </div>
                            <!-- End Single Table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Pricing Table Area -->

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
        //========= testimonial 
        tns({
            container: '.agenda-slide',
            items: 2,
            slideBy: 'page',
            autoplay: false,
            mouseDrag: true,
            gutter: 20,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-arrow-left"></i>', '<i class="lni lni-arrow-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 2,
                },
                1170: {
                    items: 2,
                }
            }
        });

        const tnsControls = document.querySelector('.tns-controls');
        const btn = tnsControls.querySelectorAll('button');

        tnsControls.classList.add('btn-group');
        btn.forEach(bt => {
            bt.classList.add('btn');
            bt.classList.add('btn-primary');
            bt.classList.add('btn-sm');
        })

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
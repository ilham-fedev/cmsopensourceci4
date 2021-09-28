<?= $this->extend('themes/classic/_layout') ?>
<?= $this->section('content') ?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Download</h1>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Download</li>
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
                    <div class="single-service one news-items">
                       <table class="table table-bordered">
                           <thead>
                               <th>No</th>
                               <th>Nama File</th>
                               <th>Direct</th>
                           </thead>
                           <tbody>
                               <?php foreach($downloads as $download): ?>
                               <tr>
                                   <td><?= $no++ ?></td>
                                   <td><?= $download->judul ?></td>
                                   <td>
                                       <button class="btn btn-link btn-downloads" data-href="<?= base_url("download?fname=".$download->nama_file) ?>">download</button>
                                   </td>
                               </tr>
                               <?php endforeach ?>
                           </tbody>
                       </table>
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

    <!-- End Call Action Area -->
    <?= $this->endSection() ?>
    <?= $this->section("postScript") ?>
    <script>
        const btnDownloads = document.querySelectorAll(".btn-downloads");
        btnDownloads.forEach(btn => {
            btn.addEventListener("click", (e)=>{
                const href = e.currentTarget.getAttribute("data-href");
                window.open(href)
            })
        })
    </script>
    <?= $this->endSection() ?>

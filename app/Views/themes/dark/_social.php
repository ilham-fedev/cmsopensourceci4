<?php $identity = service('identity'); ?>
<section class="call-action">
        <div class="container">
            <div class="inner-content">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="text">
                            <h2>Tetap Terhubung <br /> dengan Kami</h2>
                            <p style="color: #fff;" class="mt-20">Kamu dapat mengikuti aktifitas kami, <br />dengan cara bersosial media.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="social-media-frame" data-href="<?= $identity->facebook ?>">
                            <img src="/images/social/facebook.jpg" alt="">
                            <div class="high-up">
                                <i class="lni lni-facebook-filled"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="social-media-frame" data-href="<?= $identity->instagram ?>">
                            <img src="/images/social/instagram.jpg" alt="">
                            <div class="high-up">
                                <i class="lni lni-instagram-original"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="social-media-frame" data-href="<?= $identity->twitter ?>">
                            <img src="/images/social/twitter.jpg" alt="">
                            <div class="high-up">
                                <i class="lni lni-twitter-original"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="social-media-frame" data-href="<?= $identity->youtube ?>">
                            <img src="/images/social/youtube.jpg" alt="">
                            <div class="high-up">
                                <i class="lni lni-youtube"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <?= $this->section("postScript") ?>
    <script>
        const haveButtonSocial = document.querySelectorAll(".social-media-frame");
        haveButtonSocial.forEach(btn => {
            btn.addEventListener("click", e => {
                const socialMediaUrl = e.currentTarget.getAttribute("data-href");
                window.open(socialMediaUrl)
            })
        })
    </script>
    <?= $this->endSection() ?>
<header class="header navbar-area shadow">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="nav-inner">
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="/">
                                <img src="/images/logo/logo.png" alt="Logo">
                            </a>
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <?php 
                                        $menus = new \App\Models\Cms;
                                        foreach($menus->getMenu() as $menu):
                                    ?>
                                    <li class="nav-item">
                                        <?php 
                                        if($menu->child !== null): 
                                        $submenus = explode(",", $menu->child);
                                        ?>
                                        <a class="dd-menu collapsed" href="/<?= $menu->link ?>" data-bs-toggle="collapse"
                                            data-bs-target="#<?= idmenu($menu->nama_menu) ?>" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation"><?= $menu->nama_menu ?></a>
                                        <ul class="sub-menu collapse" id="<?= idmenu($menu->nama_menu) ?>">
                                            <?php 
                                            foreach($submenus as $submenu): 
                                            $idsubmenu = explode("|",$submenu);
                                            $sublink = '/' . $idsubmenu[1];
                                            if(strpos($idsubmenu[1],'http') !== false || strpos($idsubmenu[1], 'https') !== false)
                                            {
                                                $sublink = $idsubmenu[1];
                                            }
                                            ?>
                                            <li class="nav-item"><a href="<?= $sublink ?>"><?= $idsubmenu[0]  ?></a></li>
                                            <?php endforeach ?>
                                        </ul>
                                        <?php else: ?>
                                        <a href="/<?= $menu->link ?>" 
                                             aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation"><?= $menu->nama_menu ?></a>
                                        <?php endif ?>
                                    </li>
                                    <?php endforeach ?>
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>
<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="index.html"><img src="/images/logo/logo.png" alt="Logo" srcset=""></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>
            <li class="sidebar-item">
                <a href="/panel/dashboard" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php if(session()->has('cms.rules') && session()->get('cms.rules') === 'admin'): ?>
            <li class="sidebar-title">Pengaturan Web</li>
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Website</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/identitas") ?>">Identitas</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/hubungi") ?>">Hubungi Kami</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/user") ?>">Users</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                <i class="bi bi-view-stacked"></i>
                    <span>Menu</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/menu") ?>">Menu Utama</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/submenu") ?>">Sub Menu</a>
                    </li>
                </ul>
            </li>
            <?php endif ?>
            <li class="sidebar-title">Komponen</li>
            <li class="sidebar-item">
                <a href="<?= base_url("panel/halaman") ?>" class='sidebar-link'>
                    <i class="bi bi-ui-radios"></i>
                    <span>Halaman</span>
                </a>
            </li>
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-app-indicator"></i>
                    <span>Berita</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/berita/new") ?>">Tambah Berita Baru</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/berita") ?>">Daftar Berita</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/kategori") ?>">Kategori</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/tag") ?>">Tags</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-collection-fill"></i>
                    <span>Galeri</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/album") ?>">Album</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/photo") ?>">Photo</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/banner") ?>">Banner Slider</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-title">Extra</li>
            <li class="sidebar-item">
                <a href="<?= base_url("panel/agenda") ?>" class='sidebar-link'>
                    <i class="bi bi-bookmarks-fill"></i>
                    <span>Agenda</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?= base_url("panel/polls") ?>" class='sidebar-link'>
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Polling</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?= base_url("panel/pinned") ?>" class='sidebar-link'>
                    <i class="bi bi-circle-square"></i>
                    <span>Pinned</span>
                </a>
            </li>
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-arrow-bar-down"></i>
                    <span>Download</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/download/new") ?>">Tambah File Download</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/download") ?>">Drive</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-title">Akun</li>
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-emoji-neutral"></i>
                    <span>Akun Saya</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/akun/edit") ?>">Ubah</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="<?= base_url("panel/akun/ubah-password") ?>">Ubah Password</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="<?= base_url("cms-logout") ?>" class="confirm-logout">Logout</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
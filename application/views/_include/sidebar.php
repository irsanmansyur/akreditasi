<aside class="fixed skin-6" style="margin-top: 40px !important">
  <div class="sidebar-inner scrollable-sidebars">

    <!-- <div class="user-block clearfix">
            <img src="<?= base_url('assets') ?>/img/user.jpg" alt="User Avatar">
            <div class="detail">
                <strong>John Doe</strong><span class="badge badge-danger bounceIn animation-delay4 m-left-xs">4</span>
                <ul class="list-inline">
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="inbox.html" class="no-margin">Inbox</a></li>
                </ul>
            </div>
        </div>/user-block -->

    <div class="main-menu">
      <ul>
        <li>
          <a href="<?= base_url('admin/dashboard') ?>">
            <span class="menu-icon">
              <i class="fa fa-desktop fa-lg"></i>
            </span>
            <span class="text">
              Dashboard
            </span>
            <span class="menu-hover"></span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('admin/akreditasi/dokumen') ?>">
            <span class="menu-icon">
              <i class="fa fa-desktop fa-lg"></i>
            </span>
            <span class="text">
              Dokumen Akreditasi
            </span>
            <span class="menu-hover"></span>
          </a>
        </li>
        <?php if (!empty($this->session->userdata('loginData'))) : ?>
          <li class="openable">
            <a href="#">
              <span class="menu-icon">
                <i class="fa fa-server fa-lg"></i>
              </span>
              <span class="text">
                Master Data
              </span>
              <span class="menu-hover"></span>
            </a>
            <ul class="submenu">
              <li><a href="<?= base_url('admin/jenjang') ?>"><span class="submenu-label">Data Jenjang</span></a></li>
              <!-- <li><a href="<?= base_url('admin/jenjang/sub') ?>"><span class="submenu-label">Data Sub Jenjang</span></a></li> -->
              <li><a href="<?= base_url('admin/fakultas') ?>"><span class="submenu-label">Data Fakultas</span></a></li>
              <li><a href="<?= base_url('admin/prodi') ?>"><span class="submenu-label">Data Prodi</span></a></li>
              <li><a href="<?= base_url('admin/mahasiswa') ?>"><span class="submenu-label">Data Mahasiswa</span></a></li>
            </ul>
          </li>
        <?php endif; ?>
        <li class="openable">
          <a href="#">
            <span class="menu-icon">
              <i class="fa fa-university fa-lg"></i>
            </span>
            <span class="text">
              Standar 1
            </span>
            <span class="menu-hover"></span>
          </a>
          <ul class="submenu">
            <li><a href="<?= base_url('admin/visimisi') ?>"><span class="submenu-label">Visi Misi & Tujuan</span></a></li>
          </ul>
        </li>
        <li class="openable">
          <a href="#">
            <span class="menu-icon">
              <i class="fa fa-male fa-lg"></i>
            </span>
            <span class="text">
              Standar 2
            </span>
            <span class="menu-hover"></span>
          </a>
          <ul class="submenu">
            <li><a href="<?= base_url('admin/akreditasi') ?>"><span class="submenu-label">Akreditasi Program Studi</span></a></li>
          </ul>
        </li>
        <li class="openable">
          <a href="#">
            <span class="menu-icon">
              <i class="fa fa-users fa-lg"></i>
            </span>
            <span class="text">
              Standar 3
            </span>
            <span class="menu-hover"></span>
          </a>
          <ul class="submenu">
            <li><a href="<?= base_url('admin/mahasiswa/view') ?>"><span class="submenu-label">Profile Mahasiswa</span></a></li>
            <li><a href="<?= base_url('admin/mahasiswa/views') ?>"><span class="submenu-label">Profile Mahasiswa dan Lulusan</span></a></li>
            <li class="openable">
              <a href="#">
                <span class="text">
                  Prestasi Mahasiswa
                </span>
                <span class="fa fa-arrow"></span>
              </a>
              <ul class="submenu  third-level">
                <li><a href="<?= base_url('admin/mahasiswa/skpi') ?>"><span class="submenu-label">SKPI</span></a></li>
                <li><a href="<?= base_url('admin/mahasiswa/prestasi') ?>"><span class="submenu-label">Prestasi Mahasiswa</span></a></li>
              </ul>
            </li>

            <li><a href="<?= base_url('admin/mahasiswa/studi') ?>"><span class="submenu-label">Masa Studi dan IPK Lulusan</span></a></li>
            <li><a href="<?= base_url('admin/mahasiswa/lulusan') ?>"><span class="submenu-label">Status Pelacakan Lulusan</span></a></li>
            <li><a href="<?= base_url('admin/mahasiswa/layanan') ?>"><span class="submenu-label">Layanan Kepada Mahasiswa</span></a></li>
          </ul>
        </li>
        <li class="openable">
          <a href="#">
            <span class="menu-icon">
              <i class="fa fa-graduation-cap fa-lg"></i>
            </span>
            <span class="text">
              Standar 4
            </span>
            <span class="menu-hover"></span>
          </a>
          <ul class="submenu">
            <li><a href="<?= base_url('admin/dosen/dosen_tetap') ?>"><span class="submenu-label">Dosen Tetap Institusi</span></a></li>
            <li><a href="<?= base_url('admin/dosen/dosen_tidak_tetap') ?>"><span class="submenu-label">Dosen Tidak Tetap Institusi</span></a></li>
            <li><a href="<?= base_url('admin/dosen/peningkatan_dosen') ?>"><span class="submenu-label">Kegiatan Peningkatan Dosen</span></a></li>
            <li><a href="<?= base_url('admin/dosen/tenaga_kependidikan') ?>"><span class="submenu-label">Tenaga Kependidikan</span></a></li>
          </ul>
        </li>
        <li class="openable">
          <a href="#">
            <span class="menu-icon">
              <i class="fa fa-book fa-lg"></i>
            </span>
            <span class="text">
              Standar 5
            </span>
            <span class="menu-hover"></span>
          </a>
          <ul class="submenu">
            <li><a href="<?= base_url('admin/kurikulum/view') ?>"><span class="submenu-label">Kelola Kurikulum</span></a></li>
          </ul>
        </li>
        <li class="openable">
          <a href="#">
            <span class="menu-icon">
              <i class="fa fa-money fa-lg"></i>
            </span>
            <span class="text">
              Standar 6
            </span>
            <span class="menu-hover"></span>
          </a>
          <ul class="submenu">
            <li><a href="<?= base_url('admin/dana/penerimaan') ?>"><span class="submenu-label">Penerimaan Dana</span></a></li>
            <li><a href="<?= base_url('admin/dana/penggunaan') ?>"><span class="submenu-label">Penggunaan Dana</span></a></li>
            <li><a href="<?= base_url('admin/dana/penelitian') ?>"><span class="submenu-label">Dana Kegiatan Penelitian</span></a></li>
            <li><a href="<?= base_url('admin/dana/pkm') ?>"><span class="submenu-label">Dana Kegiatan PKM</span></a></li>
            <li><a href="<?= base_url('admin/dana/aksesibilitas') ?>"><span class="submenu-label">Aksesibilitas Data</span></a></li>
            <li><a href="<?= base_url('admin/dana/lahan') ?>"><span class="submenu-label">Lahan Perguruan Tinggi</span></a></li>
          </ul>
        </li>
        <li class="openable">
          <a href="#">
            <span class="menu-icon">
              <i class="fa fa-file-text fa-lg"></i>
            </span>
            <span class="text">
              Standar 7
            </span>
            <span class="menu-hover"></span>
          </a>
          <ul class="submenu">
            <li><a href="<?= base_url('admin/dokumen/penelitian') ?>"><span class="submenu-label">Penelitian Dosen Tetap</span></a></li>
            <li><a href="<?= base_url('admin/dokumen/artikel') ?>"><span class="submenu-label">Judul Artikel</span></a></li>
            <li><a href="<?= base_url('admin/dokumen/sitasi') ?>"><span class="submenu-label">Sitasi</span></a></li>
            <li><a href="<?= base_url('admin/dokumen/haki') ?>"><span class="submenu-label">HAKI</span></a></li>
            <li><a href="<?= base_url('admin/dokumen/abdimas') ?>"><span class="submenu-label">Kegiatan ABDIMAS</span></a></li>
            <li><a href="<?= base_url('admin/dokumen/dalam_negri') ?>"><span class="submenu-label">Kerjasama Dalam Negri</span></a></li>
            <li><a href="<?= base_url('admin/dokumen/luar_negri') ?>"><span class="submenu-label">Kerjasama Luar Negri</span></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</aside>
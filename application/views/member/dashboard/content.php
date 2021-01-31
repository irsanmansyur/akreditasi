<style>
    .row {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
    }

    .row>[class*='col-'] {
        display: flex;
        flex-direction: column;
    }
</style>
<div class="row">
    <?php
    $standart = [
        "Dokumen" => [
            "Dokumen Akreditasi" => base_url('admin/akreditasi/dokumen')
        ],
        "Standart 1" => [
            "Visi, Misi dan Tujuan" => base_url('admin/visimisi')
        ],
        "Standart 2" => [
            "Akreditasi Program Studi" => base_url('admin/akreditasi')
        ],
        "Standart 3" => [
            "Profile Mahasiswa" => base_url('admin/mahasiswa/view'),
            "Profile Mahasiswa dan Lulusan" => base_url('admin/mahasiswa/views'),
            "Prestasi Mahasiswa" => base_url('admin/mahasiswa/prestasi'),
            "Masa Studi dan IPK Lulusan" => base_url('admin/mahasiswa/studi'),
            "Studi Pelacakan Lulusan" => base_url('admin/mahasiswa/lulusan'),
        ],
        "Standart 4" => [
            "Dosen Tetap Institusi" => base_url('admin/dosen/dosen_tetap'),
            "Dosen Tidak Tetap Institusi" => base_url('admin/dosen/dosen_tidak_tetap'),
            "Kegiatan Peningkatan Dosen" => base_url('admin/dosen/peningkatan_dosen'),
            "Tenaga Kependidikan" => base_url('admin/dosen/tenaga_kependidikan'),
        ],
        "Standart 5" => [
            "Kurikulum" => base_url('admin/kurikulum/view')
        ],
        "Standart 6" => [
            "Penerimaan Dana"  => base_url('admin/dana/pendanaan'),
            "Penggunaan Dana" => base_url('admin/dana/penggunaan'),
            "Dana Untuk Kegiatan Penelitian" => base_url('admin/dana/penelitian'),
            "Dana Untuk Kegiatan PkM" => base_url('admin/dana/pkm'),
            "Lahan Perguruan Tinggi" => base_url('admin/dana/lahan'),
            "Aksesibilitas Data" => base_url('admin/dana/aksesibilitas'),
        ],
        "Standart 7" => [
            "Penelitian Dosen Tetap" => base_url('admin/dokumen/penelitian'),
            "Judul Artikel" => base_url('admin/dokumen/artikel'),
            "Sitasi" => base_url('admin/dokumen/sitasi'),
            "Hak Atas Kekayaan Intelektual" => base_url('admin/dokumen/haki'),
            "Kegiatan Pengabdian Kepada Masyarakat" => base_url('admin/dokumen/abdimas'),
        ]
    ];
    foreach ($standart as $key => $value) :
    ?>
        <div class="col-sm-6">
            <div class="panel panel-default" style="height: 100% !important;">
                <div class="panel-heading clearfix">
                    <?= $key ?>
                </div>
                <div class="panel-body" id="trafficWidget" style="margin: 30px;">
                    <ul>
                        <?php foreach ($value as $k => $v) : ?>
                            <li><a href="<?= $v ?>"><?= $k ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="loading-overlay">
                    <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
                </div>
            </div><!-- /panel -->
        </div>
    <?php
    endforeach;
    ?>
</div>
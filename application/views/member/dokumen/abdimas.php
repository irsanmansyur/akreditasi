<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <span class="pull-left"><?= $title ?></span>
    </div>
    <div class="panel-body" style="min-height: 500px; overflow-x: scroll; ">
        <table class="table table-bordered table-striped DataTablePrint">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Sumber Pembiayaan</th>
                    <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Judul Penelitian</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Total</th>
                </tr>
                <tr>
                    <th>TS-2</th>
                    <th>TS-1</th>
                    <th>TS</th>
                </tr>
            </thead>
            <tbody>
                <tr role="row">
                    <td>1</td>
                    <td>Pembiayaan sendiri oleh peneliti</td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=1&amp;tahun=2018">15</a></td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=1&amp;tahun=2019">3</a></td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=1&amp;tahun=2020">1</a></td>
                    <td>19</td>
                </tr>
                <tr role="row">
                    <td>2</td>
                    <td>PT/yayasan yang bersangkutan</td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=2&amp;tahun=2018">30</a></td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=2&amp;tahun=2019">18</a></td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=2&amp;tahun=2020">8</a></td>
                    <td>56</td>
                </tr>
                <tr role="row">
                    <td>3</td>
                    <td>Kemdiknas/Kemenag</td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=3&amp;tahun=2018">6</a></td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=3&amp;tahun=2019">3</a></td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=3&amp;tahun=2020">3</a></td>
                    <td>12</td>
                </tr>
                <tr role="row">
                    <td>4</td>
                    <td>Institusi dalam negeri di luar Kemdiknas/Kemenag</td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=4&amp;tahun=2018">7</a></td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=4&amp;tahun=2019">3</a></td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=4&amp;tahun=2020">1</a></td>
                    <td>11</td>
                </tr>
                <tr role="row">
                    <td>5</td>
                    <td>Institusi luar negeri</td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=5&amp;tahun=2018">0</a></td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=5&amp;tahun=2019">0</a></td>
                    <td><a href="kegiatan_pkm_list.php?sumberdana=5&amp;tahun=2020">0</a></td>
                    <td>0</td>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: center; vertical-align: middle;">Total</th>
                    <th>58</th>
                    <th>27</th>
                    <th>13</th>
                    <th>98</th>
                </tr>
                <tr>
                    <td colspan="6">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="loading-overlay">
        <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
    </div>
</div>
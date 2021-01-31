<?php


?>

<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <span class="pull-left"><?= $title ?></span>
  </div>
  <div class="panel-body" style="min-height: 500px; overflow-x: scroll; ">
    <table class="table table-bordered table-striped DataTablePrint">
      <thead>
        <tr>
          <th style="text-align: center; vertical-align: middle;" class="text-center" rowspan="3">No</th>
          <th style="text-align: center; vertical-align: middle;" rowspan="3">Status Akreditasi</th>

        </tr>
        <tr>
          <th colspan="3">Akademik</th>
          <th style="text-align: center; vertical-align: middle;" rowspan="3">Total</th>
        </tr>
        <tr>
          <th>S-3</th>
          <th>S-2</th>
          <th>S-1</th>
        </tr>
        <tr>
          <th>(1)</th>
          <th>(2)</th>
          <th>(3)</th>
          <th>(4)</th>
          <th>(5)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($listData as $key => $value) : ?>
          <tr role="row" class="odd">
            <td class="sorting_1 text-center"><?= $key + 1 ?></td>
            <td class=""><?= $value->akreditasi_nama ?></td>

            <?php
            $total = 0;
            foreach ($listJenjang as $key2 => $value2) : ?>
              <?php
              $this->db->where('id_akreditasi', $value->akreditasi_id);
              $this->db->where('id_subjenjang', $value2->jenjang_id);
              $id_sub_jenjang = $value2->jenjang_id;


              $jml = $this->db->count_all_results('tbl_prodi');
              $total = $total + $jml;
              //$this->db->where('akreditasi_id',$value->akreditasi_id)->where('id_subjenjang',$value2->subjenjang_id)->get('tbl_prodi')->count_all_results(); 
              ?>
              <td class=""><a href="<?php echo base_url('admin/prodi/breakdown_prodi/' . $id_sub_jenjang . '/' . $value->akreditasi_id) ?>"><?= $jml; ?></a></td>
            <?php endforeach; ?>

            <td class=""><a href="<?php echo base_url('admin/prodi/breakdown_prodi/' . $id_sub_jenjang . '/' . $value->akreditasi_id) ?>"><?= $total; ?></a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<div class="panel panel-default">
  <?php $this->load->view("_include/alert"); ?>
  <div class="panel-heading clearfix mt-2">
    <span class="pull-left"><?= $title ?></span>
  </div>
  <div class="panel-body" style="min-height: 500px; overflow-x: scroll; ">
    <a href="<?= base_url('admin/fakultas/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah Data</a><br><br><br><br>
    <table class="table table-bordered table-striped DataTablePrint">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Fakultas</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($listData as $key => $value) : ?>
          <tr role="row" class="odd">
            <td class="text-center"><?= $key + 1 ?></td>
            <td><?= $value->fakultas_nama ?></td>
            <td class="text-center">
              <a href="<?= base_url("admin/fakultas/edit/" . $value->fakultas_id); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>&nbsp Edit</a>
              <a onclick="return confirm('Hapus Data?')" href="<?= base_url('admin/fakultas/hapus/' . $value->fakultas_id) ?>" class="btn btn-danger  btn-xs"><i class="fa fa-trash"></i>&nbsp Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="loading-overlay">
    <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
  </div>
</div>
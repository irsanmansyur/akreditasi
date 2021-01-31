<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <span class="pull-left"><?= $title ?></span>
  </div>
  <div class="panel-body" style="min-height: 500px; overflow-x: scroll; ">
    <a href="<?= base_url('admin/jenjang/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah Data</a><br><br><br><br>
    <table class="table table-bordered table-striped DataTablePrint">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Jenjang</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($listData as $key => $value) : ?>
          <tr role="row" class="odd">
            <td class="text-center"><?= $key + 1 ?></td>
            <td><?= $value->jenjang_nama ?></td>
            <td class="text-center">
              <a href="<?= base_url('admin/jenjang/edit/' . $value->jenjang_id) ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>&nbsp Edit</a>
              <a onclick="return confirm('Hapus Data?')" href="<?= base_url('admin/jenjang/hapus/' . $value->jenjang_id) ?>" class="btn btn-danger  btn-xs"><i class="fa fa-trash"></i>&nbsp Hapus</a>
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
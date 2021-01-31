<div class="panel panel-default col-md-6">
  <div class="panel-heading clearfix">
    <span class="pull-left"><?= $title ?></span>
  </div>
  <form class="" method="post" action="" enctype="multipart/form-data">
    <div class="panel-body" style="min-height: 500px; ">
      <?= $this->session->flashdata('msgbox') ?>
      <div class="form-group">
        <label class="control-label">Nama Fakultas</label>
        <input type="text" class="form-control" name="fakultas" value="<?= set_value("fakultas", null) ?? (isset($fakultas) ? $fakultas->fakultas_nama : ''); ?>">
        <?= form_error('fakultas', '<small class="text-danger">', '</small>'); ?>
      </div>
    </div>
    <div class="panel-footer">
      <div class="form-group pull-right">
        <a class="btn btn-default" href="<?= base_url('admin/fakultas') ?>">Kembali</a>
        <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
      </div>
    </div>
  </form>
  <div class="loading-overlay">
    <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
  </div>
</div>
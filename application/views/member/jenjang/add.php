<div class="panel panel-default col-md-6">
    <div class="panel-heading clearfix">
        <span class="pull-left"><?= $title ?></span>
    </div>
    <form class="" method="post" action="" enctype="multipart/form-data">
      <div class="panel-body" style="min-height: 500px; ">
        <?= $this->session->flashdata('msgbox') ?>
        <div class="form-group">
          <label class="control-label">Nama Jenjang</label>
          <input type="text" class="form-control" name="jenjang" value="">
        </div>
      </div>
      <div class="panel-footer">
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?= base_url('admin/jenjang') ?>">Kembali</a>
          <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
        </div>
      </div>
    </form>
    <div class="loading-overlay">
        <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
    </div>
</div>

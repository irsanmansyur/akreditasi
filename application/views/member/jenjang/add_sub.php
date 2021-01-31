<div class="panel panel-default col-md-6">
    <div class="panel-heading clearfix">
        <span class="pull-left"><?= $title ?></span>
    </div>
    <form class="" method="post" action="" enctype="multipart/form-data">
      <div class="panel-body" style="min-height: 500px; ">
        <?= $this->session->flashdata('msgbox') ?>
        <div class="form-group">
          <label class="control-label">Pilih Jenjang</label>
          <select class="form-control" name="id_jenjang">
            <option value="" selected disabled>Pilih Jenjang</option>
            <?php foreach ($listData as $key => $value) : ?>
              <option value="<?= $value->jenjang_id ?>"><?= $value->jenjang_nama ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label class="control-label">Nama Sub Jenjang</label>
          <input class="form-control" type="text" value="" name="subjenjang">
        </div>

      </div>
      <div class="panel-footer">
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?= base_url('admin/jenjang/sub') ?>">Kembali</a>
          <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
        </div>
      </div>
    </form>
    <div class="loading-overlay">
        <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
    </div>
</div>

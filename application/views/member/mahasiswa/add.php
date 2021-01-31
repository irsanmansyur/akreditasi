<div class="panel panel-default col-md-6">
    <div class="panel-heading clearfix">
        <span class="pull-left"><?= $title ?></span>
    </div>
    <form class="" method="post" action="" enctype="multipart/form-data">
      <div class="panel-body" style="min-height: 500px; ">
        <?= $this->session->flashdata('msgbox') ?>
        <div class="form-group">
          <label class="control-label" required>Pilih Prodi</label>
          <select class="form-control" name="id_prodi">
            <option value="" selected disabled>Pilih Prodi</option>
            <?php foreach ($prodi as $key => $value) : ?>
              <option value="<?= $value->prodi_id ?>"><?= $value->prodi_nama ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label class="control-label">Nama Mahasiswa</label>
          <input class="form-control" type="text" value="" name="nama" required>
        </div>

        <div class="form-group">
          <label class="control-label">NIM</label>
          <input class="form-control" type="text" value="" name="nim" required>
        </div>

        <div class="form-group">
          <label class="control-label">Status Kelulusan</label>
          <select name="status_kelulusan" class="form-control" required="">
            <option value="">Pilih Status Kelulusan</option>
            <option value="1">Sudah Lulus</option>
            <option value="0">Belum Lulus</option>
          </select>
        </div>

      </div>
      <div class="panel-footer">
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?= base_url('admin/mahasiswa') ?>">Kembali</a>
          <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
        </div>
      </div>
    </form>
    <div class="loading-overlay">
        <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
    </div>
</div>
<script type="text/javascript">
  
</script>

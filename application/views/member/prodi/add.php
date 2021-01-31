<div class="panel panel-default col-md-6">
  <div class="panel-heading clearfix">
    <span class="pull-left"><?= $title ?></span>
  </div>
  <form class="" method="post" action="" enctype="multipart/form-data">
    <div class="panel-body" style="min-height: 500px; ">
      <?= $this->session->flashdata('msgbox') ?>

      <div class="form-group">
        <label class="control-label">Jenjang</label>
        <select class="form-control" name="id_subjenjang">
          <option value="" selected disabled>Pilih Jenjang</option>
          <?php foreach ($jenjang as $key => $value) : ?>
            <option value="<?= $value->jenjang_id ?>" <?= set_value("id_subjenjang") == $value->jenjang_id ? "selected" : (isset($prodi) ? ($prodi->id_subjenjang == $value->jenjang_id ? "selected" : '') : ''); ?>><?= $value->jenjang_nama ?></option>
          <?php endforeach; ?>
        </select>
        <?= form_error('id_subjenjang', '<small class="text-danger">', '</small>'); ?>
      </div>

      <div class="form-group">
        <label class="control-label">Fakultas</label>
        <select class="form-control" name="fakultas">
          <option value="" selected disabled>Pilih Fakultas</option>
          <?php foreach ($fakultas as $key => $value) : ?>
            <option value="<?= $value->fakultas_id ?>" <?= set_value("fakultas") == $value->fakultas_id ? "selected" : (isset($prodi) ? ($prodi->id_fakultas == $value->fakultas_id ? "selected" : '') : ''); ?>><?= $value->fakultas_nama ?></option>
          <?php endforeach; ?>
        </select>
        <?= form_error('fakultas', '<small class="text-danger">', '</small>'); ?>

      </div>

      <!-- <div class="form-group">
          <label class="control-label">Sub Jenjang</label>
          <select class="form-control" name="subjenjang">
            <option value="" selected disabled>Pilih Sub Jenjang</option>
            <?php foreach ($subjenjang as $key => $value) : ?>
              <option value="<?= $value->subjenjang_id ?>"><?= $value->subjenjang_nama ?></option>
            <?php endforeach; ?>
          </select>
        </div> -->

      <!-- <div class="form-group">
        <label class="control-label">Program Studi</label>
        <select class="form-control" name="prodi_nama">
          <option value="" selected disabled>Pilih Program Studi</option>
          <?php foreach ($prodi as $key => $value) : ?>
            <option value="<?= $value->prodi_nama ?>" <?= set_value("prodi_nama") == $value->prodi_nama ? "selected" : (''); ?>><?= $value->prodi_nama ?></option>
          <?php endforeach; ?>
        </select>

      </div> -->
      <div class="form-group">
        <label class="control-label" for="prodi_nama">Nama Prodi</label>
        <input class="form-control" type="text" value="<?= set_value("prodi_nama", null) ?? (isset($prodi) ? $prodi->prodi_nama : ''); ?>" name="prodi_nama">
        <?= form_error('prodi_nama', '<small class="text-danger">', '</small>'); ?>
      </div>

      <div class="form-group">
        <label class="control-label" for="no_sk">No SK</label>
        <input class="form-control" type="text" value="<?= set_value("no_sk", null) ?? (isset($prodi) ? $prodi->no_sk : ''); ?>" name="no_sk">
        <?= form_error('no_sk', '<small class="text-danger">', '</small>'); ?>
      </div>

      <div class="form-group">
        <label class="control-label" for="tahun_sk">Tahun SK</label>
        <input class="form-control" type="number" min="1800" max="<?= date("Y"); ?>" value="<?= set_value("tahun_sk", null) ?? (isset($prodi) ? $prodi->tahun_sk : ''); ?>" name="tahun_sk">
        <?= form_error('tahun_sk', '<small class="text-danger">', '</small>'); ?>
      </div>

      <div class="form-group">
        <label class="control-label" for="daluarsa">Daluarsa</label>
        <input class="form-control" type="date" value="<?= set_value("daluarsa", null) ?? (isset($prodi) ? $prodi->daluarsa : ''); ?>" name="daluarsa">
        <?= form_error('daluarsa', '<small class="text-danger">', '</small>'); ?>
      </div>


      <div class="form-group">
        <label class="control-label">Sertifikat</label>
        <input class="form-control" type="file" name="sertifikat">
        <?= $this->session->flashdata("sertifikat_error"); ?>
      </div>

      <div class="form-group">
        <label class="control-label">Akreditasi</label>
        <select class="form-control" name="id_akreditasi">
          <option value="" selected disabled>Pilih Akreditasi</option>
          <?php foreach ($akreditasi as $key => $value) : ?>
            <option value="<?= $value->akreditasi_id ?>" <?= set_value("id_akreditasi") == $value->akreditasi_id ? "selected" : (isset($prodi) ? ($prodi->id_akreditasi == $value->akreditasi_id ? "selected" : '')  : ''); ?>> <?= $value->akreditasi_nama ?></option>
          <?php endforeach; ?>
        </select>
        <?= form_error('id_akreditasi', '<small class="text-danger">', '</small>'); ?>

      </div>

    </div>
    <div class="panel-footer">
      <div class="form-group pull-right">
        <a class="btn btn-default" href="<?= base_url('admin/prodi') ?>">Kembali</a>
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
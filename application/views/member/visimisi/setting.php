<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <span class="pull-left"><?= $title ?></span>
  </div>
  <div class="panel-body" style="min-height: 500px">
    <?= $this->session->flashdata('msgbox') ?>
    <form method="post" action="">
      <div class="panel-group" id="accordion" >
        <div class="panel panel-default">
          <div class="panel-heading" style="background: #f0f0f0">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                Visi
              </a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
              <textarea id="visi" class="summernote" name="visi"><?= $value->visi ?></textarea>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" style="background: #f0f0f0">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                Misi
              </a>
            </h4>
          </div>
          <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
             <textarea id="misi" class="summernote" name="misi"><?= $value->misi ?></textarea>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" style="background: #f0f0f0">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                Tujuan
              </a>
            </h4>
          </div>
          <div id="collapse3" class="panel-collapse collapse">
            <div class="panel-body">
              <textarea id="tujuan" class="summernote" name="tujuan"><?= $value->tujuan ?></textarea>
            </div>
          </div>
        </div>
      </div>
      <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
      <a href="<?= base_url('admin/visimisi') ?>" class="btn btn-default">Cancel</a>
    </form>
  </div>
  <div class="loading-overlay">
    <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
  </div>
</div>

<!-- <script type="text/javascript">
  var visi = '<?= $visi ?>';
  var misi = '<?= $misi ?>';
  var tujuan = '<?= $tujuan ?>';
</script>
 -->

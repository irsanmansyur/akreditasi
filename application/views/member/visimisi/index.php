<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <span class="pull-left"><?= $title ?></span>
    <?php if (!empty($this->session->userdata('loginData'))) : ?>
      <a href="<?= base_url('admin/visimisi/setting') ?>" class="pull-right"> <i class="fa fa-wrench"></i></a>
    <?php endif; ?>
  </div>
  <div class="panel-body" style="min-height: 500px">
    <!-- <?php if (!empty($this->session->userdata('loginData'))) : ?>
      <a href="<?= base_url('admin/visimisi/setting') ?>" class="btn btn-primary pull-right">Setting</a><br><br>
    <?php endif; ?> -->
    <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading" style="background: #f0f0f0">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
              Visi</a>
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
          <div class="panel-body">
            <?= $value->visi ?>
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
            <?= $value->misi ?>
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
            <?= $value->tujuan ?>
          </div>
        </div>
      </div>
    </div>


  </div>
  <div class="loading-overlay">
    <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
  </div>
</div>
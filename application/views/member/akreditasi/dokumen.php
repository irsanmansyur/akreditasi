<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <span class="pull-left"><?= $title ?></span>
        <?php if (!empty($this->session->userdata('loginData'))) : ?>
            <a href="<?= base_url('admin/akreditasi/setting') ?>" class="pull-right"> <i class="fa fa-wrench"></i></a>
        <?php endif; ?>
    </div>
    <div class="panel-body" style="min-height: 500px">
        <div class="panel-group" id="accordion">
            <?php foreach ($listData as $key => $value) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: #f0f0f0">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key ?>">
                                <?= $value->judul ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse<?= $key ?>" class="panel-collapse collapse <?= $key == 0 ? "in" : "" ?>">
                        <div class="panel-body">
                            <?= $value->isi ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


    </div>
    <div class="loading-overlay">
        <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
    </div>
</div>
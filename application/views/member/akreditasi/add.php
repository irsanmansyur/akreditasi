<?php


?>
<style type="text/css">
  th{
    text-align: center; vertical-align: middle; border-bottom-width: 0px !important;
  }

  .btn-group{
    float: right !important;
    margin-bottom: 10px
  }
</style>
<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <span class="pull-left"><?= $title ?></span>
    </div>
    <div class="panel-body" style="min-height: 500px; overflow-x: scroll; ">
      <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
          <label class="control-label">Nama Akreditasi</label>
          <input type="text" class="form-control" name="akreditasi" value="">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" name="submit" value="submit"></button>
        </div>
      </form>
    </div>
    <div class="loading-overlay">
        <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
    </div>
</div>

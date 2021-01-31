<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <span class="pull-left"><?= $title ?></span>
    </div>
    <div class="panel-body" style="min-height: 500px">
        <?= $this->session->flashdata('msgbox') ?>
        <form method="post" action="">
            <div class="panel-group" id="accordion">
                <!-- <div class="panel panel-default">
                    <div class="panel-heading" style="background: #f0f0f0">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                Dokumen Evaluasi Diri (ED) UAI
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <textarea id="visi" class="summernote" name="visi"><li><a href="#">Dokumen Evaluasi Diri (ED) UAI</a></li></textarea>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: #f0f0f0">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                Dokumen Borang AIPT UAI Tahun 2017
                            </a>
                        </h4>
                    </div>

                </div> -->
                <?php foreach ($listData as $key => $value) : ?>
                    <div id="row-<?= $key ?>" class="panel panel-default">
                        <div class="panel-heading" style="background: #f0f0f0">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key ?>">
                                    <?= $value->judul ?>
                                </a>
                                <a onclick="removerow(<?= $key ?>)" class="btn btn-danger btn-xs pull-right"><i class="fa fa-minus"></i></a>
                            </h4>
                        </div>
                        <div id="collapse<?= $key ?>" class="panel-collapse collapse <?= $key == 0 ? "in" : "" ?>">
                            <div class="panel-body">
                                <input class="form-control" value="<?= $value->judul ?>" type="text" name="judul[]" placeholder="Judul" /><br><br>
                                <textarea id="isi[]" class="summernote" name="isi[]"><?= $value->isi ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <br><br>

            <a class="btn btn-primary pull-right" onclick="addrow()">Add Row</a>

            <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
            <a href="<?= base_url('admin/akreditasi/dokumen') ?>" class="btn btn-default">Cancel</a>
        </form>
    </div>
    <div class="loading-overlay">
        <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
    </div>
</div>
<script>
    var a = <?= $key ?>

    function addrow() {
        $('div').removeClass("in");
        a++;
        $('#accordion').append(
            '<div id="row-' + a + '" class="panel panel-default">' +
            '<div class="panel-heading" style="background: #f0f0f0">' +
            '<h4 class="panel-title">' +
            '<a data-toggle="collapse" data-parent="#accordion" href="#collapse' + a + '">' +
            'Judul' +
            '</a>' +
            '<a onclick="removerow(' + a + ')" class="btn btn-danger btn-xs pull-right"><i class="fa fa-minus"></i></a>' +
            '</h4>' +
            '</div>' +
            '<div id="collapse' + a + '" class="panel-collapse collapse in">' +
            '<div class="panel-body">' +
            '<input class="form-control" value="" type="text" name="judul[]" placeholder="Judul" /><br><br>' +
            '<textarea class="summernote" name="isi[]"></textarea>' +
            '</div>' +
            '</div>' +
            '</div>'
        );
        $('.summernote').summernote({
            height: "300px",
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                },
                onMediaDelete: function(target) {
                    deleteImage(target[0].src);
                }
            }
        });
    }

    function removerow(keys) {
        console.log('oko');
        $('#row-' + keys).remove();
    }
</script>
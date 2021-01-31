<script src="<?= base_url('assets') ?>/js/jquery-1.10.2.min.js"></script>
<script src="<?= base_url('assets') ?>/bootstrap/js/bootstrap.min.js"></script>
<script src='<?= base_url("assets") ?>/js/modernizr.min.js'></script>
<script src='<?= base_url("assets") ?>/js/pace.min.js'></script>
<script src='<?= base_url("assets") ?>/js/jquery.popupoverlay.min.js'></script>
<script src='<?= base_url("assets") ?>/js/jquery.slimscroll.min.js'></script>
<script src='<?= base_url("assets") ?>/js/jquery.cookie.min.js'></script>
<script src="<?= base_url('assets') ?>/js/endless/endless.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
<script type="text/javascript">
	$('.DataTable').DataTable();
    var table = $('.DataTablePrint').DataTable( {
        dom: 'Blrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $('.summernote').summernote({
        height: "300px",
        callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            },
            onMediaDelete : function(target) {
                deleteImage(target[0].src);
            }
        }
    });
    $('#visi').summernote('code');
	$('#misi').summernote('code');
	$('#tujuan').summernote('code');
    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: "<?php echo site_url('admin/visimisi/upload_image')?>",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
                $('.summernote').summernote("insertImage", url);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function deleteImage(src) {
        $.ajax({
            data: {src : src},
            type: "POST",
            url: "<?php echo site_url('admin/visimisi/delete_image')?>",
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    }

    $(".alert").fadeTo(2000, 500).slideUp(500, function() {
      $(".alert").slideUp(500);
    });


</script>
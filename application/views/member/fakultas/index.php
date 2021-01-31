<div class="panel panel-default">
  <?php $this->load->view("_include/alert"); ?>
  <div class="panel-heading clearfix mt-2">
    <span class="pull-left"><?= $title ?></span>
  </div>
  <div class="panel-body" style="min-height: 500px; overflow-x: scroll; ">
    <a href="<?= base_url('admin/fakultas/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah Data</a><br><br><br><br>
    <table class="table table-bordered table-striped DataTablePrint">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Fakultas</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($listData as $key => $value) : ?>
          <tr role="row" class="odd">
            <td class="text-center"><?= $key + 1 ?></td>
            <td><?= $value->fakultas_nama ?></td>
            <td class="text-center">
              <a href="<?= base_url("admin/fakultas/edit/" . $value->fakultas_id); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>&nbsp Edit</a>
              <a href="<?= base_url('admin/fakultas/hapus/' . $value->fakultas_id) ?>" class="btn btn-danger delete btn-xs"><i class="fa fa-trash"></i>&nbsp Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="loading-overlay">
    <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
  </div>
</div>


<link rel="stylesheet" href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css') ?>">
<script src="<?= base_url("assets/vendor/sweetalert2/dist/sweetalert2.min.js") ?>"></script>
<script>
  // CommonJS
  const tableMe = document.querySelector("table");
  tableMe.addEventListener("click", function(e) {
    if (e.target.classList.contains("delete")) {
      e.preventDefault();
      let elDelete = e.target;
      Swal.fire({
        title: 'Do you want to delete this.?',
        showCancelButton: true,
        confirmButtonText: `Delete`,
      }).then(async (result) => {
        if (result.isConfirmed) {
          let res = await fetch(elDelete.getAttribute("href"), {
            method: "POST"
          }).then(res => res.json());
          if (res.status) {
            return Swal.fire('Success!', '', res.message)
          }
          return Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: res.message
          })
        } else if (result.isDenied) {
          Swal.fire('Gagal Menghapus', '', 'info')
        }
      })
    }
  })
</script>
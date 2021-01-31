<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <span class="pull-left"><?= $title ?></span>
  </div>
  <div class="panel-body" style="min-height: 500px; overflow-x: scroll; ">
    <a href="<?= base_url('admin/prodi/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah Data</a><br><br><br><br>
    <table class="table table-bordered table-striped  DataTablePrint">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Prodi</th>
          <th>Fakultas</th>
          <th>Jenjang</th>
          <th>No SK</th>
          <th>Daluarsa</th>
          <th>Tahun SK</th>
          <th>Sertifikat</th>
          <th>Akreditasi</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($prodies as $key => $value) : ?>
          <tr role="row" class="odd">
            <td class="text-center"><?= $key + 1 ?></td>
            <td><?= $value->prodi_nama ?></td>
            <td><?= $value->fakultas_nama ?></td>
            <td><?= $value->jenjang_nama ?></td>
            <td><?= $value->no_sk ?></td>
            <td><?= $value->daluarsa ?></td>
            <td><?= $value->tahun_sk ?></td>
            <td>
              <?php if ($value->sertifikat == '') : ?>
                <span class='btn btn-danger no-sertifikat'>Belum ber Sertifikat</span>
              <?php else : ?>
                <a href="<?= base_url("uploads/sertifikat/" . $value->sertifikat); ?>" class="btn btn-primary">Lihat Sertifikat</a>
              <?php endif; ?>

            </td>
            <td><?= $value->akreditasi_nama ?></td>
            <td class="text-center">
              <a href="<?= base_url("admin/prodi/edit/" . $value->prodi_id); ?>" class="btn btn-primary btn-xl"><i class="fa fa-pencil"></i>&nbsp Edit</a>
              <a onclick="return confirm('Hapus Data?')" href="<?= base_url("admin/prodi/delete/" . $value->prodi_id); ?>" class="btn btn-danger  btn-xl"><i class="fa fa-trash"></i>&nbsp Hapus</a>
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
    if (e.target.classList.contains("no-sertifikat")) {
      Swal.fire({
        title: 'Error!',
        text: 'Tidak Ada Sertifikat',
        icon: 'error',
        confirmButtonText: 'Cool'
      })
    }
  })
</script>
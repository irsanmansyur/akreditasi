</head> 
<body>
    <div class="container">
        <h1 style="font-size:20pt"></h1>

        <h3></h3>
        <br />
        <a href="<?= base_url('admin/akreditasi') ?>" class="btn btn-danger  btn-xl"></i>Kembali</a><br><br>
    <table class="table table-bordered table-striped  DataTablePrint">
        
        
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>No</th>
			<th>Strata</th>
			<th>Fakultas</th>
			<th>Prodi</th>
			<th>No SK</th>
			<th>Tahun SK</th>
			<th>Daluarsa</th>
			<th>Sertifikat</th>
			
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach ($listing as $listing) { ?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $listing->subjenjang_nama ?></td>
			<td><?php echo $listing->fakultas_nama ?></td>
			<td><?php echo $listing->prodi_nama ?></td>
			<td><?php echo $listing->no_sk ?></td>
			<td><?php echo $listing->tahun_sk ?></td>
			<td><?php echo $listing->daluarsa ?></td>
			<td> <a href ="<?php echo base_url()?>uploads/sertifikat/<?php echo $listing->sertifikat ?>">Sertifikat </a></td> 
			
              
            </td>
		</tr>
	<?php $i++; } ?>
	</tbody>
</table>
<?php echo $this->uri->segment(5);?>
<div class="panel panel-default">
  <div class="panel-heading clearfix">
   
 
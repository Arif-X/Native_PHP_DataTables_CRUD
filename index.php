<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>CRUD</title>

	<link href="lib/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="lib/lib/datatables/DataTables-1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="lib/lib/datatables/FixedColumns-3.3.2/css/fixedColumns.bootstrap4.min.css" rel="stylesheet">
	<script src="lib/lib/datatables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
	<script src="lib/lib/datatables/DataTables-1.10.23/js/jquery.dataTables.min.js"></script>    
	<script src="lib/lib/datatables/Bootstrap-4-4.1.1/js/bootstrap.min.js"></script>
	<script src="lib/lib/datatables/DataTables-1.10.23/js/dataTables.bootstrap4.min.js"></script>
	<script src="lib/lib/datatables/FixedColumns-3.3.2/js/dataTables.fixedColumns.min.js"></script>  
</head>
<body>
	<div class="container">	
		<div class="mt-2 mb-3 text-center">
			<h1>CRUD DataTables</h1>
		</div>
		<div class="mt-2 mb-3">
			<button type="button" class="btn btn-primary" data-toggle="modal" id="create">Create New</button>
		</div>
		<div class="modal fade bd-example-modal-lg" id="ajaxModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modelHeading">Create</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">

								<form name="formData" id="formData">
									<!-- <input type="hidden" name="nis" id="nis"> -->

									<div class="form-group">
										<label for="">NIS</label>
										<input type="number" name="nis" id="nis" class="form-control" required>
									</div>

									<div class="form-group">
										<label for="">Nama</label>
										<input type="text" name="nama" id="nama" class="form-control" required>
									</div>

									<div class="form-group">
										<label for="">Jenis Kelamin</label>
										<input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
									</div>

									<div class="form-group">
										<label for="">Telp</label>
										<input type="number" name="telp" id="telp" class="form-control" required>
									</div>

									<div class="form-group">
										<label for="">Alamat</label>
										<input type="text" name="alamat" id="alamat" class="form-control" required>
									</div>

									<button class="btn btn-primary btn-sm" id="saveBtn" style="width: 100%">Simpan</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade bd-example-modal-lg" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="deleteHeading">Hapus</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">

								<form name="formDelete" id="formDelete">
									<input type="hidden" name="nis" id="nisDel">
									<h3>Ingin Menghapus Data <strong id="datas"></strong>?</h3>
									<button class="btn btn-danger btn-sm" id="deleteBtn" style="width: 100%">Hapus</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="table-responsive">
			<table class="table table-bordered" id="table-siswa">
				<thead>
					<tr>
						<th>NIS</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Telepon</th>
						<th>Alamat</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>

	</div>

	<script>
		var tabel = null;

		$(document).ready(function() {
			tabel = $('#table-siswa').DataTable({
				"processing": true,
				"serverSide": true,
				"ordering": true, 
				"order": [[ 1, 'asc' ]], 
				"ajax":
				{
					"url": "backend/siswa/view.php", 
					"type": "POST"
				},
				"deferRender": true,
				"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], 
				"columns": [
				{ "data": "nis" }, 
				{ "data": "nama" },  
				{ 
					"render": function ( data, type, row ) {  
						var html = ""

						if(row.jenis_kelamin == 1){ 
							html = 'Laki-laki' 
						}else{ 
							html = 'Perempuan' 
						}

						return html; 
					}, orderable: false, searchable: false
				},
				{ "data": "telp" }, 
				{ "data": "alamat" }, 
				{ 
					"render": function ( data, type, row ) { 
						var html  = "<a href='javascript:void(0)' data-toggle='tooltip' data-id='" + row.nis + "' data-original-title='Edit' class='edit btn btn-primary btn-sm editData'>Edit</a> | "
						html += "<a href='javascript:void(0)' data-toggle='tooltip' data-id='" + row.nis + "' data-original-title='Delete' class='delete btn btn-danger btn-sm deleteData'>Hapus</a>"

						return html
					}
				},
				],
			});

			$('body').on('click', '.editData', function () {
				var nis = $(this).data('id');
				$.ajax({
					url: "backend/siswa/get-id.php/?nis=" + nis,
					type: 'GET',
					dataType: 'json',
					success: function(data) {     
						if (data) {
							$('#deleteHeading').html("Tambah");
							$('#ajaxModal').modal('show');
							$('#nis').val(data[0].nis);
							$('#nis').attr('readonly', 'true');							
							$('#nama').val(data[0].nama);
							$('#jenis_kelamin').val(data[0].jenis_kelamin);
							$('#telp').val(data[0].telp);
							$('#alamat').val(data[0].alamat);
							// alert(data[0].nis);
						}
					},
					error: function() {
						alert("No");
					}
				});
			});

			$('body').on('click', '.deleteData', function () {
				var nis = $(this).data('id');
				$.ajax({
					url: "backend/siswa/get-id.php/?nis=" + nis,
					type: 'GET',
					dataType: 'json',
					success: function(data) {     
						if (data) {
							$('#deleteHeading').html("Hapus");
							$('#deleteModal').modal('show');
							$('#nisDel').val(data[0].nis);
							$('#nisDel').attr('readonly', 'true');
							$('#datas').html(data[0].nama + ' Dengan NIS ' + data[0].nis);
						}
					},
					error: function() {
						alert("No");
					}
				});
			});

			$('#create').click(function () {
				$('#saveBtn').val("create");
				$('#nis').val('');
				$('#formData').trigger("reset");
				$('#modelHeading').html("Tambah");
				$('#ajaxModal').modal('show');
			});

			$('#deleteBtn').click(function (e) {
				e.preventDefault();
				$.ajax({
					data: $('#formDelete').serialize(),
					url: "backend/siswa/delete.php",
					type: "POST",
					dataType: 'json',
					success: function (data) {
						$('#formDelete').trigger("reset");
						$('#deleteModal').modal('hide');
						tabel.draw();
					},
					error: function (data) {
						console.log('Error:', data);
						$('#deleteBtn').html('Simpan');
					}
				});
			});

			$('#saveBtn').click(function (e) {
				e.preventDefault();

				$.ajax({
					data: $('#formData').serialize(),
					url: "backend/siswa/create-or-update.php",
					type: "POST",
					dataType: 'json',
					success: function (data) {
						$('#formData').trigger("reset");
						$('#ajaxModal').modal('hide');
						tabel.draw();
					},
					error: function (data) {
						console.log('Error:', data);
						$('#saveBtn').html('Simpan');
					}
				});
			});
		});		
	</script>
</body>
</html>

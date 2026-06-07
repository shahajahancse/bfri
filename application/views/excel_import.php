<!DOCTYPE html>
<html>
<head>
	<title>Import Excel Data into Mysql in Codeigniter</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/bootstrap.min.css" />
	<!-- <script src="<?php echo base_url(); ?>asset/jquery.min.js"></script> -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>

<body>
	<div class="container">
		<br />
		<h3 align="center">Import Excel Data into Mysql in Codeigniter</h3>
		<form method="post" enctype="multipart/form-data" action="<?=base_url('excel_import/import')?>">
			<p><label>Select Excel File</label>
			<input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
			<br />
			<input type="submit" name="import" value="Import" class="btn btn-info" />
		</form>
		<br />
		<div class="table-responsive" id="customer_data">

		</div>
	</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
</head> 
<body>
<button onclick="printContent('div1')">CETAK</button>

<div class="row" id="div1">
            <div class="col-md-12">
			<div class="panel panel-primary">
                        <div class="panel-heading">			
			               Data Barang
                        </div>
                <div class="panel-body">
				<div class="row">
				<div class="col-md-12">
				<div class="table-responsive">
                                <table id='example' class="table table-striped table-bordered table-hover" cellspacing='0' width='100%'>
                                    <thead>
                                        <tr>
                                        		<th>No</th>
                                        		<th>Kode Barang</th>
												<th>Nama Barang</th>
												<th>Harga</th>
				                           		<th>Keterangan</th>
												<th>Qty</th>
												<th>Last Update Qty</th>
                                        		<th>Tersedia / Tidak</th>
												<th>Action</th>
                                        </tr>
                                    </thead>
									
									</table>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</div>
									</body>
									</html>
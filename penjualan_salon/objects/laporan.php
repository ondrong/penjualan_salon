<?php
	class laporan
	{
		private $connect;
//		private $table_name = "tbstok";
		
		public function __construct($db) { $this->connect = $db; }
		
		function ShowPenjualanByDate($datefrom, $dateto){
			$query = "SELECT tbitem.item_name, SUM(qty) AS qty, harga, SUM(qty*harga) AS `total` FROM tborder " . 
			"INNER JOIN tborderdetail ON tborder.order_id = tborderdetail.order_id " . 
			"INNER JOIN tbitem ON tborderdetail.item_kode = tbitem.item_kode " . 
			"WHERE order_date BETWEEN '{$datefrom}' AND '{$dateto}' " . 
			"GROUP BY tbitem.item_name, harga " .
			"ORDER BY tbitem.item_name";
			
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->email);
			$statement->execute();

			return $statement;
		}/*
$sql = "SELECT\n"
    . " `tbitem`.`item_name`\n"
    . " , `tbpurchasedetail`.`qty`\n"
    . " , `tbpurchasedetail`.`harga`\n"
    . " , `tbsupplier`.`supplier_nama`\n"
    . "FROM\n"
    . " `tbsupplier`, \n"
    . " `tbpurchasedetail`\n"
    . " INNER JOIN `tbpurchase` \n"
    . " ON (`tbpurchasedetail`.`purchase_id` = `tbpurchase`.`purchase_id`)\n"
    . " INNER JOIN `tbitem` \n"
    . " ON (`tbpurchasedetail`.`item_kode` = `tbitem`.`item_kode`)\n"
    . " WHERE `tbpurchase`.`purchase_date` BETWEEN \'2015-08-01\' AND \'2015-08-31\'\n"
    . "GROUP BY `tbitem`.`item_name`, `tbpurchasedetail`.`harga`";
*/
		function ShowPembelianByDate($datefrom, $dateto){
			$query="SELECT tbitem.item_name, tbpurchasedetail.qty, tbpurchasedetail.harga,".
			"tbsupplier.supplier_nama FROM tbpurchase " . 
			"INNER JOIN tbpurchasedetail ON (tbpurchasedetail.purchase_id = tbpurchase.purchase_id) " .
			"INNER JOIN tbsupplier ON (tbsupplier.supplier_kode = tbpurchase.supplier_kode) ".
			"INNER JOIN tbitem ON (tbpurchasedetail.item_kode = tbitem.item_kode) ".
			"WHERE tbpurchase.purchase_date BETWEEN '{$datefrom}' AND '{$dateto}' ".
			"GROUP BY tbitem.item_name, tbpurchasedetail.harga ".
			"ORDER BY tbitem.item_kode";
			
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->email);
			$statement->execute();

			return $statement;
		}
		
		function ShowStockBarang(){
			$query = "SELECT tbitem.item_kode, item_name, tbstok.qty, tbstok.last_update, tbstok.username FROM tbstok ".
			"INNER JOIN tbitem ON (tbstok.item_kode = tbitem.item_kode) ".
			"WHERE item_type='BARANG' ORDER BY item_name";
			
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->email);
			$statement->execute();

			return $statement;
		}
	}
?>
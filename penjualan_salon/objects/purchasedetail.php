<?php
	class purchasedetail
	{
		private $connect;
		private $table_name = "tbpurchasedetail";
		private $temp_table = "tmppurchasedetail";

		public $purchase_id, $item_kode, $qty, $harga, $username;

		public function __construct($db) { $this->connect = $db; }
		
		
		function InsertTemp(){
			$query = "INSERT INTO  " . $this->temp_table . "  VALUES(?,?,?,?,?)";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->purchase_id);
			$statement->bindParam(2, $this->item_kode);
			$statement->bindParam(3, $this->qty);
			$statement->bindParam(4, $this->harga);
			$statement->bindParam(5, $this->username);

			if($statement->execute()) return true; else return false;
		}
		
		function InsertData(){
			$query = "INSERT INTO  " . $this->table_name . 
				" SELECT purchase_id, item_kode, SUM(qty) AS qty, AVG(harga) AS harga FROM " . $this->temp_table . 
				" WHERE username = ? GROUP BY purchase_id, item_kode";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);

			if($statement->execute()) return true; else return false;
		}
		
		function ShowTemp($purchase_id){
			$query = "SELECT tbitem.item_kode, item_name, SUM(qty) AS qty, AVG(tmppurchasedetail.harga) AS harga " . 
				"FROM tmppurchasedetail INNER JOIN tbitem ON tmppurchasedetail.item_kode = tbitem.item_kode " . 
				"WHERE purchase_id = '{$purchase_id}' " . 
				"GROUP BY tbitem.item_kode, item_name ORDER BY item_name";
			$statement = $this->connect->prepare($query); 
			$statement->execute();

			return $statement;
		}
		
		function ShowData($purchase_id){
			$query = "SELECT tbitem.item_kode, item_name, SUM(qty) AS qty, AVG(tbpurchasedetail.harga) AS harga " . 
				"FROM tbpurchasedetail INNER JOIN tbitem ON tbpurchasedetail.item_kode = tbitem.item_kode " . 
				"WHERE tbpurchasedetail.purchase_id = '{$purchase_id}' " . 
				"GROUP BY tbitem.item_kode, item_name ORDER BY item_name";
			$statement = $this->connect->prepare($query); 
			$statement->execute();

			return $statement;
		}

		function clearTemp(){
			$query = "DELETE FROM " . $this->temp_table ."  WHERE username = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);

			if($statement->execute()) { return true; }
			else { return false; }
		}
		
		function deleteTemp(){
			$query = "DELETE FROM " . $this->temp_table ."  WHERE purchase_id = ? AND item_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->purchase_id);
			$statement->bindParam(2, $this->item_kode);

			if($statement->execute()) { return true; }
			else { return false; }
		}
	}
	
?>
<?php
	class orderdetail
	{
		private $connect;
		private $table_name = "tborderdetail";
		private $temp_table = "temporderdetail";

		public $order_id, $item_kode, $qty, $notes, $username;

		public function __construct($db) { $this->connect = $db; }
		
		
		function InsertTemp(){
			$query = "INSERT INTO  " . $this->temp_table . "  VALUES(?,?,?,'-',?)";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->order_id);
			$statement->bindParam(2, $this->item_kode);
			$statement->bindParam(3, $this->qty);
			$statement->bindParam(4, $this->username);

			if($statement->execute()) return true; else return false;
		}
		
		function InsertData(){
			$query = "INSERT INTO  " . $this->table_name . 
				" SELECT order_id, item_kode, SUM(qty) AS qty, notes FROM " . $this->temp_table . 
				" WHERE username = ? GROUP BY order_id, item_kode, notes";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);

			if($statement->execute()) return true; else return false;
		}
		
		function ShowTemp($order_id){
			$query = "SELECT tbitem.item_kode, item_name, SUM(qty) AS qty, harga " . 
				"FROM temporderdetail INNER JOIN tbitem ON temporderdetail.item_kode = tbitem.item_kode " . 
				"WHERE order_id = '{$order_id}' " . 
				"GROUP BY tbitem.item_kode, item_name, harga ORDER BY item_name";
			$statement = $this->connect->prepare($query); 
			$statement->execute();

			return $statement;
		}
		
		function ShowData($order_id){
			$query = "SELECT tbitem.item_kode, item_name, SUM(qty) AS qty, harga " . 
				"FROM tborderdetail INNER JOIN tbitem ON tborderdetail.item_kode = tbitem.item_kode " . 
				"WHERE order_id = '{$order_id}' " . 
				"GROUP BY tbitem.item_kode, item_name, harga ORDER BY item_name";
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
			$query = "DELETE FROM " . $this->temp_table ."  WHERE order_id = ? AND item_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->order_id);
			$statement->bindParam(2, $this->item_kode);

			if($statement->execute()) { return true; }
			else { return false; }
		}
	}
	
?>
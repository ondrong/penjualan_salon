<?php
	class purchase
	{
		private $connect;
		private $table_name = "tbpurchase";
		private $temp_table = "tmppurchase";

		public $purchase_id, $purchase_date, $supplier_kode, $username, $my_keys;

		public function __construct($db) { $this->connect = $db; }
		
		function AutoNumber(){
			$this->my_keys = "PP" . date("/ymd");
			$query = "SELECT purchase_id FROM " . $this->table_name . " WHERE purchase_id LIKE '". $this->my_keys ."/%' ORDER BY purchase_id DESC";
			$statement = $this->connect->prepare($query);
			$statement->execute();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			if($statement->rowCount() > 0)
			{
				$s = intval(substr($row['purchase_id'], 1,3));
				$d = substr($row['purchase_id'], 0,3);
				$t = $s + 1;
				switch(strlen($t))
				{
					case 1:
						$a = $d . '/00' . $t;
					break;
					case 2:
						$a = $d . '/0' . $t;
					break;
					case 3:
						$a = $d . '/' . $t;
					break;
				}
				return $a;
			}
			else
			{
				return $this->my_keys . "/001";
			}
		}
		
		function Insert(){
			$query = "INSERT INTO  " . $this->table_name . "  VALUES(?,?,?,?)";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->purchase_id);
			$statement->bindParam(2, $this->supplier_kode);
			$statement->bindParam(3, $this->purchase_date);
			$statement->bindParam(4, $this->username);

			if($statement->execute()) return true; else return false;
		}
		
		function InsertData(){
			$query = "INSERT INTO  " . $this->table_name . " SELECT * FROM " . $this->temp_table . " WHERE username = ? ";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);

			if($statement->execute()) return true; else return false;
		}
		
		function ClearTemp(){
			$query = "DELETE FROM " . $this->temp_table . " WHERE username = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);
			
			if($statement->execute()) return true; else return false;
		}
		
		public function countAll(){
		    $query = "SELECT 1 FROM " . $this->table_name;
		    $statement = $this->connect->prepare( $query );
		    $statement->execute();
		    $num = $statement->rowCount();
			return $num;
		}
		
		function ShowStockByDate($datefrom, $dateto, $from_record, $record_num)
		{	$query ="SELECT tborder.purchase_id, tborder.purchase_date, tbcustomer.cust_nama, tborderdetail.item_kode, tborderdetail.qty, tbitem.harga";
			"FROM    tborder".
			"INNER JOIN tbcustomer". 
			"ON (tborder.supplier_kode = tbcustomer.supplier_kode), tborderdetail".
			"INNER JOIN tbitem ".
			"ON (tborderdetail.item_kode = tbitem.item_kode)".
			"ORDER BY tborder.purchase_id ASC".
			"LIMIT  {$from_record}, {$record_num}";
			
			$statement = $this->connect->prepare($query); 
			$statement->execute();
		}
		
		public function ShowPurchase($purchase_id){
		    $query = "SELECT tbpurchase.purchase_id, purchase_date, supplier_nama FROM " . $this->table_name . " " .
			"INNER JOIN tbsupplier ON tbsupplier.supplier_kode = tbpurchase.supplier_kode " . 
			"WHERE tbpurchase.purchase_id = '{$purchase_id}'";
		    $statement = $this->connect->prepare( $query );
		    $statement->execute();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			
			return $row;
		}
		
	}
?>
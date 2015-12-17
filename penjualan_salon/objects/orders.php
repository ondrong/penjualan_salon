<?php
	class orders
	{
		private $connect;
		private $table_name = "tborder";
		private $temp_table = "temporder";

		public $order_id, $order_date, $cust_kode, $bayar, $username, $my_keys;

		public function __construct($db) { $this->connect = $db; }
		
		function AutoNumber(){
			$this->my_keys = date("Ymd");
			$query = "SELECT order_id FROM " . $this->table_name . " WHERE order_id LIKE '". $this->my_keys ."-%' ORDER BY order_id DESC";
			$statement = $this->connect->prepare($query);
			$statement->execute();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			if($statement->rowCount() > 0)
			{
				$s = intval(substr($row['order_id'], 9,3));
				$d = substr($row['order_id'], 0,8);
				$t = $s + 1;
				switch(strlen($t))
				{
					case 1:
						$a = $d . '-00' . $t;
					break;
					case 2:
						$a = $d . '-0' . $t;
					break;
					case 3:
						$a = $d . '-' . $t;
					break;
				}
				return $a;
			}
			else
			{
				return $this->my_keys . "-001";
			}
		}
		
	public	function ListPelanggan(){
			$query = "SELECT * FROM tbcustomer ORDER BY cust_kode ASC";
			$statement = $this->connect->prepare($query); 
			$statement->execute();
			return $statement;
		}
		function Insert(){
			$query = "INSERT INTO  " . $this->table_name . "  VALUES(?,?,?,?)";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->order_id);
			$statement->bindParam(2, $this->order_date);
			$statement->bindParam(3, $this->cust_kode);
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
		{	$query ="SELECT tborder.order_id, tborder.order_date, tbcustomer.cust_nama, tborderdetail.item_kode, tborderdetail.qty, tbitem.harga";
			"FROM    tborder".
			"INNER JOIN tbcustomer". 
			"ON (tborder.cust_kode = tbcustomer.cust_kode), tborderdetail".
			"INNER JOIN tbitem ".
			"ON (tborderdetail.item_kode = tbitem.item_kode)".
			"ORDER BY tborder.order_id ASC".
			"LIMIT  {$from_record}, {$record_num}";
			
			$statement = $this->connect->prepare($query); 
//			$statement->bindParam(1, $this->email);
			$statement->execute();
		}
		
		public function ShowOrder($order_id){
		    $query = "SELECT tborder.order_id, order_date, cust_nama FROM " . $this->table_name . " " .
			"INNER JOIN tbcustomer ON tbcustomer.cust_kode = tborder.cust_kode " . 
			"WHERE order_id = '{$order_id}'";
		    $statement = $this->connect->prepare( $query );
		    $statement->execute();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			
			return $row;
		}
		
		/*function ShowDataOrder($order_id){
		    $query = "SELECT tborder.order_id, tborder.order_date, tbcustomer.cust_nama, username FROM ". $this->table_name ."". 
		    "INNER JOIN tbcustomer ON (tborder.cust_kode = tbcustomer.cust_kode), tborderdetail". 
		    "INNER JOIN tbitem ON (tborderdetail.item_kode = tbitem.item_kode) ".
		    "GROUP BY tborder.order_id ASC".;
		    $statement = $this->connect->prepare( $query );
		    $statement->execute();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			
			return $row;
		}*/
		
	function showOrderData($from_record_num, $records_per_page){
		$query="SELECT tborder.order_id, tborder.order_date, tbcustomer.cust_nama, username FROM  tborder".
		"INNER JOIN tbcustomer".
		"ON (tborder.cust_kode = tbcustomer.cust_kode), tborderdetail".
		"INNER JOIN tbitem".
		"ON (tborderdetail.item_kode = tbitem.item_kode)".
		"GROUP BY tborder.order_id".
		"ORDER BY tborder.orders_id ASC LIMIT {$from_record_num}, {$records_per_page}";

		$statement = $this->connect->prepare( $query );
		    $statement->execute();	 
		    return $statement;
		}

	}
?>
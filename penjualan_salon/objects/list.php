<?php
	class lists
	{
		private $connect;

		public function __construct($db) { $this->connect = $db; }
		
		function ListItems(){
			$query = "SELECT * FROM tbitem ORDER BY item_name ASC";
			$statement = $this->connect->prepare($query); 
			$statement->execute();
			return $statement;
		}
				
		function ListBarang(){
			$query = "SELECT * FROM tbitem WHERE item_type = 'BARANG' ORDER BY item_name ASC";
			$statement = $this->connect->prepare($query); 
			$statement->execute();
			return $statement;
		}

		function ListPelanggan(){
			$query = "SELECT * FROM tbcustomer WHERE isactive = 1 ORDER BY cust_nama ASC";
			$statement = $this->connect->prepare($query); 
			$statement->execute();
			return $statement;
		}

		function ListSupplier(){
			$query = "SELECT * FROM tbsupplier WHERE isactive = 1 ORDER BY supplier_nama ASC";
			$statement = $this->connect->prepare($query); 
			$statement->execute();
			return $statement;
		}
		
	}
?>
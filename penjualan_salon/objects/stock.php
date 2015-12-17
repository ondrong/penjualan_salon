<?php
class stocks
{
	private $connect;
	private $table_name = "tbstock";
	public $stock_kode, $item_kode, $qty, $last_update, $username;
	
	public function __construct($db) { $this->connect = $db; }

	function Insert(){
			$query = "INSERT INTO  " . $this->table_name . "  VALUES(?,?,?,?,?)";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->stock_kode);
			$statement->bindParam(2, $this->item_kode);
			$statement->bindParam(3, $this->qty);
			$statement->bindParam(4, $this->last_update);
			$statement->bindParam(5, $this->username);

			if($statement->execute()) { return true; }
			else { return false; }
		}
		
	function Update(){
			$query = "UPDATE " . $this->table_name . " SET item_kode=?, qty=?, last_update=?, username WHERE stock_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(5, $this->stock_kode);
			$statement->bindParam(1, $this->item_kode);
			$statement->bindParam(2, $this->qty);
			$statement->bindParam(3, $this->last_update);
			$statement->bindParam(4, $this->username);
			
			if($statement->execute()) { return true; }
			else { return false; }
		}

	function delete(){
			$query = "DELETE FROM " . $this->table_name ."  WHERE stock_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->stock_kode);

			if($statement->execute()) { return true; }
			else { return false; }
		}
		
	
}
?>
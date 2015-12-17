<?php
class items
	{
	private $connect;
	private $table_name = "tbitem";
	public $item_kode, $item_name, $item_note, $isavailable, $harga, $item_type;
	
	public function __construct($db) { $this->connect = $db; }
	
	function Insert(){
			$query = "INSERT INTO  " . $this->table_name . "  VALUES(?,?,?,?,?,?)";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->item_kode);
			$statement->bindParam(2, $this->item_name);
			$statement->bindParam(3, $this->item_note);
			$statement->bindParam(4, $this->isavailable);
			$statement->bindParam(5, $this->harga);
			$statement->bindParam(6, $this->item_type);

			if($statement->execute()) { return true; }
			else { return false; }
		}
	function Update(){
			$query = "UPDATE " . $this->table_name . " SET item_name=?, item_note=?, isavailable=?, harga=?, item_type=? WHERE item_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(6, $this->item_kode);
			$statement->bindParam(1, $this->item_name);
			$statement->bindParam(2, $this->item_note);
			$statement->bindParam(3, $this->isavailable);
			$statement->bindParam(4, $this->harga);
			$statement->bindParam(5, $this->item_type);
			
			if($statement->execute()) { return true; }
			else { return false; }
		}
		
	function delete(){
			$query = "DELETE FROM " . $this->table_name ."  WHERE item_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->item_kode);

			if($statement->execute()) { return true; }
			else { return false; }
		}
		
 	function readBarang($from_record_num, $records_per_page){	 
		    $query = "SELECT * FROM " . $this->table_name . "  WHERE item_type='BARANG' ORDER BY item_kode ASC LIMIT {$from_record_num}, {$records_per_page}";	 
		    $statement = $this->connect->prepare( $query );
		    $statement->execute();	 
		    return $statement;
		}
		
	function readJasa($from_record_num, $records_per_page){	 
		    $query = "SELECT * FROM " . $this->table_name . "  WHERE item_type='JASA' ORDER BY item_kode, item_name ASC LIMIT {$from_record_num}, {$records_per_page}";	 
		    $statement = $this->connect->prepare( $query );
		    $statement->execute();	 
		    return $statement;
		}
	function ShowBarang(){
			$query = "SELECT * FROM " . $this->table_name;
			$statement = $this->connect->prepare($query);
			$statement->execute();

			return $statement;
		}
		
	function ShowBarang2($from_record_num, $records_per_page){
			$query = "SELECT tbitem.item_kode, " . 
			"item_name, harga, item_note, tbstok.qty, " . 
			"tbstok.last_update, isavailable " .
			"FROM tbstok ".
			"INNER JOIN tbitem ON (tbstok.item_kode = tbitem.item_kode) " .
			"WHERE item_type='BARANG' ORDER BY item_kode ASC LIMIT {$from_record_num}, {$records_per_page}";	 			
			$statement = $this->connect->prepare($query);
			$statement->execute();

			return $statement;
			
		}
		
	function ShowJasa(){
			$query = "SELECT * FROM " . $this->table_name ." WHERE item_type='JASA'";
			$statement = $this->connect->prepare($query); 
			$statement->execute();

			return $statement;
		}
		
			
	function ShowOne(){
			$query = "SELECT * FROM " . $this->table_name . " WHERE item_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->item_kode);
			$statement->execute();
			
			$num = $statement->rowCount();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			//$item_kode, $item_name, $item_note, $isavailable, $harga, $item_type;
			if($num > 0)
			{
				$this->item_name = $row['item_name'];
				$this->item_note = $row['item_note'];
				$this->isavailable = $row['isavailable'];
				$this->harga = $row['harga'];
				$this->item_type = $row['item_type'];
				
			}
		}


	public function countAll(){
		    $query = "SELECT 1 FROM " . $this->table_name;
		    $statement = $this->connect->prepare( $query );
		    $statement->execute();
		    $num = $statement->rowCount();
			return $num;
		}
		
		
}	

?>
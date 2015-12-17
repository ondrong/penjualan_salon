<?php
class supplier
{
	private $connect;
	private $table_name = "tbsupplier";
	public $supplier_kode, $supplier_nama, $supplier_alamat, $supplier_hp, $isactive;
	
	public function __construct($db) { $this->connect = $db; }
	
	function Insert(){
			$query = "INSERT INTO  " . $this->table_name . "  VALUES(?,?,?,?,?)";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->supplier_kode);
			$statement->bindParam(2, $this->supplier_nama);
			$statement->bindParam(3, $this->supplier_alamat);
			$statement->bindParam(4, $this->supplier_hp);
			$statement->bindParam(5, $this->isactive);
			

			if($statement->execute()) { return true; }
			else { return false; }
		}
	
	function Update(){
			$query = "UPDATE " . $this->table_name . " SET supplier_nama=?, supplier_alamat=?,supplier_hp=?,  isactive=? WHERE supplier_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(5, $this->supplier_kode);
			$statement->bindParam(1, $this->supplier_nama);
			$statement->bindParam(2, $this->supplier_alamat);
			$statement->bindParam(3, $this->supplier_hp);
			$statement->bindParam(4, $this->isactive);
			
			if($statement->execute()) { return true; }
			else { return false; }
		}
		
	function delete(){
			$query = "DELETE FROM " . $this->table_name ."  WHERE supplier_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->supplier_kode);

			if($statement->execute()) { return true; }
			else { return false; }
		}
	
	function readAll($from_record_num, $records_per_page){	 
		    $query = "SELECT * FROM " . $this->table_name . " ORDER BY supplier_kode ASC LIMIT {$from_record_num}, {$records_per_page}";	 
		    $statement = $this->connect->prepare( $query );
		    $statement->execute();	 
		    return $statement;
		}
	
	public function countAll(){
		    $query = "SELECT 1 FROM " . $this->table_name;
		    $statement = $this->connect->prepare( $query );
		    $statement->execute();
		    $num = $statement->rowCount();
			return $num;
		}
		//public $supplier_kode, $supplier_nama, $supplier_alamat, $isactive;
	function ShowOne(){
			$query = "SELECT * FROM " . $this->table_name . " WHERE supplier_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->supplier_kode);
			$statement->execute();
			
			$num = $statement->rowCount();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			if($num > 0)
			{
				$this->supplier_nama = $row['supplier_nama'];
				$this->supplier_alamat = $row['supplier_alamat'];
				$this->supplier_hp = $row['supplier_hp'];
				$this->isactive = $row['isactive'];
				
			}
		}
	
}
?>
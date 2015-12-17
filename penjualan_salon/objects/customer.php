<?php

class customer
{
	private $connect;
	private $table_name = "tbcustomer";
	public $cust_kode, $cust_nama, $cust_alamat, $cust_jk, $cust_tempat, $cust_dob, $cust_hp, $isactive;
	
	public function __construct($db) { $this->connect = $db; }
	
	function Insert(){
			$query = "INSERT INTO  " . $this->table_name . "  VALUES(?,?,?,?,?,?,?,?)";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->cust_kode);
			$statement->bindParam(2, $this->cust_nama);
			$statement->bindParam(3, $this->cust_alamat);
			$statement->bindParam(4, $this->cust_jk);
			$statement->bindParam(5, $this->cust_tempat);
			$statement->bindParam(6, $this->cust_dob);
			$statement->bindParam(7, $this->cust_hp);
			$statement->bindParam(8, $this->isactive);
			

			if($statement->execute()) { return true; }
			else { return false; }
		}
	
	function Update(){
			$query = "UPDATE " . $this->table_name . " SET cust_nama=?, cust_alamat=?, cust_jk=?, cust_tempat=?, cust_dob=?, cust_hp=?, isactive=? " . 
			" WHERE cust_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(8, $this->cust_kode);
			$statement->bindParam(1, $this->cust_nama);
			$statement->bindParam(2, $this->cust_alamat);
			$statement->bindParam(3, $this->cust_jk);
			$statement->bindParam(4, $this->cust_tempat);
			$statement->bindParam(5, $this->cust_dob);
			$statement->bindParam(6, $this->cust_hp);
			$statement->bindParam(7, $this->isactive);
			
			if($statement->execute()) { return true; }
			else { return false; }
		}
		
	function delete(){
			$query = "DELETE FROM " . $this->table_name ."  WHERE cust_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->cust_kode);

			if($statement->execute()) { return true; }
			else { return false; }
		}
	
	function readAll($from_record_num, $records_per_page){	 
		    $query = "SELECT * FROM " . $this->table_name . " ORDER BY cust_kode ASC LIMIT {$from_record_num}, {$records_per_page}";	 
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
	function ShowOne(){
			$query = "SELECT * FROM " . $this->table_name . " WHERE cust_kode = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->cust_kode);
			$statement->execute();
			
			$num = $statement->rowCount();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			if($num > 0)
			{
				$this->cust_nama = $row['cust_nama'];
				$this->cust_alamat = $row['cust_alamat'];
				$this->cust_jk = $row['cust_jk'];
				$this->cust_tempat = $row['cust_tempat'];
				$this->cust_dob = $row['cust_dob'];
				$this->cust_hp = $row['cust_hp'];
				$this->isactive = $row['isactive'];
			
			}
		}
		
		function ListPelanggan(){
			$query = "SELECT * FROM tbcustomer ORDER BY cust_kode ASC";
			$statement = $this->connect->prepare($query); 
			$statement->execute();
			return $statement;
		}
		
}
?>
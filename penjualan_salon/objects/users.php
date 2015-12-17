<?php
	class users
	{
		private $connect;
		private $table_name = "tbuser";
		public $username, $password, $userlevel, $isactive, $nomor;
		public function __construct($db) { $this->connect = $db; }
		
		function Insert(){
			$query = "INSERT INTO  " . $this->table_name . "  VALUES(?,?,?,?)";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);
			$statement->bindParam(2, md5($this->password));
			$statement->bindParam(3, $this->userlevel);
			$statement->bindParam(4, $this->isactive);

			if($statement->execute()) { return true; }
			else { return false; }
		}
		
		function Update(){
			$query = "UPDATE " . $this->table_name . " SET password=?, userlevel=?, isactive=? WHERE username = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(4, $this->username);
			$statement->bindParam(1, md5($this->password));
			$statement->bindParam(2, $this->userlevel);
			$statement->bindParam(3, $this->isactive);

			if($statement->execute()) { return true; }
			else { return false; }
		}
		
		function delete(){
			$query = "DELETE FROM " . $this->table_name ."  WHERE username = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);

			if($statement->execute()) { return true; }
			else { return false; }
		}
		
		function Show(){
			$query = "SELECT * FROM " . $this->table_name;
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);
			$statement->execute();

			return $statement;
		}
		
		function IsExist(){
			$query = "SELECT * FROM " . $this->table_name . " WHERE username = ? ";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);
			$statement->execute();
			$num = $statement->rowCount();
			if($num>0)
				return true;
			else
				return false;
		}
		
		function UserType(){

			$query = "SELECT * FROM " . $this->table_name . " WHERE username = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);
			$statement->execute();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			
			if($row['userlevel'] == 1)
				return "ADMIN";
			else
				return "USER";
			
		}
		
		function UserActive(){

			$query = "SELECT * FROM " . $this->table_name . " WHERE username = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);
			$statement->execute();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			
			if($row['isaactive'] == 1)
				return "YA";
			else
				return "BUKAN";
			
		}
		
		function LogIn(){
			$query = "SELECT * FROM " . $this->table_name . " WHERE username=? AND password=? ";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);
			$statement->bindParam(2, md5($this->password));
			$statement->execute();
			$num = $statement->rowCount();
			
			if($num>0)
				return true;
			else
				return false;
		}
		
		function readAll($from_record_num, $records_per_page){	 
		    $query = "SELECT * FROM " . $this->table_name . " ORDER BY username ASC LIMIT {$from_record_num}, {$records_per_page}";	 
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
		
		//menampilkan data pericord
		function ShowOne(){
			$query = "SELECT * FROM " . $this->table_name . " WHERE username = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(1, $this->username);
			$statement->execute();
			
			$num = $statement->rowCount();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			if($num > 0)
			{
				$this->password = $row['password'];
				$this->userlevel = $row['userlevel'];
				$this->isactive = $row['isactive'];
			
			}
		}
		function ChangePassword(){
			$query = "UPDATE " . $this->table_name . " SET password=? WHERE username = ?";
			$statement = $this->connect->prepare($query); 
			$statement->bindParam(2, $this->username);
			$statement->bindParam(1, md5($this->password));
			
			if($statement->execute()) { return true; }
			else { return false; }
		}
		
		
	}
	?>
<?php
	class data
	{
		private $connect;
		
		public function __construct($db) { $this->connect = $db; }
		
	function showOrderData(){
		$query="SELECT tborder.order_id, tborder.order_date, tbcustomer.cust_nama, username FROM  tborder ".
		"INNER JOIN tbcustomer ON (tborder.cust_kode = tbcustomer.cust_kode) ".
		"ORDER BY tborder.order_id ASC";

		$statement = $this->connect->prepare($query); 
		$statement->bindParam(1, $this->email);
		$statement->execute();

		return $statement;

		}
		/*SELECT tborder.order_id, tborder.order_date, tbcustomer.cust_nama, username FROM tborder 
		INNER JOIN tbcustomer ON (tborder.cust_kode = tbcustomer.cust_kode), tborderdetail 
		INNER JOIN tbitem ON (tborderdetail.item_kode = tbitem.item_kode) 
		WHERE order_date BETWEEN '2001.1.1' AND '2015.12.12' 
		GROUP BY tborder.order_id ORDER BY tborder.order_id ASC
		*/	
	function showorderdetail($order_id){
		$query="SELECT tbitem.item_name, qty, tbitem.harga, qty * tbitem.harga as total FROM tborderdetail ".
		"INNER JOIN tbitem ON tborderdetail.item_kode = tbitem.item_kode ".
		"WHERE order_id ='{$order_id}'";

		$statement = $this->connect->prepare($query); 
		$statement->execute();
		return $statement;
		}
		
	function showPembelian(){
		$query="SELECT tbpurchase.purchase_id, tbpurchase.purchase_date, tbsupplier.supplier_nama, username FROM tbpurchase ".
		"INNER JOIN tbsupplier on (tbpurchase.supplier_kode = tbsupplier.supplier_kode) ".
		"ORDER BY purchase_date ";
		$statement = $this->connect->prepare($query); 
		$statement->execute();
		return $statement;
		}
	function ShowPembeliandetail($purchase_id){
		$query="SELECT tbitem.item_name, qty, tbpurchasedetail.harga, qty * tbpurchasedetail.harga as total FROM tbpurchasedetail ".
		"INNER JOIN tbitem on (tbitem.item_kode = tbpurchasedetail.item_kode) ".
		"WHERE purchase_id='{$purchase_id}'";
		$statement = $this->connect->prepare($query); 
		$statement->execute();
		return $statement;
		}
	
	}
	
?>
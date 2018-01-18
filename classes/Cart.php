<?php

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');
?>

<?php
	
	class Cart
	{
		
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function addToCart($quantity, $id){
			
			$quantity =  $this->fm->validation($quantity);

			$quantity = mysqli_real_escape_string($this->db->link,$quantity);
			$product_id = mysqli_real_escape_string($this->db->link,$id);
			$Session_id = session_id();

			$squery = "SELECT * FROM products WHERE product_id = '$product_id'";
			$result = $this->db->select($squery)->fetch_assoc();

			$product_name = $result['product_name'];
			$price = $result['price'];
			$image = $result['image'];

			$chquery = "SELECT * FROM cart WHERE product_id = '$product_id' AND Session_id = '$Session_id'";

			$getPro = $this->db->select($chquery);
			if($getPro){
				$msg = "Product Already Added";
				return $msg;
			}
			else
			{
				$query = "INSERT INTO cart(Session_id,product_id,product_name,price,quantity,image) VALUES('$Session_id','$product_id','$product_name','$price','$quantity','$image')";
				$inserted_row = $this->db->insert($query);
				if($inserted_row){
					header("Location:cart.php");
				}
				else
				{
					header("Location:404.php");
				}
			}
			
		}

		public function getCartProduct(){
			$Session_id = session_id();
			$query = "SELECT * FROM cart WHERE Session_id = '$Session_id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function updateCartQuantity($cart_id, $quantity){
			$cart_id 	  = mysqli_real_escape_string($this->db->link,$cart_id);
			$quantity 	  = mysqli_real_escape_string($this->db->link,$quantity);

			$query = "UPDATE cart
				SET
				quantity = '$quantity'
				WHERE cart_id = '$cart_id';
				";

				$updated_row = $this->db->update($query);

				if($updated_row)
				{
					header("Location:cart.php");
				}
				else
				{
					$msg = "<span class='error'>Quantity Not Updated</span>";
					return $msg;
				}
		}
		public function delProductByCart($delid){
			$delid = mysqli_real_escape_string($this->db->link, $delid);
			$query ="DELETE FROM cart WHERE cart_id = '$delid'";
			$deldata = $this->db->delete($query);
			if($deldata){
				header("Location:cart.php");
			}
			else
			{
				$msg = "<span class = 'error'> Product Not Deleted ! </span>";

				return $msg;
			}
		}

		public function checkCartTable(){
			$Session_id = session_id();
			$query = "SELECT * FROM cart WHERE Session_id = '$Session_id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function delUserCart(){
			$Session_id = session_id();
			$query = "DELETE FROM cart WHERE Session_id= '$Session_id'";
			$this->db->delete($query);
		}
		public function orderProduct($userID){
			$Session_id = session_id();
			$query = "SELECT * FROM cart WHERE Session_id = '$Session_id'";
			$getPro = $this->db->select($query);
			if($getPro){
				while ($result = $getPro->fetch_assoc()) {
						$product_id 	= $result['product_id'];
						$product_name   = $result['product_name'];
						$quantity 		= $result['quantity'];
						$price 			= $result['price'];
						$image		    = $result['image'];

					$query = "INSERT INTO order (userID, product_id,product_name,quantity,price,image)
								VALUES ('$userID','$product_id','$product_name','$quantity','$price','$image')";

					$inserted_row = $this->db->insert($query);
				
				}
			}
		}

	}

?>
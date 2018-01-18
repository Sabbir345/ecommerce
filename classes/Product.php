<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');
?>
<?php

	class Product
	{
		
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function ProductInsert($data, $file){

			$product_name = mysqli_real_escape_string($this->db->link,$data['product_name']);
			$cat_id 	  = mysqli_real_escape_string($this->db->link,$data['cat_id']);
			$brand_id	  = mysqli_real_escape_string($this->db->link,$data['brand_id']);
			$body 		  = mysqli_real_escape_string($this->db->link,$data['body']);
			$price 		  = mysqli_real_escape_string($this->db->link,$data['price']);
			$type 		  = mysqli_real_escape_string($this->db->link,$data['type']);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
   		    $file_name = $_FILES['image']['name'];
    		$file_size = $_FILES['image']['size'];
    		$file_temp = $_FILES['image']['tmp_name'];

    		$div = explode('.', $file_name);
    		$file_ext = strtolower(end($div));
    		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    		$uploaded_image = "upload/".$unique_image;

    		if($product_name == "" || $cat_id == "" || $brand_id == "" || $body == "" || $price == "" || $type == "" || $file_name == ""){
    			$msg = "<span class='error'> Fields must not be empty </span>";
					return $msg;
    		}
    		else
    		{
    			move_uploaded_file($file_temp, $uploaded_image);

    			$query = "INSERT INTO products(product_name,cat_id,brand_id,body,price,image,type) VALUES('$product_name','$cat_id','$brand_id','$body','$price','$uploaded_image','$type')";
				$inserted_row = $this->db->insert($query);
				if($inserted_row){
					$msg = "<span class='success'> Product Inserted Successfully </span>";
					return $msg;
				}
				else
				{
					$msg = "<span class='error'>Product Not Inserted</span>";

					return $msg;
				}
    		}

		}

		public function getAllProduct(){
			
			$query = "SELECT p.*, c.cat_name, b.brand_name
			FROM products as p, create_category as c, brand as b 
			WHERE p.cat_id = c.cat_id AND p.brand_id = b.brand_id
			ORDER BY p.product_id DESC";

			$result = $this->db->select($query);
			return $result;
		}
		public function getProductById($id){
			$query = "SELECT * FROM products WHERE product_id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getFeaturedProduct(){
			$query = "SELECT * FROM products WHERE type='0' ORDER BY product_id DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}
		public function getBestProduct(){
			$query = "SELECT * FROM products WHERE type='1' ORDER BY product_id DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}
		public function getSingleProduct($id) {

			$query = "SELECT p.*, c.cat_name, b.brand_name
			FROM products as p, create_category as c, brand as b 
			WHERE p.cat_id = c.cat_id AND p.brand_id = b.brand_id AND p.product_id =
			'$id'";

			$result = $this->db->select($query);

			return $result;
		}
		public function ProductUpdate($data, $file, $id){

			$product_name = mysqli_real_escape_string($this->db->link,$data['product_name']);
			$cat_id 	  = mysqli_real_escape_string($this->db->link,$data['cat_id']);
			$brand_id	  = mysqli_real_escape_string($this->db->link,$data['brand_id']);
			$body 		  = mysqli_real_escape_string($this->db->link,$data['body']);
			$price 		  = mysqli_real_escape_string($this->db->link,$data['price']);
			$type 		  = mysqli_real_escape_string($this->db->link,$data['type']);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
   		    $file_name = $_FILES['image']['name'];
    		$file_size = $_FILES['image']['size'];
    		$file_temp = $_FILES['image']['tmp_name'];

    		$div = explode('.', $file_name);
    		$file_ext = strtolower(end($div));
    		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    		$uploaded_image = "upload/".$unique_image;

    		if($product_name == "" || $cat_id == "" || $brand_id == "" || $body == "" || $price == "" || $type == "" ){
    			$msg = "<span class='error'> Fields must not be empty </span>";
					return $msg;
    		}
    		else {

    				if(!empty($file_name)){

			    		if ($file_size >1048567) {
						     echo "<span class='error'>Image Size should be less then 1MB!
						     </span>";
						    } elseif (in_array($file_ext, $permited) === false) {
						     echo "<span class='error'>You can upload only:-"
						     .implode(', ', $permited)."</span>";
						    } 
				    		else
				    		{
				    			move_uploaded_file($file_temp, $uploaded_image);

				    			$query = "UPDATE products
				    					  SET 
				    					  product_name = '$product_name',
				    					  cat_id 	   = '$cat_id',
				    					  brand_id	   = '$brand_id',
				    					  body 		   = '$body',
				    					  price 	   = '$price',
				    					  image 	   = '$image',
				    					  type 		   = '$type'
				    					  WHERE  product_id = '$id'";

								$updated_row = $this->db->update($query);
								if($updated_row){
									$msg = "<span class='success'> Product Updated Successfully </span>";
									return $msg;
								}
								else
								{
									$msg = "<span class='error'>Product Not Updated</span>";

									return $msg;
								}
				    		}
				    	}
				    	else{

				    			$query = "UPDATE products
				    					  SET 
				    					  product_name = '$product_name',
				    					  cat_id 	   = '$cat_id',
				    					  brand_id	   = '$brand_id',
				    					  body 		   = '$body',
				    					  price 	   = '$price',
				    					  type 	       = '$type'
				    					  WHERE  product_id = '$id'";

								$updated_row = $this->db->update($query);
								if($updated_row){
									$msg = "<span class='success'> Product Updated Successfully </span>";
									return $msg;
								}
								else
								{
									$msg = "<span class='error'>Product Not Updated</span>";

									return $msg;
								}
				    	}
		    	}
		}
		public function delProById($id){

			$query   = "SELECT * FROM products WHERE product_id = '$id'";
			$getData = $this->db->select($query);
			if($getData){
				while($delimg = $getData->fetch_assoc()){
					$dellink = $delimg['image'];
					unlink($dellink);
				}
			}
			$delquery = "DELETE FROM products WHERE product_id ='$id'";
			$deldata = $this->db->delete($delquery);
			if($deldata){
				$msg = "<span class='success'> Product Deleted Successfully</span>";
				return $msg;
			}
			else
				{
					$msg = "<span class='error'>Product Not Deleted Updated</span>";
					return $msg;
				}
			}

			public function latestFromIphone(){
				$query = "SELECT * FROM products WHERE brand_id = '1' ORDER BY product_id DESC LIMIT 1";
				$result = $this->db->select($query);
				return $result;
			}
			public function latestFromSamsung(){
				$query = "SELECT * FROM products WHERE brand_id = '2' ORDER BY product_id DESC LIMIT 1";
				$result = $this->db->select($query);
				return $result;
			}
			public function latestFromNokia(){
				$query = "SELECT * FROM products WHERE brand_id = '3' ORDER BY product_id DESC LIMIT 1";
				$result = $this->db->select($query);
				return $result;
			}
			public function latestFromWalton(){
				$query = "SELECT * FROM products WHERE brand_id = '4' ORDER BY product_id DESC LIMIT 1";
				$result = $this->db->select($query);
				return $result;
			}
		
	}
?>
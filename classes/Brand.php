<?php

	$fileepath = realpath(dirname(__FILE__));
	include_once ($fileepath.'/../lib/Database.php');
	include_once ($fileepath.'/../helper/Format.php');
?>


<?php

	class Brand
	{
		
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function BrandInsert($brand_name){
			
			$brand_name =  $this->fm->validation($brand_name);

			$brand_name = mysqli_real_escape_string($this->db->link,$brand_name);

			if(empty($brand_name))
			{
				$msg = "Brand Must not be empty!";
				return $msg;
			}
			else
			{
				$query = "INSERT INTO brand(brand_name) VALUES('$brand_name')";
				$brandinsert = $this->db->insert($query);
				if($brandinsert){
					$msg = "<span class='success'> Brand Name Inserted Successfully </span>";
					return $msg;
				}
				else
				{
					$msg = "<span class='error'>Brand Name Not Inserted</span>";

					return $msg;
				}
			}
		}
		public function getAllBrand(){
			$query = "SELECT * From brand ORDER BY  brand_id DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function getBrandById($id){
			$query = "SELECT * FROM brand WHERE brand_id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function BrandUpdate($brand_name, $id){
			
			$brand_name =  $this->fm->validation($brand_name);
			$brand_name = mysqli_real_escape_string($this->db->link,$brand_name);
			$id = mysqli_real_escape_string($this->db->link,$id);



			if(empty($brand_name))
			{
				$msg = "<span class='error'> Brand Name Must not be empty! </span>";
				return $msg;
			}
			else
			{
				$query = "UPDATE brand
				SET
				brand_name = '$brand_name'
				WHERE brand_id = '$id'
				";

				$updated_row = $this->db->update($query);

				if($updated_row)
				{
					$msg = "<span class='success'> Brand Name Updated Successfully</span>";
					return $msg;
				}
				else
				{
					$msg = "<span class='error'>Brand Name Not Updated</span>";
					return $msg;
				}
			}
		}

		public function delBrandById($id){
			$query = "DELETE FROM brand WHERE brand_id = '$id'";
			$deldata = $this->db->delete($query);
			if($deldata){
				$msg = "<span class='success'> Brand delete  Successfully</span>";
				return $msg;
			}
			else
				{
					$msg = "<span class='error'>Brand Not Delete</span>";
					return $msg;
				}
		}
	}

?>
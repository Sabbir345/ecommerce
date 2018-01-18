<?php

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');
?>

<?php
	
	class User
	{
		
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function UserRegistration($data){
			$user_name = mysqli_real_escape_string($this->db->link,$data['user_name']);
			$user_email = mysqli_real_escape_string($this->db->link,$data['user_email']);
			$billing_address = mysqli_real_escape_string($this->db->link,$data['billing_address']);
			$zip = mysqli_real_escape_string($this->db->link,$data['zip']);
			$state = mysqli_real_escape_string($this->db->link,$data['state']);
			$country = mysqli_real_escape_string($this->db->link,$data['country']);
			$phone = mysqli_real_escape_string($this->db->link,$data['phone']);
			$pass = mysqli_real_escape_string($this->db->link,md5($data['pass']));

			if($user_name == "" || $user_email == "" || $billing_address == "" || $zip == "" || $state == "" || $country == "" || $phone == "" || $pass == ""){
    			$msg = "<span class='error'> Fields must not be empty </span>";
				return $msg;
    		}
    		$mailquery = "SELECT * FROM userprofile WHERE user_email ='$user_email' LIMIT 1";
    		$mailchk = $this->db->select($mailquery);
    		if($mailchk != false){
    			$msg ="<span class='error'> Email Alreay Exist ! </span>";
    			return $msg;
    		}
    		else{

    			$query = "INSERT INTO userprofile(user_name,user_email,billing_address,zip,state,country,phone,pass) VALUES('$user_name','$user_email','$billing_address','$zip','$state','$country','$phone','$pass')";
				$inserted_row = $this->db->insert($query);
				if($inserted_row){
					$msg = "<span class='success'> User Data Inserted Successfully </span>";
					return $msg;
				}
				else
				{
					$msg = "<span class='error'>User Data Not Inserted</span>";

					return $msg;
				}
    		}
		}

		public function UserLogin($data){
			$user_email = mysqli_real_escape_string($this->db->link,$data['user_email']);
			$pass = mysqli_real_escape_string($this->db->link,md5($data['pass']));

			if(empty($user_email) || empty($pass)){
				$msg = "<span class='error'> Fields must not be empty! </span>";
					return $msg;
			}
			$query = "SELECT * FROM userprofile WHERE user_email = '$user_email' AND pass='$pass'";
			$result = $this->db->select($query);
			if($result != false){
				$value = $result->fetch_assoc();
				Session::set("userlogin", true);
				Session::set("userID", $value['user_id']);
				Session::set("userName", $value['user_name']);
				header("Location:cart.php");
			}
			else{

				$msg = "<span class='error'> Email or Password does not match";
				return $msg;
			}
		}

		public function getUserData($id){
			$query = "SELECT * FROM userprofile WHERE user_id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function userUpdate($data, $userID){
			$user_name = mysqli_real_escape_string($this->db->link,$data['user_name']);
			$user_email = mysqli_real_escape_string($this->db->link,$data['user_email']);
			$billing_address = mysqli_real_escape_string($this->db->link,$data['billing_address']);
			$zip = mysqli_real_escape_string($this->db->link,$data['zip']);
			$state = mysqli_real_escape_string($this->db->link,$data['state']);
			$country = mysqli_real_escape_string($this->db->link,$data['country']);
			$phone = mysqli_real_escape_string($this->db->link,$data['phone']);
			$pass = mysqli_real_escape_string($this->db->link,md5($data['pass']));

			if($user_name == "" || $user_email == "" || $billing_address == "" || $zip == "" || $state == "" || $country == "" || $phone == "" ){
    			$msg = "<span class='error'> Fields must not be empty </span>";
				return $msg;
    		}
    		else{

    			$query = "INSERT INTO userprofile(user_name,user_email,billing_address,zip,state,country,phone,pass) VALUES('$user_name','$user_email','$billing_address','$zip','$state','$country','$phone','$pass')";

				$query = "UPDATE userprofile
				SET
				user_name 		= '$user_name',
				user_email 		= '$user_email',
				billing_address = '$billing_address',
				zip 			= '$zip',
				state 			= '$state',
				country 		= '$country',
				phone 			= '$phone'

				WHERE user_email = '$userID'";

				$updated_row = $this->db->update($query);

				if($updated_row)
				{
					$msg = "<span class='success'> User Data Updated Successfully</span>";
					return $msg;
				}
				else
				{
					$msg = "<span class='error'>User Data Not Updated</span>";
					return $msg;
				}
    		}
		}

	}

?>
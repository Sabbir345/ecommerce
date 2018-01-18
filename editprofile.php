<?php 
	include 'inc/header.php';
?>
<?php
	$id = Session::get("userlogin");
	if($login == false){
		header("Location:login.php");
	}
?>
<?php
	 $userID = Session::get("userID");
     if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['submit'])){
     	$updateUser = $user->userUpdate($_POST, $userID);
     }
 ?>
<style>
	.tblone{width: 550px;margin:0 auto; border:2px solid #ddd;}
	.tblone tr td { text-align: justify; }
	.tblone input[type="text"]{width: 400px;padding: 5px;font-size: 15px;}
</style>

	 <div class="main">
    	<div class="content">
    		<div class="section group">
    			<?php 
    				$id = Session::get("userID");
    				$getdata = $user->getUserData($id);
    					if($getdata){
    						while($result = $getdata->fetch_assoc()){
    			?>
    			<form  action="" method="POST">
					<table class="tblone">
						<?php 

							if(isset($updateUser)){
								echo "<tr><td colspan='2'>".$updateUser."</td></tr>";
							}

						?>
						<tr>
							<td colspan="2"><h2>Update Profile Details</h2></td>
						</tr>
						<tr>
							<td>Name</td>
							<td><input type="text" name="user_name" value="<?php echo $result['user_name']?>"></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><input type="text" name="user_email" value="<?php echo $result['user_email']?>"></td>
						</tr>
						<tr>
							<td>Phone</td>
							<td><input type="text" name="phone" value="<?php echo $result['phone']?>"></td>
						</tr>
						<tr>
							<td>Zipcode</td>
							<td><input type="text" name="zip" value="<?php echo $result['zip']?>"></td>
						</tr>
						<tr>
							<td>Address</td>
							<td><input type="text" name="billing_address" value="<?php echo $result['billing_address']?>"></td>
						</tr>
						<tr>
							<td>State</td>
							<td><input type="text" name="state" value="<?php echo $result['state']?>"></td>
						</tr>
						<tr>
							<td>Country</td>
							<td><input type="text" name="country" value="<?php echo $result['country']?>"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="name" value="Save"></td>
						</tr>
					</table>
				</form>
				<?php } }?>
 			</div>
 		</div>
 	</div>
<?php 
	include 'inc/footer.php';
?>


<?php 
	include 'inc/header.php';
?>
<?php
	$login = Session::get("userlogin");
	if($login == false){
		header("Location:login.php");
	}
?>
<style>
	.tblone{width: 550px;margin:0 auto; border:2px solid #ddd;}
	.tblone tr td { text-align: justify; }
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
				<table class="tblone">
					<tr>
						<td colspan="3"><h2>Your Profile Details</h2></td>
					</tr>
					<tr>
						<td>Name</td>
						<td>:</td>
						<td><?php echo $result['user_name']?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><?php echo $result['user_email']?></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><?php echo $result['phone']?></td>
					</tr>
					<tr>
						<td>Zipcode</td>
						<td>:</td>
						<td><?php echo $result['zip']?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>:</td>
						<td><?php echo $result['billing_address']?></td>
					</tr>
					<tr>
						<td>State</td>
						<td>:</td>
						<td><?php echo $result['state']?></td>
					</tr>
					<tr>
						<td>Country</td>
						<td>:</td>
						<td><?php echo $result['country']?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><a href="editprofile.php">Update Details</a></td>
					</tr>
				</table>
				<?php } }?>
 			</div>
 		</div>
 	</div>
<?php 
	include 'inc/footer.php';
?>


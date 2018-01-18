<?php 
	include 'inc/header.php';
?>
<?php
	
	if(isset($_GET['delpro'])){
		$id = preg_replace('/[^-a-zA-Z-0-9_]/', '', $_GET['delpro']);
		$delid = $ct->delProductByCart($id);
	}

      if($_SERVER['REQUEST_METHOD']=='POST')
     {
         $cart_id = $_POST['cart_id'];
         $quantity = $_POST['quantity'];
         $updateCart = $ct->updateCartQuantity($cart_id, $quantity);
         if($quantity<=0){
         	$delid =$ct->delProductByCart($cart_id);
         }
     }
 ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php
			    		if(isset($updateCart)){
			    			echo $updateCart;
			    		}
			    		if(isset($delid)){
			    			echo $delid;
			    		}
			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">Serial No</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								$getPro = $ct->getCartProduct();
								$sum = 0;
								$quantityadd = 0;
								if($getPro){
									$i = 0;
									while($result = $getPro->fetch_assoc()){
										$i++;
															
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['product_name']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td>$<?php $result['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cart_id" value="<?php echo $result['cart_id'];?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity'];?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
							<td>
								$<?php 
									$total = $result['price'] * $result['quantity']; 
									echo $total;
								?>
									
							</td>
								<td><a onclick="return confirm('Are you sure to Delete'); " href="?delpro=<?php echo $result['cart_id'];?>">X</a></td>
							</tr>
							<?php
								$sum = $sum + $total;
								$quantityadd = $quantityadd + $result['quantity'];
								Session::set("sum", $sum);
								Session::set("quantityadd", $quantityadd);
							?>
							<?php 

							 	} 
							 }
							?>		
						</table>
						<?php 
							$getData = $ct->checkCartTable();
							if($getData){
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$ <?php 
											echo $sum;
									   ?>
								</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php
										$vat = $sum * 0.1;
										$gtotal = $sum + $vat;
										echo $gtotal;
									?>
								</td>
							</tr>
					   </table>
					   <?php } else { 
					   		echo "Cart Empty!";
					   	}
					   	?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php 
	include 'inc/footer.php';
?>
<?php 
	include 'inc/header.php';
	include 'inc/slider.php'; 
?>
<?php
	$login = Session::get("userlogin");
	if($login == false){
		header("Location:login.php");
	}
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		      	<?php
		      		$getFeaturedPD = $pd->getFeaturedProduct();
		      			if($getFeaturedPD){
		      				while($result = $getFeaturedPD->fetch_assoc()){
		      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['product_id']; ?> "><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['product_name']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'], 50 ); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['product_id']; ?> " class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Best Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
		      		$getBestPD = $pd->getBestProduct();
		      			if($getBestPD){
		      				while($result = $getBestPD->fetch_assoc()){
		      	?>
				<div class="grid_1_of_4 images_1_of_4">
					  <a href="details.php?proid=<?php echo $result['product_id']; ?> "><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					  <h2><?php echo $result['product_name']; ?></h2>
					  <p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['product_id']; ?> " class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>
    </div>
 </div>


<?php 
	include 'inc/footer.php';
?>
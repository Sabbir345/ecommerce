
	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getIphone = $pd->latestFromIphone();
					if($getIphone){
						while($result = $getIphone->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['product_id']; ?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p>Lorem ipsum dolor sit amet sed do eiusmod.</p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['product_id']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php } }?>	
			   <?php
					$getSam = $pd->latestFromSamsung();
					if($getSam){
						while($result = $getSam->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['product_id']; ?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Samsung</h2>
						<p><?php echo $result['product_name']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['product_id']; ?>">Add to cart</a></span></div>
				   </div>
				</div>
				 <?php } }?>	
			</div>
			<div class="section group">
				<?php
					$getnokia = $pd->latestFromNokia();
					if($getnokia){
						while($result = $getnokia->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['product_id']; ?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Nokia</h2>
						<p><?php echo $result['product_name']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['product_id']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php } }?>	
			   <?php
					$getwal = $pd->latestFromWalton();
					if($getwal){
						while($result = $getwal->fetch_assoc()){
				?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['product_id']; ?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Walton</h2>
						<p><?php echo $result['product_name']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['product_id']; ?>">Add to cart</a></span></div>
				   </div>
				</div>
				<?php } }?>	
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	

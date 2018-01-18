<?php 

	include 'inc/header.php';
	include 'inc/sidebar.php';
	include '../classes/Product.php';
	//include_once '../helper/Format.php';
?>

<?php

	$product = new Product();
	$fm  	 = new Format();

	if(isset($_GET['delpro']))
    {
    	
    	$id =preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['delpro']);
    	$delpro = $product->delProById($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
        	<?php
        		if(isset($delpro))
        		{
        			echo $delpro;
        		}
        	?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand </th>
					<th>Price </th>
					<th>Image </th>
					<th>Type </th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$getpd = $product->getAllProduct();
					if($getpd)
					{
						$i = 0;
						while($result = $getpd->fetch_assoc()){
					
				?>

				<tr class="odd gradeX">
					<td><?php echo $i++; ?></td>
					<td><?php echo $result['product_name']; ?></td>
					<td><?php echo $result['cat_name']; ?></td>
					<td><?php echo $result['brand_name']; ?></td>
					<td><?php echo $result['price']; ?></td>
					<td> <img src="<?php echo $result['image']; ?>" height="30px" width="50px" /> </td>
					<td>	
						<?php 
								if($result['type']==0){
									echo "Featured";
								}
								else
								{
									echo "General";
								}

								
						 ?>
									
					</td>
					<td><a href="productedit.php?proid=<?php echo $result['product_id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete')" href="?delpro=<?php echo $result['product_id']; ?> ">Delete</a></td>
				</tr>
				<?php
					} }
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>

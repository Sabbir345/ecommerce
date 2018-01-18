<?php 

    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Brand.php';
    include '../classes/Product.php';
    include '../classes/Category.php';

?>
<?php

    if(!isset($_GET['proid']) || $_GET['proid'] == NULL)
     {
        echo "<script> window.location = 'productlist.php'; </script>";
     }
     else
     {
        $id = $_GET['proid'];
     }

    $product = new Product();

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
        $updateproduct = $product->ProductUpdate($_POST, $_FILES, $id);
    }

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">
        <?php
            if(isset($updateproduct))
                echo $updateproduct;
        ?> 
        <?php
            $getPro = $product->getProductById($id);
            if($getPro){
                while($value = $getPro->fetch_assoc()){
        ?>       
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
     <input type="text" name="product_name" value="<?php echo $value['product_name']?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="cat_id">
                            <option>Select Category</option>
                            <?php
                                $cat = new Category();

                                $getCat = $cat->getAllCat();
                                if($getCat){
                                    while($result = $getCat->fetch_assoc()){
                                
                            ?>
                            <option 
                            <?php 
                                if($value['cat_id']== $result['cat_id'] ){ ?>
                                    selected = "selected"
                            <?php  }
                            ?>
                            value="<?php echo $result['cat_name']; ?>"><?php echo $result['cat_name']; ?></option>
                            <?php 
                        } 
                    } 
                        ?>
                            
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand_id">
                            <option>Select Brand</option>
                            <?php
                                $brand = new Brand();
                                $getBrand = $brand->getAllBrand();
                                if($getBrand){
                                    while($result = $getBrand->fetch_assoc()){
                               
                            ?>
                            <option 
                            <?php 
                                if($value['brand_id']== $result['brand_id'] ){ ?>
                                    selected = "selected"
                            <?php  }
                            ?>
                            value="<?php echo $result['brand_name']; ?>"><?php echo $result['brand_name']; ?></option>

                            <?php
                                }
                            }
                            ?>
                         
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce"  name="body">
                          <?php echo $value['body']; ?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text"  name="price" value="<?php echo $value['price']?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $value['image']; ?>" height="30px" width="50px" />
                        <input type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php if($value['type']==0){ ?>
                            <option selected = "selected" value="0">Featured</option>
                            <option value="1">General</option>
                            <?php } else { ?>
                            <option selected = "selected" value="0">General</option>
                            <option value="0">Featured</option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


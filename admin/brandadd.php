<?php 

    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Brand.php';

 ?>
 
<?php
    $brand = new Brand();

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $brand_name = $_POST['brand_name'];
        $insertBrand = $brand->BrandInsert($brand_name);
    }

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
               <div class="block copyblock"> 
                <?php
                    if(isset($insertBrand)){
                        echo $insertBrand;
                    }
                ?>
                 <form action="brandadd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brand_name" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
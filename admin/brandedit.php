<?php 

    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Brand.php';

 ?>
<?php
     if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL)
     {
        echo "<script> window.location = 'brandlist.php'; </script>";
     }
     else
     {
        $id = $_GET['brandid'];
     }
    $brand = new Brand();

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $brand_name = $_POST['brand_name'];
        $updatebrand = $brand->BrandUpdate($brand_name, $id);
    }

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand Name</h2>
               <div class="block copyblock"> 
                <?php
                    if(isset($updatebrand)){
                        echo $updatebrand;
                    }
                ?>
                <?php

                    $getbrand = $brand->getBrandById($id);
                    if($getbrand){
                        while($result = $getbrand->fetch_assoc()){

                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brand_name" value="<?php echo $result['brand_name'] ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
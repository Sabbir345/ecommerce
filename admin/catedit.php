<?php 

    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Category.php';

 ?>
<?php
     if(!isset($_GET['catid']) || $_GET['catid'] == NULL)
     {
        echo "<script> window.location = 'catlist.php'; </script>";
     }
     else
     {
        $id = $_GET['catid'];
     }
    $cat = new Category();

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $cat_name = $_POST['cat_name'];
        $updatecat = $cat->CatUpdate($cat_name, $id);
    }

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                <?php
                    if(isset($updatecat)){
                        echo $updatecat;
                    }
                ?>
                <?php

                    $getCat = $cat->getCatById($id);
                    if($getCat){
                        while($result = $getCat->fetch_assoc()){

                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="cat_name" value="<?php echo $result['cat_name'] ?>" class="medium" />
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
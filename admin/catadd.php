﻿<?php 

    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Category.php';

 ?>
 
<?php
    $cat = new Category();

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $cat_name = $_POST['cat_name'];
        $insertcat = $cat->CatInsert($cat_name);
    }

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                <?php
                    if(isset($insertcat)){
                        echo $insertcat;
                    }
                ?>
                 <form action="catadd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="cat_name" placeholder="Enter Category Name..." class="medium" />
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
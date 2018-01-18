<?php 
	include 'inc/header.php';
?>
<?php
	$login = Session::get("userlogin");
	if($login == true){
		header("Location:index.php");
	}
?>
 <?php

	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login']))
		{
			$user_login = $user->UserLogin($_POST);
		}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
    	 	<?php 
    	 		if(isset($user_login)){
    	 			echo $user_login;
    	 		}
    	 	?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post" id="member">
                	<input name="user_email"  type="text">
                    <input name="pass" type="password">
                     <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                    </div>
             </form>

            <?php

			    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register']))
			    {
			        $user_reg = $user->UserRegistration($_POST);
			    }

			?>
    	<div class="register_account">
    		<?php 
    			if(isset($user_reg))
    			{
    				echo $user_reg;
    			}
    		?>
    		<h3>Register New Account</h3>
    		<form action ="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input 	  type="text" name="user_name" placeholder="Name" >
							</div>
							<div>
							   <input type="text" name="user_email" placeholder="Email">
							</div>
							<div>
								<input type="text" name="billing_address" placeholder="Your Billing Address">
							</div>
							<div>
								<input type="text" name="zip" placeholder="Zip">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="state" placeholder="state">
						</div>
						<div>
							<input type="text" name="country" placeholder="Country">
						</div>
		    			        
		           <div>
		          <input  type="text" name="phone" placeholder="phone">
		          </div>
				  
				  <div>
					<input type="text" name="pass" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php 
	include 'inc/footer.php';
?>
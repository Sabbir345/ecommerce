<?php 
	include '../classes/Adminlogin.php';
?>

<?php

	$adminlogin = new Adminlogin();

	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$AdminUser = $_POST['AdminUser'];
		$AdminPass = md5($_POST['AdminPass']);

		$LoginValuePass = $adminlogin->AdminLogin($AdminUser,$AdminPass);
	}

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span style="color:red;font-size:18px;">
				<?php
					if(isset($LoginValuePass)){
						echo $LoginValuePass;
					}
				?>
			</span>
			<div>
				<input type="text" placeholder="Admin Username"  name="AdminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="AdminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">E-coomerce Website</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
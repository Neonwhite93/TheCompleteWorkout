


<!DOCTYPE html>
<html  xmlns="http://www.w3.org/1999/xhtml">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

Last Modified: DBoyd 10-21-17
-->
<html>

	<head>
	
		<title>The Complete Workout</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="tcw_style.css" />
				
	</head>

	<body>

		<h1 id = "app_title" class = "frame_bar" >Welcome to The Complete Workout</h1>
			
		<div id = "view_panel" class = "center">	

			<h3 class = "loginTitle">Login</h3>
	
			<form class = "form-signin" role = "form" 
					action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">
				Username:<br>
				<input type="text" class = "form-control" 
					name = "username" placeholder = "e.g. SirLiftsALot" required autofocus>
			   <br><br>
				Password:<br>
				<input type="password" name="password" placeholder = "e.g. GetSwole2017!!!" required autofocus>
				<br>
				Forgot your password?
				<br>
				<a href="https://pbs.twimg.com/media/DKW_xbwVwAAEo8b.jpg" class="forgotPwd">
					Forgot password?
				</a>
				
				<br><br>
				
				<input type="submit" name="Login">
				
				<!-- <link to register> -->
				<br><br><br>
				<div>
					Need to register? Follow the link.
					<br>
					<a href="registerPage.html" class="goRegister">
						Register
					</a>
				</div>
				
				<br><br>
				
				<div>
					Continue as guest?
					<a href="http://www2.humboldt.edu/thecompleteworkout/">Continue
					</a>
				</div>
			</form>
			
		</div>
	
	
	
	<?php
        require_once("tcw_footer.html");
    ?>
	
	</body>
	
</html>

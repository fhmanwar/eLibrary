<?php 
include_once "config/core.php";

$page_title = "Reset Password";

include_once "helper/login_checker.php";
login_checker();

include_once "config/database.php";
include_once 'objects/user.php';
// include_once "helper/utils.php";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// include_once "layout_head.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="<?php echo $home_url . "View/assets/css/font-awesome.css" ?>">
		<link rel="stylesheet" href="<?php echo $home_url . "View/assets/css/bootstrap.css" ?>">
		<link rel="stylesheet" href="<?php echo $home_url . "View/assets/css/custom1.css" ?>">
		<title><?php echo isset($title) ? strip_tags($title) : "Reset Password"; ?></title>
		<style>
      .login{
        margin-top: 12%;
        margin-left: 2%;
      }
      .login h1{
        padding-bottom: 40px;
      }
      body{
        font-family: 'Open Sans', sans-serif;
        background: #F9F9F9;
      }
  </style>
	</head>
	<body>
		<div id="container">
		<div id="login_content" class="col-md-11 login">
		<?php
			echo "<div class='col-sm-12'>";

			// check acess code will be here
			// get given access code
			$access_code=isset($_GET['access_code']) ? $_GET['access_code'] : die("Access code not found.");
	
			// check if access code exists
			$user->access_code=$access_code;
	
			if(!$user->accessCodeExists()){
					die('Access code not found.');
			}
	
			else{
					// reset password form will be here
					// post code will be here
					// if form was posted
					if($_POST){
							// set values to object properties
							$user->password=$_POST['password'];
	
							// reset password
							if($user->updatePassword()){
									echo "<div class='alert alert-info'>Password was reset. Please <a href='{$home_url}'>login.</a></div>";
							}
	
							else{
									echo "<div class='alert alert-danger'>Unable to reset password.</div>";
							}
					}	
		?>
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<center><a href="<?php echo $home_url; ?>"><h1>Reset Password</h1></a></center>
					</div>
					<div class="panel-body">
						<form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) . "?access_code=".$access_code?>">
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-key"></i></span>
								<input type="password" class="form-control" placeholder="Your Pasword " name="password" required/>
							</div>
								<?php //echo isset($error['username']) ? $error['username'] : '';?>
								<?php //echo isset($error['reset_result']) ? $error['reset_result'] : '';?>
								<br>
								<!-- <input type="submit" class="btn btn-primary" value="Send" name="submit"/> -->
								<button type='submit' class='btn btn-primary'>Reset Password</button>
						</form>
						<br>
						<a href="<?php echo $home_url; ?>"><p class="pull-right">Cancel</p></a>
						</div>
					</div>
				</div>
			</div>
		</div>
 
	<?php 
			}
		
		echo "</div>"; 
		?>
    <script src="<?php echo $home_url . "View/assets/js/jquery.min.js" ?>"></script>
    <script src="<?php echo $home_url . "View/assets/js/bootstrap.min.js" ?>"></script>
  </body>
</html>

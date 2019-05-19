<?php 
include_once "config/core.php";

$page_title = "Forgot Password";

include_once "helper/login_checker.php";
login_checker();

include_once "config/database.php";
include_once 'objects/user.php';
include_once "helper/utils.php";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$utils = new Utils();

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
			if($_POST){

				echo "<div class='col-sm-12'>";
		
						// check if username and password are in the database
						$user->email=$_POST['email'];
		
						if($user->emailExists()){
		
								// update access code for user
								$access_code=$utils->getToken();
		
								$user->access_code=$access_code;
								if($user->updateAccessCode()){
		
										// send reset link
										$body="Hi there.<br /><br />";
										$body.="Please click the following link to reset your password: {$home_url}reset_pass/?access_code={$access_code}";
										$subject="Reset Password";
										$send_to_email=$_POST['email'];
		
										if($utils->sendEmailViaPhpMail($send_to_email, $subject, $body)){
												echo "<div class='alert alert-info' >
																Password reset link was sent to your email.
																Click that link to reset your password.
														</div>";
										}
		
										// message if unable to send email for password reset link
										else{ echo "<div class='alert alert-danger'>ERROR: Unable to send reset link.</div>"; }
								}
		
								// message if unable to update access code
								else{ echo "<div class='alert alert-danger'>ERROR: Unable to update access code.</div>"; }
		
						}
		
						// message if email does not exist
						else{ echo "<div class='alert alert-danger'>Your email cannot be found.</div>"; }
		
				echo "</div>";
		}
		?>
			<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-default">
						<div class="panel-heading">
						<center><a href="<?php echo $home_url; ?>"><h2>Reset Password</h2></a></center>
						</div>
						<div class="panel-body">
							<form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
								<input type="email" class="form-control" placeholder="Your Email " name="email" required autofocus/>
							</div>
								<br>
								<input type="submit" class="btn btn-primary" value="Send" name="submit"/>
							</form>
							<br>
							<a href="<?php echo $home_url; ?>"><p class="pull-right">Cancel</p></a>
						</div>
					</div>
				</div>
			</div>
				
		</div>

    <script src="<?php echo $home_url . "View/assets/js/jquery.min.js" ?>"></script>
    <script src="<?php echo $home_url . "View/assets/js/bootstrap.min.js" ?>"></script>
  </body>
</html>

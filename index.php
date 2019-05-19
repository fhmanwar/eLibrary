<?php
// ob_start();
// session_start();
// // include_once('model/connect.php');
// 	include_once 'config/database.php';
// 	$con = new Database();
// 	$db = $con->getConnection();

// 	// start session
// 	//session_start();

// 	// if user click Login button
// 	if(isset($_POST['submit'])){

// 		// get username and password
// 		$username = $_POST['username'];
// 		$password = $_POST['password'];

// 		// set time for session timeout
// 		$currentTime = time() + 25200;
// 		$expired = 3600;

// 		// create array variable to handle error
// 		$error = array();

// 		// check whether $username is empty or not
// 		if(empty($username)){
// 			$error['username'] = "*Username should be filled.";
// 		}

// 		// check whether $password is empty or not
// 		if(empty($password)){
// 			$error['password'] = "*Password should be filled.";
// 		}

// 		// if username and password is not empty, check in database
// 		if(!empty($username) && !empty($password)){

// 			// change username to lowercase
// 			$username = strtolower($username);

// 			//encript password to sha256
// 		  $password = hash('sha256',$username.$password);

// 			// get data from user table
// 			$sql_query = "SELECT * FROM tbl_user WHERE username = ? AND password = ?";

// 			$stmt = $connect->stmt_init();
// 			if($stmt->prepare($sql_query)) {
// 				// Bind your variables to replace the ?s
// 				$stmt->bind_param('ss', $username, $password);
// 				// Execute query
// 				$stmt->execute();
// 				/* store result */
// 				$stmt->store_result();
// 				$num = $stmt->num_rows;
// 				// Close statement object
// 				$stmt->close();
// 				if($num == 1){
// 					$_SESSION['user'] = $username;
// 					$_SESSION['timeout'] = $currentTime + $expired;
// 					header("location: View/dasbor.php");
// 				}else{
// 					$error['failed'] = "<span class='label label-danger'>Invalid Username or Password!</span>";
// 				}
// 			}

// 		}
// 	}
	// include_once('model/close_database.php');
	
include_once "config/core.php";

$title = "Login";
$require_login = false;
include_once "helper/login_checker.php";
login_checker();

$access_denied = false;

if($_POST){
	include_once "config/database.php";
	include_once "objects/user.php";

	$database = new Database();
	$db = $database->getConnection();

	$user = new User($db);

	$user->email=$_POST['email'];

	$email_exists = $user->emailExists();

	if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status==1){

			$_SESSION['logged_in'] = true;
			$_SESSION['user_id'] = $user->id;
			$_SESSION['access_level'] = $user->access_level;
			$_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8') ;
			$_SESSION['lastname'] = $user->lastname;

			if($user->access_level=='Admin'){
					header("Location: {$home_url}view/?action=login_success");
			}

			else{
					// header("Location: {$home_url}index.php?action=login_success");
					header("Location: {$home_url}?action=not_admin");
			}
	}

	else{
			$access_denied=true;
	}
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="<?php echo $home_url . "View/assets/css/font-awesome.css" ?>">
  <link rel="stylesheet" href="<?php echo $home_url . "View/assets/css/bootstrap.css" ?>">
  <link rel="stylesheet" href="<?php echo $home_url . "View/assets/css/custom1.css" ?>">
  <title><?php echo isset($title) ? strip_tags($title) : "Store Admin"; ?></title>
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
			<div class="col-md-4 col-md-offset-4">
				<?php 
				// get 'action' value in url parameter to display corresponding prompt messages
				$action=isset($_GET['action']) ? $_GET['action'] : "";

				
				if($action =='not_yet_logged_in'){ // tell the user he is not yet logged in
						echo "<div class='alert alert-danger margin-top-40' role='alert'>Please login.</div>";
				}else if($action=='please_login'){ // tell the user to login
						echo "<div class='alert alert-info'>
										<strong>Please login to access that page.</strong>
									</div>";
				}else if($action=='not_admin'){ // tell the user to login
					echo "<div class='alert alert-info'>
									<strong>Contact me, if you want to be an Admin</strong>
								</div>";
				}

				// // tell the user email is verified
				// else if($action=='email_verified'){
				// 		echo "<div class='alert alert-success'>
				// 				<strong>Your email address have been validated.</strong>
				// 		</div>";
				// }

				// tell the user if access denied
				if($access_denied){
						echo "<div class='alert alert-danger margin-top-40' role='alert'>
								Access Denied.<br /><br />
								Your username or password maybe incorrect
						</div>";
				}
				?>
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">
						<center><h3><a href="<?php echo $home_url; ?>"><?php echo isset($title) ? strip_tags($title) : "Store Admin"; ?></a></h3></center>
						<center>( E-Library Android App )</center>
					</div>
					<div class="panel-body">
						<center><?php //echo isset($error['failed']) ? $error['failed'] : '';?></center>
						<br>
						<form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
								<input type="text" class="form-control" placeholder="Your Email " name="email" required autofocus/>
							</div>
							<br>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
								<input type="password" class="form-control" placeholder="Your Password " name="password" required />
							</div>
							<br>
							<button type="submit" name="submit" class="btn btn-primary pull-right">Login</button><br><br>
						</form>
						<a href="<?php $home_url."forgotpass.php" ?>"><p class="pull-right">Forgot Password?</p></a>
					</div>
				</div>
    	</div>
    </div>
  </div>

  <script src="<?php echo $home_url . "View/assets/js/bootstrap.min.js" ?>"></script>
</body>
</html>

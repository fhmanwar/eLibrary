<?php
	ob_start();
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/custom1.css">
  <title>ELibrary Admin Page</title>
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
    	      <div class="panel panel-default">
    			  <!-- Default panel contents -->
    			  <div class="panel-heading">
    				  <center><h3>Login Administrator</h3></center>
    				  <center>( E-Library Android App )</center>
    			  </div>
    			  <div class="panel-body">
    				<center><?php echo isset($error['failed']) ? $error['failed'] : '';?></center>
    				<br>
    		    <form method="post">
              <label>Username :</label>
              <input type="text" name="username" class="form-control" required>
    					<br>
              <label>Password :</label>
              <input type="password" class="form-control" name="password" required>
    					<br>
    					<button type="submit" name="submit" class="btn btn-primary pull-right">Login</button><br><br>
    		    </form>
    				<a href="forgotpass.php"><p class="pull-right">Forgot Password?</p></a>
    			  </div>
    			</div>
    	</div>
    </div>
  </div>

  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
<?php
	include_once('model/connect.php');

	// start session
	//session_start();

	// if user click Login button
	if(isset($_POST['submit'])){

		// get username and password
		$username = $_POST['username'];
		$password = $_POST['password'];

		// set time for session timeout
		$currentTime = time() + 25200;
		$expired = 3600;

		// create array variable to handle error
		$error = array();

		// check whether $username is empty or not
		if(empty($username)){
			$error['username'] = "*Username should be filled.";
		}

		// check whether $password is empty or not
		if(empty($password)){
			$error['password'] = "*Password should be filled.";
		}

		// if username and password is not empty, check in database
		if(!empty($username) && !empty($password)){

			// change username to lowercase
			$username = strtolower($username);

			//encript password to sha256
		  $password = hash('sha256',$username.$password);

			// get data from user table
			$sql_query = "SELECT * FROM tbl_user WHERE username = ? AND password = ?";

			$stmt = $connect->stmt_init();
			if($stmt->prepare($sql_query)) {
				// Bind your variables to replace the ?s
				$stmt->bind_param('ss', $username, $password);
				// Execute query
				$stmt->execute();
				/* store result */
				$stmt->store_result();
				$num = $stmt->num_rows;
				// Close statement object
				$stmt->close();
				if($num == 1){
					$_SESSION['user'] = $username;
					$_SESSION['timeout'] = $currentTime + $expired;
					header("location: View/dasbor.php");
				}else{
					$error['failed'] = "<span class='label label-danger'>Invalid Username or Password!</span>";
				}
			}

		}
	}
  include_once('model/close_database.php');
	?>

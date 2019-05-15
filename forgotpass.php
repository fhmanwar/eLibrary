<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/custom1.css">
        <title>Material Wallpaper</title>
    </head>
    <body>
    	<div id="container">


        <?php
        	include_once('model/connect.php');
        	include('helper/functions.php');

        	if(isset($_POST['btnReset'])){

        		$username = $_POST['username'];

        		$function = new functions;

        		// create array variable to handle error
        		$error = array();

        		// create array variable to store data
        		$data = array();

        		if(empty($username)){
        			$error['username'] = "*Username should be filled.";
        		}else{
        			// check username in user table
        			$sql_query = "SELECT Password, Email
        					FROM tbl_user
        					WHERE Username = ?";

        			$stmt = $connect->stmt_init();
        			if($stmt->prepare($sql_query)) {
        				// Bind your variables to replace the ?s
        				$stmt->bind_param('s', $username);
        				// Execute query
        				$stmt->execute();
        				// store result
        				$result = $stmt->store_result();
        				$stmt->bind_result($data['Password'],
        					$data['Email']
        					);
        				$stmt->fetch();
        				$num = $stmt->num_rows;
        				$stmt->close();
        			}

        			// if username exist send new password
        			if($num == 1){
        				$email = $data['Email'];
        				$string = 'abcdefghijklmnopqrstuvwxyz';
        				$password = $function->get_random_string($string, 6);
        				$encrypt_password = hash('sha256',$username.$password);

        				// store new password to user table
        				$sql_query = "UPDATE tbl_user
        						SET Password = ?
        						WHERE Username = ?";

        				$stmt = $connect->stmt_init();
        				if($stmt->prepare($sql_query)) {
        					// Bind your variables to replace the ?s
        					$stmt->bind_param('ss',
        							$encrypt_password,
        							$username);
        					// Execute query
        					$stmt->execute();
        					// store result
        					$reset_result = $stmt->store_result();
        					$stmt->close();
        				}

        				// send new password to user email
        				if($reset_result){
        					$to = $email;
        					$subject = $email_subject;
        					$message = $reset_message." ".$password;
        					$from = $admin_email;
        					$headers = "From: ".$from;
        					mail($to,$subject,$message,$headers);

        					$error['reset_result'] = "*New Password has been sent to your email.";
        				}else{
        					$error['reset_result'] = "*Failed getting new password.";
        				}

        			}else{
        				$error['reset_result'] = "*Username is not available.";
        			}
        		}
        	}
        ?>

        <div id="login_content" class="col-md-11 login">
          <div class="col-md-4 col-md-offset-4">
      	      <div class="panel panel-default">
                <div class="panel-heading">
        	         <h1>Reset Password</h1>
               </div>
    	      <div class="panel-body">
            	<form method="post">
            	  <label>Username:</label>
  			        <input type="text" name="username" class="form-control" />
              	<?php echo isset($error['username']) ? $error['username'] : '';?>
              	<?php echo isset($error['reset_result']) ? $error['reset_result'] : '';?>
              	<br>
            		<input type="submit" class="btn btn-primary" value="Send" name="btnReset"/>
            	</form>
            	<br>
            	<a href="index.php"><p class="pull-right">Cancel</p></a>
            </div>
          </div>
        </div>
      </div>
        <?php include_once('model/close_database.php'); ?>
  	</div>

    <script src="assets/css/js/jquery.min.js"></script>
    <script src="assets/css/js/bootstrap.min.js"></script>
  </body>
</html>

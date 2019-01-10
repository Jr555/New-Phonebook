<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="bootstrap-4.0.0-beta.3-dist/css/bootstrap.min.css">
</head>
<body bgcolor="red">
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date)
VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'>
<center><h1>You are now registered!</h1>
<br><h3>Click here to</h3><a href='login.php'><h4><font color='red'><b>Login</b></font></h4></a></div></center>";
	}
    }else{
?>
<center><div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<b><div class="input-group">
<input type="text" name="username" placeholder="Username" required /><br><br>
</div>
<b><div class="input-group">
<input type="text" name="firstname" placeholder="Firstname" required /><br><br>
</div>
<b><div class="input-group">
<input type="text" name="lastname" placeholder="Lastname" required /><br><br>
</div>
<b><div class="input-group">
<input type="email" name="email" placeholder="Email" required /><br><br>
</div>
<b><div class="input-group">
<input type="password" name="password" placeholder="Password" required /><br><br>
</div>
<b><div class="input-group">
<input type="password" name="confirm password" placeholder=" Confirm Password" required /><br><br>
</div>
<div class="input-group">
<button type="submit" class="btn" name="reg_user">Register</button>
</div></b>
<p>
<b><h4>Already a member?<a href="login.php"><font color="white">Log In</font></b></h4></a>
</p>
</form>
</div></center>
<?php } ?>
</body>
</html>
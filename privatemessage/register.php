<?php require_once("connection.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Private Messaging App</title>
	<style type="text/css">
		* {margin: 0px; padding: 0px;}
			#container{ width: 300px; margin: 0px auto;}
		.input {width: 92%;padding: 2%;}
	</style>
</head>
<body>
	<h1  align="center">Registration Form</h1>
	<div id="container">
		<form method="post">
			<input type="text" name="user_name" placeholder="user name" id="user_name" onkeyup= "check_user()" class="input" required="user">
			<div id="checking">Checking</div>
			<br><br>




			<input type="password" name="password" placeholder="password" class="input" required="password"><br><br>
			<input type="submit" id="register" name="register" value="register">
			<a href="login.php">Login here</a>
		</form>
	</div>
	<?php if(isset($_POST['register'])) {

		   $user_name= $_POST['user_name'];
		   $password= $_POST['password'];

		   $q= "INSERT INTO `users` (`id`,`user_name`,`password`) 
		         VALUES('','".$user_name."', '".$password."')" ;
		   $r= mysqli_query($con, $q) ;
           
              if($r) {
		   	header("location:login.php");
		   }
		   else {
		   	echo $q;
		   }

		         
	}
	?>
    <script type="text/javascript" src="sub_file/jquery-3.5.1.min.js"></script>
	<script type="text/javascript">

			document.getElementById("register").disabled= true;
		function check_user() {

     var user_name = document.getElementById("user_name").value;

     //here we will send data to user_check.php file

     $.post("sub_file/user_check.php",
     {
     	user: user_name
     },

      //in return we will recieve data in this function
      function(data, status) {

       if (data =='<p style= "color:red">User already registered</p>') {
       	    document.getElementById("register").disabled= true;
       }else {
       		document.getElementById("register").disabled= false;
       }
        
       document.getElementById("checking").innerHTML = data;
      }

     	);
      }
	</script>
</body>
</html>
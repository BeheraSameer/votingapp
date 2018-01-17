<?php
   ob_start();
   session_start();
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Admin Page</title>
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,700,300italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/admincss.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/animate.min.css" />
	<link rel="stylesheet" href="css/jquery.fancybox.css" />
	<link rel="stylesheet" href="css/nivo-lightbox.css" />
	<link rel="stylesheet" href="css/default.css" />
	<link rel="stylesheet" href="css/owl.carousel.css" />
	<link rel="stylesheet" href="css/owl.theme.css" />
	<link rel="stylesheet" href="css/owl.transitions.css">
	
	
	<style>
	        h1{
            text-align: center;
            color: #4A4A4B;
         }
	        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #E8E8E8;
         }
	</style>
	
	
</head>
	
   <body>
      <center><h1><b>DATABASE ADMINISTRATOR PAGE!</b></h1></center>
      <div class = "container form-signin">
         
         <?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['username'] == 'Admin' && 
                  $_POST['password'] == 'Pass@123') {
                  $_SESSION['loggedin'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'Admin';
                  header('location:my_search.php');
                  
               }
			   else
			   {
                  $msg = 'Wrong Username or Password';
               }
            }
         ?>
      </div> <!-- /container -->
      
      <div class = "container">
      
         <center><form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input align="center" type = "text" class = "form-control" 
               name = "username" placeholder = "Enter Username" required autofocus></br>
            <input align="center" type = "password" class = "form-control"
               name = "password" placeholder = "Enter Password" required></br>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               align="center" name = "login">Login</button>
         </form></center>
			
         <center><h5><a href = "outsession.php">Clear Session</a></h5></center></br></br>
		 <center><h3><u><b><a href = "index.php">Back to Home Page</a></b></u></h3></center>
      
   </body>
</html>
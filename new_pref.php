<?php
// Since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($first, $last, $l_dob, $gen, $pref, $error)
{
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Set Preference</title>
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,700,300italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/animate.min.css" />
	<link rel="stylesheet" href="css/jquery.fancybox.css" />
	<link rel="stylesheet" href="css/nivo-lightbox.css" />
	<link rel="stylesheet" href="css/default.css" />
	<link rel="stylesheet" href="css/owl.carousel.css" />
	<link rel="stylesheet" href="css/owl.theme.css" />
	<link rel="stylesheet" href="css/owl.transitions.css">
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/responsive.css" />
	
	<center><h1>Add Your Preference!</h1></center>
	
</head>
<body>


<footer id="footer" class="footer">
		<div class="container">
		     <div class="col-sm-5 col-sm-offset-7 col-xs-10 col-xs-offset-2">
			 <div class="head_title text-center">
							<h2>Enter Details</h2><br/>
<?php
// If there are any errors then display them
if ($error != '')
{
echo '<center><div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div></center>';
}
?>
<center><form action="new_pref.php" method="post">
<div>
First Name: <font color = "red">*</font> <input type = "text" placeholder = "Enter First Name" maxlength = "20" name = "fname" value = "<?php echo $first; ?>"><br/><br/>

Last Name: <font color = "red">*</font> <input type = "text" placeholder = "Enter Last Name" maxlength = "20" name = "lname" value = "<?php echo $last; ?>"><br/><br/>

Date of Birth: <font color = "red">*</font> <input type = "text" placeholder = "DDMMYYYY" maxlength = "8" name = "dob" value = "<?php echo $l_dob; ?>"><br/><br/>

Gender: <font color = "red">*</font> <select name = "gender">
                                     <option value = "">Select...</option>
                                     <option value = "M">Male</option>
									 <option value = "F">Female</option>
									 </select><br/><br/>

E-Mail Id: <input type = "text" placeholder = "Enter E-Mail Id" maxlength = "40" name = "email"><br/><br/>

Mobile Number: <input type = "text" placeholder = "Eg. +1-979-587-6584" maxlength = "20" name = "mob"><br/><br/>

Fruit Preference: <font color = "red">*</font> <select name = "new_pref">
                                    <option value="">Select...</option>
	                                <option value="APPLES">APPLES</option>
	                                <option value="ORANGES">ORANGES</option>
	                                <option value="BANANAS">BANANAS</option>
	                                <option value="PINEAPPLES">PINEAPPLES</option>
	                                </select><br/><br/>

<input type = "reset" name = "reset">
<input type = "submit" name = "submit">
</div>
</form></center>
<center><h6>NOTE: <font color = "red">*</font> Marked Fields are Mandatory!</h6></center>
<div class="form_btn_area text-center">
		<a href="index.php" class="btn">Back to Home!</a>
</div>
                 </div>
			</div>
		</div>
	</footer>
<?php
}
// Check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['submit']))
{
// Connect to the database
include('db_connect.php');
$conn = OpenCon();

//$data = preg_replace('/[^A-Za-z0-9]/', "", $data);
// Get form data, making sure it is valid
$first = strtoupper(trim(preg_replace('/[^ A-Za-z0-9]/', '', $_POST['fname'])));
$last = strtoupper(trim(preg_replace('/[^ A-Za-z0-9]/', '', $_POST['lname'])));
//$first = strtoupper(mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fname']))));
//$last = strtoupper(mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lname']))));
$l_dob = preg_replace('/[^0-9]/', '', $_POST['dob']);
$gen = $_POST['gender'];
$l_email = $_POST['email'];
$l_mob = preg_replace('/[^0-9+-]/', '', $_POST['mob']);
$pref = $_POST['new_pref'];
$stu_id = substr($first,0,2).substr($last,0,2).strval($l_dob).($gen);

// Check to make sure both fields are entered
if ($first == '' || $last == '' || $l_dob == '' || $gen == '' || $pref == '')
{
// Generate error message
$error = 'Please Fill In All the Mandatory/Correct Fields!';

// If either field is blank, display the form again
renderForm($first, $last, $l_dob, $gen, $pref, $error);
}

else
{
// Save the data to the database
$sql = "INSERT INTO students (STU_ID,FIRST_NAME,LAST_NAME,DOB,GENDER,EMAIL,MOBILE) VALUES ('$stu_id','$first','$last','$l_dob','$gen','$l_email','$l_mob');
INSERT INTO stu_item (STU_ID,ITEM_NAME) VALUES ('$stu_id','$pref');";

//$res = $conn->multi_query($sql);
// Print Response from MySQL
if ($conn->multi_query($sql) === TRUE)
    {
	//$last_id = $conn->insert_id;
	echo "<script>
    alert('Records Added Successfully to the Tables!!!');
    window.location.href='index.php';
    </script>";
	}
else {
	die ("Error: {$conn->errno} : {$conn->error}");
	}

//$conn->close();;
}
CloseCon($conn);
}

else
// If the form hasn't been submitted, display the form
{
renderForm('','','','','','');
}

//CloseCon($conn);
?>
	

</body>
</html>
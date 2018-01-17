<?php
session_start();

if (!isset($_SESSION['loggedin']))
{
	$_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
	header('location:admin.php');
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Edit Record</title>
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
	
	<center><h1>Update Record!</h1></center>
	
</head>
<body>


<section id="abouts" class="abouts sections">
      <center><p><h4><u><a href="my_search.php">Back to Search</a></u></h4></p></center>
          <div class="container">
               
<?php
// Connect to the database
include('db_connect.php');
$conn = OpenCon();
// Check if the 'id' variable is set in URL, and check that it is valid
if (isset($_GET['edit']))
{
$id = $_GET['edit'];

// Get results from database
$sql = "SELECT A.STU_ID AS STU_ID,FIRST_NAME,LAST_NAME,DOB,GENDER,EMAIL,MOBILE,ITEM_NAME
FROM students A JOIN stu_item B ON A.STU_ID=B.STU_ID WHERE A.STU_ID = '$id'";

$result = $conn->query($sql);
?>
<table border='1' cellpadding='1'>
<tr> <th>Student Id</th> <th>First Name</th> <th>Last Name</th> <th>Date of Birth</th> <th>Gender</th> <th>E-Mail</th> <th>Mobile</th> 
<th>Preference</th> <th>Edit</th> </tr>

<?php
// Display results of database query in a table
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
}
//mysqli_free_result($result);
if (isset($_POST['submit']))
{
$same_id = $_POST['same_id'];
$new_email = $_POST['new_email'];
$new_mob = preg_replace('/[^0-9+-]/', '', $_POST['new_mob']);
$new_pref = $_POST['new_pref'];
$nsql = "UPDATE students SET EMAIL = '$new_email', MOBILE = '$new_mob' WHERE STU_ID = '$same_id';
UPDATE stu_item SET ITEM_NAME = '$new_pref' WHERE STU_ID = '$same_id'";

// Print Response from MySQL
if ($conn->multi_query($nsql) === TRUE)
    {
	echo "<script>
    alert('Records Got Updated into the Tables Successfully!!!');
    window.location.href='my_search.php';
    </script>";
	}
else {
	die ("Error: {$conn->errno} : {$conn->error}");
	}
}
CloseCon($conn);
?>

<form action=update.php method=post>
<tr>
 <td> <input type = "text" name = "same_id" value = "<?php echo $row['STU_ID']; ?>" readonly> </td>           
 <td> <?php echo $row['FIRST_NAME']; ?></td>
 <td> <?php echo $row['LAST_NAME']; ?></td>
 <td> <?php echo $row['DOB']; ?></td>
 <td> <?php echo $row['GENDER']; ?></td>
 <td> <input type = "text" maxlength = "40" name =  "new_email" value = "<?php echo $row['EMAIL']; ?>"> </td>
 <td> <input type = "text" maxlength = "20" name = "new_mob" value = "<?php echo $row['MOBILE']; ?>"> </td>
 <td> <input type = "text" maxlength = "20" name = "new_pref" value = "<?php echo $row['ITEM_NAME']; ?>"> </td>
 <td> <input type="submit" name="submit" value="Update"></td>
</tr>
</form>
</table>

</div>
</section>
</body>
</html>
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
	<title>Lookup Directory</title>
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
	
	<center><h1>Search Directory!</h1></center>
	
</head>
<body>


<section id="abouts" class="abouts sections">
	
	<div class="container">
				
    <p><b>Search By First Name or Last Name:</b></p>
    <form action="my_search.php" method="post">
      <input type="text" name="name">
      <input type="submit" maxlength = "30" name="submit" value="Search/Reset">&nbsp&nbsp&nbsp&nbsp<a href="outsession.php">Signout/Back to Admin Page!</a>
    </form>

<?php
if(isset($_POST['submit'])){
if(preg_match("/^[a-zA-Z]+/", $_POST['name'])){
  $name=$_POST['name'];
// Connect to the database
include('db_connect.php');
$conn = OpenCon();

//-Query  the database table
$sql="SELECT A.STU_ID AS STU_ID,FIRST_NAME,LAST_NAME,DOB,GENDER,EMAIL,MOBILE,ITEM_NAME
FROM students A JOIN stu_item B ON A.STU_ID=B.STU_ID
WHERE FIRST_NAME LIKE '$name%' OR LAST_NAME LIKE '$name%';";

//-Run  the query against the mysql query function
$result = $conn->query($sql);
?>
<table border='1' cellpadding='1'>
<tr> <th>Student Id</th> <th>First Name</th> <th>Last Name</th> <th>Date of Birth</th> <th>Gender</th> <th>E-Mail</th> <th>Mobile</th> 
<th>Preference</th> <th>Edit</th> <th>Remove</th> </tr>
<?php
// Loop through results of database query, displaying them in the table
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
$id = $row['STU_ID'];
$fname = $row['FIRST_NAME'];
$lname = $row['LAST_NAME'];
$dob = $row['DOB'];
$gen = $row['GENDER'];
$email = $row['EMAIL'];
$mob = $row['MOBILE'];
$item = $row['ITEM_NAME'];
?>

 <tr>
 <td> <?php echo $id; ?></td>           
 <td> <?php echo $fname; ?></td>
 <td> <?php echo $lname; ?></td>
 <td> <?php echo $dob; ?></td>
 <td> <?php echo $gen; ?></td>
 <td> <?php echo $email; ?></td>
 <td> <?php echo $mob; ?></td>
 <td> <?php echo $item; ?></td>
 <td><a href="update.php?edit=<?php echo $id; ?>" >Update</a></td>
 <td><a href="remove.php?delete=<?php echo $id; ?>" onclick="return confirm('Are You Sure?');">Delete</a></td>
 </tr>

<?php
}
mysqli_free_result($result);
CloseCon($conn);
  }
  else
  {
  echo  "<p>Please Enter a New Search Query!</p>";
  }
  }
?>
</table>
	
</div>
	
</section>

</body>
</html>
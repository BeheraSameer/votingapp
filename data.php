<?php
//Setting header to json
header('Content-Type: application/json');

// Connect to the database
include('db_connect.php');
$conn = OpenCon();

//-Query  the database table
$sql = sprintf("SELECT ITEM_NAME, COUNT(STU_ID) AS VOTES FROM stu_item GROUP BY ITEM_NAME ORDER BY VOTES DESC, ITEM_NAME ASC");

//-Run  the query against the mysql query function
$result = $conn->query($sql);

// Loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

// Free Result
mysqli_free_result($result);
// Close database connection
CloseCon($conn);

// Now Print the Data
print json_encode($data);
?>
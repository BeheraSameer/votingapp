<?php

function OpenCon()
 {

 $dbhost = "localhost";
 $dbuser = "id4316346_votingapp";
 $dbpass = "db_admin";
 $db = "id4316346_my_db";
 
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connection Failed: %s\n". $conn -> error);
 
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>
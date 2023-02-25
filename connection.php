<?php
	
	
	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "timbangan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO bm_scaling (no,nopol,truck,art,gross,tara,netto)  VALUES('2','9000','2','2','9000','200','50')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
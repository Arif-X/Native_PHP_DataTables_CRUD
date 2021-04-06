<?php
include "../connection.php"; 

$nis = $_GET['nis'];

$result = mysqli_query($connect, "SELECT * FROM siswa WHERE nis='$nis'");

$rows = array();
while($row = mysqli_fetch_assoc($result)) {
	$rows[] = $row;
}

// header('Content-Type: application/json');
echo json_encode($rows); 

?>
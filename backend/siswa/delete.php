<?php
include "../connection.php"; 

$nis = $_POST['nis'];

$result = mysqli_query($connect, "DELETE FROM siswa WHERE nis='$nis'");

header('Content-Type: application/json');
echo json_encode($result); 

?>
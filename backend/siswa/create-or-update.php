<?php
include "../connection.php"; 

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$telp = $_POST['telp'];
$jenisKelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];

$check = mysqli_query($connect, "SELECT * FROM siswa WHERE nis='$nis'");

if($check->num_rows == 0){
	$result = mysqli_query($connect, "INSERT INTO `siswa`(`nis`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES ('$nis', '$nama', '$jenisKelamin', '$telp', '$alamat')");
	header('Content-Type: application/json');
	echo json_encode($result); 
} else {
	$result = mysqli_query($connect, "UPDATE siswa SET nama='$nama', telp='$telp', jenis_kelamin='$jenisKelamin', alamat='$alamat' WHERE nis = $nis");
	header('Content-Type: application/json');
	echo json_encode($result); 
}
?>
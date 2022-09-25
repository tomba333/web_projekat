<?php
include 'dbo-conn.php';

$conn = OpenCon();
 
$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$datum = $_POST['datum'];
$email = $_POST['email'];
$br_gostiju = $_POST['br_gostiju'];
$stol =isset($_POST['stol'])?$_POST['stol']:'not yet';
$vrijeme = $_POST['vrijeme'];
 $sql = "INSERT INTO rezervacija (ime,prezime,datum,email,broj_gostiju,stol,vrijeme)
VALUES ('$ime','$prezime','$datum','$email','$br_gostiju','$stol','$vrijeme')";

if (mysqli_query($conn, $sql)) {
    header('Location: ./index.php');
} else {
    echo "Error: " . $sql . ":-" . mysqli_error($conn);
}
exit();


CloseCon($conn);




?>
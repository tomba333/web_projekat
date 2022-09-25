<?php
include 'dbo-conn.php';

$conn = OpenCon();
 

$datum = $_GET['q'];
$stol =isset($_GET['p'])?$_GET['p']:'not yet';



$sql = "SELECT CONCAT(HOUR(vrijeme),".'":00"'.") as vrijeme from rezervacija where stol= '".$stol."' and date(datum) = '".$datum."'";
$query = mysqli_query($conn,$sql);
$rows = array();
if(mysqli_num_rows($query)<1){
        exit();
}else{
    while($row= mysqli_fetch_array($query)){
        $rows[] =$row['vrijeme'];
        $rows[] =date('H:i',strtotime($row['vrijeme']."+1 hour 59 minute"));
        
    }
    echo json_encode($rows);
}



CloseCon($conn);




?>
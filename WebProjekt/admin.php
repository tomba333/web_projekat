<style>
table {
  width: 60%;
  border-collapse: collapse;
}
th{
    border: none;
}
td {
  border-top: 1px solid black;
  border-bottom: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
<?php
include 'dbo-conn.php';
$conn = OpenCon();
$sifra =intval($_GET['q']);
    if(intval($_GET['p'])==1 && $sifra != null){
        $sifra =intval($_GET['q']);
        $sql = "Select ime,prezime from admin where sifra = '".$sifra."'";
        $query = mysqli_query($conn,$sql);
        $rows = mysqli_fetch_array($query);
        $sql2 = "SELECT * from rezervacija";
        $query2 = mysqli_query($conn,$sql2);
        echo "<table>"; 
        echo "<th>".$rows['ime'] ." ". $rows['prezime']."</th>";
        while($row = mysqli_fetch_array($query2)){ 
        echo "<tr><td>" . htmlspecialchars($row['ime']) . "</td><td>" . htmlspecialchars($row['prezime']) . "</td><td>". htmlspecialchars($row['datum']) . "</td><td>". htmlspecialchars($row['broj_gostiju']) . "</td><td>". htmlspecialchars($row['stol']) . "</td><td>".htmlspecialchars($row['vrijeme'])."</td></tr>";    

        }

        echo "</table>";
   }
$conn->close();
?>
<?php
include 'dbo-conn.php';

$conn = OpenCon();


CloseCon($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Admin locale_get_display_variant</title>
</head>
<body>
    <div class="form-login">
    <form method="GET" action="admin.php" >
        <input type="text" id="sifra" placeholder="sifra konobara" >
    </form>
    <button type="submit" id="submit">Submit</button>
    </div>
    <div id="table">
    </div>
</body>
</html>
<script>
$('#submit').click(function(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table").innerHTML = this.responseText;
        }
        };
        xmlhttp.open("get","admin.php?q="+$('#sifra').val()+"&p=1",true);
        xmlhttp.send();
                              
});
</script>
<?php
//chmod 0777 html - when can't create file

/*$servername = "localhost";//$username = "root";//$password = "line";$username = "test";$password = "lol";$db="quickmafs";$getQuery="select counter from api;";//$postQuery="insert into api(counter) values (1);";//$result = $conn->query($postQuery);$result = mysqli_query($conn,"SELECT * FROM api");//$conn->query($getQuery);echo ("$result");//echo "Connected successfully";*/
if(!file_exists("api.txt")){fopen("api.txt","w+") or die("Unable to load!");}
$txt_rw=fopen("api.txt","a+") or die("Unable to load!");
$data = explode(" ", fgets($txt_rw));
$api=$data[0];
$api++;
$handle = fopen ("api.txt", "w+");
fclose($handle);
fwrite($txt_rw, $api);
header("Content-Type: application/json");
echo("{\"api\":$api}");
fclose($txt_rw);
?>
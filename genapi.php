<?php
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

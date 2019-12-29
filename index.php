<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<body style="background: #000">
<center style="padding: 10%;"><h1 style="color: #22ffff;">HEY, STRANGER!</h1>
<p style="color: white">You may have to login ;)</p><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<input type="password" name="text">
<input type="submit" style="color: white" value="HEY"></input></center>
</form><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>
<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>
</body>
<?php $a = $_POST['text']; $url = "client.php";if(isset($a)&&!empty($a)){if(md5($a)=="399b3fa0ae2b171789eaa5502227fbea"){echo "string";ob_start();header('Location: '.$url);ob_end_flush();}else{echo('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/><body style="background: #fff"><center style="padding: 10%;"><h1 style="color: red;">DO YOU REALLY THINK THAT YOU CAN F§&% WITH ME?!</h1><p><bold>Check out the sc. I have a gift for you!</bold></p><p style="color: white">Well... here you are again. How about if I just send your IP to the police ;)</p><br></center></form><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><script>window.scrollTo(0, 50000);</script></body>');}} ?>
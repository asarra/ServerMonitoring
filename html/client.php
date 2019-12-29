<title>Server Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<body><style>body{background: #22ffff}p,h1{font-family: Calibri}#child{width:50%;height:50%;border-radius: 2.5px;}#jsup{background: #5aff22;border-radius:25px;}#jsdown{background: #ff2222;border-radius:25px;}#jserr{background: white;color:red;border-radius:25px;}</style>
<script>
green='<center><h1 id="jsup">Quick Status: All systems are up</h1></center>';red='<center><h1 id="jsdown">Quick Status: All systems are down</h1></center>';errr='<center><h1 id="jserr">Quick Status: An unknown error has occured</h1></center>';
host = "192.168.178.2";port = ":22";
//location.href = 'http://WLAN-Luebbecke.hotspot.mk/status';

function well(){
	if (window.XMLHttpRequest){xhr = new XMLHttpRequest();}else{xhr = new ActiveXObject("Microsoft.XMLHTTP");}
//	xhr.open("GET", "https://ipinfo.io/json");//works
//	xhr.open("GET",host+port);
	xhr.open("GET", "server.php");
	xhr.onreadystatechange=function(e){		
		if (xhr.readyState==4 && xhr.status==200){
			document.getElementById("quickstat").innerHTML="Server status: OK!";
			}
		else if (!xhr.status||xhr.readyState!=4){
			document.getElementById("quickstat").innerHTML="Server status: NO CONN!";
		}
		else{
			document.getElementById("quickstat").innerHTML="Server status: UNKOWN!";
		}
		console.log(e);
		/*alert(xhr.readyState);
		alert(xhr.status);*/
		}
	xhr.send();}
//well();
setInterval(well,5000);
</script>
<damn style="display: flex;flex-wrap: wrap;width:auto;height:97.5vh;">
<topleft id="child" style="background:#f50;color:white;order: 0;"><center><h1>Manage Servers</h1><br><p>Switch to Server 1/2/3</p></center></topleft>
<topright id="child" style="background:yellow;order: 1;"><center><h1 id="quickstat">Server status</h1><br><p>CPU Usage: %</p><p>Free RAM:</p><p>Load Average:</p><p>Network: kb/s</p><p>Disk Usage: %</p></center></topright>
<bottomright id="child" style="background:#5a1122;color:white;order: 2;"><center><h1>Note</h1><br><p>Login needs to be added via php</p></center></bottomright>
<bottomleft id="child" style="background:#22aaaa;color:white;order: 3;"><center><h1>Billing system</h1><br><p>$5 per year</p></center></bottomleft></damn></body>
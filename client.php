<?php
if($_SERVER['HTTP_REFERER']=="http://uiklo2.hopto.org/index.php"){
//'"``"'
$content = <<<EOT
<title>Server Management</title><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/><body><style>body{background: #22ffff}p,h1,h3{font-family: Calibri}#child{width:50%;height:50%;border-radius: 2.5px;}#jsup{background: #5aff22;border-radius:25px;}#jsdown{background: #ff2222;border-radius:25px;}#jserr{background: white;color:red;border-radius:25px;}</style>
<damn style="display: flex;flex-wrap: wrap;width:auto;height:97.5vh;">

<topleft id="child" style="background:#f50;color:white;order: 0;"><center><h1>Manage Servers</h1>
<p>Switch to Server - subdomain:os</p>
<manage style="background:orange;display: flex;flex-wrap: wrap;width:90%;height:25vh;border-radius: 2.5px;">
<server style="order: 0;width:33%;height:99%;border-radius: 2.5px;border-style: solid;border-width: 1px; border-color: rgb(160,160,255);"><a href="/" style="text-decoration: none;color:white;"><fill style="width:33%;height:99%;"><h3 style="padding:10%;">uiklo2:raspbian</h3></fill></a></server>
<server style="order: 1;width:33%;height:99%;border-radius: 2.5px;border-style: solid;border-width: 1px; border-color: rgb(160,160,255);"><a href="/" style="text-decoration: none;color:white;"><fill style="width:33%;height:99%;"><h3 style="padding:10%;">test:test</h3></fill></a></server>
<server style="order: 2;width:33%;height:99%;border-radius: 2.5px;border-style: solid;border-width: 1px; border-color: rgb(160,160,255);"><a href="/" style="text-decoration: none;color:white;"><fill style="width:auto;height:100%;"><h3 style="padding:10%;">test:test</h3></fill></a></server>
</manage></center></topleft>
<topright id="child" style="background:yellow;order: 1;"><center><h1 id="quickstat">Server status</h1><br><p id="cpu"></p><p id="mem_percent"></p><p id="loadfirstmin"></p><p id="net"></p><p id="hdd_percent"></p></center></topright><bottomright id="child" style="background:#5a1122;color:white;order: 2;"><center><h1>Terminal</h1>

<box style="background:black;display: flex;flex-wrap: wrap;width:90%;height:25vh;border-radius: 2.5px;">
<output id="outputt" style="order: 0;width:100%;height:100%;text-align:left;text-align:bottom;word-wrap: break-word;overflow:auto;">www-data@sys:~$ </output>

<input id="inputt" name="input" style="order: 0;width:80%;height:20%;border-radius: 0px 0px 0px 2.5px;"></input>
<button id="submit" type="submit" style="order: 1;width:20%;height:20%;border-radius: 0px 0px 2.5px 0px;" value="SEND"></button>
</box>
</center></bottomright><bottomleft id="child" style="background:#22aaaa;color:white;order: 3;"><center><h1>Disconnect</h1></center><a href="/"><click style="width:25%;height:25vh;position:absolute;margin-left:12.5%;background:blue;opacity:0.2;"><center><h1 style="color:white">^_^</center></h1></click></a></bottomleft></damn>

<script>


if (screen.width <= 699){
 //document.location = mobile.php;
//alert("OOPS");
document.getElementsByTagName("topleft")[0].style.display="none";
document.getElementsByTagName("bottomleft")[0].style.display="none";
var serverstats=document.getElementsByTagName("topright")[0];
serverstats.style.width="100%";
serverstats.getElementsByTagName("br")[0].style.display="none";
var terminal=document.getElementsByTagName("bottomright")[0];
terminal.style.width="100%";
}


localStorage.setItem('rxtx_prev', JSON.stringify(0));
function wella(){if (window.XMLHttpRequest){xhrr = new XMLHttpRequest();}else{xhrr = new ActiveXObject("Microsoft.XMLHTTP");}xhrr.open("GET", "genapi.php",false);xhrr.onreadystatechange=function(e){if (xhrr.readyState==4 && xhrr.status==200){localStorage.setItem('apikey', JSON.stringify(JSON.parse(xhrr.responseText).api));console.log(e);}}
	xhrr.send();}
wella();
function well(){
	if (window.XMLHttpRequest){xhr = new XMLHttpRequest();}else{xhr = new ActiveXObject("Microsoft.XMLHTTP");}
	var apikey=localStorage.getItem('apikey');
	//alert(apikey);
	xhr.open("GET", `server.php?api=\${apikey}`);
	xhr.onreadystatechange=function(e){		
		if (xhr.readyState==4 && xhr.status==200){
			//alert(xhr.responseText);
			document.getElementById("quickstat").textContent="Server status: OK!";
			var jsonResponse = JSON.parse(xhr.responseText);
			var jsonResponse_old = JSON.parse(localStorage.getItem('rxtx_prev'));
			document.getElementById("cpu").textContent=`CPU Usage: \${jsonResponse.cpu}%`;
			document.getElementById("mem_percent").textContent=`RAM Usage: \${jsonResponse.mem_percent}%`;
			document.getElementById("hdd_percent").textContent=`Disk Usage: \${jsonResponse.hdd_percent}%`;
			//if(typeof down_prev === 'undefined'&&typeof up_prev === 'undefined') {}
			down=jsonResponse.network_rx;up=jsonResponse.network_tx;
			down_prev=jsonResponse_old.network_rx_prev;up_prev=jsonResponse_old.network_tx_prev;
			down_speed = down - down_prev;
			//down = Math.round(((down_speed*50000)/8));//up = Math.round(((up_speed*50000)/8));
			up_speed = up - up_prev;
			document.getElementById("net").textContent=`Network: \${down_speed}kbps/\${up_speed}kbps`;
			down_prev=jsonResponse.network_rx_prev;up_prev=jsonResponse.network_tx_prev;
			jsonResponse_old=jsonResponse;
			localStorage.setItem('rxtx_prev', JSON.stringify(jsonResponse_old));
			document.getElementById("loadfirstmin").textContent=`Load Average: \${jsonResponse.load_avg}`;
		}
		else if (!xhr.status||xhr.readyState!=4){document.getElementById("quickstat").textContent="Server status: NO CONN!";}
		else{document.getElementById("quickstat").textContent="Server status: UNKOWN!";}
		console.log(e);
		}
	xhr.send();}
setInterval(well,1000);







document.getElementById("submit").addEventListener("click", myFunction);

function myFunction(){
	var abc = document.getElementById("inputt").value;
	console.log(abc);//.textContent);
	localStorage.setItem('input', abc);
	document.getElementById("inputt").value="";

	var apikey=localStorage.getItem('apikey');
	//alert(apikey);
if (window.XMLHttpRequest){	xhrr = new XMLHttpRequest();}else{xhrr = new ActiveXObject("Microsoft.XMLHTTP");}
var input=localStorage.getItem('input');
//alert(input);
xhrr.open("POST", `output.php?api=\${apikey}`);
xhrr.setRequestHeader("Content-type","application/x-www-form-urlencoded"); //THIS IS VERY IMPORTANT
xhrr.send(`input=\${input}`);
xhrr.onreadystatechange=function(e){
	if (xhrr.readyState==4 && xhrr.status==200){
		//alert(xhrr.responseText);
		var output = xhrr.responseText;
		localStorage.setItem('output',output);
		var txt = `www-data@sys:~$ \${input}>\${output}`;
		document.getElementById("outputt").textContent=txt;
		console.log(e);}
		console.warn(xhrr.statusText, xhrr.responseText);
	}





}
</script>



</body>
EOT;
echo("$content");
}

else{
//echo $_SERVER['o_shied'];
echo "U in dah wrong plazz boii";
}

?>
import requests,json
r=json.loads(requests.get("http://uiklo2.hopto.org/server.php",{"o_shied":"ok"}).text)
for x in r:
	print "%s: %s" % (x,r[x])
<?php 
header('X-Accel-Buffering/: no');
ob_implicit_flush();
ob_end_flush();

$ip=$_GET['ip'];
$dnsbl_lookup=array(
"b.barracudacentral.org",
"bl.deadbeef.com",
"bl.spamcop.net",
"blacklist.woody.ch",
"cbl.abuseeat.org",
"combined.rbl.msrbl.net",
"db.wpbl.info",
"dnbl.cyberlogic.net",
"dnsbl.njabl.org",
"dnsbl.sorbs.net",
"dnsbl-3.uceprotect.net",
"drone.abuse.ch",
"http.dnsbl.sorbs.net",
"httpbl.abuse.ch",
"images.rbl.msrbl.net",
"ips.backscatterer.org",
"nomail.rhsbl.sorbs.net",
"pbl.spamhaus.org",
"phishing.rbl.msrbl.net",
"sbl.spamhaus.org",
"smtp.dnsbl.sorbs.net",
"socks.dnsbl.sorbs.net",
"spam.dnsbl.sorbs.net",
"spam.rbl.msrbl.net",
"spam.spamrats.com",
"ubl.unsubscore.com",
"virus.rbl.msrbl.net",
"web.dnsbl.sorbs.net",
"xbl.spamhaus.org",
"zen.spamhaus.org",
"zombie.dnsbl.sorbs.net"
);

?>
<html>
<head>
<title>DNSBL Check</title>
<style type="text/css">
a {
	color: #089fce;
	text-decoration: none;
	font-weight: bold;
}
</style>
</head>
<body>
<table>
<tr><td><a href="whois.php">Domain/IP Whois</a> || </td><td><a href="reverse.php">Reverse DNS</a> || </td><td><a href="dns.php">DNS Record Lookup</a> || </td><td><a href="blacklist.php"><b>IP Blacklist Search</b></a> || </td><td><a href="http://wvnet.work">URL Shortener(Requires Login)</a></td></tr>
</table>
<form action="" method="get">
<b><label for="ip">IP Address:</label></b>
<input type="text" value="<?=$ip?>" name="ip" />
<input type="submit" value="LOOKUP" />
</form>
<?php
if(filter_var($ip,FILTER_VALIDATE_IP)){ 
	$reverse_ip=implode(".",array_reverse(explode(".",$ip)));
}else{
	echo "Please enter a valid IP";
	die();
}
foreach($dnsbl_lookup as $host){
	$checker = checkdnsrr($reverse_ip.".".$host.".","A");
	if ($checker) {
		$listed.=$ip.' on '.$host.' - <font color="red"><b>Listed</b></font><br />';
	}else{
		$listed.=$ip.' on '.$host.' - <font color="black">Not Listed</font><br />';
	}
	echo $listed;
	$listed="";
	sleep(0.2);
}
echo "Done";


?> 
</body>
</html>

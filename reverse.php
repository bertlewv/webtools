<html>
<head>
<title>Reverse IP Lookup</title>
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
<tr><td><a href="who.php">Domain Whois</a> || </td><td><a href="ipwhois.php"><b>IP Whois</b></a> || </td><td><a href="reverse.php"><b>Reverse DNS</b></a> || </td><td><a href="dns.php">DNS Record Lookup</a> || </td><td><a href="blacklist.php">IP Blacklist Search</a> || </td><td><a href="http://wvnet.work">URL Shortener(Requires Login)</a></td></tr>
</table>
<?php
$host = $_POST['host'];
if (!$host) {
        $host = $_GET['host'];
}
if (!$host) {
	$msg = "Please enter an IP Address";
}else{
	if (filter_var($host, FILTER_VALIDATE_IP)) {
		$rawr = gethostbyaddr($host);
		$msg = "rDNS name: <b>".$rawr."</b>";
	}else{
		$msg = "Value entered is not a valid IP address.";
	}
}
?>
<form action="" method="post">
<b><label for="host">IP Address:</label></b> <input type="text" name="host" id="host" value="<?=$host;?>"> <input type="submit" value="Lookup">
</form>
<?=$msg;?>
</body>
</html>

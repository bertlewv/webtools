<html>
<head>
<title>DNS Record Lookup</title>
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
<tr><td><a href="whois.php">Domain/IP Whois</a> || </td><td><a href="reverse.php">Reverse DNS</a> || </td><td><a href="dns.php"><b>DNS Record Lookup</b></a> || </td><td><a href="blacklist.php">IP Blacklist Search</a> || </td><td><a href="http://wvnet.work">URL Shortener(Requires Login)</a></td></tr>
</table>

<?php
$host = $_POST['host'];
if (!$host) {
        $host = $_GET['host'];
}
?>
<form action="/dns.php" method="post">
<b><label for="host">Domain:</label></b> <input type="text" name="host" id="host" value="<?=$host;?>"> <input type="submit" value="Lookup">
</form>

<?php
if (!$host) {
	end;
} else {
	$result = dns_get_record($host);
	$command = "host -a $host";
	$results = shell_exec("$command 2>&1");
	$output = "<pre>";
	$output .= nl2br(htmlentities(trim($results)));
	$output .= '</pre>';
	echo $output;
}
?>
</body>
</html>

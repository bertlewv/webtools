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
$dig_class = "ANY";
$dig_server = "8.8.8.8";
$dig_class_array = Array('ANY',  'A',  'IN',  'MX',  'NS',  'SOA',  'HINFO',  'AXFR',  'IXFR');
if(filter_var($dig_server, FILTER_VALIDATE_IP) !== false){
    $command = "dig -t $dig_class $host";
    if ($dig_server) { $command .= ' @' . $dig_server; }
    // Send the dig command to the system
    //   Normally,  the shell_exec function does not report STDERR messages.  The "2>&1" option tells the system
    //   to pipe STDERR to STDOUT so if there is an error,  we can see it.
    $results = shell_exec("$command 2>&1");
    // Save the results as a variable and send to the parse_output() function
    $output = "Results for $dig_class: <pre>";
    $output .= nl2br(htmlentities(trim($results)));
    $output .= '</pre>';
    echo($output);
} else {
    echo "Dig Error: <blockquote>";
    echo 'Invalid Dig Server field.';
    echo '</blockquote>';
}
}
?>
</body>
</html>

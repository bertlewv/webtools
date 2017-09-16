<?php
$domain = $_POST['domain'];
if (!$domain) {
        $domain = $_GET['domain'];
}
// http://www.iana.org/domains/root/db/
function find_whois_server($ext)
{
$WHOIS_SERVERS = array(
"com"  =>  "whois.crsnic.net",
"net"  =>  "whois.crsnic.net",
"org"  =>  "whois.pir.org",
"edu"  =>  "whois.crsnic.net",
"biz"  =>  "whois.neulevel.biz",
"info" =>  "whois.afilias.info",
"us"   =>  "whois.nic.us",
"uk"   =>  "whois.nic.uk",
"ca"   =>  "whois.cira.ca",
"de"   =>  "whois.nic.de",
"ws"   =>  "whois.nic.ws",
"au"   =>  "whois.ausregistry.net.au",
"nu"   =>  "whois.nic.nu",
"in"   =>  "whois.registry.in",
"tel"  =>  "whois.nic.tel",
"ie"   =>  "whois.iedr.ie",
"tw"   =>  "whois.twnic.net.tw", 
"tv"   =>  "whois.nic.tv", 
"ch"   =>  "whois.nic.ch", 
"eu"   =>  "whois.eu", 
"it"   =>  "whois.nic.it", 
"cn"   =>  "whois.cnnic.net.cn", 
"mobi" =>  "whois.dotmobiregistry.net", 
"cc"   =>  "whois.nic.cc",
"asia" =>  "whois.nic.asia",
"pro"  =>  "whois.registrypro.pro",
"hk"   =>  "whois.hknic.net.hk",
"me"   =>  "whois.meregistry.net",
"be"   =>  "whois.dns.be",
"se"   =>  "whois.nic.se",
"ca"   =>  "whois.cira.ca", 
"nz"   =>  "whois.domainz.net.nz", 
"nl"   =>  "whois.sidn.nl",
'ventures' => 'whois.donuts.co',
'singles' => 'whois.donuts.co',
'bike' => 'whois.donuts.co',
'holdings' => 'whois.donuts.co',
'plumbing' => 'whois.donuts.co',
'guru' => 'whois.donuts.co',
'clothing' => 'whois.donuts.co',
'camera' => 'whois.donuts.co',
'equipment' => 'whois.donuts.co',
'estate' => 'whois.donuts.co',
'gallery' => 'whois.donuts.co',
'graphics' => 'whois.donuts.co',
'lighting' => 'whois.donuts.co',
'photography' => 'whois.donuts.co',
'contractors' => 'whois.donuts.co',
'land' => 'whois.donuts.co',
'technology' => 'whois.donuts.co',
'construction' => 'whois.donuts.co',
'directory' => 'whois.donuts.co',
'kitchen' => 'whois.donuts.co',
'today' => 'whois.donuts.co',
'diamonds' => 'whois.donuts.co',
'enterprises' => 'whois.donuts.co',
'tips' => 'whois.donuts.co',
'voyage' => 'whois.donuts.co',
'shoes' => 'whois.donuts.co',
'careers' => 'whois.donuts.co',
'photos' => 'whois.donuts.co',
'recipes' => 'whois.donuts.co',
'limo' => 'whois.donuts.co',
'domains' => 'whois.donuts.co',
'cab' => 'whois.donuts.co',
'company' => 'whois.donuts.co',
'computer' => 'whois.donuts.co',
'center' => 'whois.donuts.co',
'systems' => 'whois.donuts.co',
'academy' => 'whois.donuts.co',
'management' => 'whois.donuts.co',
'training' => 'whois.donuts.co',
'solutions' => 'whois.donuts.co',
'support' => 'whois.donuts.co',
'builders' => 'whois.donuts.co',
'email' => 'whois.donuts.co',
'education' => 'whois.donuts.co',
'institute' => 'whois.donuts.co',
'repair' => 'whois.donuts.co',
'camp' => 'whois.donuts.co',
'glass' => 'whois.donuts.co',
'solar' => 'whois.donuts.co',
'coffee' => 'whois.donuts.co',
'international' => 'whois.donuts.co',
'house' => 'whois.donuts.co',
'florist' => 'whois.donuts.co',
'holiday' => 'whois.donuts.co',
'marketing' => 'whois.donuts.co',
'viajes' => 'whois.donuts.co',
'farm' => 'whois.donuts.co',
'codes' => 'whois.donuts.co',
'cheap' => 'whois.donuts.co',
'zone' => 'whois.donuts.co',
'agency' => 'whois.donuts.co',
'bargains' => 'whois.donuts.co',
'boutique' => 'whois.donuts.co',
'tienda' => 'whois.donuts.co',
'watch' => 'whois.donuts.co',
'work' => 'whois.nic.work',
'works' => 'whois.donuts.co',
'cool' => 'whois.donuts.co',
'expert' => 'whois.donuts.co',
'menu' => 'whois.nic.menu',
'club' => 'whois.nic.club',
'photo' => 'whois.uniregistry.net',
'gift' => 'whois.uniregistry.net',
'guitars' => 'whois.uniregistry.net',
'pics' => 'whois.uniregistry.net',
'link' => 'whois.uniregistry.net',
'sexy' => 'whois.uniregistry.net',
'tattoo' => 'whois.uniregistry.net',
'reviews' => 'whois.unitedtld.com',
'ms' => 'whois.nic.ms',
'uno' => 'whois.nic.uno',
'buzz' => 'whois.nic.buzz',
'berlin' => 'whois.nic.berlin'
);
	$ext = strtolower($ext);
	if(array_key_exists($ext, $WHOIS_SERVERS))
		return $WHOIS_SERVERS[$ext];
	else return "";
}

/////////////////////////////////////////////////////////////////////
function do_whois($domainname, $server, $port=43)
{
	$output = "Unable to connect to " . $server;
	if(($ns = fsockopen($server,$port)) == true)
	{
		$output = "";
		fputs($ns,"$domainname\r\n");
		while(!feof($ns)) 
			$output .= fgets($ns,128); 
		fclose($ns);
	}
	return $output . "\r\n";
}

/////////////////////////////////////////////////////////////////////

function get_registrar_server($string)
{
	$lookfor = array("Registrar WHOIS Server:", "Whois Server:");
	foreach($lookfor as $fstr)
	{
		if(strstr($string, $fstr))
		{
			$string = str_ireplace($fstr, "", $string);
			return trim($string);
		}
	}
	return false;
}

/////////////////////////////////////////////////////////////////////
function domain_whois($domainname, $port=43)
{
	$domainname = trim($domainname);
	$domparts = explode(".", $domainname);
	$count = count($domparts);
	if(!$count)
		return "Invalid domain name";
	$server = find_whois_server($domparts[$count-1]);
	if($server == "")
		return "Don't know the whois server for domain " . $domainname;	
	$lookupname = $domainname;
	if(preg_match("/.(com|.net|.edu)$/i", $domainname))
		$lookupname = "domain " . $domainname;
	$output = do_whois($lookupname, $server);	
	if(preg_match("/.(com|.net|.edu|.cc|.tv|.ws)$/i", $domainname))
	{
		$pieces = explode("\n", $output);
		$count = count($pieces);
		$c = 0;
		for($c = 0; $c < $count; $c++)
		{
			$line = $pieces[$c];
			$registrar_server = get_registrar_server($line);
			if($registrar_server !== false)
				$output = do_whois($domainname, $registrar_server);
		}
	}
	if(!strlen($output))
		$output = "There was error connecting to the whois server [" . $server . "]";
	return $output; 
}

?>
<html>
<head><title>Domain Whois</title>
<style = type="text/css">
a {
	color: #089fce;
    text-decoration: none;
    font-weight: bold;
}
</style>
</head>

<body>
<table>
<tr><td><a href="who.php"><b>Domain Whois</b></a> || </td><td><a href="ipwhois.php"><b>IP Whois</b></a> || </td><td><a href="reverse.php">Reverse DNS</a> || </td><td><a href="dns.php">DNS Record Lookup</a> || </td><td><a href="blacklist.php">IP Blacklist Search</a> || </td><td><a href="http://wvnet.work">URL Shortener(Requires Login)</a></td></tr>
</table>	
<form action="#" method="get">
<b><label for="domain">Domain Name:</label></b> <input type="text" name="domain" id="domain" value="<?=$domain;?>"> <input type="submit" value="Lookup">
</form>
<?php
/////////////////////////////////////////////////////////////////////
$domain = "";
$server = "";

if(isset($_GET["domain"]))
        $domain = strip_tags(stripslashes($_GET["domain"]));
if(isset($_GET["server"]))
        $server = strip_tags(stripslashes($_GET["server"]));

if($domain != "")
{
        if($server != "")
                echo "<pre>" . do_whois($domain, $server) . "</pre>";
        else
                echo "<pre>" . domain_whois($domain) . "</pre>";
}
else
        echo "Domain Name Not Specified.";
/////////////////////////////////////////////////////////////////////


?>
</body>
</html>



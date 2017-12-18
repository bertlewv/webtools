<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="refresh" content="61" />
        <title>NOCMonitor Container</title>
<style>
body {
        font-family: 'Open Sans', serif;
}
p {
        font-family: 'Open Sans', serif;
        padding: 0px;
        margin: 0px;
}
#alert {
        font-family: 'Open Sans', serif;
        font-weight: bold;
        font-size: 18px;
}
</style>
<body>
<?php
date_default_timezone_set('America/New_York');
//$page = $_GET['id'];
error_reporting(0);
$page = "MCOEM";

$current_time = time();
$hue = json_decode(file_get_contents("https://graph.facebook.com/".$page."/posts?access_token=1727418294201726|R0XZoK23OtRoOFcn44nRGrjIZAs&date_format=U&limit=1"), TRUE);
$array = $hue['data'];
if (empty($array)) {
        echo "No posts. Check back later.";
}else {
        foreach($array as $val) {
                $start_time = $val['created_time'];
                $timey = ($current_time - $start_time);
                echo $timey."<br>";
		if (($current_time - $start_time) < 43200) {
                        $message = $val['message'];
			$timey = ($current_time - $start_time);
			echo $timey;
                        //$start_time = DateTime::createFromFormat(DateTime::ISO8601, $start_time);
			$date = date("M d, y", $start_time);
			$time = date("h:i A", $start_time);
                        //$date = $start_time->format('M d, y');
                        //$time = $start_time->format('h:i A');
                        echo "<center><div><font color=#ff3300 size=5>".$date." - ".$time." - ".$message."</font></div></center>";
                }

        }
}
?>
</body>
</html>


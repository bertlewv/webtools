<html>
<head>
<title>NOCMonitor - Thor</title>
<link rel="stylesheet" type="text/css" href="style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="61" /> 
<script type="text/javascript">
var frames = Array('#', 30,
    'http://telcomm.wvnet.edu/cardlock/', 30);
var i = 0, len = frames.length;
function ChangeSrc()
{
  //if (i >= len) { i = 0; } // start over
  if (i >= len) 
	return;
  document.getElementById('frame').src = frames[i++];
  setTimeout('ChangeSrc()', (frames[i++]*1000));
}
window.onload = ChangeSrc;
</script>
</head>
 
<body>
<?php
date_default_timezone_set('America/New_York');
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
		//12 hours - 43200 6 hours - 21600 3 hours - 10800
                if (($current_time - $start_time) < 3600) {
                        $message = $val['message'];
                        $date = date("M d, y", $start_time);
                        $time = date("h:i A", $start_time);
						if (strlen($message) > 500) {
							$stringCut = substr($message, 0, 500);
							$message = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
						}
						echo "<center><div><font color=#ff3300 size=5>".$date." - ".$time." - ".$message."</font></div></center>";
                }

        }
}
?>
<iframe src="main.html" id="frame" name="frame" width="100%" height="720" style="border: 0px; padding: 0px; margin: 0px; background-color: #fff;"></iframe>
    </body>
</html>

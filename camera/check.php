<?php

$cam = $_GET['cam'];

if (!$cam) {
	$cam = "006";
	echo "Default Camera Displayed";
} else {
	echo $cam;
}
$prev = ($cam - 1);
if ($prev < 0) {
	$prev = 0;
}
$prev = sprintf('%03d',$prev);
$next = ($cam + 1);
$next = sprintf('%03d',$next);

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Camera Checker</title>
</head>
<body>
<!-- http://www.wv511.org/wv511/jwplayer/player.swf -->
<p><?$cam?></p>
<div class="blended_grid">
<p>
<div class="xpic">
<embed type='application/x-shockwave-flash' src='1.swf' flashvars='autostart=true&controlbar=none&bufferlength=0&streamer=rtmp://162.210.14.137:1935/rtplive&file=CAM<?=$cam;?>' allowscriptaccess='always' allowfullscreen='true' seamlesstabbing="true" wmode="opaque" bgcolor="#000000" height="360" width="360">
</div>
</p>
<p>
<a href='?cam=<?=$prev?>'>Previous</a> <a href='?cam=<?=$next?>'>Next</a>
</body>
</html>

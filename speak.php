<?php

$vName = $_GET['voice'];
$text = $_GET['msg'];

   $url = 'https://api.voiceforge.com/swift_engine?HTTP-X-API-KEY=9a272b4&voice=' . $vName . '&msg=' . urlencode($text) . '&email=undefined';
   
   $filename = md5($vName . $text . date("mdyhisA"));
   
   $wavname = "swift_engine(" . $filename . ").wav";
   
   $mp3name = $filename . ".mp3";
   
   file_put_contents($wavname,file_get_contents($url));
   $command = 'cd lame && lame.exe -q0 -b320 "../' . $wavname . '" "../' . $mp3name . '"';
   shell_exec($command);
   unlink($wavname);
   $file = $mp3name;
   playFile($file);
   unlink($mp3name);

function playFile($file){
	header('Content-Type: audio/mp3');
	readfile($file);
}
?>

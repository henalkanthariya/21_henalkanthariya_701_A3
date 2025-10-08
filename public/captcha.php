<?php
session_start();
$code = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'),0,5);
$_SESSION['captcha']=$code;
$img = imagecreatetruecolor(120,40);
$bg = imagecolorallocate($img, 240,240,240);
$txtc = imagecolorallocate($img, 20,20,20);
imagefilledrectangle($img,0,0,120,40,$bg);
imagestring($img,5,12,10,$code,$txtc);
header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);
?>
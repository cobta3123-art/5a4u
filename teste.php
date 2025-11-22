<?php
header("Content-Type: image/png");

$img = imagecreatetruecolor(600, 200);
$bg = imagecolorallocate($img, 30, 30, 30);
$text = imagecolorallocate($img, 255, 255, 255);

imagefill($img, 0, 0, $bg);
imagestring($img, 5, 10, 90, "TESTE GD", $text);

imagepng($img);
imagedestroy($img);

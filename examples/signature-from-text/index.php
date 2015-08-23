<?php

header('Content-type: image/png');

$img = imagecreatetruecolor(400, 30);

$bgColour = imagecolorallocate($img, 0xff, 0xff, 0xff);
$penColour = imagecolorallocate($img, 0x14, 0x53, 0x94);
imagefilledrectangle($img, 0, 0, 399, 29, $bgColour);

$text = 'Sir John A. Macdonald';
$font = 'journal.ttf';

imagettftext($img, 20, 0, 10, 20, $penColour, $font, $text);

imagepng($img);
imagedestroy($img);

<?php

require_once 'sig-json-to-image.php';

$options = array(
	'imageSize' => array(198, 55),
	'bgColour' => array(0xff, 0xff, 0xff),
	'penWidth' => 2,
	'penColour' => array(0x14, 0x53, 0x94)
);

$img = sigJsonToImage(file_get_contents('sig-output.json'), $options);

// Save to file
//imagepng($img, 'signature.png');

// Output to browser
header('Content-Type: image/png');
imagepng($img);

// Destroy the image in memory when complete
imagedestroy($img);

<?php
/**
 *	Signature to Image: A supplemental script for Signature Pad that
 *	  generates an image of the signature’s text representation server-side using PHP.
 *	
 *	@project	ca.thomasjbradley.applications.signaturetoimage
 *	@author		Thomas J Bradley <hey@thomasjbradley.ca>
 *	@link		http://thomasjbradley.ca/lab/signature-to-image
 *	@link		http://github.com/thomasjbradley/signature-to-image
 *	@copyright	Copyright MMXI–, Thomas J Bradley
 *	@license	New BSD License
 *	@version	1.0.1
 */

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

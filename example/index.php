<?php
/**
 *	Signature to Image: A supplemental script for Signature Pad that
 *	generates an image of the signature’s JSON output server-side using PHP.
 *	
 *	@project	ca.thomasjbradley.applications.signaturetoimage
 *	@author		Thomas J Bradley <hey@thomasjbradley.ca>
 *	@link		http://thomasjbradley.ca/lab/signature-to-image
 *	@link		http://github.com/thomasjbradley/signature-to-image
 *	@copyright	Copyright MMX–, Thomas J Bradley
 *	@license	New BSD License
 *	@version	1.0.0
 */

require_once '../signature-to-image.php';

$img = sigJsonToImage(file_get_contents('sig-output.json'));

// Save to file
//imagepng($img, 'signature.png');

// Output to browser
header('Content-Type: image/png');
imagepng($img);

// Destroy the image in memory when complete
imagedestroy($img);

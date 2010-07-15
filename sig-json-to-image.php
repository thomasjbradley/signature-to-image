<?php

/**
 *	Accepts a signature created by signature pad in Json format
 *	Converts it to an image resource
 *	The image resource can then be changed into png, jpg whatever PHP GD supports
 *
 *	To create a nicely anti-aliased graphic the signature is drawn 24 times it's original size then shrunken
 *
 *	@param	string|array	$json
 *	@param	array			$options	The options for image creation
 *										imageSize => array(width, height)
 *										bgColour => array(red, green, blue)
 *										penWidth => int
 *										penColour => array(red, green, blue)
 *
 *	@return	object
 */
function sigJsonToImage($json, $options)
{
	$drawMultiplier = 12;

	$img = imagecreatetruecolor($options['imageSize'][0] * $drawMultiplier, $options['imageSize'][1] * $drawMultiplier);
	$bg = imagecolorallocate($img, $options['bgColour'][0], $options['bgColour'][1], $options['bgColour'][2]);
	$pen = imagecolorallocate($img, $options['penColour'][0], $options['penColour'][1], $options['penColour'][2]);
	imagefill($img, 0, 0, $bg);

	if(is_string($json))
		$json = json_decode($json);

	foreach($json as $v)
		drawThickLine($img, $v->lx * $drawMultiplier, $v->ly * $drawMultiplier, $v->mx * $drawMultiplier, $v->my * $drawMultiplier, $pen, $options['penWidth'] * ($drawMultiplier / 2));

	$imgDest = imagecreatetruecolor($options['imageSize'][0], $options['imageSize'][1]);
	imagecopyresampled($imgDest, $img, 0, 0, 0, 0, $options['imageSize'][0], $options['imageSize'][0], $options['imageSize'][0] * $drawMultiplier, $options['imageSize'][0] * $drawMultiplier);

	imagedestroy($img);

	return $imgDest;
}

/**
 *	Draws a thick line
 *	Changing the thickness of a line using imagesetthickness doesn't produce as nice of result
 *
 *	@param	object	$img
 *	@param	int		$startX
 *	@param	int		$startY
 *	@param	int		$endX
 *	@param	int		$endY
 *	@param	object	$colour
 *	@param	int		$thickness
 *
 *	@return	void
 */
function drawThickLine($img, $startX, $startY, $endX, $endY, $colour, $thickness) 
{
	$angle = (atan2(($startY - $endY), ($endX - $startX))); 

	$dist_x = $thickness * (sin($angle));
	$dist_y = $thickness * (cos($angle));

	$p1x = ceil(($startX + $dist_x));
	$p1y = ceil(($startY + $dist_y));
	$p2x = ceil(($endX + $dist_x));
	$p2y = ceil(($endY + $dist_y));
	$p3x = ceil(($endX - $dist_x));
	$p3y = ceil(($endY - $dist_y));
	$p4x = ceil(($startX - $dist_x));
	$p4y = ceil(($startY - $dist_y));

	$array = array(0=>$p1x, $p1y, $p2x, $p2y, $p3x, $p3y, $p4x, $p4y);
	imagefilledpolygon($img, $array, (count($array)/2), $colour);
}

<?php defined('SYSPATH') OR die('No direct script access.');

class Flexagon
{


	function render()
	{
		// set up array of points for polygon
		$values = [
			40,  50,  // Point 1 (x, y)
			20,  240, // Point 2 (x, y)
			60,  60,  // Point 3 (x, y)
			240, 20,  // Point 4 (x, y)
			50,  40,  // Point 5 (x, y)
			10,  10   // Point 6 (x, y)
		];

		// create image
		$image = imagecreatetruecolor(842*1.2, 595*1.2);


		// allocate colors
		$bg   = imagecolorallocate($image, 255, 255, 255);
		$blue = imagecolorallocate($image, 255, 255, 255);

		// fill the background
		imagefilledrectangle($image, 0, 0, 249, 249, $bg);

		// draw a polygon
		imagefilledpolygon($image, $values, 6, $blue);

		// flush image
		header('Content-type: image/jpeg');
		imagejpeg($image, null, 100);
		imagedestroy($image);
		die();
	}
}
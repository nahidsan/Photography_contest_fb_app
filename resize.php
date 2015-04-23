<?php

/*

Simple PHP Image Resizer
Copyright (c) 2012 Ryan Fait
www.ryanfait.com

INSTRUCTIONS:

Specify just the width:       <img src="/dir/resize.php?w=100&amp;img=/test.jpg" />
Specify just the height:      <img src="/dir/resize.php?h=200&amp;img=/test.jpg" />
Specify the width and height: <img src="/dir/resize.php?w=100&amp;h=200&amp;img=/test.jpg" />

IMPORTANT:

Use the full web path to your images. img=test.jpg will not work. You need to use: /dir/test.jpg


This script is free. If you want to redistribute this script, you must leave the copyright
notice and my website URL with the function.


*/

session_start();
header("Pragma: public");
header("Cache-Control: max-age = 604800");
header("Expires: ".gmdate("D, d M Y H:i:s", time() + 604800)." GMT");

function thumbnail($image, $width, $height) {

	$image = $_SERVER["DOCUMENT_ROOT"].$image;
	$image_properties = getimagesize($image);
	$image_width = $image_properties[0];
	$image_height = $image_properties[1];
	$image_ratio = $image_width / $image_height;
	$type = $image_properties["mime"];

	if(!$width && !$height) {
		$width = $image_width;
		$height = $image_height;
	}
	if(!$width) {
		$width = round($height * $image_ratio);
	}
	if(!$height) {
		$height = round($width / $image_ratio);
	}

	if($type == "image/jpeg") {
		header('Content-type: image/jpeg');
		$thumb = imagecreatefromjpeg($image);
	} elseif($type == "image/png") {
		header('Content-type: image/png');
		$thumb = imagecreatefrompng($image);
	} else {
		return false;
	}

	$temp_image = imagecreatetruecolor($width, $height);
	imagecopyresampled($temp_image, $thumb, 0, 0, 0, 0, $width, $height, $image_width, $image_height);
	$thumbnail = imagecreatetruecolor($width, $height);
	imagecopyresampled($thumbnail, $temp_image, 0, 0, 0, 0, $width, $height, $width, $height);

	if($type == "image/jpeg") {
		imagejpeg($thumbnail);
	} else {
		imagepng($thumbnail);
	}

	imagedestroy($temp_image);
	imagedestroy($thumbnail);

}

if(isset($_GET["h"])) { $h = $_GET["h"]; } else { $h = 0; }
if(isset($_GET["w"])) { $w = $_GET["w"]; } else { $w = 0; }

thumbnail($_GET["img"], $w, $h);

?>
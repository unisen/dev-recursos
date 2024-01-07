<?php

$file_image = "adriana.jpg";

$output_pdf = "adriana.pdf";

$image = new Imagick();
$image->newImage(800, 600, new ImagickPixel('red'));
$image->setImageFormat('pdf');

$image->removeImage();

$path = new SplFileInfo(__DIR__);
$rootDir = $path->getRealPath();
$rootDir .= '/';
$rootDir = str_replace("C:\\", "/", $rootDir);
$rootDir = str_replace("\\", "/", $rootDir);
$incoming_file = $rootDir . $file_image;
$output_file = $rootDir . $output_pdf;

//$incoming_file = '/xampp/htdocs/recursos/create-ico/adriana.jpg';
$path_img = new Imagick(realpath($incoming_file));
//$output_file = '/xampp/htdocs/recursos/create-ico/adriana.pdf';
$path_pdf = new Imagick(realpath($incoming_file));
$image->addImage($path_img);
$image->writeImages($output_file, false);
//header('Content-type: image/png');
//echo $image;

?>
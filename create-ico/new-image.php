<?php

$image = new Imagick();
$image->newImage(800, 600, new ImagickPixel('red'));
$image->setImageFormat('pdf');

$image->removeImage();

$incoming_file = '/xampp/htdocs/recursos/create-ico/adriana.jpg';
$path_img = new Imagick(realpath($incoming_file));


$output_file = '/xampp/htdocs/recursos/create-ico/adriana.pdf';
$path_pdf = new Imagick(realpath($incoming_file));

$image->addImage($path_img);

$image->writeImages($output_file, false);

//header('Content-type: image/png');
//echo $image;

?>
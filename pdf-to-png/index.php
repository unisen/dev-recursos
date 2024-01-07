<?php
    /* $imagick = new Imagick();
    $imagick->setResolution (150, 150);

    $path = new SplFileInfo(__DIR__);
    $rootDir = $path->getRealPath();

    $pdf_file = $rootDir . '\\' . 'foto.pdf';
    
    echo $pdf_file;

    $imagick->readImage($pdf_file);

    $imagick = $imagick->flattenImages();

    $imagick->writeImages('converted.jpg'); */

    /* $source = "foto.pdf";

    $target = "converted.png";

    exec('convert "'.$source .'" -colorspace RGB –res "');    */
    
    $pathToImage = "C:\\xampp\\htdocs\\recursos\\pdf-to-png\\foto.pdf";
    $imagick = new Imagick("C:\\xampp\\htdocs\\recursos\\pdf-to-png\\foto.pdf");
    $imagick->setImageFormat('png');
    file_put_contents($pathToImage, $imagick);

?>
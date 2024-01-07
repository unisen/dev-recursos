<?php
//http://192.168.100.3/convert/examples/convert.php?pdf=file5&jpg=titulo-eleitor

// http://192.168.1.109/recursos/pdf-to-png/pdf-to-jpg.php?pdf=foto&jpg=foto

if (isset($_GET['pdf']) && isset($_GET['jpg'])) {
    
    $path = new SplFileInfo(__DIR__);
    $rootDir = $path->getRealPath();

    $pdf_file = $rootDir . '\\' . $_GET['pdf'] . '.pdf';
    echo $pdf_file . "<br>";
    $jpg_file = $rootDir . '\\' . $_GET['jpg'] . '.jpg';

    $image = new imagick();
    $image->setResolution(80, 80);
    
    //'C:\xampp\htdocs\convert\examples\foto.pdf'
    $pdf_file = "foto.pdf[0]";
    $image->readImage($pdf_file);
    
    $image->setImageCompressionQuality(50);
    
    // 'C:\xampp\htdocs\convert\examples\high_quality.jpg'
    $image->writeImages($jpg_file, false);

}
else {
    echo "Sem Parâmetros tente novamente!";
    $path = new SplFileInfo(__DIR__);
    echo 'The real path is '.$path->getRealPath();
}

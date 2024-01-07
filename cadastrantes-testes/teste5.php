<?php
  
/* Store the path of source file */
//$filePath = '../../register/cadastrantes/888999GO.zip';
  
/* Store the path of destination file */
$destinationFilePath = '../../register/cadastrantes/arquivados/888999GO.zip';
 
function extractZip($filePath, $destinationDir) {
    
    $zip = new ZipArchive;    
    // Zip File Name
    if ($zip->open($filePath) === TRUE) {    
        // Unzip Path
        $zip->extractTo($destinationDir);
        $zip->close();
        //echo 'Unzipped Process Successful!';
        return true;
    } else {
        //echo 'Unzipped Process failed';
        return false;
    }
}

$path = '../../register/cadastrantes/arquivados/888999GO.zip';
$destDir = '../../register/cadastrantes/888999GO/';

extractZip($path, $destDir);

<?php
  
/* Store the path of source file */
$filePath = '../../register/cadastrantes/888999GO.zip';
  
/* Store the path of destination file */
$destinationFilePath = '../../register/cadastrantes/arquivados/888999GO.zip';
  
/* Move File from images to copyImages folder */
if( !rename($filePath, $destinationFilePath) ) {  
    echo "File can't be moved!";  
}  
else {  
    echo "File has been moved!";  
} 
  
?>
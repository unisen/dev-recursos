<?php session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'farquivos.php';


if (isset($_SESSION['path_registro'])) {
    // "../../register/cadastrantes/"
    $path_registro = $_SESSION['path_registro'];
}


if (isset($_POST['userid'])) {

    $pasta_cadastrante = $_POST['userid'];

   
        // Enter the name to creating zipped directory
        // "../../register/cadastrantes/" + 888999GO 
        $path = $path_registro . $pasta_cadastrante;
        // "../../register/cadastrantes/888999GO" + "/"
        $pathdir = $path . "/";

        // nome e origem do arquivo ZIP 
        $arquivo_zip = $pasta_cadastrante . ".zip";        
        //zipDirectory($pathdir, $zipcreated);
        
        $pathArquivos = $path_registro . "arquivados/" . $arquivo_zip;

        //echo "<script>alert('$pathArquivos')</script>";
        if (!is_dir($pathdir)) {
            // Making a directory with the provision
            // of all permissions to the owner and 
            // the owner's user group
            mkdir($pathdir, 0777, true);
        }

        extractZip($pathArquivos,$pathdir);
        //moveFiles($zipcreated, $pathArquivos); 
        // $path = $path_registro . $pasta_cadastrante
        //removeFiles($path);
        
        $response = array();
        array_push($response, 'sucesso');
        array_push($response, $pasta_cadastrante);

        echo json_encode($response);
    }
        

    else {
        echo "Erro: " . json_encode($pathArquivos);
    }




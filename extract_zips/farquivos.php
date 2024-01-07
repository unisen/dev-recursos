<?php
/**
 *  farquivos.php  - Versão mais completa
 * 
 */

/** Functions */

  // Function to remove folders and files 
  function rrmdir($dir) {
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file)
            if ($file != "." && $file != "..") rrmdir("$dir/$file");
        rmdir($dir);
    }
    else if (file_exists($dir)) unlink($dir);
}

// Function to Copy folders and files       
function rcopy($src, $dst) {
    if (file_exists ( $dst ))
        rrmdir ( $dst );
    if (is_dir ( $src )) {
        mkdir ( $dst );
        $files = scandir ( $src );
        foreach ( $files as $file )
            if ($file != "." && $file != "..")
                rcopy ( "$src/$file", "$dst/$file" );
    } else if (file_exists ( $src ))
        copy ( $src, $dst );
}

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 

function custom_copy($src, $dst)
{
    // open the source directory
    $dir = opendir($src);
    // Make the destination directory if not exist
    @mkdir($dst);
    // Loop through the files in source directory
    while ($file = readdir($dir)) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                // Recursively calling custom copy function
                // for sub directory 
                custom_copy($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

function create_cadastrante($indice, $nome, $crm, $crm_uf, $mode = 0)
{
    if ($mode != 0) {
        if (!is_dir("./cadastrantes/" . $indice . " - " . $nome . "/")) mkdir("./cadastrantes/" . $indice . " - " . $nome . "/", 0777, true);
        $src =  dirname(__FILE__) . "/cadastrantes/1000 - MODELO";
        $dst =  dirname(__FILE__) . "/cadastrantes/$indice - $nome";
        custom_copy($src, $dst);
        return 1;
    } else {
        if (!is_dir("./cadastrantes/" . $crm . $crm_uf . "/")) mkdir("./cadastrantes/" . $crm . $crm_uf . "/", 0777, true);
        $src =  dirname(__FILE__) . "/cadastrantes/1000 - MODELO";
        $dst =  dirname(__FILE__) . "/cadastrantes/$crm$crm_uf";
        custom_copy($src, $dst);
        return 1;
    }
}



/**
 * MODE = 0 -> em verificação
 */


/* $path_parts = pathinfo('/cadastrantes/1000 - MODELO/');
echo $path_parts['dirname'], "<br>";
echo $path_parts['basename'], "<br>";
echo $path_parts['extension'], "<br>";
echo $path_parts['filename']; */

/* if (create_cadastrante("999", "Diego Fernandes", "696969", "GO", 0) == 1) {
    echo "Pasta Criada";
}
 */
//echo dirname(__FILE__);  
//custom_copy($src, $dst);



function lista_arquivos($diretorio)
{
    if ($handle = opendir($diretorio)) {

        while (false !== ($entry = readdir($handle))) {

            if ($entry != "." && $entry != "..") {

                $arr_files = explode(" - ", $entry);
                echo "<br>$arr_files[1]";
                //$arr_1 = explode(" [1]", $arr_files[1]);
                //echo "$arr_1[0] <br>";
                //echo "$entry <br>";
            }
        }

        closedir($handle);
    }
}

function monta_select_arquivos($diretorio)
{
    if ($handle = opendir($diretorio)) {

        echo "<select name='lista_documentos[]' id='lista_documentos' onchange='mostra_documentoPDF(this)' class='custom-select my-1 mr-sm-2 form-control r-0 light s-12'><option value='' disabled='' selected=''>Selecione</option>";


        while (false !== ($entry = readdir($handle))) {

            if ($entry != "." && $entry != "..") {

                $arr_files = explode(" - ", $entry);

                // Nome do Arquivo Completo
                //echo "<br>$arr_files[1]";

                $arr_1 = explode(" [1]", $arr_files[1]);

                // Nome do Documento Origem
                //echo "$arr_1[0] <br>";

                echo "<option value='$entry'>$arr_1[0]</option>";
                //echo "$entry <br>";
            }
        }

        echo "</select>";

        closedir($handle);
    }
}

function monta_select_arquivos2($diretorio)
{
    if ($handle = opendir($diretorio)) {

        echo "<select name='lista_documentos[]' id='lista_documentos' onchange='mostra_documentoPDF(this)' class='custom-select my-1 mr-sm-2 form-control r-0 light s-12'><option value='' disabled='' selected=''>Selecione</option>";

        $lista = array();
        while (false !== ($entry = readdir($handle))) {

            if ($entry != "." && $entry != "..") {
                array_push($lista, $entry);
            }
        }

        sort($lista);
        foreach ($lista as $arquivo) {
            $arr_files = explode(" - ", $arquivo);
            $arr_1 = explode(" [1]", $arr_files[1]);
            echo "<option value='$arquivo'>$arr_1[0]</option>";
        }
        echo "</select>";


        closedir($handle);
    }
}


// Pega arquivos de um diretorio e retorna um array com os nomes
function listar_documentos($diretorio)
{
    $lista = array();

    if ($handle = opendir($diretorio)) {

        while (false !== ($entry = readdir($handle))) {

            if ($entry != "." && $entry != "..") {
                //$arr_files = explode(" - ", $entry);
                //echo "<br>$arr_files[1]";
                //$arr_1 = explode(" [1]", $arr_files[1]);
                //echo "$arr_1[0] <br>";
                //echo "$entry <br>";
                array_push($lista, $entry);
            }
        }

        closedir($handle);
    }

    //Ordena os arquivos
    sort($lista);
    //print_r($lista);
    return $lista;
}


function conta_arquivos($diretorio)
{

    $x = 0;
    $xtotal = 0;

    $nome_anterior = "";

    //echo opendir($diretorio);
    // Checking whether a file is directory or not
    if (!is_dir($diretorio)) {
        // Making a directory with the provision
        // of all permissions to the owner and 
        // the owner's user group
        mkdir($diretorio, 0777, true);
    }


    if ($handle = opendir($diretorio)) {

        while (false !== ($entry = readdir($handle))) {

            if ($entry != "." && $entry != "..") {

                $arr_files = explode(" - ", $entry);
                $arr2 = explode(" [", $arr_files[1]);

                if ($nome_anterior != $arr2[0]) {
                    //echo "$arr2[0] Folhas: $x<br>";
                    $x++;
                }
                $xtotal++;
                $nome_anterior = $arr2[0];
                //$arr_1 = explode(" [1]", $arr_files[1]);
                //echo "$arr_1[0] <br>";
                //echo "$entry <br>";
            }
        }

        closedir($handle);
        return array($x, $xtotal);
    }
    return 0;
}

function zipDirectory($pathdir, $zipcreated)
{
    // Create new zip class
    $zip = new ZipArchive;

    if ($zip->open($zipcreated, ZipArchive::CREATE) === TRUE) {

        // Store the path into the variable
        $dir = opendir($pathdir);

        while ($file = readdir($dir)) {
            if (is_file($pathdir . $file)) {
                $zip->addFile($pathdir . $file, $file);
            }
        }
        $zip->close();
    }
}

/* $path = '../../register/cadastrantes/arquivados/888999GO.zip';
$destDir = '../../register/cadastrantes/888999GO/';

extractZip($path, $destDir); */

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



function removeFiles($target)
{
    if (is_dir($target)) {
        $files = glob($target . '*', GLOB_MARK);

        foreach ($files as $file) {
            removeFiles($file);
        }

        rmdir($target);
    } elseif (is_file($target)) {
        unlink($target);
    }
}

//$path = "teste/46327CE";

/* Store the path of source file */
//$filePath = '../../register/cadastrantes/888999GO.zip';  
/* Store the path of destination file */
//$destinationFilePath = '../../register/cadastrantes/arquivados/888999GO.zip';
function moveFiles($filePath, $destinationFilePath)
{
    /* Move File from images to copyImages folder */
    if (!rename($filePath, $destinationFilePath)) {
        return false;
        //echo "File can't be moved!";
    } else {
        return true;
        //echo "File has been moved!";
    }
}


/**
 *  Renomeia todos os documentos da pasta cadastrante 
 *  se houver mudança no Nome Completo do Cadastrante
 *  
 *  Vars:
 *  - $diretorio = 'cadastrantes';
 *  - $pasta_cadastrante = "18720GO"; // CRM Completo do Cadastrante
 *  - $path_folder = "$diretorio/" . $pasta_cadastrante;
 * 
 *  - $lista_docs lista original de documentos gerada pela
 *    função: $cadastrante_docs = listar_documentos($path);
 * 
 *  - $new_name  = 'Novo NOME COMPLETO DO CADASTRANTE'
 * 
 */
function rename_all_documents($new_name, $path_folder) {
    $lista_docs = listar_documentos($path_folder);

    $lista_docs_new_names = array();
    foreach ($lista_docs as $itemDoc) {                        
        $docSplit = explode(" - ", $itemDoc);       
        $nomeDoc = $docSplit[1];
        $new_doc_name = $new_name . ' - ' . $nomeDoc;
        array_push($lista_docs_new_names, $new_doc_name);
        rename("$path_folder/$itemDoc","$path_folder/$new_doc_name");         
    }
    return $lista_docs_new_names;
}





<?php session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../../config/database/conexao.php';
require_once '../../DAO/config/database.php';
require_once '../../DAO/controllers/LogsDAO.php';
require_once '../../DAO/controllers/CadastranteDAO.php';

//Include libs private functions
require_once './libs/farquivos.php';


if (isset($_SESSION['path_documentos_registro'])) {
    // "../../register/cadastrantes/"
    $path_registro = $_SESSION['path_documentos_registro'];
}


if (isset($_POST['userid']) && isset($_POST['usercrm'])) {

    $userid = $_POST['userid'];

    $pasta_cadastrante = $_POST['usercrm'];

    //Grava um backup do Cadastro na tbl_cadastro_arquivado
    $sql_backup = "INSERT INTO tbl_cadastrantes SELECT * FROM tbl_cadastro_arquivado WHERE tbl_cadastro_arquivado.ID = $userid";
    if (!$result_backup = mysqli_query($con, $sql_backup)) {
        $result_backup = 0;
    }
    //Atualiza o status para Arquivado
    $sql_status = "UPDATE `tbl_cadastrantes` SET `STATUS`='cadastrando' WHERE ID = $userid";
    if (!$result_status = mysqli_query($con, $sql_status)) {
        $result_status = 0;
    }

    //$con->close();

    /* $CadastranteDAO = new CadastranteDAO();
    $params = "WHERE ID = $userid";

    $result = $CadastranteDAO->selectNewCadastrante($params);
    $Cadastrante = $result[0];
    */

    //pega pasta do documento
    //$arquivo = explode("/", $userfolder);
    //$pasta_cadastrante = $arquivo[1];
    
        //$parameters = "WHERE ID = $userid";
    /* $parameters = array(
        'id' => $userid,
      );  */

    $origem = "Painel Cadastrantes - Arquivados - $result_backup";
    $tabela = 'tbl_cadastro_arquivado';
    $login_user = $_SESSION['name'];
    $username = $_SESSION['username'];
    $ip_usuario = $_SERVER['REMOTE_ADDR'];

    // Deleta os dados na tbl_cadastro_arquivado
    $sql_delete_arq = "DELETE FROM tbl_cadastro_arquivado WHERE ID = $userid";
    if (!$result_delete = mysqli_query($con, $sql_delete_arq)) {
        $result_delete = 0;  
  
        //Registra o Log
        $LogsDAO = new LogsDAO();
        $acao = "Deletou Id: $userid - Tabela: $tabela";

        $logData = array();
        $logData[] = $acao;
        $logData[] = $origem;
        $logData[] = $tabela;
        $logData[] = $login_user;
        $logData[] = $username;
        $logData[] = $ip_usuario;

        $LogsDAO->insertLog($logData);

        // Enter the name of directory
        //$pasta_cadastrante = "46327CE";

        // Enter the name to creating zipped directory
        // "../../register/cadastrantes/" + 888999GO 
        $path = $path_registro . $pasta_cadastrante;
        // "../../register/cadastrantes/888999GO" + "/"
        $pathdir = $path . "/";

        // nome e origem do arquivo ZIP 
        $zipcreated = $path_registro . $pasta_cadastrante . ".zip";        
        //zipDirectory($pathdir, $zipcreated);
        
        $pathArquivos = $path_registro . "arquivados/" . $pasta_cadastrante . ".zip";

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
        echo "Erro: " . json_encode($logData);
    }
}

$con->close();

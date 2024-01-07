<?php   

    if (isset($_GET['dir']) && isset($_GET['crm_uf'])) {
        $diretorio = $_GET['dir'];
        $pasta_cadastrante = $_GET['crm_uf'];

    } else {
        $diretorio = "arquivos";
        $pasta_cadastrante = "999999GO";
    }
  
    $path = "./$diretorio/".$pasta_cadastrante."/";

    if (is_dir($path)) {
        echo "Pasta Existe!";
        //
        //echo json_encode('sucesso');
    }
    else {
        mkdir($path,0777,true);
        echo "Pasta Criada!";
        //echo json_encode('erro');
    }
?>
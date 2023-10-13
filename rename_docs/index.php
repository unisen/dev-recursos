<?php session_start();


include_once 'libs/farquivos.php';

// convert illegal input value to ligal value formate
function legal_input($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RENAME ALL DOCUMENTS IN FOLDER - IF NAME CHANGE</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <form role="form" id="frm_rename_docs" name="frm_rename_docs" method="POST" class="form-horizontal">
                    <div class="card">
                        <div class="card-header">
                            <b>Renomeia arquivos numa pasta se o Nome do Cadastrante mudar: </b>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nome_completo">Nome do Cadastrante</label>
                                <input type="text" class="form-control" name="nome_completo" id="nome_completo"
                                    placeholder="Digite um novo nome para o cadastrante" onchange="changeToUppercase('#nome_completo')" required>

                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <button type="submit" name="btn-rename" id="btn-rename"
                                class="btn btn-primary btn-lg" onclick="renomear_documentos()">Renomear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm">
                <h4>Lista Original</h4>
                <hr>
                <?php
                    $diretorio = 'cadastrantes';
                    $pasta_cadastrante = "18720GO"; // CRM Completo do Cadastrante
                    $path = "$diretorio/" . $pasta_cadastrante;
                    $cont = 1;
                    $cadastrante_docs = listar_documentos($path);
                    
                    if (!isset($_SESSION['lista_antiga'])) {
                        $_SESSION['lista_antiga'] = $cadastrante_docs;
                    }

                    //$listaDocOriginal = array();
                    foreach ($cadastrante_docs as $itemDoc) {                       
                        
                        if ($cont<=9) {
                            echo "0$cont) " . $itemDoc . "<br>";
                        }
                        else {
                            echo $cont . ") " . $itemDoc . "<br>";
                        }

                        $cont++;
                    }
                ?>
            </div>
            <div class="col-sm">
                <h4>Lista Renomeada</h4>
                <hr>
                <?php                    
                    
                    if (isset($_POST['nome_completo']) and $_POST['nome_completo'] != '') {
                        $novo_nome = $_POST['nome_completo'];

                        // $novo_nome = Nome Completo
                        // $path = "$diretorio/$pasta_cadastrante"
                        $lista_new_names = rename_all_documents($novo_nome, $path);
                        $i1 = 1;
                        foreach ($lista_new_names as $newDoc) {
                            if ($i1<=9) {
                                echo "0$i1) " . $newDoc . "<br>";
                            }
                            else {
                                echo $i1 . ") " . $newDoc . "<br>";
                            }
                            $i1++;
                        }

                        echo "<hr>";
                    }
                    else {
                        $novo_nome = '';

                    }
                    


                  

                    //print_r($lista_docs_new_names);

                ?>
            </div>

        </div>
    </div>

    <script src="" async defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <script>
    function changeToUppercase(campo) {
        //console.log(strNome.value);
        $(campo).val($(campo).val().toUpperCase());
    }

    function renomear_documentos() {
        var new_name = $('#nome_completo').val();
        if (new_name != '') {
            //alert(new_name);
        }
    }
    </script>
</body>

</html>
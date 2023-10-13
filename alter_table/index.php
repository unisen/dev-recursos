<?php

//require_once 'config/conexao.php';
require_once 'inc/str_functions.php';

if(isset($_POST['banco_de_dados']) and $_POST['banco_de_dados'] != '') {
  $banco_de_dados = $_POST['banco_de_dados'];
} 
else {
  $banco_de_dados = "escala_db";
}


if(isset($_POST['table_name']) and $_POST['table_name'] != '') {
  $table_name = $_POST['table_name'];
} 
else {
  $table_name = "tbl_socios";
}


if($_SERVER['HTTP_HOST'] == 'localhost' or strpos($_SERVER['HTTP_HOST'],"192.168") !== false) {
  // Change this to your connection info.
  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = '';
  $DATABASE_NAME = $banco_de_dados;
}
else {
  // Connection servidor.
  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'chefre17_unisen2107';
  $DATABASE_PASS = 'LgBkCfTv7DEP';
  $DATABASE_NAME = 'chefre17_dbunisen';
}

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql = "SHOW COLUMNS FROM $table_name";
$table_fields = mysqli_query($con, $sql);
//$columns = mysqli_fetch_array($table_fields, MYSQLI_ASSOC);
$fields = array();
while($row = mysqli_fetch_array($table_fields)){ 
  //echo $row['Field'] . ", ";  
  array_push($fields,$row['Field']);
}
$con->close();

$fix_fields_names = array();
foreach($fields as $campo) {
  array_push($fix_fields_names, fix_SQL_fieldname($campo)); 
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
    <title>RENAME ALL TABLE FIELDS NAME TO best pratices</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <form role="form" id="frm_alter_table" name="frm_alter_table" method="POST" class="form-horizontal">
                    <div class="card">
                        <div class="card-header">
                            <b>Corrige os nomes do campos de uma tabela sql, renomeando usando boas práticas, snakedcase
                                format</b>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="banco_de_dados">Banco de Dados</label>
                                <input type="text" class="form-control" name="banco_de_dados" id="banco_de_dados"
                                    placeholder="Digite o nome do Banco de Dados" required>
                                <label for="table_name">Tabela</label>
                                <input type="text" class="form-control" name="table_name" id="table_name"
                                    placeholder="Digite o nome da Tabela" required>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <button type="submit" name="btn-rename" id="btn-rename"
                                class="alterar_tabela btn btn-primary btn-lg">Alterar Campos</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm" style="padding: 4%;">
                <?php 
                  echo "<b>TABELA:</b> $table_name<hr>";
                  echo implode(", ", $fields); ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm">
                <h4>Campos Originais</h4>
                <hr>
                <?php 
                if(isset($_POST['table_name']) and $_POST['table_name'] != '') { ?>
                <br><br>
                <pre>
                    <?php print_r($fields); ?>
                   </pre>
                <hr>
                FIX FIELDS NAMES -
                <?php } ?>
            </div>
            <div class="col-sm">
                <h4>Campos Modificados</h4>
                <hr>
                <?php
                 if(isset($_POST['table_name']) and $_POST['table_name'] != '') { ?>
                <br><br>
                <pre>
                    <?php print_r($fix_fields_names); ?>
                    </pre>
                <hr>
                <?php } ?>
            </div>

        </div>
    </div>

    <!-- MODAL Deletar Cadastrante -->
    <?php
            $path = dirname(__FILE__);
            $path .= '/modalChangeFields.php';
            include_once($path);
            ?>
    <script src="js/sweetalert2@9.js"></script>
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

    function alterar_sql_ajax() {

        var banco_de_dados = $("#database_name").val();
        var tabela = $("#table_change").val();

        //var data = "Banco de Dados: "+banco_de_dados+" Tabela: "+tabela;
        //alert(data);

        $.ajax({
            url: 'inc/alter_table_fields.php',
            type: 'post',
            data: {
                banco_de_dados: banco_de_dados,
                tabela: tabela
            },
            success: function(response) {
                response = JSON.parse(response);

                //alert(response[0]);

                // Add response for delete cadastrante
                if (response[0] == 'sucesso') {
                    alert('Tabela Alterada!');
                    console.log(response);
                } else {
                    alert("Erro: " + response);
                }
            }
        });

    }
    </script>


    <script>
    $(document).ready(function() {
        $(".btnChange").click(function() {

            //var userid = $(this).data('id');
            //$("#id_delete_cadastrante").val(userid);

            var banco_de_dados = $("#banco_de_dados").val();
            $("#database_name").val(banco_de_dados);

            var tabela = $("#table_name").val();
            $("#table_change").val(tabela);

            $("#modalChangeFields").modal("show");

        });


        $("#modalChangeFields").on('show.bs.modal', function() {
            var nomeTabela = $("#table_change").val();
            $("#nomeTabelaChange").text(nomeTabela);

        });
    });
    </script>

    <script>
    $(document).ready(function() {

        $("#modalChangeFields").on('hide.bs.modal', function() {
            //location.reload();
        });

    });
    </script>

    <!-- AJAX FUNCIONANDO !!! -->
    <script>
    $(document).ready(function() {

        $('.alterar_tabela').click(function() {

            var banco_de_dados = $("#banco_de_dados").val();
            //$("#database_name").val(banco_de_dados);

            var tabela = $("#table_name").val();
            //$("#table_change").val(tabela);

            //dados = 'Banco de Dados: ' + banco_de_dados + ' Tabela: ' + tabela;
            //  alert(dados);

            $.ajax({
                url: 'inc/alter_table_fields.php',
                type: 'post',
                data: {
                    banco_de_dados: banco_de_dados,
                    tabela: tabela
                },
                dataType: "text",
                success: function(response) {
                response = JSON.parse(response);

                //alert(response[0]);

                // Add response for delete cadastrante
                if (response[0] == 'sucesso') {
                    console.log(response[1]);
                    console.log(response[2]);
                    console.log(response[3]);
                    alert('Tabela Alterada!');                    
                } else {
                    alert("Erro: " + response);
                }
            }
            });
        });
    });
        </script>

    <!-- <script>
    $(document).ready(function() {

        $("#frm_alter_table").submit(function(e) {

            e.preventDefault();

            $.ajax({
                method: "POST",
                url: "inc/alter_table_fields.php'",
                data: $("form").serialize(),
                dataType: "text",
                success: function(strMessage) {
                    $("#message").text(strMessage);
                    if ($.trim(strMessage) == 'sucesso') {
                        Swal.fire({
                            title: '',
                            text: "Cliente inserido com sucesso!",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                                $('#adicionar_novo_cliente').modal('toggle');
                                $('#adicionar_novo_cliente').find('input').val('');

                            }

                        })

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: strMessage,

                        });

                    }
                }
            });
        });
    });
    </script> -->

    <!--  <script>
    $(document).ready(function() {

        $('.alterar_tabela').click(function() {

            var banco_de_dados = $("#banco_de_dados").val();
            $("#database_name").val(banco_de_dados);

            var tabela = $("#table_name").val();
            $("#table_change").val(tabela);

            //dados = 'Banco de Dados: ' + banco_de_dados + 'Tabela: ' + tabela;
            //alert(dados);


            $.ajax({
                url: 'inc/alter_table_fields.php',
                type: 'post',
                data: {
                    banco_de_dados: banco_de_dados,
                    tabela: tabela
                },
                success: function(response) {
                    response = JSON.parse(response);

                    //alert(response[0]);

                    // Add response for delete cadastrante
                    if (response[0] == 'sucesso') {
                        Swal.fire({
                            title: '',
                            text: "Campos da Tabela Alterados!",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                alert(reponse[1]);
                                console.log(response);
                                //var url = "?id=" + userid + "&cad=" + response[1];
                                //location.replace(url);
                                //window.location.href = url;                            
                                //location.reload();
                            }
                        })
                        //var url = " ?id=" + userid + "&cad=" + response[1];
                        //location.replace(url);
                        //$('#delete_selecionados').modal('toggle');
                    } else {
                        Swal.fire({
                            title: '',
                            text: "Erro ao alterar tabela: " + response,
                            icon: 'Erro',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        })
                    }
                }
            });

            //var userid = $(this).data('id');
            //var userid = $("#id_delete_cadastrante").val();
            //alert(userid);
            // AJAX Documentos Cadastrante request
            /* $.ajax({
                url: 'ajax-deletar-cadastrante.php',
                type: 'post',
                data: {
                    userid: userid
                },
                success: function(response) {
                    response = JSON.parse(response);

                    //alert(response[0]);

                    // Add response for delete cadastrante
                    if (response[0] == 'sucesso') {
                        Swal.fire({
                            title: '',
                            text: "Cadastrante Excluido!",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {

                                var url = "?id=" + userid + "&cad=" + response[1];
                                location.replace(url);
                                //window.location.href = url;                            
                                //location.reload();
                            }
                        })
                        var url = " ?id=" + userid + "&cad=" + response[1];
                        location.replace(url);
                        //$('#delete_selecionados').modal('toggle');
                    } else {
                        Swal.fire({
                            title: '',
                            text: "Erro ao excluir cadastrante: " + response,
                            icon: 'Erro',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        })
                    }
                }
            }); */
        });
    });
    </script> -->
</body>

</html>
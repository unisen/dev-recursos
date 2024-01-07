<?php session_start(); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EXTRACT ZIP FILES</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <?php 

        //Include libs private functions
        //require_once 'farquivos.php';
        $_SESSION['path_registro'] = "cadastrantes/";
        $pasta_cadastrante = "191191GO";

        ?>


    <button onclick="extrair_pasta();">
        Extrair
    </button>

    <!-- <script src="js/script.js" async defer></script> -->
    <script>
    function extrair_pasta() {
        //alert('kkk');
        var userid = '191191GO';
        $.ajax({
            url: 'ajax-extrair.php',
            type: 'post',
            data: {
                userid: userid
            },
            success: function(response) {
                if (response[0] == 'sucesso') {
                    alert("Pasta Extraída com sucesso!");
                } else {
                    alert("Pasta não extraída!");
                }
            }
        });
    }
    </script>
</body>

</html>
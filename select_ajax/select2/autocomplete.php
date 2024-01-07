<?php
    define (DB_USER, "root");
    define (DB_PASSWORD, "");
    define (DB_DATABASE, "escala_db");
    define (DB_HOST, "localhost");
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    if(!isset($_GET['searchTerm'])){ 
        $json = [];
    }else{
        $search = $_GET['searchTerm'];
        $sql = "SELECT tbl_associados.id, tbl_associados.nome_completo FROM tbl_associados 
                WHERE nome_completo LIKE '%".$search."%'
                LIMIT 10"; 
        $result = $mysqli->query($sql);
        $json = [];
        while($row = $result->fetch_assoc()){
            $json[] = ['id'=>$row['id'], 'text'=>$row['nome_completo']];
        }
    }

    echo json_encode($json);
?>
<?php
$mysqli = new mysqli("localhost","root","","escala_db");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$sql = "SELECT `ID`,`REGISTRO`,`CONTRATO`,`INSCRIÇÃO`,`SEXO`,`ESTADO CIVIL`,`NOME COMPLETO`,`FILIAÇÃO`,`CRM`,`TELEFONE`,`E-MAIL`,`DATA DE NASCIMENTO`,`RG`,`NATURALIDADE`,`NACIONALIDADE`,`CPF`,`TITULO DE ELEITOR`,`PIS`,`ENDEREÇO`,`ENDEREÇO NO NOME`,`DADOS BANCARIOS`,`FUNÇÃO`,`ESPECIALIDADE`,`ID PLANILHA`,`EMPRESA`,`STATUS`,`USER_IMAGE` FROM tbl_socios ORDER BY ID DESC";

if ($result = $mysqli -> query($sql)) {
  // Get field information for all fields
  while ($fieldinfo = $result -> fetch_field()) {
    
    printf("Name: %s<br>", $fieldinfo -> name);
    printf("Type: %s<br>", $fieldinfo -> type);
    printf("Table: %s<br>", $fieldinfo -> table);
    printf("Max. Len: %d<br>", $fieldinfo -> max_length);
    echo "<hr>";
  }
  $result -> free_result();
}

$mysqli -> close();
?>
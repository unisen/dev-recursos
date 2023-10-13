<?php
/**
 *  SCRIPT QUE ALTERA O NOMES DOS CAMPOS
 *  DE UMA TABELA DE FORMA A FORMALIZAR 
 *  A NOMENCLATURA USANDO AS BOAS PRÁTICAS
 */

 /* 
-- Pega toda a configuração do campo na tabela

$sql_atributes = "SELECT * 
FROM information_schema.COLUMNS 
WHERE 
TABLE_SCHEMA = '$banco_de_dados' 
AND TABLE_NAME = '$table_name'

*/

require_once 'str_functions.php';

if(isset($_POST['banco_de_dados']) and isset($_POST['tabela'])) {
    $banco_de_dados = $_POST['banco_de_dados'];
    $table_name = $_POST['tabela'];
} else {
    $banco_de_dados = "escala_db";
    $table_name = "tbl_socios";
    exit;
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

// CRIA UMA TABELA TEMPORARIA
$temp_sufix = "_temp";
$table_name_temp = "$table_name" . $temp_sufix;
$sql_create = "CREATE TABLE $table_name_temp LIKE $table_name";
$table_create_temp = mysqli_query($con, $sql_create);
$sql_insert_into = "INSERT INTO $table_name_temp SELECT * from $table_name";
$table_insert_into = mysqli_query($con, $sql_insert_into);

// Muda o nome da tabela a ser altera para o nome Temporario
$table_name = $table_name_temp;

//Declare Arrays
$fields = array();
$fix_fields_names = array();
$col_atributes = array();

$sql = "SHOW COLUMNS FROM $table_name";
$table_fields = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($table_fields)){ 
  array_push($fields,$row['Field']);
  array_push($fix_fields_names, fix_SQL_fieldname($row['Field']));
}


  foreach($fields as $campo) {
    $field_change = fix_SQL_fieldname($campo);

    // PEGA OS ATRIBUTOS DO CAMPO
    $sql_attr = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$banco_de_dados' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$campo'";
      
    $field_atributes = mysqli_query($con, $sql_attr);

    while($row = mysqli_fetch_array($field_atributes)){ 
      // MONTA A QUERY DO ALTER TABLE CHANGE COLUMNS ATRIBUTES
      $sql_alter_atrr = '';
      if ($campo == "ID") {
        $sql_alter_atrr .= $row[15];
        if($row[6] == 'NO') {
          $sql_alter_atrr .= "  NOT NULL";
        }
        if($row[17] == "auto_increment") {
          $sql_alter_atrr .= " AUTO_INCREMENT";
        }
      } 
      else {
        // COLUMN_TYPE
        $sql_alter_atrr .= $row[15] . " CHARACTER SET " . $row[13] . " COLLATE " .  $row[14];
        if($row[6] == 'NO') {
          $sql_alter_atrr .= "  NOT NULL";
        }
      }
      
      // Monta a query do alter table change field
      $sql_alter = "ALTER TABLE $table_name CHANGE `$campo` `$field_change` $sql_alter_atrr";
      // Executa o SQL
      $table_alter_change = mysqli_query($con, $sql_alter);
      echo $sql_alter . "<hr>";
    }
  }

  if (count($fix_fields_names) > 0) {         
    $response = array();
    array_push($response, 'sucesso');
    array_push($response,$fields);
    array_push($response,$fix_fields_names);
    array_push($response,$col_atributes);
    echo json_encode($response);
  }
  else {
    echo "Erro: " . json_encode($fix_fields_names);
    //prin
    t_r($_POST);
  }

 

?>
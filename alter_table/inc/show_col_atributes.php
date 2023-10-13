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
 
    /**
     * - Atributes using information_schema.COLUMNS
     * 
     * CREATE VIEW vm_tblsocios_atrr AS
     * SELECT * 
     * FROM information_schema.COLUMNS 
     * WHERE 
     * TABLE_SCHEMA = 'escala_db' 
     * AND TABLE_NAME = 'tbl_socios'
     * AND COLUMN_NAME = 'NOME COMPLETO';
     * 
      */

require_once 'str_functions.php';

$banco_de_dados = "unisen19_financeiro";
$table_name = "cash2";


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

$fields = array();
$fix_fields_names = array();
while($row = mysqli_fetch_array($table_fields)){  
  array_push($fields,$row['Field']);
  array_push($fix_fields_names, fix_SQL_fieldname($row['Field']));
}
echo "<br><br><hr>ORIGINAL FIELDS<pre>";
print_r($fields);
echo "</pre>";
echo "<hr>FIX FIELDS NAMES -";

//echo fix_SQL_fieldname($fields[3]);
echo "<br><br><hr><pre>";
print_r($fix_fields_names);
echo "</pre>";
echo "<hr>";

foreach($fields as $campo) {
  
  $field_change = fix_SQL_fieldname($campo);

  // Atributes fields using SHOW COLUMNS - SQL
  //Array ( [0] => NOME COMPLETO [Field] => NOME COMPLETO [1] => varchar(300) [Type] => varchar(300) [2] => NO [Null] => NO [3] => [Key] => [4] => [Default] => [5] => [Extra] => )
  /**
   * - Atributes using information_schema.COLUMNS
   * 
   * CREATE VIEW vm_tblsocios_atrr AS
   * SELECT * 
   * FROM information_schema.COLUMNS 
   * WHERE 
   * TABLE_SCHEMA = 'escala_db' 
   * AND TABLE_NAME = 'tbl_socios'
   * AND COLUMN_NAME = 'NOME COMPLETO';
   * 
   * 
   * Array ( [0] => def [TABLE_CATALOG] => def [1] => unisen19_financeiro [TABLE_SCHEMA] => unisen19_financeiro [2] => cash2 [TABLE_NAME] => cash2 [3] => NF/CPF [COLUMN_NAME] => NF/CPF [4] => 4 [ORDINAL_POSITION] => 4 [5] => [COLUMN_DEFAULT] => [6] => NO [IS_NULLABLE] => NO [7] => varchar [DATA_TYPE] => varchar [8] => 100 [CHARACTER_MAXIMUM_LENGTH] => 100 [9] => 300 [CHARACTER_OCTET_LENGTH] => 300 [10] => [NUMERIC_PRECISION] => [11] => [NUMERIC_SCALE] => [12] => [DATETIME_PRECISION] => [13] => utf8 [CHARACTER_SET_NAME] => utf8 [14] => utf8_general_ci [COLLATION_NAME] => utf8_general_ci [15] => varchar(100) [COLUMN_TYPE] => varchar(100) [16] => [COLUMN_KEY] => [17] => [EXTRA] => [18] => select,insert,update,references [PRIVILEGES] => select,insert,update,references [19] => [COLUMN_COMMENT] => [20] => NEVER [IS_GENERATED] => NEVER [21] => [GENERATION_EXPRESSION] => )
  */

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


     //echo print_r($row) . '<hr>';
    //array_push($fields,$row['Field']);
    //array_push($col_atributes, $row);
  }

} 
?>
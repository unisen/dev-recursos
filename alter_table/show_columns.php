<?php

require_once 'config/conexao.php';
require_once 'inc/str_functions.php';

$sql = "SHOW COLUMNS FROM tbl_socios2";


$table_fields = mysqli_query($con, $sql);

//$columns = mysqli_fetch_array($table_fields, MYSQLI_ASSOC);

$fields = array();

while($row = mysqli_fetch_array($table_fields)){ 

  echo $row['Field'] . ", ";  
  array_push($fields,$row['Field']);
}
$con->close();

echo "<br><br><hr>ORIGINAL FIELDS<pre>";
print_r($fields);
echo "</pre>";
echo "<hr>FIX FIELDS NAMES -";

$fix_fields_names = array();
foreach($fields as $campo) {
  array_push($fix_fields_names, fix_SQL_fieldname($campo));
  //echo fix_SQL_fieldname($campo);
  //echo "<hr>"; 
}
//echo fix_SQL_fieldname($fields[3]);
echo "<br><br><hr><pre>";
print_r($fix_fields_names);
echo "</pre>";
echo "<hr>";

?>
<?php 
if($_SERVER['HTTP_HOST'] == 'localhost' or strpos($_SERVER['HTTP_HOST'],"192.168") !== false) {
  // Change this to your connection info.
  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = '';
  $DATABASE_NAME = 'escala_db';
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

?>
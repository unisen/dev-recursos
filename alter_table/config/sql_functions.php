<?php

function getColoumn($table) {

    $result = mysqli_query("SHOW COLUMNS FROM ". $table);
    
     if (!$result) {
    
       echo 'Could not run query: ' . mysql_error();
    
     }
    
     $fieldnames=array();
    
     if (mysqli_num_rows($result) > 0) {
    
       while ($row = mysqli_fetch_assoc($result)) {
    
         $fieldnames[] = $row['Field'];
    
       }
    
     }
     
     return $fieldnames;
    
    }
    
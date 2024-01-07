<?php 
 
// Database configuration  
$dbHost     = "localhost";  
$dbUsername = "root";  
$dbPassword = "";  
$dbName     = "escala_db";  
  
// Create database connection  
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);  
  
// Check connection  
if ($db->connect_error) {  
    die("Connection failed: " . $db->connect_error);  
} 
 
if(!empty($_GET['type']) && $_GET['type'] == 'user_search'){ 
    $search_term = !empty($_GET['search'])?$_GET['search']:''; 
 
    // Fetch matched data from the database  
    $query = $db->query("SELECT * FROM tbl_associados WHERE nome_completo LIKE '%".$search_term."%' AND status = 'ATIVO' ORDER BY nome_completo ASC");  
     
    // Generate array with filtered records  
    $usersData = array();  
    if($query->num_rows > 0){  
        while($row = $query->fetch_assoc()){  
            $data['id'] = $row['id'];  
            $data['text'] = $row['nome_completo'];  
            array_push($usersData, $data);  
        }  
    }  
     
    // Return results as json encoded array  
    echo json_encode($usersData);  
} 
 
?>
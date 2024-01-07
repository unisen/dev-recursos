<?php
// Include the database configuration file
require_once 'dbConfig.php';

$editorContent = $statusMsg = '';

// If the form is submitted
if(isset($_POST['submit'])){
    // Get editor content
    $editorContent = utf8_decode($_POST['editor']);
    
    // Check whether the editor content is empty
    if(!empty($editorContent)){
        // Insert editor content in the database
        $insert = $db->query("INSERT INTO editor (content, created) VALUES ('".$editorContent."', NOW())");
        
        // If database insertion is successful
        if($insert){
            $statusMsg = "The editor content has been inserted successfully.";
        }else{
            $statusMsg = "Some problem occurred, please try again.";
        } 
    }else{
        $statusMsg = 'Please add content in the editor.';
    }
}
?>
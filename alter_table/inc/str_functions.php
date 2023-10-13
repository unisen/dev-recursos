<?php

function tirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(ç)/","/(Ç)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n c c N"),$string);
}


// convert illegal input value to ligal value formate
function legal_input($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

function fix_SQL_fieldname ($fieldname) {
    //$new_fieldname = legal_input($fieldname);
    $new_fieldname = tirarAcentos($fieldname);
    $new_fieldname = str_replace(" ", "_", $new_fieldname);
    $new_fieldname = str_replace("-", "_", $new_fieldname);
    $new_fieldname = str_replace("/", "_", $new_fieldname);
    $new_fieldname = str_replace("\\", "_", $new_fieldname);
    $new_fieldname = strtolower($new_fieldname);
    return $new_fieldname;    
}


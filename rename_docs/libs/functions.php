<?php

function tirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

/* function criarPasta($pasta) {
    if()

} */
function diretorioCadastrante($diretorio) {
    $diretorio = date('m-Y') . '/';
    $arquivo   = $_FILES['arquivo']['name'];

    if(!is_dir($diretorio)){
    mkdir($diretorio, 0700);
    }

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . basename($arquivo));

    $link = __DIR__ .$diretorio.$arquivo;

    print_r($link);
}

function nome_abreviado($nome_completo)
{
    $arrNomeCompleto = explode(" ",strtolower($nome_completo));
    
    $nome_abreviado = "";
    $i = 0;   
    
    while($i < count($arrNomeCompleto)) {
    
    	  $item = $arrNomeCompleto[$i];
          
    	  if (strlen($item) == 2) {
         	$i++;
          }
          if ($i == 0) {
              $nome_abreviado .= ucfirst($arrNomeCompleto[0]) . " ";
          }
          elseif ($i == (count($arrNomeCompleto)-1)) {
              $nome_abreviado .= ucfirst($arrNomeCompleto[$i]);
          }
          else {
              $nome_abreviado .= ucfirst($arrNomeCompleto[$i][0]) . ". ";
          }    	
          $i++;      
    }
    return $nome_abreviado;
}

/* FUNCAO DE QUEBRAR URL PARAMETROS
$parametros = "?confirmacao=650105653efe1889977GO&page=2";

if(strpos($parametros, "&") !== false){
  $lista_params = explode("&", $parametros);
  $params = $lista_params[0];
  $tempArray = explode("=",$params);
  
  $param1 = $tempArray[0];
  $value1 = $tempArray[1];
  
  $params = $lista_params[1];
  $tempArray = explode("=",$params);
  
  $param2 = $tempArray[0];
  $value2 = $tempArray[1];
  
  echo $param1 . ": " . $value1;
  echo "<br>" . $param2 . ": ". $value2;  
}
else {
	$tempArray = explode("=",$parametros);
    $param1 = $tempArray[0];
  $value1 = $tempArray[1];
  echo $param1 . ": " . $value1;
} */

?>
<?php
$to = 'usuário@exemplo.com'; 
$from = 'remetente@exemplo.com'; 
$fromName = 'NomeRemetente'; 
$subject = "Enviar e-mail HTML em PHP pela CodexWorld"; 
 
/* $htmlContent  =  ' 
    <html> 
    <head> 
        <title>Bem-vindo ao CodexWorld</title> 
    </head> 
    <body> 
        <h1>Obrigado por se juntar a nós!</h1> 
        <table cellpacing="0" style= "borda: 2px tracejado #FB4314; largura: 100%;"> 
            <tr> 
                <th>Nome:</th><td>CodexWorld</td> 
            </tr> 
            <tr style="background-color: #e0e0e0 ;"> 
                <th>E-mail:</th><td>contact@codexworld.com</td> 
            </tr> 
            <tr> 
                <th>Site:</th><td><a href="http: //www.codexworld.com">www.codexworld.com</a></td> 
            </tr> 
        </table> 
    </body> 
    </html>' ; 
 */ 
// Obtém o conteúdo HTML do arquivo 
$htmlContent  =  file_get_contents ( "email_template.html" );

// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
$headers .= 'Cc: welcome@example.com' . "\r\n"; 
$headers .= 'Bcc: welcome2@example.com' . "\r\n"; 
 
// Enviar e-mail 
if( mail ( $to ,  $subject ,  $htmlContent ,  $headers )){ 
    echo 'E-mail enviado com sucesso.'; 
}else{ 
   echo 'Falha no envio de e-mail.'; 
}
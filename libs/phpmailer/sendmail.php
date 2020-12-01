<?php

require_once("class.phpmailer.php");

$mail = new PHPMailer(true);

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');

$mail->IsSMTP(); 

try {
     $mail->Host = 'mail.lubnorteam.com.br'; 
     $mail->SMTPAuth   = true; 
     $mail->Port       = 587;
     $mail->Username = 'teste2@lubnorteam.com.br'; 
     $mail->Password = 'teste123@-@-'; 
     
    
     $mail->SetFrom('teste2@lubnorteam.com.br', 'Site LUBNORTE'); 
     $mail->Subject = 'Contato via Formulario de Sistema';
     

     $mail->AddAddress('teol.melara@lubnorteam.com.br', 'Teol Melara - LUBNORTE');

     
     $archive = "<style type='text/css'>
     body {
      margin:0px;
      font-family:Verdana;
      font-size:12px;
      color: #666666;
    }
    a{
      color: #666666;
      text-decoration: none;
    }
    a:hover {
      color: #FF0000;
      text-decoration: none;
    }
    </style>
    <html>
    <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
        <tr>
            <td width='500'>Formulário de Contato via Site LUBNORTE</td>
        </tr>
        <tr>
            <td width='500'>Nome:$name</td>
        </tr>

        <tr>
            <td width='320'>E-mail:<b>$email</b></td>
        </tr>
        
        <tr>
            <td width='320'>Telefone:<b>$phone</b></td>
        </tr>
        
        <tr>
            <td width='320'>Mensagem:$message</td>
        </tr>  
        
        <tr>
            <td>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></td>
        </tr>
    
    </table>
    </html>";

    
    $mail->MsgHTML($archive); 
    
   
    $mail->Send();
    echo "<script>window.alert('Mensagem enviada com sucesso!'); location.href='../';</script>";
    
   
  }catch (phpmailerException $e) {
      echo $e->errorMessage(); 
    }

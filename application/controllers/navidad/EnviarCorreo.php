<?php

  require_once 'Zend/Mail.php';  
  require_once 'Zend/Mail/Transport/Smtp.php';


  $user = 'jjrosales@estudiantes.uci.cu';
  $pass ='passsworddelcorreo';
   
   $mail = new Zend_Mail ();  

   $transport_config = array ('auth' => 'login',
     'username' => $user,
     'password' => $pass,
     'ssl'      => 'tls',
     'port'     => 25);
      
   $from         = 'jjrosales@estudiantes.uci.cu';
   $msg	         = 'Hola';   
   $subject	 = 'Asunto';   
   $to           = 'jjrosales@estudiantes.uci.cu';
   
   $transport = new Zend_Mail_Transport_Smtp('smtp.uci.cu', $transport_config);

   $mail->setDefaultTransport ($transport);
   $mail->setBodyHtml(utf8_decode($msg));
   $mail->setFrom($user,$from);
   $mail->addTo($to, 'Some Recipient');
   $mail->setSubject($subject);
   $mail->send();

   die();


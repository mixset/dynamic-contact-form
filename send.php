<?php
/*

// Author: Dominik Ryńko
// Email: dominikrynko@gmail.com
// Website: http://www.rynko.pl/
// Description:   Skrypt wysyłający wiadomość na E-maila za pomocą biblioteki PHPMailer. 
                  Dodatkowo walidacja danych po stronie servera w razie gdyby użytkownik miał wyłączone JavaScript.
// Version: 1.0
// Wszystkie prawa zastrzeżone
*/

header('Content-Type: text/html; charset=UTF-8');

if(phpversion() <= '5.0.0')
 die('Twój server musi obsługiwać PHP w wersji 5.0.0 lub większej!');

if(get_magic_quotes_gpc() == true) 
 ini_set('magic_quotes_gpc', 'off');
		
error_reporting(0); // wyświetlanie błędów jest wyłączone. Aby włączyć wyświetlanie błędów zamiast 0 wpis E_ALL

ini_set('display_error', "0"); // 0 -> wyświetlanie błędów jest wyłączone, 1 -> wyświetlanie błędów jest włączone.

define('SCRIPT', '1');

if(SCRIPT == 0)
 die('Skrypt zablokowany. Stała SCRIPT ma wartość 0');
 
 
$name    = strip_tags($_POST['name']); // Filtracja danych za pomocą strip_tags() - usuwa znaki HTML
$email   = strip_tags($_POST['email']);
$message = strip_tags($_POST['message']);

if(empty($_POST))
 return 'Formularz nie został wysłany.';
elseif(!is_array($_POST)) 
 return '$_POST nie jest tablicą. Możliwy atak!';
elseif(!is_string($name) || !is_string($email) || !is_string($message))
 return 'Zmienna $name, $email lub $message nie są typu string. Możliwy atak!';
elseif(empty($name) || empty($email) || empty($message))
 return 'Wypełnij wszystkie pola.';
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
 return 'Wpisz poprawny adres E-mail.';
elseif(strlen($message) < 5)
 return 'Wiadomość nie może być krótsza niż 5 znaków.';
elseif($_SERVER['HTTP_HOST'] !== 'skryptoteka.rynko.pl') 
 return 'Wiadomość próbuje zostać wysłana z strony innej niż rynko.pl. Możliwy atak!';
elseif($_SERVER['REQUEST_METHOD'] !== 'POST')
 return 'Wiadomość musi zostać przesłana metodą POST. Możliwy atak!';
else
{
 $address_ip = $_SERVER['REMOTE_ADDR'];
 $user_data  = $_SERVER['HTTP_USER_AGENT'];

  require_once('PHPMailer/class.phpmailer.php');
$mail             = new PHPMailer(); // jeśli w argumentach wpiszemy true zostaną wyświetlone błędy.
$mail->IsSMTP();
$mail->Host       = "our_mail@our_website.pl";
$mail->SMTPDebug  = 0;            
$mail->AddAddress($email, "Imię i nazwisko");                          
$mail->SMTPAuth   = true;                  
$mail->SMTPSecure = "tls";                 
$mail->Host       = "smtp.gmail.com";      
$mail->Port       = 587;                   
$mail->Username   = "nasz_adres_gmail";  
$mail->Password   = "nasze_haslo_do_gmaila";            
   $mail->MsgHTML("
      <p>Adresat: <strong>$name</strong> </p>
      <p>E-mail: <strong>$email</strong></p>
      <p>Wiadomość: $message</p>
      <br><br> 
      <p>Adres IP: <strong>$address_ip</strong></p>
      <p>USER_AGENT: <strong>$user_data</strong></p> 	    

	");
   $mail -> Send();
  if($mail)
   echo 'Pomyślnie wysłano wiadomość.';  
}	 

?>
<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

$_POST = $_GET;

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$email = $_POST['email'];
// Формирование самого письма
if(isset($_POST['newsletter__button'])){
    $title = "Новое обращение Best Tour Plan";
    $body = "<b>e-mail: </b><br>$email";
};
if (isset($_POST['footer__button'])) {
    $title = "Новое обращение Best Tour Plan";
    $body = "
    <h2>Новое обращени</h2>
    <b>Имя: </b> $name <br>
    <b>Телефон: </b> $phone<br><br>
    <b>Сообщение: </b><br>$message
    ";
}

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'krempinatatyana@gmail.com'; // Логин на почте islamov.glo.academy@gmail.com
    $mail->Password   = 'pkqpwttbmczbahik'; // Пароль на почте n^fB0RZ]j6oqu|t%X
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('krempinatatyana@gmail.com'); // Адрес самой почты и имя отправителя islamov.glo.academy@gmail.com Артем Исламов

    // Получатель письма
    $mail->addAddress('krempina95@yandex.ru'); // Ещё один, если нужен

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
header('Location: thankyou.html');

//echo "<pre>".print_r($GLOBALS, true)."</pre>";
?>
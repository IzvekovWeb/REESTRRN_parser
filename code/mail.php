<?php 

require 'libs/PHPMailer/src/Exception.php';
require 'libs/PHPMailer/src/PHPMailer.php';
require 'libs/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function send_mail($news, $DEBUG=true){
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';

    $yourEmail = 'reestr.parser@yandex.ru'; // ваш email на яндексе
    $password = 'z4bJG4Gl'; // ваш пароль к яндексу или пароль приложения

    // настройки SMTP
    $mail->Mailer = 'smtp';
    $mail->Host = 'ssl://smtp.yandex.ru';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = $yourEmail; // ваш email - тот же что и в поле From:
    $mail->Password = $password; // ваш пароль;


    // формируем письмо

    // от кого: это поле должно быть равно вашему email иначе будет ошибка
    $mail->setFrom($yourEmail, 'Новостная рассылка');

    // кому - получатель письма
        $mail->addAddress('reestr.parser@yandex.ru', 'Parser');
        // $mail->addAddress('aizvekov@reestrrn.ru', 'Извеков Александр Дмитриевич');
        $mail->addAddress('mbushuev@reestrrn.ru', 'Бушуев Михаил Игоревич');

    $mail->Subject = 'Последние новости';  // тема письма

    $message = create_mail($news);

    $mail->msgHTML($message);


    if ($mail->send()) { // отправляем письмо
        echo 'Письмо отправлено!';
    } else {
        echo 'Ошибка: ' . $mail->ErrorInfo;
    }
}


function create_mail($items){
    $message = "<html><body>";
    foreach ($items as $item){
        $message .= "<div>" . $item ;
    }
    $message .= "</body></html>";
    return $message;
}
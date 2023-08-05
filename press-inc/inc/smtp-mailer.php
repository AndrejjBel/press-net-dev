<?php
use PHPMailer\PHPMailer\PHPMailer;
function press_net_send_smtp_email( PHPMailer $phpmailer ) {
  $phpmailer->isSMTP();
  $phpmailer->Host       = SMTP_HOST;
  $phpmailer->SMTPAuth   = SMTP_AUTH;
  $phpmailer->Port       = SMTP_PORT;
  $phpmailer->Username   = SMTP_USER;
  $phpmailer->Password   = SMTP_PASS;
  $phpmailer->SMTPSecure = SMTP_SECURE;
  $phpmailer->From       = SMTP_FROM;
  $phpmailer->FromName   = SMTP_NAME;
}
// add_action( 'phpmailer_init', 'press_net_send_smtp_email' );


// // Имя пользователя для SMTP авторизации
// define( 'SMTP_USER', 'user@example.com' );
// // Пароль пользователя для SMTP авторизации
// define( 'SMTP_PASS', 'smtp password' );
// // Хост почтового сервера
// define( 'SMTP_HOST', 'smtp.example.com' );
// // Обратный Email
// define( 'SMTP_FROM', 'website@example.com' );
// // Имя для обратного мыла
// define( 'SMTP_NAME', 'Вася Пупкин' );
// // Номер порта (25, 465, 587)
// define( 'SMTP_PORT', '25' );
// // Тип шифиования (ssl или tls)
// define( 'SMTP_SECURE', 'tls' );
// // Включение/отключение шифрования
// define( 'SMTP_AUTH', true );
// // Режим отладки (0, 1, 2)
// define( 'SMTP_DEBUG', 0 );


//Отправка в Телеграм
define('TELEGRAM_TOKEN', '5827265567:AAG3vIStamk1AWXwGBR-xPVF4XsCoRU8978');
// сюда нужно вписать ваш внутренний айдишник
define('TELEGRAM_CHATID', '477875115');
//message_to_telegram($msgotpravtel);

function message_to_telegram($text, $chatid) {
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => $chatid, // TELEGRAM_CHATID
                'text' => $text,
            ),
        )
    );
    curl_exec($ch);
}

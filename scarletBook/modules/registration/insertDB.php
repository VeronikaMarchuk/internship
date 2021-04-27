<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?
$login = $_POST['login'];
$pass = $_POST['password'];
$mail = $_POST['mail'];
$date = $_POST['birthday'];
$photo = $_POST['src'];
$salt = mt_rand(100, 999);
$pass = md5(md5($pass).$salt);
$hash = md5($login . time());
include '../../connect/connection.php'; //подключаемся к БД

// Переменная $headers нужна для Email заголовка
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "To: <$mail>\r\n";
        $headers .= "From: <aliceneklan@gmail.com>\r\n";
// Сообщение для Email
        $message = '
                <html>
                <head>
                <title>Подтвердите Email</title>
                </head>
                <body>
                <p>Что бы подтвердить Email, перейдите по <a href="http://scarletbook/modules/comfirmed.php?hash=' . $hash . '">ссылка</a></p>
                </body>
                </html>
                ';

$query = "INSERT INTO users (login, email, password, salt, hash, birthday, photo, email_confirmed) VALUES ('$login','$mail','$pass','$salt','$hash','$date','$photo','0')";

if (mail($mail, "Подтвердите Email на сайте", $message, 'From: aliceneklan@gmail.com')) {
            // Если да, то выводит сообщение
            echo 'Подтвердите на почте';
        }

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if ($result) {
            $query = "SELECT * FROM users WHERE login='$login'";
            $rez = mysqli_query($link, $query);
            if ($rez) {
                $row = mysqli_fetch_assoc($rez);
                $_SESSION['id'] = $row['id'];
                $_SESSION['login'] = $row['login'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['salt'] = $row['salt'];
                $_SESSION['birthday'] = $row['birthday'];
                $_SESSION['photo'] = $row['photo'];
                mysqli_close($link);
                print "<script language='Javascript'
type='text/javascript'>
 function reload(){top.location =
'../../index.php'};
 setTimeout('reload()', 0);
</script>";
            }
    }
?>
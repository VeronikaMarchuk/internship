<?php
// Подключаем коннект к БД
include '../connect/connection.php';

// Проверяем нажата ли кнопка отправки формы
if (isset($_REQUEST['doGo'])) {

    // Все последующие проверки, проверяют форму и выводят ошибку
    // Проверка на совпадение паролей
    if ($_REQUEST['pass'] !== $_REQUEST['pass_rep']) {
        $error = 'Пароль не совпадает';
    }

    // Проверка есть ли вообще повторный пароль
    if (!$_REQUEST['pass_rep']) {
        $error = 'Введите повторный пароль';
    }

    // Проверка есть ли пароль
    if (!$_REQUEST['pass']) {
        $error = 'Введите пароль';
    }

    // Проверка есть ли email
    if (!$_REQUEST['email']) {
        $error = 'Введите email';
    }

    // Проверка есть ли логин
    if (!$_REQUEST['login']) {
        $error = 'Введите login';
    }

    // Если ошибок нет, то происходит регистрация
    if (!$error) {
        $login = $_REQUEST['login'];
        $email = $_REQUEST['email'];
        // Пароль хешируется
        $pass = password_hash($_REQUEST['pass'], PASSWORD_DEFAULT);
        // хешируем хеш, который состоит из логина и времени
        $hash = md5($login . time());

        // Переменная $headers нужна для Email заголовка
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "To: <$email>\r\n";
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

        // Добавление пользователя в БД
        $query="INSERT INTO users (login, email, password, hash, email_confirmed) VALUES ('$login','$email','$pass','$hash','0')";
//        mysqli_query($link, "INSERT INTO `users` (`login`, `email`, `password`, `hash`, `email_confirmed`) VALUES ('" . $login . "','" . $email . "','" . $pass . "', '" . $hash . "', 1)");
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        // проверяет отправилась ли почта
        if (mail($email, "Подтвердите Email на сайте", $message, 'From: aliceneklan@gmail.com')) {
            // Если да, то выводит сообщение
            echo 'Подтвердите на почте';
        }
        mysqli_close($link);
    } else {
        // Если ошибка есть, то выводить её
        echo $error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
</head>
<body>
<form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="post">
    <p>Логин: <input type="text" name="login"> <samp style="color:red">*</samp></p>
    <p>EMail: <input type="email" name="email"><samp style="color:red">*</samp></p>
    <p>Пароль: <input type="password" name="pass"><samp style="color:red">*</samp></p>
    <p>Повторите пароль: <input type="password" name="pass_rep"><samp style="color:red">*</samp></p>
    <p><input type="submit" value="Зарегистрироваться" name="doGo"></p>
</form>
</body>
</html>
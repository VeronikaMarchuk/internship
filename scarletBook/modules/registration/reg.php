<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>

<?
//if (isset($_POST['login'])) {
//    $login = $_POST['login'];
//    if ($login == '') { unset($login);}
//}
//
//if (isset($_POST['password'])) {
//    $password=$_POST['password'];
//    if ($password =='') { unset($password);}
//}
//
//if (isset($_POST['password2'])) {
//    $password2=$_POST['password2'];
//    if ($password2 =='') { unset($password2);}
//}
//
//if (isset($_POST['email'])) {
//    $email=$_POST['email'];
//    if ($email =='') { unset($email);}
//}
//
//if (isset($_POST['date'])) {
//    $birthday = $_POST['date'];
//    if($birthday == '') {unset($birthday);}
//}
//
//if(isset($_POST['file'])){
//    $file = $_POST['file'];
//    if($file == '') {unset($file);}
//}
//if(isset($_POST['submit'])) {
    $login = $_POST['login'];
    include '../../connect/connection.php'; //подключаемся к БД

    $query = "SELECT id FROM users WHERE login='$login'";

    $result = mysqli_query($link, $query) or die("Ошибка выполнения запроса" . mysqli_error($link));
    if ($result) {
        $row = mysqli_fetch_row($result);
        if (!empty($row[0])) echo "Данный логин занят";
        else echo "Данный логин свободен";
    }
//    $e2 = null;
//    $password = trim($_POST["password"]);
//    $password = strip_tags($password);
//    $password = htmlspecialchars($password, ENT_QUOTES);
//    $password = stripslashes($password);
//    if (strlen($password) == "0") {
//        $e2 .= "Заполните поле 'Пароль'<br>";
//    }
//    $e3 = null;
//    $password2 = trim($_POST["password2"]);
//    $password2 = strip_tags($password2);
//    $password2 = htmlspecialchars($password2, ENT_QUOTES);
//    $password2 = stripslashes($password2);
//    if (strlen($password2) == "0") {
//        $e3 .= "Заполните поле 'Повторить пароль'<br>";
//    }
//    if ($password != $password2) {
//        $e2 .= "Пароли не совпадают<br>";
//    }
//    $e4 = null;
//    $email = trim($_POST["email"]);
//    $email = strip_tags($email);
//    $email = htmlspecialchars($email, ENT_QUOTES);
//    $email = stripslashes($email);
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//        $e4 .= "Неверный e-mail<br>";
//    }
//    $eEn = $e1 . $e2 . $e3 . $e4;
//    if ($eEn == "") {
//        $salt = mt_rand(100, 999);
//
//        $password = md5(md5($password) . $salt);
//        $hash = md5($login . time());
//
//// Переменная $headers нужна для Email заголовка
//        $headers = "MIME-Version: 1.0\r\n";
//        $headers .= "Content-type: text/html; charset=utf-8\r\n";
//        $headers .= "To: <$email>\r\n";
//        $headers .= "From: <aliceneklan@gmail.com>\r\n";
//// Сообщение для Email
//        $message = '
//                <html>
//                <head>
//                <title>Подтвердите Email</title>
//                </head>
//                <body>
//                <p>Что бы подтвердить Email, перейдите по <a href="http://scarletbook/modules/comfirmed.php?hash=' . $hash . '">ссылка</a></p>
//                </body>
//                </html>
//                ';
//
//        $query = "INSERT INTO users (login, email, password, salt, hash, birthday, photo, email_confirmed) VALUES ('$login','$email','$password','$salt','$hash','2000-11-11','$file','0')";
//
//        if (mail($email, "Подтвердите Email на сайте", $message, 'From: aliceneklan@gmail.com')) {
//            // Если да, то выводит сообщение
//            echo 'Подтвердите на почте';
//        }
//
//        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
//        if ($result) {
//            $query = "SELECT * FROM users WHERE login='$login'";
//            $rez = mysqli_query($link, $query);
//            if ($rez) {
//                echo "заносим в сессию";
//                $row = mysqli_fetch_assoc($rez);
//                $_SESSION['id'] = $row['id'];
//                $_SESSION['login'] = $row['login'];
//                $_SESSION['email'] = $row['email'];
//                $_SESSION['password'] = $row['password'];
//                $_SESSION['salt'] = $row['salt'];
//                $_SESSION['birthday'] = $row['birthday'];
//                $_SESSION['photo'] = $row['photo'];
//                echo "Вы успешно зарегистрированы, " . $_SESSION['login'];
//                mysqli_close($link);
//                print "<script language='Javascript'
//type='text/javascript'>
// function reload(){top.location =
//'../../index.php'};
// setTimeout('reload()', 0);
//</script>";
//            }
//        }
//    }


//}

?>




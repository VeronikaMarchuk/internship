<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
$login = $_POST['login'];
    $password = $_POST['password'];
    $cod = $_POST['cod'];
if (empty($login) or empty($password)) {
    echo 'Вы заполнили не все поля!';
}
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$login = trim($login);
$password = trim($password);
$_SESSION['temp_login'] = $login;
include '../../connect/connection.php';



$message = rand(68412358, 848678584455555);
$query = "SELECT * FROM users WHERE login='$login'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);
if (empty($row['id'])) {
    mysqli_close($link);
    echo 'Такого логина не существует!';
} else {
    if ($row['password'] == md5(md5($password) . $row['salt'])) {
//        if (mail($row['email'], "Код доступа ", $message, 'From: aliceneklan@gmail.com')) {
//            $mail =$row['email'];
//            $headers = "MIME-Version: 1.0\r\n";
//            $headers .= "Content-type: text/html; charset=utf-8\r\n";
//            $headers .= "To: <$mail>\r\n";
//            $headers .= "From: <aliceneklan@gmail.com>\r\n";
//// Сообщение для Email
//
//            $_SESSION['id'] = $row['id'];
//            $_SESSION['login'] = $row['login'];
//
//            $_SESSION['password'] = $row['password'];
//
//        }
//        if($cod == $message){
////            $_SESSION['id'] = $row['id'];
////            $_SESSION['login'] = $row['login'];
//
//            $_SESSION['password'] = $row['password'];
//            $_SESSION['email'] = $row['email'];
//            $_SESSION['salt'] = $row['salt'];
//            $_SESSION['birthday'] = $row['birthday'];
//            $_SESSION['photo'] = $row['photo'];
//        print "<script language='Javascript'
//type='text/javascript'>
// function reload(){top.location = '../../index.php'};
// setTimeout('reload()', 0)
// </script>";
//        }
//        else{
            $_SESSION['id'] = $row['id'];
            $_SESSION['login'] = $row['login'];

            $_SESSION['password'] = $row['password'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['salt'] = $row['salt'];
            $_SESSION['birthday'] = $row['birthday'];
            $_SESSION['photo'] = $row['photo'];
            print "<script language='Javascript'
type='text/javascript'>
 function reload(){top.location = '../../index.php'};
 setTimeout('reload()', 0)
 </script>";
//            $_SESSION['id'] = '';
//            $_SESSION['login'] = '';
//            echo 'Неверный код';
//        }
//        echo '<input id="cod" type="text">';

    } else {
       echo 'Вы ввели не правильный пароль!';
    }
    mysqli_close($link);
}

?>
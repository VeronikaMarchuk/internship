<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
require '../../connect/connection.php';
$id = $_POST['id'];
$sql = "DELETE FROM `comments` where idComment=".$id;
$res=mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
$sql = "DELETE FROM `comments` where parent=".$id;
$res=mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

$query = "SELECT  * FROM `comments` inner JOIN `users` on `comments`.idUser=`users`.id WHERE `comments`.idStory=" . $_SESSION['idStory'] . " and  `comments`.parent=0 order by `comments`.date desc";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);
do {
    $str1 = "<div><img class='photo' src='" . $row['photo'] . "'><div><p>" . $row['date'] . "</p><p>" . $row['text'] . "</p>";
    if ($_SESSION['login'] != '') {
        $str1 .= "<button onclick='answer(this, " . $row['idComment'] . ", " . $row['idComment'] . ")'>Ответить</button>";
    }
    if ($_SESSION['id'] == $row['idUser']) {
        $str1 .= "<button onclick='deleteComment(" . $row['idComment'] . ")'>Удалить</button>";
    }
    $str1 .= "</div>";
    $echo.= $str1;
    $query2 = "SELECT  * FROM `comments` inner JOIN `users` on `comments`.idUser=`users`.id WHERE `comments`.idStory=" . $_SESSION['idStory'] . " and  `comments`.mainParent=" . $row['idComment'];
    $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
    $row2 = mysqli_fetch_assoc($result2);
    $echo.= "<div class='com2'>";
    do {
        if (sizeof($row2) != 0) {
            $query3 = "SELECT  * FROM `users` idUser=" . $row2['parent'];
            $result3 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
            $row3 = mysqli_fetch_assoc($result3);
            $str2 = "<img class='photo' src='" . $row2['photo'] . "'><div><p>" . $row3['login'] . "</p><p>" . $row2['date'] . "</p><p>" . $row2['text'] . "</p>";
            if ($_SESSION['login'] != '') {
                $str2 .= "<button onclick='answer(this," . $row2['idComment'] . ", " . $row['idComment'] . ")'>Ответить</button>";
            }
            if ($_SESSION['id'] == $row2['idUser']) {
                $str2 .= "<button onclick='deleteComment(" . $row2['idComment'] . ")'>Удалить</button>";
            }
            $echo.= $str2 . "</div>";
        }
    } while ($row2 = mysqli_fetch_assoc($result2));
    $echo.= "</div>";
} while ($row = mysqli_fetch_assoc($result));

echo $echo;
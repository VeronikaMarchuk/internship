<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include '../../connect/connection.php';
$comment = $_POST['comment'];
$parent = $_POST['idCom'];
$mainParent = $_POST['parent'];
$date = date("y-m-d");

if($mainParent > 0){
    $query0 = "INSERT INTO comments (idStory, idUser, date, text, parent, mainParent) VALUES ('" . $_SESSION['idStory'] . "','" . $_SESSION['id'] . "', '$date','$comment', '$parent', '$mainParent')";
    $result0 = mysqli_query($link, $query0) or die("Ошибка " . mysqli_error($link));

    $sql = "SELECT  count(*) FROM `comments` inner JOIN `users` on `comments`.idUser=`users`.id WHERE `comments`.idStory=".$_SESSION['idStory']." and  `comments`.parent=0";
    $res = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    $row0 = mysqli_fetch_assoc($res);
    do
    {
        $count = $row0['count(*)'];
    }while($row0 = mysqli_fetch_assoc($res));
    if($count != 0) {
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
    }
}
else {

    $query0 = "INSERT INTO comments (idStory, idUser, date, text, parent, mainParent) VALUES ('" . $_SESSION['idStory'] . "','" . $_SESSION['id'] . "', '$date','$comment', 0, 0)";
    $result0 = mysqli_query($link, $query0) or die("Ошибка " . mysqli_error($link));

    $sql = "SELECT  count(*) FROM `comments` inner JOIN `users` on `comments`.idUser=`users`.id WHERE `comments`.idStory=".$_SESSION['idStory']." and  `comments`.parent=0";
    $res = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    $row0 = mysqli_fetch_assoc($res);
    do
    {
        $count = $row0['count(*)'];
    }while($row0 = mysqli_fetch_assoc($res));
    if($count != 0) {
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
    }
}

echo $echo;
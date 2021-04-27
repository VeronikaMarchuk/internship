<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
$idStory = $_GET['idStory'];
$_SESSION['idStory'] = $idStory;
require 'connect/connection.php';
$query = "SELECT * FROM story where id=".$idStory;
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);
do
{
    $_SESSION['imgStory'] = $row['img'];
    $_SESSION['author'] = $row['author'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['discription'] = $row['discription'];
    $_SESSION['status'] = $row['status'];
}
while($row = mysqli_fetch_assoc($result));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="JS/jquery-ui-1.12.1/jquery-3.2.1.min.js"></script>
    <script src="JS/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <meta charset="utf-8">
    <style>
        * {box-sizing: border-box; font-family: Verdana}
        body{
            margin: 0;
        }
        .container{
            display: flex;
            width: 100%;
            justify-content: space-between;
            margin: 0 auto;
        }
        .logo{
            background-image: url("img/logo.svg");
            width: 56px;
            height: 44px;
        }

        .header-inner{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /*<--nav-->*/
        nav{
            font-family: Verdana;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        nav a {
            display: block;
            text-decoration: none;
            outline: none;
            transition: .4s ease-in-out;
        }
        .nav-li{
            display: inline-block;
            position: relative;
        }
        .nav-li>a{
            font-family: Verdana;
            font-size: 14pt;
            height: 70px;
            line-height: 70px;
            padding: 0 30px;
            color: #000;
        }
        .nav-li:hover{
            color: black;
        }
        .ganres{
            background: white;
            border: 1px solid #000;
            position: absolute;
            left: 0;
            visibility: hidden;
            opacity: 0;
            z-index: 5;
            width: 150px;
            transform: perspective(600px) rotateX(-90deg);
            transform-origin: 0% 0%;
            transition: .6s ease-in-out;
        }
        .nav-li:hover .ganres{
            visibility: visible;
            opacity: 1;
            transform: perspective(600px) rotateX(0deg);
        }
        .ganres-li a{
            color: black;
            font-size: 13pt;
            line-height: 36px;
            padding: 0 25px;
        }
        .ganres-li:hover{
            font-weight: bold;
        }


        .search{
            display: flex;
            justify-content: space-evenly;
            border: 2px solid #B1B1B1 ;
            border-radius: 25px;
            height: 24px;
            width: 197px;
        }
        .search img{
            width: 15.3px;
            height: auto;
        }
        .search input{
            outline: none;
            border: none;
            background-color: rgba(255, 255, 255, 0);
        }
        /*jhgvfcdxfcvgbh*/
        #display{
            background: white;
            border: 1px solid #000;
            position: absolute;
            left: 0;
            visibility: hidden;
            opacity: 0;
            z-index: 5;
            width: 350px;
        }

        .user{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .username{
            font-family: Verdana;
            font-size: 14pt;
            color: black;
        }
        .photo{
            border-radius: 100%;
            background: aqua;
            width: 33px;
            height: 33px;
        }
        /*<--nav-->*/
        hr{
            width: 100%;
            height: 2px;
            color: #474545;
            background-color: #474545;
            margin-bottom: 0;
        }

        .section{
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            align-items: center;
        }
        .container2{
            width: 840px;
            display: flex;
            justify-content: space-between;
        }
        .com{
            margin-left: 0px;
        }

        #imageStory{
            height: 300px;
            width: 200px;
        }
        h1{
            color: #333333;
            line-height: 18pt;
            margin: 0;
        }
        .author{
            display: flex;

            font-size: 20pt;
            align-items: center;
        }

        .author img{
            width: 54px;
            height: 54px;
            border-radius: 50%;
        }
        .author p{
            padding-left: 20px;
        }
        .storyDescription{
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            padding-left: 20px;
        }
        .status{
            width: 120px;
            border-radius: 12px;
            background-color: #F6BEBE;
            color: #333333;
            padding: 5px 15px;
        }
        .like{
            display: flex;
        }
        .ganre{
            display: flex;
        }
        .ganre p{
            padding: 5px 10px;
            border: black;
            background-color: #CACACA;
            border-radius: 24px;
        }

        .read button{
            background-color: #FF2400;
            border: none;
            border-radius: 24px;
            padding: 5px 15px;
            font-size: 14pt;
            color: white;
            font-weight: bold;
        }
        .description{
            font-size: 18pt;
            color: #4D4D4D;
            line-height: 24pt;
        }
        .contents p{
            font-size: 16pt;
            padding: 0;
            color: #4D4D4D;
            margin: 0;
        }
        .chapters{
            font-size: 18pt;
        }
        .hr{
            height: 3pt;
            background-color: #FF2400;
            border: none;
        }
        .info{
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .infoUser{
            display: flex;
            justify-content: space-around;
        }
        #textComment{
            width: 750px;
            resize: none;
            overflow: hidden;
            font-size: 10pt;
            min-height: 70px;
            border-color: #B1B1B1;
            border-radius: 15px;
        }
        .send input{
            background-color: #FF2400;
            border: none;
            border-radius: 24px;
            padding: 5px 15px;
            font-size: 14pt;
            color: white;
        }
        .comments{
            display: flex;
            flex-direction: column;
        }
        .infoComment{
            display: flex;
            flex-direction: row;
            align-items: center;
            padding-right: 15px;
            font-size: 9pt;
        }
        .com2{
            display: flex;
            margin-left: 50px;
        }
    </style>
    <script src="JS/nav.js"></script>
</head>
<body>
<div class="container">
    <div class="header-inner">
        <a href="index.php"><div class="logo"></div></a>
        <nav class="nav">
            <ul class="nav-ul">
                <li class="nav-li">Жанры
                    <ul class="ganres">
                        <li class="ganres-li"><p onclick="searchRes('Романтика')">Романтика</p></li>
                        <li class="ganres-li"><p onclick="searchRes('Ужасы')">Ужасы</p></li>
                        <li class="ganres-li"><p onclick="searchRes('Приключения')">Приключения</p></li>
                        <li class="ganres-li"><p onclick="searchRes('Фантастика')">Фантастика</p></li>
                        <li class="ganres-li"><p onclick="searchRes('Мистика')">Мистика</p></li>
                        <li class="ganres-li"><p onclick="searchRes('Драма')">Драма</p></li>
                        <li class="ganres-li"><p onclick="searchRes('Детектив')">Детектив</p></li>
                        <li class="ganres-li"><p onclick="searchRes('Исторический')">Исторический</p></li>
                        <li class="ganres-li"><p onclick="searchRes('Боевик')">Боевик</p></li>
                        <li class="ganres-li"><p onclick="searchRes('Психология')">Психология</p></li>
                        <li class="ganres-li"><p onclick="searchRes('Стихи')">Стихи</p></li>
                    </ul>
                </li>
                <li class="nav-li">
                    <div class="search">
                        <img src="img/search.svg">
                        <input  type="search" class="searchText">
                    </div>
                    <div id="display"></div>
                </li>
            </ul>
        </nav>

    </div>
    <?
    if ($_SESSION['login']!='') { ?>
        <div class="user">
            <div class="username"><button class="log-out" onclick="logout()">Выход</button> / <?echo $_SESSION['login']?></div>
            <div class="photo"><img class="photo" src="<?echo $_SESSION['photo']?>" onclick="profile()"></div>
        </div>
    <? } else { ?>
        <div class="user">
            <div class="username"><button class="log-in" onclick="authModal()">Вход</button> / <button class="reg" onclick="regModal()">Регистрация</button></div>
            <div class="photo"></div>
        </div>

    <? } ?>

</div>
<hr>
<section class="section">
    <div class="container2">
        <div>
            <img id="imageStory" src="<? echo $_SESSION['imgStory']?>" >
        </div>
        <div class="storyDescription">
            <h1><?echo $_SESSION['name']?></h1>
            <div class="author">
                <?
                require 'connect/connection.php';
                $query = "SELECT login, photo FROM users where id=".$_SESSION['author'];
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                $row = mysqli_fetch_assoc($result);
                do
                {
                    echo "<img src=".$row['photo']."><p>".$row['login']."</p>";
                }
                while($row = mysqli_fetch_assoc($result));
                ?>
            </div>
            <div class="like">
                <img src="img/likeUnactive.svg" width="auto" height="15px">
            <?
            require 'connect/connection.php';
            $query = "SELECT count(*) FROM likes where idStory=".$_SESSION['idStory'];
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            $row = mysqli_fetch_assoc($result);
            $i =0;
            do
            {
                echo $row['count(*)'];
            }
            while($row = mysqli_fetch_assoc($result));

            ?>
            <img src="img/menu.svg" width="auto" height="15px">
            <?
            require 'connect/connection.php';
            $query = "SELECT count(*) FROM textofstory where idStory=".$_SESSION['idStory'];
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            $row = mysqli_fetch_assoc($result);
            $i =0;
            do
            {
                $countChapters = $row['count(*)'];
                echo $row['count(*)'];
            }
            while($row = mysqli_fetch_assoc($result));

            ?>
            </div>
            <div class="status"><? echo $_SESSION['status']?></div>
            <div class="ganre">
            <?php
            require 'connect/connection.php';
            $query = "SELECT ganre FROM ganres where idStory=".$_SESSION['idStory'];
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            $row = mysqli_fetch_assoc($result);
            do
            {
                echo "<p>".$row['ganre']."</p>";
            }
            while($row = mysqli_fetch_assoc($result));
            ?>
            </div>
            <div class="read">
                <button onclick="readStory()">Читать</button>
                <img src="img/markUnactive.svg" width="auto" height="25px">
            </div>
        </div>
    </div>
</section>
<br>
<div class="section">
    <div class="container2">
        <div class="description">
            <?echo $_SESSION['discription']?>
        </div>
    </div>
</div>
<br>
<div class="section">
    <div class="container2">
        <div class="contents">
            <div class="chapters">Оглавление</div>
            <hr class="hr">
            <?php
            require 'connect/connection.php';
            if($countChapters != 0) {
                $query = "SELECT * FROM textofstory where idStory=" . $_SESSION['idStory'];
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                $row = mysqli_fetch_assoc($result);
                do {
                    echo "<p onclick='readChapters(" . $row['id'] . ")'>Глава" . $row['chaptersN'] . "</p><hr>";
                } while ($row = mysqli_fetch_assoc($result));
            }
            else{
                echo '<p>В ожидании</p>';
            }
            ?>
        </div>
    </div>
</div>
<br>
<div class="section">
    <div class="container2">
        <div>
            <div class="info">
            <?
            if ($_SESSION['login']!='') { ?>
                    <div class="infoUser">
                <div class="photo"><img class="photo" src="<?echo $_SESSION['photo']?>"></div>
                <div><textarea id="textComment" name="text"></textarea></div>
                    </div>
                <div class="send"><input onclick="sendComment()" type="submit" value="Отправить"></div>
            <? } else { ?>
                <div>Чтобы оставить комментарий нужно авторизоваться</div>

            <? } ?>
            </div>

            <div class="comments">
<!--                --><?//
//                require 'connect/connection.php';
//                $query = "SELECT  * FROM `comments` inner JOIN `users` on `comments`.idUser=`users`.id WHERE `comments`.idStory=".$_SESSION['idStory']." order by `comments`.idComment desc";
//                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
//                if(!$result) {
//                    return NULL;
//                }
//                $arr_cat = array();
//                if(mysqli_num_rows($result) != 0) {
//
//                    //В цикле формируем массив
//                    for($i = 0; $i < mysqli_num_rows($result);$i++) {
//                        $row = mysqli_fetch_assoc($result);
//
//                        //Формируем массив, где ключами являются адишники на родительские категории
//                        if(empty($arr_cat[$row['parent']])) {
//                            $arr_cat[$row['parent']] = array();
//                        }
//                        $arr_cat[$row['parent']][] = $row;
//                    }
//                }
//                function view_cat($arr,$parent_id = 0) {
//
//                    //Условия выхода из рекурсии
//                    if(empty($arr[$parent_id])) {
//                        return;
//                    }
//                    $j=0;
//                    for($i = 0; $i < count($arr[$parent_id]);$i++) {
//                        if($arr[$parent_id][$i]['parent'] == 0) {
//                            echo "<div><img class='photo' src='" . $arr[$parent_id][$i]['photo'] . "'><div><p>" . $arr[$parent_id][$i]['date'] . "</p><p>" . $arr[$parent_id][$i]['text'] . "</p><button onclick='answer(" . $arr[$parent_id][$i]['idComment'] . ")'>Ответить</button></div>";
//                        }//рекурсия - проверяем нет ли дочерних категорий
//                        else{
//                            if($j==0){echo "<div class='com2'>"; $j++;}
//                            echo "<div><img class='photo' src='" . $arr[$parent_id][$i]['photo'] . "'><div><p>" . $arr[$parent_id][$i]['date'] . "</p><p>" . $arr[$parent_id][$i]['text'] . "</p><button onclick='answer(" . $arr[$parent_id][$i]['idComment'] . ")'>Ответить</button></div>";
//                            if($i==count($arr[$parent_id])-1){echo "</div>";}
//                        }
//                        view_cat($arr,$arr[$parent_id][$i]['idComment']);
//                    }
//
//
//                }
//                view_cat($arr_cat);
//                ?>

                <?
                require 'connect/connection.php';
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
                        $str1 = "<div class='infoComment'><img class='photo' src='" . $row['photo'] . "'><div>" . $row['date'] . "</div></div><div><p>" . $row['text'] . "</p>";
                        if ($_SESSION['login'] != '') {
                            $str1 .= "<button onclick='answer(this, " . $row['idComment'] . ", " . $row['idComment'] . ")'>Ответить</button>";
                        }
                        if ($_SESSION['id'] == $row['idUser']) {
                            $str1 .= "<button onclick='deleteComment(" . $row['idComment'] . ")'>Удалить</button>";
                        }
                        $str1 .= "</div>";
                        echo $str1;
                        $query2 = "SELECT  * FROM `comments` inner JOIN `users` on `comments`.idUser=`users`.id WHERE `comments`.idStory=" . $_SESSION['idStory'] . " and  `comments`.mainParent=" . $row['idComment'];
                        $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
                        $row2 = mysqli_fetch_assoc($result2);
                        echo "<div class='com2'>";
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
                                echo $str2 . "</div>";
                            }
                        } while ($row2 = mysqli_fetch_assoc($result2));
                        echo "</div>";
                    } while ($row = mysqli_fetch_assoc($result));
                }
                ?>



<!--            --><?php
//            require 'connect/connection.php';
//            $query = "SELECT  * FROM `comments` inner JOIN `users` on `comments`.idUser=`users`.id WHERE `comments`.idStory=".$_SESSION['idStory']." order by `comments`.id desc";
//            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
//            $row = mysqli_fetch_assoc($result);
//            do
//            {
//                if($_SESSION['login']!=''){
//                    echo "<div class='parentComment'><img class='photo' src='".$row['photo']."'><div><p>".$row['date']."</p><p>".$row['text']."</p><button onclick='answer(".$row['idComment'].")'>Ответить</button></div></div>";
//                }
//                else{
//                    echo "<div class='parentComment'><img class='photo' src='".$row['photo']."'><div><p>".$row['date']."</p><p>".$row['text']."</p></div></div>";
//                }
//            }
//            while($row = mysqli_fetch_assoc($result));
//            ?>
            </div>
        </div>
    </div>
</div>
<script src="JS/nav.js"></script>
<script>
    function readChapters(id) {
        document.location.href = `chapters.php?id=${id}`;
    }

	function answer(elem, id, parent){
		elem.parentNode.innerHTML += `<p><textarea id="textComment2" rows="10" cols="45" name="text"></textarea></p><p><input onclick="sendCommentAnswer(${id}, ${parent})" type="submit" value="Отправить"></p>`;
	}
    function sendCommentAnswer(id, parent){
        let comment = document.querySelector('#textComment2');
        alert(id+' '+ parent);
        $.post("modules/comments/comment.php", {comment: comment.value, idCom: id, parent: parent},
            function (data){
                $('.comments').html(data);
            }
        );
    }

	function deleteComment(id){
        alert(id);
        $.post("modules/comments/deleteComments.php", {id: id},
            function (data){
                $('.comments').html(data);
            }
        );
    }

	function sendComment(){
        let comment = document.querySelector('#textComment');
        $.post("modules/comments/comment.php", {comment: comment.value},
            function (data){
                $('.comments').prepend(data);
            }
        );
    }
</script>
</body>
</html>
<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include 'connect/connection.php';
$_SESSION['idChapters'] = $_GET['id'];
$query = "SELECT * FROM textofstory where idStory=".$_SESSION['idStory']." and id=".$_SESSION['idChapters'];
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);
do
{
    $_SESSION['chaptersN'] = $row['chaptersN'];
    $_SESSION['nameChapters'] = 'Глава '.$_SESSION['chaptersN'];
    $_SESSION['text'] = $row['text'];
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
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .infoChapters{
            display: flex;
            flex-direction: column;
        }
        .nameChapters{
            text-align: center;
            font-size: 36pt;
            color: #4D4D4D;
        }
        .textChapters{
            margin-top: 20px;
            font-size: 18pt;
            text-align: justify;
        }
        .button{
            background-color: #FF2400;
            border: none;
            border-radius: 24px;
            padding: 5px 15px;
            font-size: 14pt;
            color: white;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
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
<div class="section">
    <div class="container2">
        <div class="infoChapters">
            <div class="nameChapters"><? echo $_SESSION['nameChapters']?></div>
            <div class="textChapters"><?echo  nl2br($_SESSION['text'])?></div>
        </div>
        <?
        include 'connect/connection.php';
        $query = "SELECT count(*) FROM textofstory where idStory=".$_SESSION['idStory']." and chaptersN>".$_SESSION['chaptersN'];

        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $row = mysqli_fetch_assoc($result);

        if($row['count(*)'] != 0){ ?>
            <div><button class="button" onclick="nextChapter(<?echo $_SESSION['chaptersN']?>)">Следующая глава</button></div>
        <? } else { ?>
            <div><button class="button" onclick="chapterPage(<?echo $_SESSION['idStory']?>)">Перейти к описанию</button></div>

        <? } ?>
    </div>
</div>
<script src="JS/nav.js"></script>
<script>
    function nextChapter(chaptersN){
        document.location.href = `chapters.php?id=${chaptersN+1}`;
    }
    function chapterPage(idStory){
        document.location.href = `story.php?idStory=${idStory}`;
    }
</script>
</body>
</html>
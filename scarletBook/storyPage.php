<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
require 'connect/connection.php';
$_SESSION['idCreateStory'] = $_GET['id'];
$query = "SELECT * FROM story where author=".$_SESSION['id'];
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);
do
{
    $nameStory = $row['name'];
}
while($row = mysqli_fetch_assoc($result));
$query2 = "SELECT count(*) FROM textofstory where idStory=".$_SESSION['idCreateStory'];
$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));

$row2 = mysqli_fetch_assoc($result2);

do
{
    $chapterN = $row2['count(*)'] + 1;
}
while($row2 = mysqli_fetch_assoc($result2));
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="JS/jquery-ui-1.12.1/jquery-3.2.1.min.js"></script>
    <script src="JS/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <meta charset="utf-8">
    <style>
        * {box-sizing: border-box;}
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

        .slide-section{
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            align-items: center;
        }
        .slider{
            width: 840px;
            height: 475px;
        }
        .slides{
            width: 100%;
            display: none;
        }
        .slides img{
            width: 100%;
        }
        .slide-bar{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .dot {
            cursor: pointer;
            height: 18px;
            width: 18px;
            margin: 0 2px;
            background-color: #B1B1B1;
            color: #B1B1B1;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active, .dot:hover {
            background-color: #333333;
        }
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        @keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }



        .text{
            text-align: left;
            font-size: 36px;
            color: #333333;
            font-family: Verdana;
            padding: 0;
            margin: 0;
        }

        .bold {
            font-weight: bold;
        }

        .slideStory{
            justify-content: space-between;
            flex-direction: column;
            align-items: center;
            width: 840px;
            overflow: hidden;
            transition: .2s;
        }
        .item-container{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .item-img{
            margin-right: 10px;
            height: 296px;
            width: 197px;
        }

        .controls{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-prev{
            background-color: aqua;
        }
        .btn-next{
            background-color: aqua;
        }





        /*modal*/
        .modal{
            position: fixed;
            top:0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            background-color: rgba(0, 0, 0, .5);
            opacity: 0;
            transition: .2s;
        }
        .modal-dialog-reg{
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background-color: white;
            transition: .2s;
            transform: translateY(-50px);
            height: 80vh;
            width: 600px;
        }

        .modal-dialog-auth{
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background-color: white;
            transition: .2s;
            transform: translateY(-50px);
            height: 40vh;
            width: 600px;
        }

        .modal-dialog-description{
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background-color: white;
            transition: .2s;
            transform: translateY(-50px);
            height: 60vh;
            width: 690px;
        }
        .modal-dialog-body-description{
            display: flex;
            padding: 20px 40px;
            flex-grow: 1;
        }

        .modal-active{
            visibility: visible;
            opacity: 1;
        }
        .modal-dialog-body{
            display: flex;
            padding: 20px 40px;
            flex-grow: 1;
            overflow: auto;
        }
        .modal-dialog-header{
            padding: 10px 10px;
            transition: .2s;
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
        }
        .modal-dialog-header-close{
        }
        .js-modal-close{

        }
        .btn-close{
            margin: 0;
            padding: 0;
            background: none;
            border: 0;
            font-size: 24px;
            line-height: 24px;
        }

        #imageStory{
            height: 296px;
            width: 197px;
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
            justify-content: center;
            flex-wrap: wrap;
        }

        .chapter {
            resize: none;
            width: 100%;
            font-size: 36pt;

            text-align: center;
        }
        textarea{
            resize: none;
            overflow: hidden;
            width: 100%;
            font-size: 18pt;
            min-height: 50px;

            text-align: justify;
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
        <div class="chapter"><? echo "Глава ".$chapterN ?></div>
    </div>
</div>
<div class="section">
    <div class="container2">
        <textarea></textarea>
    </div>
</div>
<div class="section">
    <div class="container2">
        <button onclick="addChapter()">send</button>
    </div>
</div>
<script src="JS/nav.js"></script>
<script>


    document.querySelector('textarea').addEventListener('input', function(event) {
        var text = document.querySelector('textarea');
        function resize () {
            text.style.height = 'auto';
            text.style.height = text.scrollHeight+'px';
        }

        resize();
    }, false)
    function addChapter(){
        $.post("modules/story/addChapters.php", {text: document.querySelector('textarea').value, chapter: <?echo $chapterN?>},
            function (data) {
                document.location.href = data;
            }
        );
    }
</script>
</body>
</html>

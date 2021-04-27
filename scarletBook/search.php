<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include 'connect/connection.php';

if($_GET['ganre'] == ''){
    $_SESSION['ganre'] = "Романтика', 'Ужасы', 'Драма";
}
else{
    $_SESSION['ganre'] = $_GET['ganre'];
}
//$_SESSION['ganre'] = $_GET['ganre'];

if($_GET['ageCategory'] == ''){
    $_SESSION['ageCategory'] = "13', '16', '18";
}
else{

    $_SESSION['ageCategory'] = $_GET['ageCategory'];
}

if($_GET['statusStory'] == ''){
    $_SESSION['statusStory'] = "В процессе', 'Завершён', 'Заморожен";
}
else{
    $_SESSION['statusStory'] = $_GET['statusStory'];
}

if($_GET['partner'] == ''){
    $_SESSION['partner'] = "Гет', 'Слеш', 'Фемслеш";
}
else{
    $_SESSION['partner'] = $_GET['partner'];
}


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
        .resultSearch{
            display: flex;
            flex-wrap: wrap;
        }
        .resultSearch div{
            width: 420px;
        }

        #imageStory{
            height: 296px;
            width: 197px;
        }
        .ganres1{
            background: #B1B1B1;
            font-size: 10pt;
            border-radius: 14px;
            padding: 2px 7px;
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
        <?
        require 'connect/connection.php';
        $query = "SELECT  ganre FROM ganre";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $row = mysqli_fetch_assoc($result);
        $activeGanre = explode("', '",  $_SESSION['ganre']);
        $flag=false;
        do
        {
            foreach ($activeGanre as $value){
                if($row['ganre'] == $value){
                    $flag=true;
                }
            }
            if($flag){
                echo "<p class='ganres1' onclick='addGanre(this, `".$row['ganre']."`)'>".$row['ganre']."</p>";
                $flag=false;
            }
            else{
                echo "<p style='font-size: 10pt' onclick='addGanre(this, `".$row['ganre']."`)'>".$row['ganre']."</p>";
            }


        }
        while($row = mysqli_fetch_assoc($result));
        ?>
    </div>
</div>
<!--jhgfcdxsz-->
<div class="section">
    <div class="container2">
        <?
        $activeAge = explode("', '",  $_SESSION['ageCategory']);
        $Array = Array(13, 16, 18);
        for($i = 0; $i<3; $i++){
            if(in_array($Array[$i], $activeAge)){
                echo '<p class="ganres1" onclick="addStatus(this, `'.$Array[$i].'`)">'.$Array[$i].'+</p>';
            }
            else{
                echo '<p onclick="addStatus(this, `'.$Array[$i].'`)">'.$Array[$i].'+</p>';
            }
        }

        ?>
<!--        <p onclick="addAge('13')">13+</p>-->
<!--        <p onclick="addAge('16')">16+</p>-->
<!--        <p onclick="addAge('18')">18+</p>-->
    </div>
</div>
<div class="section">
    <div class="container2">
        <?
        $activeStatus = explode("', '",  $_SESSION['statusStory']);
        $Array = Array('В процессе', 'Завершён', 'Заморожен');
        for($i = 0; $i<3; $i++){
            if(in_array($Array[$i], $activeStatus)){
                echo '<p class="ganres1" onclick="addStatus(this, `'.$Array[$i].'`)">'.$Array[$i].'</p>';
            }
            else{
                echo '<p onclick="addStatus(this, `'.$Array[$i].'`)">'.$Array[$i].'</p>';
            }
        }

        ?>
<!--        <p onclick="addStatus('В процессе')">В процессе</p>-->
<!--        <p onclick="addStatus('Завершён')">Завершён</p>-->
<!--        <p onclick="addStatus('Заморожен')">Заморожен</p>-->
    </div>
</div>
<div class="section">
    <div class="container2">
        <?
        $activePartners = explode("', '",  $_SESSION['partner']);
        $Array = Array('Гет', 'Слеш', 'Фемслеш');
        for($i = 0; $i<3; $i++){
            if(in_array($Array[$i], $activePartners)){
                echo '<p class="ganres1" onclick="addPartners(this, `'.$Array[$i].'`)">'.$Array[$i].'</p>';
            }
            else{
                echo '<p onclick="addPartners(this, `'.$Array[$i].'`)">'.$Array[$i].'</p>';
            }
        }

        ?>
<!--        <p onclick="addPartners('Гет')">Гет</p>-->
<!--        <p onclick="addPartners('Слеш')">Слеш</p>-->
<!--        <p onclick="addPartners('Фемслеш')">Фемслеш</p>-->
    </div>
</div>
<div class="section">
    <div class="container2">
        <button onclick="search()">Найти</button>
    </div>
</div>
<section class="section">
    <div class="container2">
        <div class="resultSearch">
                <?
                require 'connect/connection.php';
                $count = substr_count($_SESSION['ganre'], ",") + 1;
                $query = "SELECT count(*) as `count`, `story`.id, `story`.img, `story`.name, `story`.discription, `ganres`.idStory FROM `story` inner JOIN `ganres` on `story`.id=`ganres`.idStory WHERE `ganres`.ganre in ('".$_SESSION['ganre']."') and `story`.status in ('".$_SESSION['statusStory']."') and `story`.ageCategory in ('".$_SESSION['ageCategory']."') and `story`.partners in ('".$_SESSION['partner']."') group by `story`.id having `count`=".$count;
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                $row = mysqli_fetch_assoc($result);
                $i = 0;
                do
                {
                    if($row['count'] == 0){
                        echo '<div>По вашему запросу ничего не найдено</div>';
                    }
                    else {
                        $ganre = '';
                        $str = "<div><img id='imageStory' src='" . $row['img'] . "'><p>" . $row['name'] . "</p><p>" . $row['discription'] . "</p>";
                        $query2 = "SELECT * FROM `story` inner JOIN `ganres` on `story`.id=`ganres`.idStory WHERE `ganres`.idStory=" . $row['idStory'];
                        $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
                        $row2 = mysqli_fetch_assoc($result2);
                        do {
                            $ganre .= '<p>' . $row2['ganre'] . '</p>';
                        } while ($row2 = mysqli_fetch_assoc($result2));
                        $str .= $ganre . '</div>';
                        echo $str;
                    }
                }
                while($row = mysqli_fetch_assoc($result));


                ?>
        </div>
    </div>
</section>
<!--<script src="JS/nav.js"></script>-->
<script>
    // function readChapters(id) {
    //     $.post("modules/story/chapters.php", {id: id},
    //         function (data){
    //             document.location.href = "chapters.php";
    //         }
    //     );
    // }


    function answer(id){
        alert(id == 1);
    }

    let sessionAge = "<?echo $_SESSION['ageCategory']?>";
    let arrAge = sessionAge.split(`', '`);
    let ageCategory = new Set(arrAge);
    let ageCategory1 = "<?echo $_SESSION['ageCategory']?>";

    function addAge(p, age){
        if(ageCategory.has(age)){
            ageCategory.delete(age);
            p.style.backgroundColor = '#fff';
        }
        else {
            ageCategory.add(age);
            p.style.backgroundColor = '#B1B1B1';
            p.style.borderRadius = '14px';
        }
        let array = [...ageCategory];
        ageCategory1 =  array.join(`', '`);
    }

    let sessionStatus = "<?echo $_SESSION['statusStory']?>";
    let arrStatus = sessionStatus.split(`', '`);
    let statusStory = new Set(arrStatus);
    let statusStory1 = "<?echo $_SESSION['statusStory']?>";

    function addStatus(p,status){
        if(statusStory.has(status)){
            statusStory.delete(status);
            p.style.backgroundColor = '#fff';
        }
        else {
            statusStory.add(status);
            p.style.backgroundColor = '#B1B1B1';
            p.style.borderRadius = '14px';
        }
        let array = [...statusStory];
        statusStory1 =  array.join(`', '`);
    }


    let sessionPartner = "<?echo $_SESSION['partner']?>";
    let arrPartner = sessionPartner.split(`', '`);
    let partner = new Set(arrPartner);
    let partner1 = "<?echo $_SESSION['partner']?>";

    function addPartners(p, partners){
        if(partner.has(partners)){
            partner.delete(partners);
            p.style.backgroundColor = '#fff';
        }
        else {
            partner.add(partners);
            p.style.backgroundColor = '#B1B1B1';
            p.style.borderRadius = '14px';
        }
        let array = [...partner];
        partner1 =  array.join(`', '`);
    }


    let session = "<?echo $_SESSION['ganre']?>";
    let array2 = session.split(`', '`);
    let ganres = new Set(array2);
    let ganres1 = "<?echo $_SESSION['ganre']?>";
    function addGanre(p, ganre){
        if(ganres.has(ganre)){
            ganres.delete(ganre);
            p.style.backgroundColor = '#fff';
        }
        else {
            ganres.add(ganre);
            p.style.backgroundColor = '#B1B1B1';
            p.style.borderRadius = '14px';
        }
        let array = [...ganres];
        ganres1 =  array.join(`', '`);

        // $.post("modules/search/ganresFilter.php", {ganres: ganres},
        //     function (data){
        //         document.querySelector('.resultSearch').innerHTML = data;
        //         // $('.resultSearch').html(data);
        //     }
        // );
    }

    function search(){
        document.location.href = `search.php?ganre=${ganres1}&ageCategory=${ageCategory1}&statusStory=${statusStory1}&partner=${partner1}`;
    }
</script>
</body>
</html>
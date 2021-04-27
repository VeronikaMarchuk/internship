<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
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
            flex-wrap: wrap;
        }
        .container2 p{
            font-size: 18pt;
            padding: 0;
            margin: 0;
        }
        .avatar{
            border-radius: 100%;
            background: aqua;
            width: 209px;
            height: 209px;
        }

        .item-img{
            margin-right: 10px;
            height: 296px;
            width: 197px;
        }

    /*    */
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
            height: 500px;
            width: 700px;
        }

        .modal-dialog-profileStory{
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background-color: white;
            transition: .2s;
            transform: translateY(-50px);
            width: 700px;
        }
        .modal-dialog-body-profileStory{
            display: flex;
            padding: 0px 40px;
            flex-grow: 1;
        }
        .description{
            display: flex;
            flex-direction: column;
            line-height: 1.5;
            padding: 0px 20px;
            font-size: 10pt;
        }
        .description h2{
            font-size: 18pt;
            line-height: 20pt;
            letter-spacing: -1px;
            padding: 0px;
        }
        .like{
            display: flex;
        }
        #likes{
            display: flex;
        }
        .countLike{
            padding: 0px 5px;
        }
        .ganre{
            display: flex;
        }

        #imageStory{
            height: 429px;
            width: 286px;
        }
        .ganre p{
            padding: 5px 10px;
            border: black;
            background-color: #CACACA;
            border-radius: 24px;
        }
        .read-align{
            display: flex;
            flex-direction: row;
            justify-content: right;
            align-items: center;
        }
        .read{
            padding: 0px 5px 0px 200px;
            margin: 7px;
        }
        .read2{
            padding: 0px 5px 0px 40px;
            margin: 7px;
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
        .read2 button{
            background-color: #FF2400;
            border: none;
            border-radius: 24px;
            padding: 5px 15px;
            font-size: 14pt;
            color: white;
            font-weight: bold;
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
        .authorStory{
            margin: 5px 0;
        }
        .redHr{
            height: 4px;
            border: none;
            background-color: #FF2400;
            margin: 5px auto;
        }
        .authorInfo{
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #4D4D4D;
            font-size: 28pt;
            font-weight: bold;
            margin-top: 15px;
        }

        .container3{
            display: flex;
            justify-content: flex-end;
            width: 840px;
        }
        .container3 button{
            background-color: #FF2400;
            border: none;
            border-radius: 24px;
            padding: 5px 15px;
            font-size: 14pt;
            color: white;
            font-weight: bold;
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
        <div class="authorInfo">
            <img class="avatar" src="<?echo $_SESSION['photo']?>">
            <div><?echo $_SESSION['login']?></div>
        </div>

    </div>
</div>
<div class="section">
    <div class="container2">
        <p>Работы</p>
        <hr class="redHr">
        <?php
        require 'connect/connection.php';
        $query = "SELECT * FROM story where author=".$_SESSION['id'];
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $row = mysqli_fetch_assoc($result);
        do
        {
            echo "<div class='authorStory'><div class='item-img' onclick='profileStory(" .$row['id'].")'><img class='item-img' src='" .$row['img'] . "'></div></div>";
        }
        while($row = mysqli_fetch_assoc($result));
        ?>
    </div>
</div>

<div class="section">
    <div class="container3">
        <button onclick="add()">add</button>
    </div>
</div>
<div class="modal">
    <div class="modal-dialog-reg">
        <div class="modal-dialog-header">
            <div class="modal-dialog-header-close">
                <button class="js-modal-close btn-close" onclick="closeModal()"><span>&times;</span></button>
            </div>
        </div>
        <div class="modal-dialog-body">
            <div>
                <h2>Регистрация</h2>
                <form  id="validation">
                    <p>
                        <label>Логин:&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;</label>
                        <input id="login" type="text" name="login" size="25" maxlength="25" autofocus>
                        <span class="errorLogin"></span>
                    </p>
                    <p>
                        <label>Пароль:&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;</label>
                        <input id="password" name="password" type="password" size="25"
                               maxlength="25">
                        <span class="errorPass"></span>
                    </p>
                    <p>
                        <label>Повторите пароль:</label>
                        <input id="password2" name="password2" type="password" size="25"
                               maxlength="25">
                        <span class="errorPass2"></span>
                    </p>
                    <p>
                        <label>E-mail:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;</label>
                        <input id="email" name="email"  type="text"
                               size="25" maxlength="25">
                        <span class="error"></span>
                    </p>
                    <p>
                        <label >День Рождения:</label>
                        <SELECT id ="year" name = "yyyy" onchange="change_year(this)" onclick="birthdayVal()">
                        </SELECT>
                        <SELECT  id ="month" name = "mm" onchange="change_month(this)" onclick="birthdayVal()">
                        </SELECT>
                        <SELECT id ="day" name = "dd" onclick="birthdayVal()">
                        </SELECT> <span class="errorDate"></span>
                    </p>
                    <p>
                        <label>Аватар</label>
                        <img id="image" src="#" width="50px" height="50px">
                        <input id="file" name="file" type="file">
                    </p>


                    <p style="margin-left: 15%">
                        <input id="submit" type="submit" name="submit"
                               value="Зарегистрироваться">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal">
    <div class="modal-dialog-auth">
        <div class="modal-dialog-header">
            <div class="modal-dialog-header-close">
                <button class="js-modal-close btn-close" onclick="closeModalAuth()"><span>&times;</span></button>
            </div>
        </div>
        <div class="modal-dialog-body">
            <div>
                <h2>Авторизация</h2>
                <form  id="auth">
                    <p><span class="errorAuth"></span></p>
                    <p>
                        <label>Логин:&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;</label>
                        <input id="loginAuth" type="text" name="login" size="25" maxlength="25" autofocus value="<?=@$_SESSION['login'];?>">

                    </p>
                    <p>
                        <label>Пароль:&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;</label>
                        <input id="passwordAuth" name="password" type="password" size="25"
                               maxlength="25">

                    </p>

                    <p style="margin-left: 15%">
                    <div type="submit"  onclick="auth()" >Вход</div>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal">
    <div class="modal-dialog-description">
        <div class="modal-dialog-header">
            <div class="modal-dialog-header-close">
                <button class="js-modal-close btn-close" onclick="closeDescription()"><span>&times;</span></button>
            </div>
        </div>
        <div class="modal-dialog-body-description">
            <!--            <div>-->
            <!--                <img id="imageStory">-->
            <!--            </div>-->
            <!--            <div id="infoStory">-->
            <!--            </div>-->
        </div>

    </div>
</div>

<div class="modal">
    <div class="modal-dialog-auth">
        <div class="modal-dialog-header">
            <div class="modal-dialog-header-close">
                <button class="js-modal-close btn-close" onclick="closeRegAuth()"><span>&times;</span></button>
            </div>
        </div>
        <div class="modal-dialog-body-auth">
            <button class="log-in" onclick="authModal()">Вход</button>
            <button class="reg" onclick="regModal()">Регистрация</button>
        </div>
    </div>
</div>

<div class="modal">
    <div class="modal-dialog-reg">
        <div class="modal-dialog-header">
            <div class="modal-dialog-header-close">
                <button class="js-modal-close btn-close" onclick="closeModalAdd()"><span>&times;</span></button>
            </div>
        </div>
        <div class="modal-dialog-body">
            <div>
                <h2>Регистрация</h2>
                <form  id="validation2">
                    <p>
                        <label>Название:</label>
                        <input id="nameStory" name="nameStory" type="text" size="25"
                               maxlength="25">
                        <span class="error"></span>
                    </p>
                    <p>
                        <label>Описание:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;</label>
                        <textarea id="description" name="description"  type="text"
                                  size="25" maxlength="25"></textarea>
                        <span class="error"></span>
                    </p>
                    <p>
                        <label>Герои:</label>
                        <input id="hero" name="hero" type="text" size="25"
                               maxlength="25">
                        <span class="error"></span>
                    </p>
                    <p>
                        <label>Тип отношений:</label>
                        <select id="typePartners"  name="type" onchange="getPartners()">
                            <option value="Слеш">Слеш</option>
                            <option value="Гет">Гет</option>
                            <option value="Феслеш">Фемслеш</option>
                        </select>
                        <span class="error"></span>
                    </p>
                    <p>
                        <label>Жанры:</label>
                        <select id="ganre" multiple name="ganre[]" onchange="getGanre()">
                            <?php
                            require 'connect/connection.php';
                            $query = "SELECT * FROM ganre";
                            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                            $row = mysqli_fetch_assoc($result);
                            do
                            {
                                echo "<option value='".$row['ganre']."'>".$row['ganre']."</option>";
                            }
                            while($row = mysqli_fetch_assoc($result));
                            ?>
                        </select>
                        <span class="error"></span>
                    </p>
                    <p>
                        <label>Рейтинг:</label>
                        <select id="age"  name="type" onchange="getAge()">
                            <option value="13">13+</option>
                            <option value="16">16+</option>
                            <option value="18">18+</option>
                        </select>
                        <span class="error"></span>
                    </p>

                    <p>
                        <label>Обложка</label>
                        <img id="image" src="#" width="50px" height="50px">
                        <input id="file" name="file" type="file">
                    </p>


                    <p style="margin-left: 15%">
                        <input id="submit" type="submit" name="submit"
                               value="Зарегистрироваться">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal">
    <div class="modal-dialog-profileStory">
        <div class="modal-dialog-header">
            <div class="modal-dialog-header-close">
                <button class="js-modal-close btn-close" onclick="closeDescription()"><span>&times;</span></button>
            </div>
        </div>
        <div class="modal-dialog-body-profileStory">
            <!--            <div>-->
            <!--                <img id="imageStory">-->
            <!--            </div>-->
            <!--            <div id="infoStory">-->
            <!--            </div>-->
        </div>
        <div class="read2">
            <button onclick="updateStatus('Завершён')">Завершить</button>
            <button onclick="updateStatus('Заморожен')">Заморозить</button>
            <button onclick="addChapter()">Добавить главу</button>
        </div>
    </div>
</div>

<script>
    function add(){
        let modal = document.querySelectorAll('.modal')[4];
        modal.style.visibility = 'visible';
        modal.style.opacity = '1';
    }
    function closeModalAdd(){
        let modal = document.querySelectorAll('.modal')[4];
        modal.style.visibility = 'hidden';
        modal.style.opacity = '0';
    }


    let form1 = document.querySelector('#validation2');
    let nameStory = form1.querySelector('#nameStory');
    let description = form1.querySelector('#description');
    let hero = form1.querySelector('#hero');

    // var value = e.options[e.selectedIndex].value;
    // var text = e.options[e.selectedIndex].text;

    let typePartners = form1.querySelector('#typePartners');
    let typePartnersVal = typePartners.options[typePartners.selectedIndex].value;

    let age = form1.querySelector('#age');
    let ageVal = age.options[age.selectedIndex].value;

    let selected = document.querySelectorAll('#ganre');
    let values = Array.from(selected).map(el => el.value);

    let photo1 = form1.querySelector('#image');
    let file1 = form1.querySelector('#file');
    // let submit1 = form1.querySelector('.submit');

    let src1;

    function getPartners(){
        typePartnersVal = typePartners.options[typePartners.selectedIndex].value;
    }

    function getAge(){
        ageVal = age.options[age.selectedIndex].value;
    }

    var result = [];
    function getGanre(){
        result = $('#ganre').val();
    }
    file1.addEventListener('change', function(event) {
        for(var x = 0; x < event.target.files.length; x++) {
            (function(i) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    src1 = event.target.result;
                    photo1.setAttribute('src', event.target.result);
                    photo1.setAttribute('class', 'preview');
                }
                reader.readAsDataURL(event.target.files[x]);
            })(x);
        }
    }, false);
    form1.addEventListener("submit", function (event) {
        if (nameStory.value.length == 0 || description.value.length == 0 || hero.value.length == 0 || typePartnersVal.length == 0 || ageVal.length == 0 || result.length == 0) {
            event.preventDefault();
        }
        else{
            event.preventDefault();
            createStory();
        }
    }, false);

    function createStory(){
        $.post("modules/story/createStory.php", {
                nameStory: nameStory.value,
                description: description.value,
                hero: hero.value,
                typePartners: typePartnersVal,
                ageCategory: ageVal,
                ganre: result,
                storyImg: src1
            },
            function (data) {
                document.location.href = data;
            }
        );
    }
    function descriptionModal(){
        let modal = document.querySelectorAll('.modal')[5];
        modal.style.visibility = 'visible';
        modal.style.opacity = '1';
    }
    function closeDescription(){
        let modal = document.querySelectorAll('.modal')[5];
        modal.style.visibility = 'hidden';
        modal.style.opacity = '0';
    }

    let idStory;

    function profileStory(id){
        idStory = id;
        let image = document.querySelector('.modal-dialog-body-profileStory');
        // $.post("modules/description/image.php", {id: id},
        //     function (data){
        //         image.setAttribute('src', data);
        //     }
        // );
        $.post("modules/description/description.php", {id: id},
            function (data){
                $('.modal-dialog-body-profileStory').html(data);
            }
        );
        descriptionModal();

    }

    function like(){
        $.post("modules/likes/like.php", { idStory: idStory},
            function (data){
                $('#likes').html(data);
            }
        );
    }

    function mark(){
        $.post("modules/marks/mark.php", { idStory: idStory},
            function (data){
                $('#mark').html(data);
            }
        );
    }



    function read(){
        document.location.href = `story.php?idStory=${idStory}`;
    }
    function addChapter(){
        document.location.href = `storyPage.php?id=${idStory}`;
    }
    function updateStatus(status){
        $.post("modules/story/updateStatus.php", { idStory: idStory, status: status},
            function (data){
            alert(status+idStory)
            }
        );
    }
</script>
<script src="JS/nav.js"></script>
</body>
</html>
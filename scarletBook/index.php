<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
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
            font-family: Verdana;
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


        .section{
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            align-items: center;
            background-color: #CDF4D9;
            height: auto;
            width: 100%;
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
            height: 500px;
            width: 700px;
        }
		.modal-dialog-body-description{
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



    </style>
</head>
<body>
<div class="container">
    <div class="header-inner">
        <a href="index.php"><div class="logo"></div></a>
        <nav class="nav">
            <ul class="nav-ul">
                <li class="nav-li">??????????
                    <ul class="ganres">
                        <li class="ganres-li"><p onclick="searchRes('??????????????????')">??????????????????</p></li>
                        <li class="ganres-li"><p onclick="searchRes('??????????')">??????????</p></li>
                        <li class="ganres-li"><p onclick="searchRes('??????????????????????')">??????????????????????</p></li>
                        <li class="ganres-li"><p onclick="searchRes('????????????????????')">????????????????????</p></li>
                        <li class="ganres-li"><p onclick="searchRes('??????????????')">??????????????</p></li>
                        <li class="ganres-li"><p onclick="searchRes('??????????')">??????????</p></li>
                        <li class="ganres-li"><p onclick="searchRes('????????????????')">????????????????</p></li>
                        <li class="ganres-li"><p onclick="searchRes('????????????????????????')">????????????????????????</p></li>
                        <li class="ganres-li"><p onclick="searchRes('????????????')">????????????</p></li>
                        <li class="ganres-li"><p onclick="searchRes('????????????????????')">????????????????????</p></li>
                        <li class="ganres-li"><p onclick="searchRes('??????????')">??????????</p></li>
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
            <div class="username"><button class="log-out" onclick="logout()">??????????</button> / <?echo $_SESSION['login']?></div>
            <div class="photo"><img class="photo" src="<?echo $_SESSION['photo']?>" onclick="profile()"></div>
        </div>
    <? } else { ?>
        <div class="user">
            <div class="username"><button class="log-in" onclick="authModal()">????????</button> / <button class="reg" onclick="regModal()">??????????????????????</button></div>
            <div class="photo"></div>
        </div>

    <? } ?>

</div>
<hr>
<section class="slide-section">
    <div class="slider">
        <div >
            <div class="slides fade">
                <img src="img/naruto.jpg">
            </div>

            <div class="slides fade">
                <img src="img/harrypotter.jpg" >
            </div>

            <div class="slides fade">
                <img src="img/naruto.jpg" >
            </div>
            <div class="slide-bar">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
    </div>
</section>
<br><br>
<section>
<div class="section">
    <div class="text"><p class="bold">???????????????????? ?????? ????????????????????????</p></div>
    <div class="slideStory">
        <div class="item-container">
            <?php
            require 'connect/connection.php';
            $query = "SELECT * FROM story where partners='??????'";
            $result = mysqli_query($link, $query) or die("???????????? " . mysqli_error($link));
            $row = mysqli_fetch_assoc($result);
            do
            {
                echo "<div class='item-img' onclick='description(" .$row['id'].")'><img class='item-img' src='" .$row['img'] . "'></div>";
            }
            while($row = mysqli_fetch_assoc($result));
            ?>

        </div>
        <div class="controls">
            <button class="btn-prev">prev</button>
            <button class="btn-next">next</button>
        </div>
    </div>

</div>
</section>

<div class="section">
    <div class="text"><p class="bold">???????????????????? ???????? ????????????????????????</p></div>
    <div class="slideStory">
        <div class="item-container">
            <?php
            require 'connect/connection.php';
            $query = "SELECT * FROM story where partners='????????'";
            $result = mysqli_query($link, $query) or die("???????????? " . mysqli_error($link));
            $row = mysqli_fetch_assoc($result);
            do
            {
                echo "<div class='item-img' onclick='description(" .$row['id'].")'><img class='item-img' src='" .$row['img'] . "'></div>";
            }
            while($row = mysqli_fetch_assoc($result));
            ?>

        </div>
        <div class="controls">
            <button class="btn-prev">prev</button>
            <button class="btn-next">next</button>
        </div>
    </div>

</div>

<div class="section">
    <div class="text"><p class="bold">???????????????????? ?????????????? ????????????????????????</p></div>
    <div class="slideStory">
        <div class="item-container">
            <?php
            require 'connect/connection.php';
            $query = "SELECT * FROM story where partners='??????????????'";
            $result = mysqli_query($link, $query) or die("???????????? " . mysqli_error($link));
            $row = mysqli_fetch_assoc($result);
            do
            {
                echo "<div class='item-img' onclick='description(" .$row['id'].")'><img class='item-img' src='" .$row['img'] . "'></div>";
            }
            while($row = mysqli_fetch_assoc($result));
            ?>

        </div>
        <div class="controls">
            <button class="btn-prev">prev</button>
            <button class="btn-next">next</button>
        </div>
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
                <h2>??????????????????????</h2>
                <form  id="validation">
                    <p>
                        <label>??????????:&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;</label>
                        <input id="login" type="text" name="login" size="25" maxlength="25" autofocus>
                        <span class="errorLogin"></span>
                    </p>
                    <p>
                        <label>????????????:&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;</label>
                        <input id="password" name="password" type="password" size="25"
                               maxlength="25">
                        <span class="errorPass"></span>
                    </p>
                    <p>
                        <label>?????????????????? ????????????:</label>
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
                        <label >???????? ????????????????:</label>
                        <SELECT id ="year" name = "yyyy" onchange="change_year(this)" onclick="birthdayVal()">
                        </SELECT>
                        <SELECT  id ="month" name = "mm" onchange="change_month(this)" onclick="birthdayVal()">
                        </SELECT>
                        <SELECT id ="day" name = "dd" onclick="birthdayVal()">
                        </SELECT> <span class="errorDate"></span>
                    </p>
                    <p>
                        <label>????????????</label>
                        <img id="image" src="#" width="50px" height="50px">
                        <input id="file" name="file" type="file">
                    </p>


                    <p style="margin-left: 15%">
                        <input id="submit" type="submit" name="submit"
                               value="????????????????????????????????????">
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
                <h2>??????????????????????</h2>
                <form  id="auth">
                    <p><span class="errorAuth"></span></p>
                    <p>
                        <label>??????????:&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;</label>
                        <input id="loginAuth" type="text" name="login" size="25" maxlength="25" autofocus value="<?=@$_SESSION['login'];?>">

                    </p>
                    <p>
                        <label>????????????:&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;</label>
                        <input id="passwordAuth" name="password" type="password" size="25"
                               maxlength="25">

                    </p>

                    <p style="margin-left: 15%">
                        <div type="submit"  onclick="auth()" >????????</div>
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
            <button class="log-in" onclick="authModal()">????????</button>
            <button class="reg" onclick="regModal()">??????????????????????</button>
        </div>
    </div>
</div>
<script src="JS/nav.js"></script>
<script>
    // function searchRes(ganre){
    //     // $.post("modules/search/ganreSearch.php", {ganre: ganre},
    //     //     function (data){
    //             document.location.href = `search.php?ganre=${ganre}`;
    //     //     }
    //     // );
    // }

    ///slider
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("slides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
    }

    //
    let position = 0;
    const slidesToShow = 4;
    const slidesToScroll = 1;
    const container = document.querySelector('.slideStory');
    const track = document.querySelector('.item-container');
    // const item = document.querySelector('.item-img');
    const btnPrev = document.querySelector('.btn-prev');
    const btnNext = document.querySelector('.btn-next');
    const items = document.querySelectorAll('.item-img');
    const itemsCount = items.length;
    const itemWidth = container.clientWidth / slidesToShow;
    const movePosition = slidesToScroll * itemWidth;

    items.forEach((item) =>{
        item.style.minWidth = `${itemWidth}px`;
    });

    btnNext.addEventListener('click', () =>{
        const  itemsLeft = itemsCount - (Math.abs(position) + slidesToShow * itemWidth) / itemWidth;
        position -= itemsLeft >= slidesToScroll ? movePosition : itemsLeft * itemWidth;

        setPosition();
        checkBtns();
    });

    btnPrev.addEventListener('click', () =>{
        const  itemsLeft = Math.abs(position) / itemWidth;
        position += itemsLeft >= slidesToScroll ? movePosition : itemsLeft * itemWidth;

        setPosition();
        checkBtns();
    });

    function setPosition (){
        track.style.transform = `translateX(${position}px)`;
    };

    function checkBtns (){
        btnPrev.disabled = position === 0;
        btnNext.disabled = position <= -(itemsCount - slidesToShow) * itemWidth;
    };
    checkBtns();




    ///
    // function regModal(){
    //     closeRegAuth()
    //     let modal = document.querySelector('.modal');
    //     modal.style.visibility = 'visible';
    //     modal.style.opacity = '1';
    // }
    // function authModal(){
    //     closeRegAuth()
    //     let modal = document.querySelectorAll('.modal')[1];
    //     modal.style.visibility = 'visible';
    //     modal.style.opacity = '1';
    // }
    // function closeModalAuth(){
    //     let modal = document.querySelectorAll('.modal')[1];
    //     modal.style.visibility = 'hidden';
    //     modal.style.opacity = '0';
    // }
    // function closeModal(){
    //     let modal = document.querySelector('.modal');
    //     modal.style.visibility = 'hidden';
    //     modal.style.opacity = '0';
    // }

    function descriptionModal(){
        let modal = document.querySelectorAll('.modal')[2];
        modal.style.visibility = 'visible';
        modal.style.opacity = '1';
    }
    function closeDescription(){
        let modal = document.querySelectorAll('.modal')[2];
        modal.style.visibility = 'hidden';
        modal.style.opacity = '0';
    }

    // function regAuth(){
    //     closeDescription()
    //     let modal = document.querySelectorAll('.modal')[3];
    //     modal.style.visibility = 'visible';
    //     modal.style.opacity = '1';
    // }
    // function closeRegAuth(){
    //     let modal = document.querySelectorAll('.modal')[3];
    //     modal.style.visibility = 'hidden';
    //     modal.style.opacity = '0';
    // }


    ////
    let idStory;

    function description(id){
        idStory = id;
        let image = document.querySelector('.modal-dialog-body-description');
        // $.post("modules/description/image.php", {id: id},
        //     function (data){
        //         image.setAttribute('src', data);
        //     }
        // );
        $.post("modules/description/description.php", {id: id},
            function (data){
                $('.modal-dialog-body-description').html(data);
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
    // function readS(id){
    //     $.get("modules/story/storyPage.php", {idStory: id},
    //         function (data){
    //             document.location.href = "story.php?idStory=" + id;
    //         }
    //     );
    // }

    // function profile(){
    //     document.location.href = "profile.php";
    // }



    ///
    // let form = document.querySelector('#validation');
    // let login = form.querySelector(`#login`);
    // let password = form.querySelector('#password');
    // let password2 = form.querySelector('#password2');
    // let mail = form.querySelector(`#email`);
    // let yearOfBirthday = form.querySelector('#year');
    // let monthOfBirthday = form.querySelector('#month');
    // let dayOfBirthday = form.querySelector('#day');
    // let photo = form.querySelector('#image');;
    // let file = form.querySelector('#file');
    // let submit = form.querySelector('.submit');


    // function auth(){
    //     let login = document.querySelector(`#loginAuth`);
    //     let password = document.querySelector('#passwordAuth');
    //     // let cod = document.querySelector('#cod').value;
    //     // if(cod != ''){
    //     //     $.post("modules/auth/auth.php", {login: login.value, password: password.value, cod: cod},
    //     //         function (data){
    //     //             $('.errorAuth').html(data);
    //     //         }
    //     //     );
    //     // }
    //     // else{
    //         $.post("modules/auth/auth.php", {login: login.value, password: password.value},
    //             function (data){
    //                 $('.errorAuth').html(data);
    //                 alert(data.length)
    //                 // document.querySelector('#passwordAuth').parentNode.innerHTML += data;
    //             }
    //         );
    //     // }
    //
    // }
    // function logout(){
    //     $.post("modules/auth/logout.php", {},
    //         function (data){
    //             location.reload()
    //         }
    //     );
    // }



    //
    // let src;
    //
    // file.addEventListener('change', function(event) {
    //     for(var x = 0; x < event.target.files.length; x++) {
    //         (function(i) {
    //             var reader = new FileReader();
    //             reader.onload = function(event) {
    //                 src = event.target.result;
    //                 photo.setAttribute('src', event.target.result);
    //                 photo.setAttribute('class', 'preview');
    //             }
    //             reader.readAsDataURL(event.target.files[x]);
    //         })(x);
    //     }
    // }, false);


     //???????????? ??????????????
    function show_hide_password(target){

        if (password.getAttribute('type') == 'password') {
            password.setAttribute('type', 'text');
        } else {
            password.setAttribute('type', 'password');
        }
        return false;
    }


    // class Validator{
    //     static isEmail(mail){
    //         let reg = /^([A-Za-z0-9_])+\@([A-Za-z0-9_]{2,5})+\.([A-Za-z]{2,3})$/;
    //         if (reg.test(mail))
    //             return true;
    //         else
    //             return false;
    //     }
    //
    //     static isLogin(login){
    //         let reg = /^([A-Za-z??-????-????0-9_;$()^:]{3,})$/;
    //         if (reg.test(login))
    //             return true;
    //         else
    //             return false;
    //     }
    //
    //     static isPassword(password){
    //         let reg = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
    //         if (reg.test(password))
    //             return true;
    //         else
    //             return false;
    //     }
    //
    //     static isBirthday(birthday){
    //         let reg = /^(\d{4})\-([1-9]|[0-1][0-2])\-([1-9]|[0-2][0-9]|[3][0-1])$/;
    //         if (reg.test(birthday))
    //             return true;
    //         else
    //             return false;
    //     }
    // }
    //
    // let loginMassage = 0;
    // function loginPost(){
    //     $.post("modules/registration/reg.php", {login: login.value},
    //         function (data){
    //             $('.errorLogin').html(data);
    //             // if(data.toString() == '???????????? ?????????? ????????????????'){
    //             //     loginMassage = 1;
    //             //     alert(data);
    //             // }
    //             // else alert(data);
    //             // alert(loginMassage);
    //         }
    //     );
    // }
    //
    // let error = document.querySelector('.error');
    // form.addEventListener("input", function (event) {
    // //     // ???????????? ??????, ?????????? ???????????????????????? ???????????? ??????-????????, ???? ??????????????????,
    // //     // ???????????????? ???? ???????????????????? ???????? ?????????????????????? ??????????.
    //     if (Validator.isEmail(mail.value)) {
    //         mail.style.boxShadow = '0px 0px 5px green'
    //     }
    //     else{
    //         mail.style.boxShadow = '0px 0px 5px red'
    //     }
    //
    //
    //     if(Validator.isLogin(login.value)){
    //         loginPost();
    //     }
    //     else{
    //         login.style.boxShadow = '0px 0px 5px red'
    //         $('.errorLogin').html('?????????? ????????????????');
    //     }
    //
    //     if(Validator.isPassword(password.value)){
    //         $('.errorPass').html('');
    //     }
    //     else{
    //         $('.errorPass').html('???????????? ???? ???????????????????????? ??????????????????????');
    //     }
    //
    //     if(password.value != password2.value){
    //         $('.errorPass2').html('???????????? ???? ??????????????????');
    //     }
    //     else $('.errorPass2').html('');
    //
    //
    //
    // }, false);
    //
    // let search = document.querySelector('.searchText');
    // search.addEventListener("input", function (event) {
    //     //     // ???????????? ??????, ?????????? ???????????????????????? ???????????? ??????-????????, ???? ??????????????????,
    //     //     // ???????????????? ???? ???????????????????? ???????? ?????????????????????? ??????????.
    //
    //     $.post("modules/search/search.php", {search: search.value},
    //         function (data){
    //             $('#display').css('visibility', 'visible');
    //             $('#display').css('opacity', '1');
    //             $('#display').html(data);
    //         }
    //     );
    //
    //
    // }, false);

    // form.addEventListener("focus", () => form.classList.add('focused'), true);

    // search.addEventListener("blur", () => {
    //     $('#display').css('visibility', 'hidden');
    //     $('#display').css('opacity', '0');
    // }, true);

    // let birthday;
    // function birthdayVal(){
    //     birthday = `${yearOfBirthday.value}-${monthOfBirthday.value}-${dayOfBirthday.value}`;
    //     if(!Validator.isBirthday(birthday)){
    //         $('.errorDate').html('???????????????? ????????');
    //     }
    //     if(Validator.isBirthday(birthday)){
    //         $('.errorDate').html('');
    //     }
    // }
    // //
    // form.addEventListener("submit", function (event) {
    //     if (!Validator.isEmail(mail.value) || !Validator.isLogin(login.value) || !Validator.isPassword(password.value)) {
    //         event.preventDefault();
    //     }
    //     else{
    //         event.preventDefault();
    //         reg();
    //     }
    // }, false);
    // function reg(){
    //     $.post("modules/registration/insertDB.php", {
    //             login: login.value,
    //             password: password.value,
    //             mail: mail.value,
    //             birthday: birthday,
    //             src: src
    //         },
    //         function (data) {
    //             alert(data);
    //             $('.modal').css({'visibility': 'hidden', 'opacity': '0'});
    //         }
    //     );
    // }
    //
    //
    //
    //
    // var Days = [31,28,31,30,31,30,31,31,30,31,30,31];// index => month [0-11]
    // $(document).ready(function(){
    //     var option = '<option value="day">day</option>';
    //     var selectedDay="day";
    //     for (var i=1;i <= Days[0];i++){ //add option days
    //         option += '<option value="'+ i + '">' + i + '</option>';
    //     }
    //     $('#day').append(option);
    //     $('#day').val(selectedDay);
    //
    //     var option = '<option value="month">month</option>';
    //     var selectedMon ="month";
    //     for (var i=1;i <= 12;i++){
    //         option += '<option value="'+ i + '">' + i + '</option>';
    //     }
    //     $('#month').append(option);
    //     $('#month').val(selectedMon);
    //
    //
    //     var d = new Date();
    //     var option = '<option value="year">year</option>';
    //     selectedYear ="year";
    //     for (var i=1930;i <= d.getFullYear();i++){// years start i
    //         option += '<option value="'+ i + '">' + i + '</option>';
    //     }
    //     $('#year').append(option);
    //     $('#year').val(selectedYear);
    // });
    // function isLeapYear(year) {
    //     year = parseInt(year);
    //     if (year % 4 != 0) {
    //         return false;
    //     } else if (year % 400 == 0) {
    //         return true;
    //     } else if (year % 100 == 0) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
    //
    // function change_year(select)
    // {
    //     if( isLeapYear( $(select).val() ) )
    //     {
    //         Days[1] = 29;
    //
    //     }
    //     else {
    //         Days[1] = 28;
    //     }
    //     if( $("#month").val() == 2)
    //     {
    //         var day = $('#day');
    //         var val = $(day).val();
    //         $(day).empty();
    //         var option = '<option value="day">day</option>';
    //         for (var i=1;i <= Days[1];i++){ //add option days
    //             option += '<option value="'+ i + '">' + i + '</option>';
    //         }
    //         $(day).append(option);
    //         if( val > Days[ month ] )
    //         {
    //             val = 1;
    //         }
    //         $(day).val(val);
    //     }
    // }
    //
    // function change_month(select) {
    //     var day = $('#day');
    //     var val = $(day).val();
    //     $(day).empty();
    //     var option = '<option value="day">day</option>';
    //     var month = parseInt( $(select).val() ) - 1;
    //     for (var i=1;i <= Days[ month ];i++){ //add option days
    //         option += '<option value="'+ i + '">' + i + '</option>';
    //     }
    //     $(day).append(option);
    //     if( val > Days[ month ] )
    //     {
    //         val = 1;
    //     }
    //     $(day).val(val);
    // }
</script>
</body>
</html>
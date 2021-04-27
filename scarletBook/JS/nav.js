function searchRes(ganre){
    // $.post("modules/search/ganreSearch.php", {ganre: ganre},
    //     function (data){
    document.location.href = `search.php?ganre=${ganre}`;
    //     }
    // );
}


function regModal(){
    closeRegAuth()
    let modal = document.querySelector('.modal');
    modal.style.visibility = 'visible';
    modal.style.opacity = '1';
}
function authModal(){
    closeRegAuth()
    let modal = document.querySelectorAll('.modal')[1];
    modal.style.visibility = 'visible';
    modal.style.opacity = '1';
}
function closeModalAuth(){
    let modal = document.querySelectorAll('.modal')[1];
    modal.style.visibility = 'hidden';
    modal.style.opacity = '0';
}
function closeModal(){
    let modal = document.querySelector('.modal');
    modal.style.visibility = 'hidden';
    modal.style.opacity = '0';
}

function regAuth(){
    closeDescription()
    let modal = document.querySelectorAll('.modal')[3];
    modal.style.visibility = 'visible';
    modal.style.opacity = '1';
}
function closeRegAuth(){
    let modal = document.querySelectorAll('.modal')[3];
    modal.style.visibility = 'hidden';
    modal.style.opacity = '0';
}

function profile(){
    document.location.href = "profile.php";
}


function auth(){
    let login = document.querySelector(`#loginAuth`);
    let password = document.querySelector('#passwordAuth');
    // let cod = document.querySelector('#cod').value;
    // if(cod != ''){
    //     $.post("modules/auth/auth.php", {login: login.value, password: password.value, cod: cod},
    //         function (data){
    //             $('.errorAuth').html(data);
    //         }
    //     );
    // }
    // else{
    $.post("modules/auth/auth.php", {login: login.value, password: password.value},
        function (data){
            $('.errorAuth').html(data);
            // document.querySelector('#passwordAuth').parentNode.innerHTML += data;
        }
    );
    // }

}
function logout(){
    $.post("modules/auth/logout.php", {},
        function (data){
            location.reload()
        }
    );
}


let form = document.querySelector('#validation');
let login = form.querySelector(`#login`);
let password = form.querySelector('#password');
let password2 = form.querySelector('#password2');
let mail = form.querySelector(`#email`);
let yearOfBirthday = form.querySelector('#year');
let monthOfBirthday = form.querySelector('#month');
let dayOfBirthday = form.querySelector('#day');
let photo = form.querySelector('#image');;
let file = form.querySelector('#file');
let submit = form.querySelector('.submit');


let src;

file.addEventListener('change', function(event) {
    for(var x = 0; x < event.target.files.length; x++) {
        (function(i) {
            var reader = new FileReader();
            reader.onload = function(event) {
                src = event.target.result;
                photo.setAttribute('src', event.target.result);
                photo.setAttribute('class', 'preview');
            }
            reader.readAsDataURL(event.target.files[x]);
        })(x);
    }
}, false);


class Validator{
    static isEmail(mail){
        let reg = /^([A-Za-z0-9_])+\@([A-Za-z0-9_]{2,5})+\.([A-Za-z]{2,3})$/;
        if (reg.test(mail))
            return true;
        else
            return false;
    }

    static isLogin(login){
        let reg = /^([A-Za-zА-Яа-яё0-9_;$()^:]{3,})$/;
        if (reg.test(login))
            return true;
        else
            return false;
    }

    static isPassword(password){
        let reg = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
        if (reg.test(password))
            return true;
        else
            return false;
    }

    static isBirthday(birthday){
        let reg = /^(\d{4})\-([1-9]|[0-1][0-2])\-([1-9]|[0-2][0-9]|[3][0-1])$/;
        if (reg.test(birthday))
            return true;
        else
            return false;
    }
}

let loginMassage = 0;
function loginPost(){
    $.post("modules/registration/reg.php", {login: login.value},
        function (data){
            $('.errorLogin').html(data);
            // if(data.toString() == 'Данный логин свободен'){
            //     loginMassage = 1;
            //     alert(data);
            // }
            // else alert(data);
            // alert(loginMassage);
        }
    );
}

let error = document.querySelector('.error');
form.addEventListener("input", function (event) {
    //     // Каждый раз, когда пользователь вводит что-либо, мы проверяем,
    //     // является ли корректным поле электронной почты.
    if (Validator.isEmail(mail.value)) {
        mail.style.boxShadow = '0px 0px 5px green'
    }
    else{
        mail.style.boxShadow = '0px 0px 5px red'
    }


    if(Validator.isLogin(login.value)){
        loginPost();
    }
    else{
        login.style.boxShadow = '0px 0px 5px red'
        $('.errorLogin').html('Логин короткий');
    }

    if(Validator.isPassword(password.value)){
        $('.errorPass').html('');
    }
    else{
        $('.errorPass').html('Пароль не соответсвует требованиям');
    }

    if(password.value != password2.value){
        $('.errorPass2').html('Пароли не совпадают');
    }
    else $('.errorPass2').html('');



}, false);

let search = document.querySelector('.searchText');
search.addEventListener("input", function (event) {
    //     // Каждый раз, когда пользователь вводит что-либо, мы проверяем,
    //     // является ли корректным поле электронной почты.

    $.post("modules/search/search.php", {search: search.value},
        function (data){
            $('#display').css('visibility', 'visible');
            $('#display').css('opacity', '1');
            $('#display').html(data);
        }
    );


}, false);


let birthday;
function birthdayVal(){
    birthday = `${yearOfBirthday.value}-${monthOfBirthday.value}-${dayOfBirthday.value}`;
    if(!Validator.isBirthday(birthday)){
        $('.errorDate').html('Выберите дату');
    }
    if(Validator.isBirthday(birthday)){
        $('.errorDate').html('');
    }
}
//
form.addEventListener("submit", function (event) {
    if (!Validator.isEmail(mail.value) || !Validator.isLogin(login.value) || !Validator.isPassword(password.value)) {
        event.preventDefault();
    }
    else{
        event.preventDefault();
        reg();
    }
}, false);
function reg(){
    $.post("modules/registration/insertDB.php", {
            login: login.value,
            password: password.value,
            mail: mail.value,
            birthday: birthday,
            src: src
        },
        function (data) {
            alert(data);
            $('.modal').css({'visibility': 'hidden', 'opacity': '0'});
        }
    );
}




var Days = [31,28,31,30,31,30,31,31,30,31,30,31];// index => month [0-11]
$(document).ready(function(){
    var option = '<option value="day">day</option>';
    var selectedDay="day";
    for (var i=1;i <= Days[0];i++){ //add option days
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $('#day').append(option);
    $('#day').val(selectedDay);

    var option = '<option value="month">month</option>';
    var selectedMon ="month";
    for (var i=1;i <= 12;i++){
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $('#month').append(option);
    $('#month').val(selectedMon);


    var d = new Date();
    var option = '<option value="year">year</option>';
    selectedYear ="year";
    for (var i=1930;i <= d.getFullYear();i++){// years start i
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $('#year').append(option);
    $('#year').val(selectedYear);
});
function isLeapYear(year) {
    year = parseInt(year);
    if (year % 4 != 0) {
        return false;
    } else if (year % 400 == 0) {
        return true;
    } else if (year % 100 == 0) {
        return false;
    } else {
        return true;
    }
}

function change_year(select)
{
    if( isLeapYear( $(select).val() ) )
    {
        Days[1] = 29;

    }
    else {
        Days[1] = 28;
    }
    if( $("#month").val() == 2)
    {
        var day = $('#day');
        var val = $(day).val();
        $(day).empty();
        var option = '<option value="day">day</option>';
        for (var i=1;i <= Days[1];i++){ //add option days
            option += '<option value="'+ i + '">' + i + '</option>';
        }
        $(day).append(option);
        if( val > Days[ month ] )
        {
            val = 1;
        }
        $(day).val(val);
    }
}

function change_month(select) {
    var day = $('#day');
    var val = $(day).val();
    $(day).empty();
    var option = '<option value="day">day</option>';
    var month = parseInt( $(select).val() ) - 1;
    for (var i=1;i <= Days[ month ];i++){ //add option days
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $(day).append(option);
    if( val > Days[ month ] )
    {
        val = 1;
    }
    $(day).val(val);
}

function readS(id){
    $.get("modules/story/storyPage.php", {idStory: id},
        function (data){
            document.location.href = "story.php?idStory=" + id;
        }
    );
}
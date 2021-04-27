<?php
$host = 'localhost';
$db = 'scarletbook';
$user = 'root';
$password_bd = 'root';

$link = mysqli_connect($host, $user, $password_bd, $db) or die("Ошибка " . mysqli_error($link));
if (!$link) {
    // Если проверку не прошло, то выводится надпись ошибки и заканчивается работа скрипта
    echo "Не удается подключиться к серверу базы данных!";
    exit;
}

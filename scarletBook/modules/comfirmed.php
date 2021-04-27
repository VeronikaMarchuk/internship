<?php
// Подключаем коннект к БД
include '../connect/connection.php';

// Проверка есть ли хеш
if ($_GET['hash']) {
    $hash = $_GET['hash'];
    // Получаем id и подтверждено ли Email
    if ($result = mysqli_query($link, "SELECT id, email_confirmed FROM users WHERE hash='" . $hash . "'")) {
        while( $row = mysqli_fetch_assoc($result) ) {
            echo $row['id'] . " " . $row['email_confirmed'];
            // Проверяет получаем ли id и Email подтверждён ли
            if ($row['email_confirmed'] == 0) {
                // Если всё верно, то делаем подтверждение
                mysqli_query($link, "UPDATE users SET email_confirmed=1 WHERE id=". $row['id'] );
                echo "Email подтверждён";
            } else {
                echo "Что то пошло не так";
            }
        }
    } else {
        echo "Что то пошло не так";
    }
} else {
    echo "Что то пошло не так";
}
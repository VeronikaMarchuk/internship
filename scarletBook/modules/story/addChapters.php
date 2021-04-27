<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
require '../../connect/connection.php';

$text =$_POST['text'];
$chapter = $_POST['chapter'];
$id = $_SESSION['idCreateStory'];

$query = "INSERT INTO textofstory (idStory, chaptersN, text) VALUES ('$id','$chapter','$text')";
$result  = mysqli_query($link, $query ) or die("Ошибка " . mysqli_error($link));
echo 'profile.php';
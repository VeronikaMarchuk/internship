<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include '../../connect/connection.php';

$chapters = $_GET['chaptersN'] + 1;
$_SESSION['chaptersN'] = $_GET['chaptersN'] + 1;

$query = "SELECT * FROM textofstory where idStory=".$_SESSION['idStory']." and chaptersN=".$chapters;
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);
do
{
    $_SESSION['chaptersN'] = $row['chaptersN'];
    $_SESSION['nameChapters'] = 'Глава '.$_SESSION['chaptersN'];
    $_SESSION['text'] = $row['text'];
    echo "chapters.php?chaptersN=".$row['chaptersN'];
}
while($row = mysqli_fetch_assoc($result));

<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

$_SESSION['idChapters'] = $_GET['id'];
include '../../connect/connection.php';
$query = "SELECT * FROM textofstory where id=".$_SESSION['idChapters'];
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
?>
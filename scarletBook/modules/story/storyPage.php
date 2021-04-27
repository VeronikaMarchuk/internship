<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

$_SESSION['idStory'] = $_POST['idStory'];
include '../../connect/connection.php';
$query = "SELECT * FROM story where id=".$_SESSION['idStory'];
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);
do
{
    $_SESSION['imgStory'] = $row['img'];
    $_SESSION['author'] = $row['author'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['discription'] = $row['discription'];
    $_SESSION['status'] = $row['status'];
}
while($row = mysqli_fetch_assoc($result));
?>

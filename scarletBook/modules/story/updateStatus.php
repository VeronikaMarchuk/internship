<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
require '../../connect/connection.php';
$idStory = $_POST['idStory'];
$status = $_POST['status'];
$query = "update story set status='".$status."' WHERE id=".$idStory;

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
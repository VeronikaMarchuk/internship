<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include '../../connect/connection.php';

$search = $_POST['search'];
$query = "SELECT * FROM story where name like '%".$search."%'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);
$name = '';
do
{
    $name .= '<div onclick="readS('.$row["id"].')"><p>'.$row["name"].'</p></div>';
}
while($row = mysqli_fetch_assoc($result));

//$query = "SELECT * FROM story where author like '%".$search."%'";
//$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
//$row = mysqli_fetch_assoc($result);
//$author = '';
//do
//{
//    $author .= '<div><p>'.$row["name"].'</p></div>';
//}
//while($row = mysqli_fetch_assoc($result));
echo $name;
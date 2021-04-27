<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
require '../../connect/connection.php';
$nameStory = $_POST['nameStory'];
$description = $_POST['description'];
$hero = $_POST['hero'];
$typePartners = $_POST['typePartners'];
$ageCategory = $_POST['ageCategory'];
$ganre = $_POST['ganre'];
$storyImg = $_POST['storyImg'];
$author = $_SESSION['id'];
$date = date("y-m-d");

if(strlen($storyImg) == 0){
    $storyImg = 'img/imgDef.jpg';
}

$query = "INSERT INTO story (name, discription, img, author, status, date, partners, ageCategory) VALUES ('$nameStory','$description','$storyImg','$author','В процессе','$date','$typePartners','$ageCategory')";
$result  = mysqli_query($link, $query ) or die("Ошибка " . mysqli_error($link));

$query2 = "select * from story where author=".$_SESSION['id']." ORDER BY id DESC LIMIT 1";
$result2  = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
$row2 = mysqli_fetch_assoc($result2);
do
{
    $_SESSION['idCreateStory'] = $row2['id'];
}
while($row2 = mysqli_fetch_assoc($result2));
$id = $_SESSION['idCreateStory'];

for($i=0; $i< count($ganre); $i++){
    $query = "INSERT INTO ganres (idStory, ganre, idGanre) VALUES ('$id','$ganre[$i]','1')";
    $result  = mysqli_query($link, $query ) or die("Ошибка " . mysqli_error($link));
}
echo 'storyPage.php?id='.$id;
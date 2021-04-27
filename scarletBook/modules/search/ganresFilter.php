<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include '../../connect/connection.php';
$ganre = $_POST['ganres'];
$ganres = "'".$_SESSION['ganre']."', ".$ganre;

$query = "SELECT * FROM `story` inner JOIN `ganres` on `story`.id=`ganres`.idStory WHERE `ganres`.ganre in(".$ganres.") group by `story`.id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);
$i = 0;

do
{
    $ganre = '';
    $str = "<div><img id='imageStory' src='".$row['img']."'><p>".$row['name']."</p><p>".$row['discription']."</p>";
    $query2 = "SELECT * FROM `story` inner JOIN `ganres` on `story`.id=`ganres`.idStory WHERE `ganres`.idStory=".$row['idStory'];
    $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
    $row2 = mysqli_fetch_assoc($result2);
    do{
        $ganre .= '<p>'.$row2['ganre'].'</p>';
    }while($row2 = mysqli_fetch_assoc($result2));
    $str .= $ganre.'</div>';
    echo $str;
}
while($row = mysqli_fetch_assoc($result));
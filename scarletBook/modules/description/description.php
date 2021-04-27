<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php
include '../../connect/connection.php';
$id = $_POST['id'];

$query = "SELECT * FROM `story` inner JOIN `ganres` on `story`.id=`ganres`.idStory WHERE `ganres`.idStory=".$id;
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);
$i = 0;
$str2 = '';
if($_SESSION['login']  != '') {
    $query2 = "SELECT count(*) FROM likes WHERE idUser=" . $_SESSION['id'] . " and idStory=" . $id;
    $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
    $row2 = mysqli_fetch_assoc($result2);
}

$query3 = "SELECT count(*) FROM likes WHERE idStory=".$id;
$result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
$row3 = mysqli_fetch_assoc($result3);

$query5= "SELECT count(*) FROM textofstory WHERE idStory=".$id;
$result5 = mysqli_query($link, $query5) or die("Ошибка " . mysqli_error($link));
$row5 = mysqli_fetch_assoc($result5);


if($_SESSION['login']  != '' && $row2['count(*)'] == 0) {
    do {
        if($i == 0){
            $str = '<div><img id="imageStory" src="' . $row['img'] . '"></div><div class="description"><h2>' . $row['name'] . '</h2><div class="like"><div id="likes"><img class="like" src="img/likeUnactive.svg" width="auto" height="15px" onclick="like()"><div class="countLike">'.$row3['count(*)'].'</div></div><div><img src="img/menu.svg" width="16.5px" height="15px"> '.$row5['count(*)'].'</div></div><p>' . $row['discription'] . '</p><div class="ganre"><p>' . $row['ganre'] . '</p>';
            $i++;
        }
        else{
            $str2 .= '<p>' . $row['ganre'] . '</p>';
        }
    } while ($row = mysqli_fetch_assoc($result));
   // echo $str.$str2.'<img src="img/markUnactive.svg" width="auto" height="25px" onclick="mark()"></div>';
}
elseif($_SESSION['login']  != '' && $row2['count(*)'] != 0){
 do {
        if($i == 0){
            $str = '<div><img id="imageStory" src="' . $row['img'] . '"></div><div class="description"><h2>' . $row['name'] . '</h2><div class="like"><div id="likes"><img class="like" src="img/likeActive.svg" width="auto" height="15px" onclick="like()"><div class="countLike">'.$row3['count(*)'].'</div></div><div><img src="img/menu.svg" width="16.5px" height="15px"> '.$row5['count(*)'].'</div></div><p>' . $row['discription'] . '</p><p>' . $row['ganre'] . '</p>';
            $i++;
        }
        else{
            $str2 .= '<p>' . $row['ganre'] . '</p>';
        }
    } while ($row = mysqli_fetch_assoc($result));
   // echo $str.$str2.'<img src="img/markUnactive.svg" width="auto" height="25px" onclick="mark()"></div>';
}
else{
    do {
        if($i == 0){
            $str = '<div><img id="imageStory" src="' . $row['img'] . '"></div><div class="description"><h2>' . $row['name'] . '</h2><div class="like"><div id="likes"><img src="img/likeUnactive.svg" width="auto" height="15px" onclick="regAuth()"><div class="countLike">'.$row3['count(*)'].'</div></div><div><img src="img/menu.svg" width="16.5px" height="15px"> '.$row5['count(*)'].'</div></div><p>' . $row['discription'] . '</p><p>' . $row['ganre'] . '</p>';
            $i++;
        }
        else{
            $str2 .= '<p>' . $row['ganre'] . '</p>';
        }
    } while ($row = mysqli_fetch_assoc($result));
//    echo $str.$str2.'<img src="img/markUnactive.svg" width="auto" height="25px" onclick="mark()"></div>';
}

if($_SESSION['login']  != '') {
    $query4 = "SELECT count(*) FROM bookmarks WHERE idUser=" . $_SESSION['id'] . " and idStory=" . $id;
    $result4 = mysqli_query($link, $query4) or die("Ошибка " . mysqli_error($link));
    $row4 = mysqli_fetch_assoc($result4);
}

if($_SESSION['login']  != '' && $row4['count(*)'] == 0){
	$str3 = '</div><div class="read-align"><div class="read"><button onclick="read()">Читать</button></div><div id="mark"><img src="img/markUnactive.svg" width="auto" height="25px" onclick="mark()"></div></div></div></div>';
}
elseif($_SESSION['login']  != '' && $row4['count(*)'] != 0){
	$str3 = '<div id="mark"><div class="read-align"><div class="read"><button onclick="read()">Читать</button></div><img src="img/markActive.svg" width="auto" height="25px" onclick="mark()"></div></div></div></div>';
}
else {
	$str3 = '<div id="mark"><div class="read-align"><div class="read"><button onclick="read()">Читать</button></div><img src="img/markUnactive.svg" width="auto" height="25px" onclick="regAuth()"></div></div></div></div>';
}

echo $str.$str2.$str3;
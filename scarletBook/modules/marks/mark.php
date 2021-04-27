<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php
include '../../connect/connection.php';
$idStory = $_POST['idStory'];

$query = "SELECT count(*) FROM bookmarks WHERE idUser=".$_SESSION['id']." and idStory=".$idStory;

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);

if($row['count(*)'] == 0){
	$query2 = "INSERT INTO bookmarks (idStory, idUser) VALUES ('$idStory','".$_SESSION['id']."')";
	$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
	

	echo '<img src="img/markActive.svg" width="auto" height="25px" onclick="mark()">';
}
else {
	$query4 = "DELETE FROM bookmarks WHERE idUser=".$_SESSION['id']." and idStory=".$idStory;
	$result4 = mysqli_query($link, $query4) or die("Ошибка " . mysqli_error($link));

	echo '<img src="img/markUnactive.svg" width="auto" height="25px" onclick="mark()">';
}



?>
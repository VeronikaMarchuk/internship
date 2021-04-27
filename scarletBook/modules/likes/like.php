<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php
include '../../connect/connection.php';
$idStory = $_POST['idStory'];

$query = "SELECT count(*) FROM likes WHERE idUser=".$_SESSION['id']." and idStory=".$idStory;

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);

if($row['count(*)'] == 0){
	$query2 = "INSERT INTO likes (idStory, idUser) VALUES ('$idStory','".$_SESSION['id']."')";
	$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
	
	$query3 = "SELECT count(*) FROM likes WHERE idStory=".$idStory;
	$result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
	$row3 = mysqli_fetch_assoc($result3);
	echo "<img src='img/likeActive.svg' width='auto' height='15px' onclick='like()'><div class='countLike'>".$row3['count(*)']."</div>";
}
else {
	$query4 = "DELETE FROM likes WHERE idUser=".$_SESSION['id']." and idStory=".$idStory;
	$result4 = mysqli_query($link, $query4) or die("Ошибка " . mysqli_error($link));

	$query5 = "SELECT count(*) FROM likes WHERE idStory=".$idStory;
	$result5 = mysqli_query($link, $query5) or die("Ошибка " . mysqli_error($link));
	$row5 = mysqli_fetch_assoc($result5);
	echo "<img src='img/likeUnactive.svg' width='auto' height='15px' onclick='like()'><div class='countLike'>".$row5['count(*)']."</div>";
}



?>

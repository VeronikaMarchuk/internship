<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php
include '../../connect/connection.php';
$id = $_POST['id'];

$query = "SELECT img FROM story where id=".$id;
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);
do
{
    echo $row['img'];
}
while($row = mysqli_fetch_assoc($result));

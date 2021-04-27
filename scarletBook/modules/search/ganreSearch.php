<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include '../../connect/connection.php';
$_SESSION['ganre'] = $_POST['ganre'];
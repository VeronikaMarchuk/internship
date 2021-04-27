<?php

if (session_status() != PHP_SESSION_ACTIVE) session_start();
$_SESSION['id'] = '';
$_SESSION['login'] = '';
$_SESSION['email'] = '';
$_SESSION['password'] = '';
$_SESSION['salt'] = '';
$_SESSION['birthday'] = '';
$_SESSION['photo'] = '';
print "<script language='Javascript' type='text/javascript'>
 function reload(){top.location = '../../index.php'};
 setTimeout('reload()', 0);
 </script>";
?>
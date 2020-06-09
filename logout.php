<?php
session_start();
$_SESSION['loginStatus'] = false;
session_destroy();
header('Location: index.php');
exit();
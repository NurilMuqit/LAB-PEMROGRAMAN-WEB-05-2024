<?php
session_start();
$_SESSION = [];
session_unsen();
session_destroy();
header("Location: login.php");
exit;
?>
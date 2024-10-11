<?php
session_start();
session_destroy();
header('Location: ../src/homepage.php');
exit;
?>

<?php
session_start();
unset($_SESSION["usnm"]);
unset($_SESSION["val"]);
session_destroy();
header("Location:dtproj.html");
?>
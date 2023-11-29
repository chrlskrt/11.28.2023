<?php
    include_once("api.php");
    unset($_SESSION['username']);
    session_destroy();
    header("Location: index.php");
    exit();
?>
<?php
    include("api.php");

    if($_SERVER["REQUEST_METHOD"] === "POST") {  
        handleDelComment($_POST['commId']);
        header("Location: index.php");
        exit();
    }
?>
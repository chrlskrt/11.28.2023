<?php
    include("api.php");

    if($_SERVER["REQUEST_METHOD"] === "POST") {  
        handleDelPost($_POST['postId']);
        header("Location: index.php");
        exit();
    }
?>
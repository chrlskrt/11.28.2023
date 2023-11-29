<?php
    include("api.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $currUser = json_decode($_SESSION["user"],true);
        $post_id = getNewPostID();

        handleCreatePost([
            "uid" => $currUser["id"],
            "id" => $post_id,
            "title" => $_POST["title"],
            "body" => $_POST["body"],
        ]);

        header("Location: index.php");
        exit();
    }
?>
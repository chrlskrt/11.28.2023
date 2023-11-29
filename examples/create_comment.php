<?php
    include("api.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $currUser = json_decode($_SESSION["user"],true);
        $comment_id = getNewCommentID();

        handleCreateComment([
            "postId" => $_POST["postId"],
            "id" => $comment_id,
            "name" => $currUser["name"],
            "email" => $currUser["email"],
            "body" => $_POST["comment-body"],
        ]);

        header("Location: index.php");
        exit();
    }
?>
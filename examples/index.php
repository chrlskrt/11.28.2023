<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='styles.css'>
</head>
<body>
    <?php
        include_once("header.php");
    ?>
    
    <div class="container">
        <?php
            include_once("api.php");
            if (isset($_SESSION['user'])) {
                echo '<div class="new-post">
                        <form action="create_post.php" method="post">
                        <div class="new-post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="title" id="posttitle" placeholder="Post Title" required>
                            <label for="posttitle">Post Title</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Write something..." id="postbody" name="body" style="height: 100px" required></textarea>
                            <label for="postbody">Write something...</label>
                        </div>
                        <button type="submit" role="button" class="btn btn-primary btn-lg btn-block">Post</button>
                      </div></form> </div>';
            } 
            
            echo getPosts();
        ?>    
    </div>
</body>
</html>
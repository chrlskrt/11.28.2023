<?php
    include_once("api.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $result = handleLogIn();
        if ($result === 1){
            header("Location: index.php");
            exit();
        } 

        if ($result === -1){
            header("Location: ?password_unmatch");
            exit();
        }

        header("Location: ?login_error");
        exit();
    }
?>


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
        include("header.php");
    ?>
    <section class="CreateNLog">
        <div>
            <h1>Log In</h1>
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                <div class="formsch">
                    <div class="form-floating mb-3">
                        
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username..." required>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password..." required>
                        <label for="password">Password</label>
                    </div>
                    <button type="submit" role="button" class="btn btn-primary btn-lg btn-block">Log In</button>

                </div>
            
                <?php
                    if (isset($_GET["password_unmatch"])){
                        echo '<div class="alert alert-danger mt-3" role="alert">Log-in failed. Password unmatch.</div>';
                    }

                    if (isset($_GET['login_error'])){
                        echo '<div class="alert alert-danger mt-3" role="alert">Log-in failed. User not found.</div>';
                    }
                ?>
            </form>
        </div>
    </section>
</body>
</html>
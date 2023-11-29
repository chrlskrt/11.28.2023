<?php
    include_once("api.php");
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        if (handleSignUp()){
            header("Location: index.php");
            exit();
        }

        header("Location: ?signup_error");
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
            <h1>Sign Up</h1>
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                <div class="formsch">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                        <label for="name">Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating mb-3"> 
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                        <label for="username">Username</label>
                    </div>

                    <div class="form-floating mb-3"> 
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                
                    <div>
                        Address
                    </div>

                    <div class="form-floating mb-3">  
                        <input type="text" class="form-control" id="street" name="street" required>
                        <label for="street">Street</label>
                    </div>

                    <div class="form-floating mb-3">
                        
                        <input type="text" class="form-control" id="barangay" name="barangay" required>
                        <label for="barangay">Barangay</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        
                        <input type="text" class="form-control" id="city" name="city" required>
                        <label for="city">City</label>
                    </div>
            
                
                    <button type="submit" role="button" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </div>

                <?php
                    if (isset($_GET['signup_error'])){
                        echo '<div class="alert alert-danger mt-3" role="alert">Sign-up failed. User already exists.</div>';
                    }
                ?>
            </form>
        </div>
    </section>
</body>
</html>
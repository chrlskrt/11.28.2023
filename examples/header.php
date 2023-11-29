<?php
  include_once("api.php");
?>

<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="index.php" class="nav-link px-2 text-white">Posts</a></li>
        </ul>

        <div class="text-end">
          <?php
            global $currentUser;
            if ($currentUser){
              echo '<span>' . $currentUser . '</span>
                    <a href="logout.php" class="btn btn-danger">LOGOUT</a>';
            } else {
              echo '<a href="login.php" class="btn btn-outline-light me-2">Login</a>
              <a href="signup.php" class="btn btn-warning">Sign-up</a>';
            }
          ?>
        </div>
      </div>
    </div>
  </header>
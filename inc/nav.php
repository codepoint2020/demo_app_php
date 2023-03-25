<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">MySite</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="register.php">Users</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="">Users</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li> -->
      </ul>
      <form class="d-flex">
        <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->

        <a class = "current_user" href="user_profile.php?view=<?php if (isset($_SESSION['ID'])) { echo $_SESSION['ID']; } ?>">
          
          <?php
  
          if (isset($_SESSION['current_user'])) {  
             echo "Hi, " . $_SESSION['current_user'];
          }
  
  
          ?>
  
        
          </a>


        <?php if (!isset($_SESSION['isLoggedIn'])): ?>

       

        <a class="btn btn-primary" href="login.php">Login</a>
        <?php else: ?>
        <a class="btn btn-primary" href="logout.php">Logout</a>
        <?php endif; ?>
      </form>
    </div>
  </div>
</nav>
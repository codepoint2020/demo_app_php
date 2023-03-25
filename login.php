
<?php
    include 'inc/config.php';
    include 'inc/header.php';
    include 'inc/process.php';
?>
    <link href="css/signin.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="login.php" method="POST">
    <img class="mb-4" src="images/icon.png" alt="" width="72">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating mb-2">
      <input type="email" class="form-control" id="login_email" name="login_email" value="<?php  if (!empty($_SESSION['entered_email'])) { echo $_SESSION['entered_email']; } ?>" placeholder="name@example.com">
      <label for="login_email">Email address</label>


      <?php if (in_array('empty_email', $login_error_array )) {?>
        <p class="required">Required</p>
      <?php } ?>


    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Password">
      <label for="login_password">Password</label>


      <?php if (in_array('empty_password', $login_error_array )) {?>
        <p class="required">Required</p>
      <?php } ?>


    </div>

    <?php display_login_error(); //print_r($login_error_array); ?>
    <button class="w-100 btn btn-lg btn-primary mt-4" name="signin_btn">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>

<?php
    include 'inc/footer.php';
?>
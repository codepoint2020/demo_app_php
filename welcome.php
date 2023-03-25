<?php

include 'inc/config.php';
include 'inc/process.php';
include 'inc/header.php';
include 'inc/nav.php';

?>


<?php if (isset($_SESSION['isLoggedIn'])): ?>
  <div class="px-4 py-5 my-5 text-center">
    <!-- <img class="d-block mx-auto mb-4" src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="display-5 fw-bold">Welcome, <?php if (isset($_SESSION['current_user'])) { echo $_SESSION['current_user']; }?></h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">You are currently logged in.</p>
   
    </div>
  </div>
<?php else: ?>
    <div class="px-4 py-5 my-5 text-center">
    <!-- <img class="d-block mx-auto mb-4" src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="display-5 fw-bold">Welcome user</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">You are NOT currently logged in.</p>
      <a class="btn btn-primary" href="login.php">Login in now...</a>
   
    </div>
  </div>
<?php endif; ?>

  <?php
include 'inc/footer.php';
?>

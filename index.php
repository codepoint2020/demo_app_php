<?php
include 'inc/config.php';
include 'inc/process.php';
include 'inc/header.php';
include 'inc/nav.php';

?>

<?php if (!isset($_SESSION['isLoggedIn'])): ?>
<div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="images/laptop.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">Welcome to my page</h1>
        <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <a href="login.php" class="btn btn-primary btn-lg px-4 me-md-2">Login Now</a>
      
        </div>
      </div>
    </div>
  </div>

  <?php else:
  header("Location: welcome.php");
  endif; ?>

  <?php
include 'inc/footer.php';
?>

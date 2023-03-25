<?php
include 'inc/config.php';
include 'inc/process.php';
include 'inc/header.php';
include 'inc/nav.php';

if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: index.php");
}

?>

<div class="container mt-4">

<div class="row">
    <div class="col-md-3">
        <?php if (!empty($profile_pic)): ?>
            <img src="<?php echo $path . $profile_pic; ?>" alt="..." class="img-thumbnail img-center">
        <?php else: ?>
            <img src="<?php echo $path . "default.png"; ?>" alt="..." class="img-thumbnail img-center">
        <?php endif; ?>
    </div>
    <div class="col-md-9">
        <h1>Name: <?php echo $firstname . " " .$lastname?></h1>
        <p>Email: <?php echo $email; ?></p>
        <p>Username: <?php echo $username; ?></p>

        <?php
            display_notification();
        ?>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#manual_password" type="button" role="tab" aria-controls="home" aria-selected="true">Manual Password</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#generate_password" type="button" role="tab" aria-controls="profile" aria-selected="false">Auto Generate</button>
            </li>
          
            </ul>

            <form action="user_profile.php?view=<?php echo $id; ?>" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="manual_password" role="tabpanel" aria-labelledby="home-tab">
                        <div class="mb-3">
                            <label for="m_password" class="form-label">Enter a password</label>
                            <input type="text" class="form-control" id="m_password" name="m_password" placeholder="Enter a password">
                        </div>
                        <div>
                            <button class="btn btn-success" name="m_password_btn">Submit</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="generate_password" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="mt-3">
                            <button class="btn btn-success" name="gen_password_btn">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
    </div>


</div>



</div>


<?php
include 'inc/footer.php';
?>
<?php
include 'inc/config.php';
include 'inc/process.php';
include 'inc/header.php';
include 'inc/nav.php';

if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: index.php");
}


?>

<?php display_notification(); ?>
<div class="container">
    
    <!-- <a href="register.php" class="btn btn-sm btn-info mt-4">RESET</a>
    <div>
    <a href="logout.php" class="btn btn-sm btn-warning mt-2">LOGOUT</a>
    </div> -->
<div class="row">

    
        <div class="col-md-3">
            <form action="register.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <h3>Name: <?php if (isset($_SESSION['current_user'])) { echo $_SESSION['current_user']; }?></h3>
                    <p>Role: <?php if (isset($_SESSION['role'])) { echo $_SESSION['role']; }?></p>
                </div>
                <h1 class="text-center mt-4">Registration Form</h1>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First name</label>
                    <input type="text" 
                    
                    class="form-control 
                    
                    <?php 
                    if (in_array('empty_fname', $login_error_array )) { 
                        echo 'alert-user'; 
                    } 
                    ?>
                    "
                    value="<?php echo $fname; ?>" 
                    
                    name="first_name" id="first_name" placeholder="Enter your first name">
                </div>

                <?php if (in_array('empty_fname', $login_error_array )) :?>
                    <p class="required">Required</p>
                <?php endif; ?>
                
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last name</label>
                    <input type="text" 
                    
                    class="form-control
                    
                    <?php 
                    if (in_array('empty_lname', $login_error_array )) { 
                        echo 'alert-user'; 
                    } 
                    ?>
                    
                    " value="<?php echo $lname; ?>" 

                    name="last_name" id="last_name" placeholder="Enter last name">
                </div>

                <?php if (in_array('empty_lname', $login_error_array )) :?>
                    <p class="required">Required</p>
                <?php endif; ?>

                
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control

                    <?php 
                    if (in_array('empty_email', $login_error_array )) { 
                        echo 'alert-user'; 
                    } 
                    ?>
                    
                    " 
                    value="<?php echo $em; ?>" 
                    
                    name="email" id="email" placeholder="Enter email">
                </div>

                <?php if (in_array('empty_email', $login_error_array )) :?>
                    <p class="required">Required</p>
                <?php endif; ?>


                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>

                    <select name="role" id="role" class="form-control
                    
                    <?php 
                    if (in_array('empty_role', $login_error_array )) { 
                        echo 'alert-user'; 
                    } 
                    ?>
                    
                    ">
                        <?php if (empty($role)): ?>
                        <option value="" selected hidden>Default</option>
                        <?php else: ?>
                        <option value="<?php echo $role; ?>" selected hidden><?php echo $role; ?></option>
                        <?php endif; ?>
                        <option value="administrator">Administrator</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="CEO">CEO</option>
                        <option value="team_leader">Team Leader</option>
                        <option value="agent">Agent</option>
                    </select>
                </div>

                <?php if (in_array('empty_role', $login_error_array )) :?>
                    <p class="required">Required</p>
                <?php endif; ?>


                <?php if ($update == false) : ?>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control
                    
                    <?php 
                    if (in_array('empty_password', $login_error_array )) { 
                        echo 'alert-user'; 
                    } 
                    ?>
                    
                    " 
                    
                    value="<?php echo $pword; ?>" 
                    
                    name="password" id="password" placeholder="Enter your password">
                </div>
                <?php endif; ?>

                <?php if (in_array('empty_password', $login_error_array )) :?>
                    <p class="required">Required</p>
                <?php endif; ?>
                    
                <?php if (!empty($profile_pic)) :?>
                <div class="mb-3">
                    <img src="<?php echo $path . $profile_pic; ?>" alt="profile picture" height="72px">
                </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="profile_pic" class="form-label">
                    <?php   if ($update == false) {
                        echo "Upload a picture";
                    } else {

                        if (empty($profile_pic)) {
                            echo "Upload a picture";
                        } else {
                            echo "Change ID Picture";
                        }
                        
                    }
                    ?>
                    </label>
                    <input type="file" name="profile_pic" id="profile_pic">
                </div>




                <?php if ($update == false ) {?>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" name="submit_btn">Submit</button>
                </div>
                <?php } else { ?>
                <div class="d-grid gap-2 mb-3">
                    <button class="btn btn-success" name="update_btn">Update</button>
                    <a class="btn btn-outline-secondary" href="register.php">Cancel</a>
                </div>
                <?php } ?>
            </form>
        </div>
    


    <div class="col-md-9">
        <h1 class="text-center mt-4 display-4">DEMO APP</h1>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>ID PICTURE</th>
                    <th>COMPLETE NAME</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th>USERNAME</th>
                    <th>OPERATION</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $my_records = $con->query("SELECT * FROM users ORDER BY ID DESC");
                $myCounter = 0;
                while ($row = $my_records->fetch_assoc()) { 
                    $myCounter++;       
                ?>
                <tr>
                    <td><?php echo $myCounter; ?></td>
                    <td> <img src="
                        <?php 
                        if (!empty($row["ID_PIC"])) {
                            echo $path . $row['ID_PIC']; 
                        } else {
                            echo $path."default.png";
                        }
                        
                        
                        ?>" 
                    
                    alt="" height="72px"> </td>
                    <td><?php echo ucwords(strtolower($row["FIRSTNAME"] . " " .$row["LASTNAME"])); ?></td>
                    <td><?php echo strtolower($row["EMAIL"]); ?></td>
                    <td><?php echo $row["ROLE"]; ?></td>
                    <td><?php echo $row["USERNAME"]; ?></td>
                    <td>
                    <a href="register.php?delete=<?php echo $row["ID"]; ?>" class="btn btn-danger btn-sm">Del</a>
                    <a href="register.php?edit=<?php echo $row["ID"]; ?>" class="btn btn-info btn-sm">Edit</a> 
                    <a href="user_profile.php?view=<?php echo $row["ID"]; ?>" class="btn btn-success btn-sm">View</a> 
                    
                    </td>
                </tr>
                <?php } ?>
            </tbody>
    </table>
        
    </div>
</div>



    
</div>

<?php
    include 'inc/footer.php';
?>
  
  
  
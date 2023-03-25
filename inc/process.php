<?php

//Initialize variables
$id = "";
$fname ="";
$lname = "";
$em = "";
$role = "";
$username = "";
$pword = "";
$update = false;
$profile_pic = "";
$path = "images/profile_pictures/";

$manual_password = "";
$random_password = "";






//Entered email sessioin
$_SESSION['entered_email'] = "";

//Initialized login error array
$login_error_array = array();


//This is to CREATE a record
if (isset($_POST['submit_btn'])) {

    $fname = clean_string($_POST['first_name']);
    $lname = clean_string($_POST['last_name']);
    $em = clean_string($_POST['email']);
    $role = clean_string($_POST['role']);

    $username = $fname . "." . $lname;
    $pword = $_POST["password"];

   

    //capture image filename
    $profile_pic = $_FILES['profile_pic']['name'];

    $target = "images/profile_pictures/".$profile_pic;
    

    if (empty($fname)) {
        prepare_login_error('empty_fname');
        array_push($login_error_array, 'empty_fname');
    }
    
    if (empty($lname)) {
        prepare_login_error('empty_lname');
        array_push($login_error_array, 'empty_lname');
    }

    if (empty($em)) {
        prepare_login_error('empty_email');
        array_push($login_error_array, 'empty_email');
    }

    if (empty($pword)) {
        prepare_login_error('empty_password');
        array_push($login_error_array, 'empty_password');
    }



    if (empty($login_error_array)) {

        $pword = password_hash($_POST['password'], PASSWORD_BCRYPT);

        if (empty($profile_pic)) {
            $insert_query = $con->query("INSERT INTO users (LASTNAME, FIRSTNAME, EMAIL, ROLE, USERNAME, PASSWORD ) VALUES ('$lname','$fname','$em','$role','$username', '$pword') ") or die("Insert query failed: " .$con->error.__LINE__);
        } else {
            $insert_query = $con->query("INSERT INTO users (ID_PIC, LASTNAME, FIRSTNAME, EMAIL, ROLE, USERNAME, PASSWORD ) VALUES ('$profile_pic', '$lname','$fname','$em','$role','$username', '$pword') ") or die("Insert query failed: " .$con->error.__LINE__);
            
            move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);
        }

       

        if ($insert_query == true) {

            set_notify("A new record has been added.");

            $id = "";
            $fname ="";
            $lname = "";
            $em = "";
            $role = "";
            $username = "";
            $pword = "";
            $profile_pic = "";

        } 

    } else {
        set_notify("Please fill up the form completely");
    }

}

//This is to delete a record

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    //query existing id picture filename
    $existing_filename = $con->query("SELECT * FROM users WHERE ID = $id; ");
    $row = $existing_filename->fetch_assoc();
    $existing_pic = $row["ID_PIC"];

    //DELETE the existing picture
    if (!empty($existing_pic)) {
        unlink($path.$existing_pic);
    }

    $del_query = $con->query("DELETE FROM users WHERE ID = $id;");

    if ($del_query == true) {
        set_notify("You have deleted a record.");
    }

}

//This is to select a record to update

if (isset($_GET['edit'])) {

    $update = true;
    $id = $_GET['edit'];

    $target_query = $con->query("SELECT * FROM users WHERE ID = $id;");
    $target_row = $target_query->fetch_assoc();

    $fname = $target_row["FIRSTNAME"];
    $lname = $target_row["LASTNAME"];
    $em = $target_row["EMAIL"];
    $role = $target_row["ROLE"];
    $username = $target_row["USERNAME"];
    $pword = $target_row["PASSWORD"];

    if (!empty($target_row["ID_PIC"])) {
        $profile_pic = $target_row["ID_PIC"];
    } else {
        $profile_pic = "";
    }
 
}


//This is to UPDATE a record
if (isset($_POST['update_btn'])) {

    $id = $_POST['id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $em = $_POST['email'];
    $role = $_POST['role'];
    $username = $fname . "." . $lname;


    //capture image filename
    $profile_pic = $_FILES["profile_pic"]["name"];


    //target location of the server directory/folder where the image will be uploaded.
    $target = $path.$profile_pic;
  


    
    if (empty($fname)) {
        prepare_login_error('empty_fname');
        array_push($login_error_array, 'empty_fname');
    }
    
    if (empty($lname)) {
        prepare_login_error('empty_lname');
        array_push($login_error_array, 'empty_lname');
    }

    if (empty($em)) {
        prepare_login_error('empty_email');
        array_push($login_error_array, 'empty_email');
    }

    if (empty($role)) {
        prepare_login_error('empty_role');
        array_push($login_error_array, 'empty_role');
    }

    if (empty($username)) {
        prepare_login_error('empty_username');
        array_push($login_error_array, 'empty_username');
    }



    if (empty($login_error_array)) {

        if (empty($profile_pic)) {
            $update_query = $con->query("UPDATE users SET LASTNAME = '$lname', FIRSTNAME = '$fname', EMAIL = '$em', ROLE = '$role', USERNAME = '$username' WHERE ID = $id ");
        } else {
            //query existing id picture filename
            $existing_filename = $con->query("SELECT * FROM users WHERE ID = $id; ");
            $row = $existing_filename->fetch_assoc();
            $existing_pic = $row["ID_PIC"];

            //DELETE the existing picture
            if (!empty($existing_pic)) {
                unlink($path.$existing_pic);
            }
            
            //update the database including the filename of the new picture;
            $update_query = $con->query("UPDATE users SET ID_PIC = '$profile_pic', LASTNAME = '$lname', FIRSTNAME = '$fname', EMAIL = '$em', ROLE = '$role', USERNAME = '$username' WHERE ID = $id ");

            //upload the new id picture
            move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target);
            
        }

       

        if ($update_query == true) {

            set_notify("A new record has been updated");

            $id = "";
            $fname ="";
            $lname = "";
            $em = "";
            $role = "";
            $username = "";
            $profile_pic = "";
         

        } 

    } else {
        set_notify("Please fill up the form completely");
        $update = true;
    }

}



//View record individually

if (isset($_GET['view'])) {
    $id = $_GET['view'];
    
    $individual_record_query = $con->query("SELECT * FROM users WHERE ID = $id"); 
    $row = $individual_record_query->fetch_assoc();

    $firstname = $row['FIRSTNAME'];
    $lastname = $row['LASTNAME'];
    $email = $row['EMAIL'];
    $username = $row['USERNAME'];
    $profile_pic = $row['ID_PIC'];

}



//Login functionality
if (isset($_POST['signin_btn'])) {

    
   $login_email = $_POST['login_email'];
   $_SESSION['entered_email'] = $login_email;


   $login_password = $_POST['login_password'];


   
   
   if (empty($login_email)) {
        prepare_login_error('empty_email');
        array_push($login_error_array, 'empty_email');
   }
   
   if (empty($login_password)) {
        prepare_login_error('empty_password');
        array_push($login_error_array, 'empty_password');
   }

    if (empty($login_email) && empty($login_password)) {
        prepare_login_error('empty_login_attempt');
        array_push($login_error_array, 'empty_login_attempt');
    }

    if (empty($login_error_array)) {

        $check_email_query = $con->query("SELECT * FROM users WHERE EMAIL = '$login_email' ");
        $row = $check_email_query->fetch_assoc();
        

        if ($check_email_query->num_rows > 0) {
                $hashed_password = $row['PASSWORD'];
                if (password_verify($login_password, $hashed_password)) {
                    $_SESSION['isLoggedIn'] = 'yes';
                    $_SESSION['username'] = $row['USERNAME'];
                    $_SESSION['current_user'] = $row['FIRSTNAME'];
                    $_SESSION['role'] = $row['ROLE'];
                    $_SESSION['ID'] = $row['ID'];
                    header("Location: welcome.php");
                } else {
                    prepare_login_error('password_failed');
                    
                }
        } else {
                prepare_login_error('email_not_found');
               
        }

    }

}


if (isset($_POST['m_password_btn'])) {
    $id = clean_string($_POST['id']);
    $new_password = clean_string($_POST['m_password']);
    $non_encrypted_password = clean_string($_POST['m_password']);

    if (empty($new_password) || strlen($new_password) < 5) {

        $_SESSION['notification'] = "Password cannot be empty and must at least 4 characters";
    } else {

    
        $new_password = password_hash($new_password, PASSWORD_BCRYPT);

        $update_password_query = $con->query("UPDATE users set PASSWORD = '$new_password' WHERE ID = $id ");

        if ($update_password_query) {
            $_SESSION['notification'] = "New password is: " .$non_encrypted_password;
        }
    }

    
}

if (isset($_POST['gen_password_btn'])) {
    $id = clean_string($_POST['id']);

    //52 letters compost of lower and uppercase form

    $letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
    'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v',
    'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G',
    'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R',
    'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];


//Numbers from 0 to 9

    $numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

//Symbols, other symbols can be added
    $symbols = ['!', '#', '$', '%', '&', '(', ')', '*',('_')];

    //An array that will hold the characters
    $gen_chars = [];

    for ($i = 0; $i < 3; $i++ ) {
       //code
       $x = rand(0, count($letters) - 1);
       array_push($gen_chars, $letters[$x]);
    }

    for ($i = 0; $i < 3; $i++ ) {
        //code
        $x = rand(0, count($numbers) - 1);
        array_push($gen_chars, $numbers[$x]);
     }

     for ($i = 0; $i < 3; $i++ ) {
        //code
        $x = rand(0, count($symbols) - 1);
        array_push($gen_chars, $symbols[$x]);
     }

   

     //shuffle the array
     shuffle($gen_chars);

     //convert the array into a string
     $generated_password = implode($gen_chars);

     //encrypt the password and put it in another variable
     $enc_generated_password = password_hash($generated_password, PASSWORD_BCRYPT);

     $update_password_query = $con->query("UPDATE users set PASSWORD = '$enc_generated_password' WHERE ID = $id; ");

     if ($update_password_query) {
        $_SESSION['notification'] = "The new password is: " . $generated_password;
     }

}



//Preparing login error
function prepare_login_error($error) {
    if (!empty($error)) {
        $_SESSION['login_error'] = $error;
    } else {
        $error = "";
    }
}


//Display login in error function
function display_login_error() {
    if (isset($_SESSION['login_error'])) {
        if ($_SESSION['login_error'] == 'password_failed') {
            echo "<div class='alert alert-danger'>Wrong password</div>";
        } elseif ($_SESSION['login_error'] == 'empty_login_attempt') {
            echo "<div class='alert alert-info'>Email and password are required</div>";
        } elseif ($_SESSION['login_error'] == 'empty_email') {
            echo "<div class='alert alert-info'>Email is required</div>";
        } elseif ($_SESSION['login_error'] == 'empty_password') {
            echo "<div class='alert alert-warning'>Password is required</div>";
        } else {
            echo "<div class='alert alert-primary'>Email not found please sign up</div>";
        }
    }
    unset($_SESSION['login_error']);
}

//SANITIZE OR CLEAN DATA ENTRIES IN REGISTER.PHP
function clean_string($string) {

    global $con;
    //Remove extra whitespaces for both left and right of a string
    $string = trim($string);

    //Allow names with quotes ' or hyphens ' /secures the sql database
    $string = $con->real_escape_string($string);

    //Prevents XSS / Cross Site Scripting
    $string = htmlentities($string, ENT_QUOTES, 'UTF-8');

    //returns the processed string
    return $string;
}


function set_notify($notification) {
    if (!empty($notification)) {
        $_SESSION['notification'] = "$notification";
    } else {
        $notification = "";
    }
}

function display_notification() {
    if (isset($_SESSION['notification'])) {
        echo "<div class='alert alert-info text-center sticky-top'>" . $_SESSION['notification'] . "</div>";
        unset($_SESSION['notification']);
    }
}











<?php

ob_start();
session_start();

//Connection to the database
$con = new mysqli ("localhost", "epiz_33624107", "K6VbJiKfyWAQqY", "epiz_33624107_db_1");

if ($con->connect_error) {
    echo "Connection failed";
} 


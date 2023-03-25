<?php

//Logout functionality
include 'inc/config.php';
session_destroy();
header("Location: index.php");


?>
<?php
    session_start();
   
    echo 'u r logged out';
    session_destroy();
    header('location: /forum/index.php');
?>
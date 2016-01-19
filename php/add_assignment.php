<?php 

if(isset($_FILES['files'])) {
    // Make sure the file was sent without errors
    if($_FILES['files']['error'] == 0) {
        // Connect to the database
        $dbLink = new mysqli('127.0.0.1', 'root', '', 'assignment_upload');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }

        

?>
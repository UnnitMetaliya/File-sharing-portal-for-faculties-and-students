<?php
// Check if a file has been uploaded
if(isset($_FILES['files'])) {
    // Make sure the file was sent without errors
    if($_FILES['files']['error'] == 0) {
        // Connect to the database
        $dbLink = new mysqli('127.0.0.1', 'root', '', 'assignment_upload');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Gather all required data
        $name = $dbLink->real_escape_string($_FILES['files']['name']);
        $mime = $dbLink->real_escape_string($_FILES['files']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['files']['tmp_name']));
        $size = intval($_FILES['files']['size']);

        $subject = $dbLink->real_escape_string($_POST['subject']);
        $title = $dbLink->real_escape_string($_POST['title']);
        $deadline = $dbLink->real_escape_string($_POST['deadline']);
        $description = $dbLink->real_escape_string($_POST['description']);
 
        // Create the SQL query
        $query = "
            INSERT INTO `file` (
                `name`, `mime`, `size`, `data`, `created`,`subject`,`title`,`deadline`,`description`
            )
            VALUES (
                '{$name}', '{$mime}', {$size}, '{$data}', NOW(), '{$subject}','{$title}','{$deadline}','{$description}'
            )";
 
        // Execute the query
        $result = $dbLink->query($query);
 
        // Check if it was successfull
        if($result) {
            echo 'Success! Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['files']['error']);
    }
 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';
}
 
// Echo a link back to the main page
echo '<p>Click <a href="../assignments_upload_final.html">here</a> to go back</p>';
?>
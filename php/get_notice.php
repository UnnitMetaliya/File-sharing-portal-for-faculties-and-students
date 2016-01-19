<?php 

// Make sure id was passed

	if (isset($_GET['id'])) {
		# code...
		// Get the ID

		$id= intval($_GET['id']);

		// Make sure that the id is valid id

		if ($id<=0) {
			# code...

			die("The ID is invalid");
		}
		else
		{
        // Connect to the database
        	
        	$dbLink = new mysqli('127.0.0.1', 'root', '', 'assignment_upload');
        	if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
			//Conenct to the database

			$query = "
            SELECT `id`, `title`, `notice`
            FROM `notices`
            WHERE `id` = {$id}";

            $result = $dbLink->query($query);

            if ($result) {
            	# making sure that result is valid

            	if ($result->num_rows==1) {
            		# get the row
            		$row = mysqli_fetch_assoc($result);

           			echo $row['data'];
            }
                       else {
                echo 'Error! No image exists with that ID.';
            }
 
            // Free the mysqli resources
            @mysqli_free_result($result);
        }
        else {
            echo "Error! Query failed: <pre>{$dbLink->error}</pre>";
        }
        @mysqli_close($dbLink);
    }
}
else {
    echo 'Error! No ID was passed.';
	}


 ?>
<?php 

//check if notice has been typed
if (isset($_POST['title']) && isset($_POST['notice'])) {
	# code...
	$dbLink = new mysqli('localhost','root','','notice_give');

	if (mysqli_connect_errno()) {
		# code...
		die("MySQL connection failed".mysqli_connect_error());
	}

	//Gather all required data
	$subject = $dbLink->real_escape_string($_POST['subject']);

	$title = $dbLink->real_escape_string($_POST['title']);
	$notice = $dbLink->real_escape_string($_POST['notice']);

	//create SQL query

	$query = "INSERT INTO `notices`(`title`,`notice`,`subject`) VALUES('{$title}','{$notice}','{$subject}')";

	//execute the query

	$result = $dbLink->query($query);

	//check if notice sent to database

	if ($result) {
		# code...
		echo "Your notice has been sent..!";
	}
	else{
		echo 'Error'."<pre>{$dbLink->error}</pre>";
	}

	$dbLink->close();

}

?>
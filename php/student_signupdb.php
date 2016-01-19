<?php
if(isset($_POST['signup']))
{
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$name = $_POST['usernamesignup'];
$email = $_POST['emailsignup'];
$enroll = $_POST['enroll'];
$passw = ($_POST['passwordsignup']);
$passw_c = ($_POST['passwordsignup_confirm']);


$sql1 = "SELECT  * FROM student_signupdb  WHERE'$email'=student_signupdb.emailsignup ";
$result = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result) > 0) {
?>
	<script>
		alert("Existing user");
	</script>
<?php
        header('Location:http://localhost/Front%20page/i_am_student.html');
	} 
	else {
    if($passw==$passw_c)
	{	
		$sql = "INSERT INTO student_signupdb (usernamesignup, emailsignup,enroll, passwordsignup,passwordsignup_confirm)
		VALUES ('$name', '$email', $enroll, '$passw','$passw_c')";

		if ($conn->query($sql) === TRUE ) {
			session_start();
			$_SESSION["email"]=$email;
			header('Location:http://localhost/Front%20page/s_regestration_next.html');  
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	else
		{
			echo "Error";
		}
		$conn->close();
	}
}
?>

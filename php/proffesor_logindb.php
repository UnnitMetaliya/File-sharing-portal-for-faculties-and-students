<?php
if(isset($_POST['login']))
{
 
$email = $_POST['emailloginup'];
$passw = ($_POST['passwordlogin']);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proffesor";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql1 = "SELECT * FROM `proffesor_signupdb`  WHERE proffesor_signupdb.emailsignup='$email' AND proffesor_signupdb.passwordsignup='$passw' ";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result)==1) {
		session_start();
		$_SESSION["email"]=$email;
		
        header('Location:http://localhost/Front%20page/p_dashboard.html');
	} 
	else
		{
			?>
	<script>
		alert("Existing user");
	</script>
<?php
		header('Location:http://localhost/Front%20page/i_am_proffesor.php');
		}
	
	$conn->close();
}
?>

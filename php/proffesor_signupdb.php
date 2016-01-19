<?php
if(isset($_POST['signup']))
{
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
$name = $_POST['usernamesignup'];
$email = $_POST['emailsignup'];
$passw = ($_POST['passwordsignup']);
$passw_c = ($_POST['passwordsignup_confirm']);


$sql1 = "SELECT  * FROM proffesor_signupdb  WHERE'$email'=proffesor_signupdb.emailsignup ";
$result = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result) > 0) {
?>
	<script>
		alert("Existing user");
	</script>
<?php
        header('Location:http://localhost/Front%20page/i_am_proffesor.html');
	} 
	else {
    if($passw==$passw_c)
	{	
		$sql = "INSERT INTO proffesor_signupdb (usernamesignup, emailsignup, passwordsignup,passwordsignup_confirm)
		VALUES ('$name', '$email', '$passw','$passw_c')";

		if ($conn->query($sql) === TRUE ) {
			session_start();
			$_SESSION["email"]=$email;
			header('Location:http://localhost/Front%20page/p_regestration_next.html');  
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

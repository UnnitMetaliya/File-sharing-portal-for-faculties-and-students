<?php
if(isset($_POST['forget']))
{
$email = $_POST['username'];
$passw = ($_POST['password']);
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
$sql1 = "SELECT * FROM `proffesor_signupdb`  WHERE proffesor_signupdb.emailsignup='$email' OR proffesor_signupdb.passwordsignup='$passw' ";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result)==1) {
		$rows=mysqli_fetch_array($result);
		$pass  =($rows['passwordsignup']);
		//echo "your pass is ::".($pass)."";
		$to = $rows['emailsignup'];
		//echo "your email is ::".$email;
		//Details for sending E-mail
		$from = "Online repository";
		$body  =  "Online password recovery 
		-----------------------------------------------
		email Details is : $to;
		Here is your password  : $pass;
		Sincerely,
		Online Repository Team ";
		$from = "onlinerepository@yahoo.com";
		$subject = "Password recovery";
		$headers1 = "From: $from\n";
		$sentmail = mail( $to, $subject, $body, $headers1 );
	} else {
	if ($_POST ['email'] != "") {
?>	
	<script>
		alert("Not found your email in our database");
	</script>
<?php
	}
		}
	//If the message is sent successfully, display sucess message otherwise display an error message.
	if($sentmail==1)
	{
		?><script>
		alert("Mail sent");
	</script>
<?php
	}
		else
		{
		if($_POST['username']!="")
		?><script>
		alert("Cannot send password to your e-mail address.Problem  sending mail...");
	</script>
<?php
	}
}
?>

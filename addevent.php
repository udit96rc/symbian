<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "9374070589";
$dbname = "symbian";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//To check whether a user with similar username or email id exists in the database
session_start();	
	if(isset($_SESSION['suusername']) && !empty($_SESSION['suusername'])) {
		$suusername = $_SESSION["suusername"];
		$sql = "INSERT INTO Events(EventID, Title, StartDate, EndDate, Time, Description, AddedBy,VenueID)
				VALUES ($_POST[eventid], $_POST[title],$_POST[startdate],$_POST[enddate],'$_POST[time]','$_POST[description]','$suusername','1')";
	}
	else 
		header('Location: index.php');
	if($conn->query($sql) === TRUE) {
				echo "Event Added Successfully!!";
			}
			else
				echo "Error: " . $sql . "<br>" . $conn->error;

?>

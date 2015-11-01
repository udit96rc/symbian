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
	session_start();	
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		$susername = $_SESSION["username"];
		$sql = "SELECT DPName,FirstName FROM registered WHERE username = '$susername'";
		$result = $conn->query($sql);
		if($result->num_rows == 1) {	
			$row = $result->fetch_assoc();
			$imgname = $row['DPName'];
			$userFirstName = $row['FirstName'];
		}
		else {
			echo 'Error in fetching image!';
		}
	}
	else 
		header('Location: index.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>SYMBIAN</title>
	<link href="css/main.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,800' rel='stylesheet' type='text/css'>
</head>
<body>
	<header>
		<nav class="navbar">
		    <ul>
		    <a href="index.php" id="header-link"><h2 id="header-logo"><abbr title="Symbiosis Insitute of Technology Alu	mni Network">Symbian</abbr></h2></a>
		        <li><a href="index.php">Home</a></li>			
		    	<li><a href="logout.php">Logout</a></li>
		    	<div class="nav-dp-dropdown-container" style="margin-top:5px;">
		    	<?php 
		    	echo "<img class=\"nav-dp-dropdown-btn\"src=\"dp/"."$imgname\"/>" ?>
		    	</div>
		    	<li> <?php echo "<p id=\"userfirstname\"> $userFirstName</p>";?></li>
		    </ul>
		</nav>
	</header>
	<div class="main">
		<div class="wrapper">
			<div class="upcoming-events">
			<?php
				$sql = "SELECT * FROM Events";
				$result = $conn->query($sql);
				if($result->num_rows == 0) {
					echo "No Upcoming Events";
				}
				else {?>
					<table border="0">
					<caption><h3>Upcoming Events</h3></caption>
						<tr>
							<th>Event Name</th>
							<th colspan="2">Attending?</th>
						</tr>
						<?php while ($row = $result->fetch_assoc()) {?>
						<tr>
				    		<?php echo "<td>".$row["Title"]."</td>";?>
							<td id = "yes" value="1" onclick="updateRsvp('1')" rowspan="2">Yes</td>
							<td id = "no" value="0" onclick="updateRsvp('0')" rowspan="2">No</td>
						</tr>
						<tr>
							<?php echo "<td id=\"event-date\">".date("F j, Y",strtotime($row["StartDate"]))."</td>";?>
						</tr>
						<?php } }?>
					</table>
					
			</div>
		</div>
	</div>
</body>
</html>
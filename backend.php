<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}

	$severname = "localhost";
	$username = "root";
	$password = "";
	$db = "simplelogin";

	$conn = new mysqli($severname, $username, $password, $db);

	if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
	}

	$ticname = $_POST['ticket_name'];
	$ticdesc = $_POST['ticket_desc'];
	$ticby = $_POST['ticket_by'];
	$ticassign = $_POST['ticket_to'];

	if(isset($_POST['ticket_name']))
	{
		$sql = "INSERT INTO `tickets` (`name`, `description`, `creator`, `assignee`) VALUES ('$ticname', '$ticdesc', '$ticby', '$ticassign')";

		if($conn->query($sql) == TRUE)
		{
			echo "New ticket was created!";
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	$conn->close();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta charset="utf-8"/>
    	<title>Command</title>
    	<link type = "text/css" rel = "stylesheet" href = "stylesheet.css">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    	<link rel="stylesheet" href="css/foundation.css" />
    	<link rel="stylesheet" href="css/app.css" />
    	<link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
    	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	<!--[if lt IE 9]>
    	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="header">
				<div class="row">
					<div class="large-12 columns">
						<div class="callout large">
							<h1>Black Gekko Backend</h1>
							<p>USERS NAME</p>
							<p>USERS STATUS</p>
							<button class="small button" type="submit" name="submit" onclick="location.href = 'index.php'">Logout</button>
						</div>
					</div>
				</div>
			</div>
			<div class="tickets">
				<div class="row">
					<div class="large-12 columns">
						<div class="callout large">
							<div class="ticketCreator">
								<form class="createATicket" method="post" action="backend.php">
									<p>Ticket Name:</p>
									<input type="text" name="ticket_name">
									<p>Ticket Description:</p>
									<input type="text" name="ticket_desc">
									<p>Ticket Creator:</p>
									<input type="text" name="ticket_by">
									<p>Ticket assignee (If none leave blank):</p>
									<input type="text" name="ticket_to">
									<button class="small button" type="submit" name="submit">Submit</button>
								</form>
							</div>
							<div class="ticketDisplay">
								<!-- Dynamic Tickets -->
								<?php
								//Create edit function

								$severname = "localhost";
								$username = "root";
								$password = "";
								$db = "simplelogin";

								$conn = new mysqli($severname, $username, $password, $db);

								if (mysqli_connect_errno()) {
    								printf("Connect failed: %s\n", mysqli_connect_error());
    								exit();
								}

								$showTicketsQuery = "SELECT * FROM tickets";
								$result = mysqli_query($conn, $showTicketsQuery) or die(mysql_error());

								echo "<table>";

								while($row = mysqli_fetch_array($result))
								{
									echo "<tr><td>" . $row['name'] . "<tr><td>" . $row['description'] . "<tr><td>" . $row['creator'] . "<tr><td>" . $row['assignee'] . "<tr><td>";
								}

								echo "</table>";

								$conn->close();

								function delete()
								{
									//We Will pick back up here tomorrow!!!
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
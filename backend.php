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
									<button class="small button" type="button" name="closeOne" id="showClose">Close a ticket</button>
									<button class="small button" type="button" name="editOne" id="showEdit">Edit a ticket</button>
								</form>
							</div>
							<div class="closeBay">
								<div class="row">
									<div class="large-6 columns">
										<div class="callout large">
											<form class="closeATicket" method="post" action="backend.php">
												<p>Enter ticket to close name:</p>
												<input type="text" name="ticket_close">
												<button class="small button" type="submit" name="closeer">Close</button>
											</form>
											<?php

											$severname = "localhost";
											$username = "root";
											$password = "";
											$db = "simplelogin";

											$conn = new mysqli($severname, $username, $password, $db);

											if (mysqli_connect_errno()) {
    											printf("Connect failed: %s\n", mysqli_connect_error());
    											exit();
											}

											$ticketToClose = $_POST['ticket_close'];

											$ticketCloser = "DELETE FROM tickets WHERE name='$ticketToClose'";
											if(mysqli_query($conn, $ticketCloser))
											{
												echo "Ticket has been deleted";
											}
											else
											{
												echo "Error: " . mysqli_error($conn);
											}

											$conn->close();
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="editBay">
								<div class="row">
									<div class="large-6 columns">
										<div class="callout large">
											<form class="editATicket" method="post" action="backend.php">
												<p>Enter ticket to edit name:</p>
												<input type="text" name="ticket_edit">
												<p>Enter ticket description:</p>
												<input type="text" name="new_ticket_desc">
												<button class="small button" type="submit" name="editor">Edit</button>
											</form>
											<?php


											$severname = "localhost";
											$username = "root";
											$password = "";
											$db = "simplelogin";

											$conn = new mysqli($severname, $username, $password, $db);

											if (mysqli_connect_errno()) {
    											printf("Connect failed: %s\n", mysqli_connect_error());
    											exit();
											}

											$ticketToEdit = $_POST['ticket_edit'];
											$newDescription = $_POST['new_ticket_desc'];

											$ticketEditor = "UPDATE tickets SET description = '$newDescription' WHERE name = '$ticketToEdit'";
											if(mysqli_query($conn, $ticketEditor))
											{
												echo "Ticket has been updated!";
											}
											else
											{
												echo "Error: " . mysqli_error($conn);
											}

											$conn->close();

											?>
										</div>
									</div>
								</div>
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
									echo "<tr><td>" . $row['name'] . "<tr><td>" . $row['description'] . "<tr><td>" . $row['creator'] . "<tr><td>" . $row['assignee'] . "<tr><td>" . $row['id'] . "<tr><td>";
								}

								echo "</table>";

								$conn->close();
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			
			var bay = $('.closeBay').hide();

			$('#showClose').click(function()
			{
				$('.closeBay').slideToggle(function()
				{
					if($(this).is(':hidden'))
					{
						$(this).hide();
					}
				});
			});

			var editBay = $('.editBay').hide();

			$('#showEdit').click(function()
			{
				$('.editBay').slideToggle(function()
				{
					if($(this).is(':hidden'))
					{
						$(this).hide();
					}
				});
			});
		</script>
	</body>
</html>
<?php
	require_once("createPage.php");
	$page = new Page();
	
	print $page->getTop();

	include 'connection.php';

	$currentTicket = $_GET['id'];
	$getTicketInformation = "SELECT * FROM tickets WHERE id='$currentTicket'";
	$ticketInfoResults = mysqli_query($conn, $getTicketInformation) or die(mysql_error());

	$row = mysqli_fetch_array($ticketInfoResults);

?>
<div class="mainContent">
		<div class="row">
			<div class="large-12 columns">
				<div class="calout large">
					<p><span style="color: teal;">Ticket name:</span> <?php echo $row['name']; ?></p>
					<p><span style="color: teal;">Ticket description:</span> <?php echo $row['description']; ?></p>
					<p><span style="color: teal;">Ticket created by:</span> <?php echo $row['creator']; ?></p>
					<p><span style="color: teal;">Ticket assigned to:</span> <?php echo $row['assignee']; ?></p>
					<br>
					<button class="small button" type="button" onclick="location.href = 'backend.php'">Return</button>
				</div>
			</div>
		</div>
	</div>
	<?php
		print $page->getBottom();
	?>
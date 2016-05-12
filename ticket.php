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
                    <p><span style="color: teal;">Ticket ID:</span> <?php $whereDoIGo = $row['id']; echo $whereDoIGo; ?></p>
					<br>
					<button class="small button" type="button" onclick="location.href = 'backend.php'">Return</button>
				</div>
			</div>
		</div>
        <div class="comment_creation">
        	<div class="row">
            	<div class="large-12 columns">
                	<div class="callout large">
                    	<form class="comment_creation" method="post" action="ticket.php?id=<?php echo $currentTicket ?>">
                        	<p>Your name:</p>
                            <input type="text" name="commentor_name" />
                            <p>Comment name:</p>
                            <input type="text" name="comment_name" />
                            <p>Comment:</p>
                            <input type="text" name="comment_body" />
                            <button class="small button" type="submit" name="comment_submit">Post</button>
                        </form>
                        <?php
						
						include 'connection.php';
						
						$commentor = $_POST['commentor_name'];
						$commentName = $_POST['comment_name'];
						$commentBody = $_POST['comment_body'];
						$forTicket = $row['id'];
						
						if(isset($_POST['$comment_name']))
						{
							$createNewComment = "INSERT INTO comments (`commenter`, `comment`, `comName`) VALUES ('$commentor', '$commentBody', '$commentName')";
						
							if($conn->query($createNewComment) == TRUE)
							{
								echo "New comment was created!";
							}
							else
							{
								echo "Error: " . $createNewComment . "<br>" . $conn->error;
							}
						}
						
						?>
                    </div>
                </div>
            </div>
        </div>
        <div class="comment_show">
        	<div class="row">
            	<div class="large-12 columns">
                	<div class="callout large">
                    	<h3>Comments:</h3>
                    	<!-- comments will be shown here -->
                        <?php
						
						include 'connection.php';
						
						//Please halp
						
						?>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <script>
		$('.comment_creation').on('submit', function() {
			//event.preventDefault();
		});
	</script>
	<?php
		print $page->getBottom();
	?>
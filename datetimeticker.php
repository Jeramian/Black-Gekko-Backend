<?php

	session_start();
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta charset="utf-8"/>
    	<title>Date Time Ticker</title>
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
			<div class="app">
				<div class="row">
					<div class="large-12 columns">
						<div class="callout large">
							<h4>Date:</h4>
							<?php
								echo "Today is: " . date("m/d/Y");
							?>
							<h4>Time spent on this site wasting time:</h4>
							<?php

								$_SESSION['timeLogged'] = time() - $_SESSION['startTime'];
								echo $_SESSION['timeLogged'] . " seconds and counting!";

							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Book</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BOOKING</title>
  <!-- CORE CSS-->
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">

<style type="text/css">
html,
body {
    height: 100%;
}
html {
    display: table;
    margin: auto;
}
body {
    display: table-cell;
    vertical-align: middle;
}
.margin {
  margin: 0 !important;
}
</style>
</head>
<body class="blue">
	<h1>TICKET BOOKING</h1>
	<?php 
	// Start the session
   session_start();
	require('conn.php');//connect to config file
	$userid= $_SESSION["userid"] ;
	$eventid=$_SESSION["eventid"];
	$sql1 = "SELECT * FROM event_details WHERE event_id = '$eventid' ";
      $result = $conn->query($sql1);
       while($array=mysqli_fetch_array($result))
         {
			 $title=$array['event_title'];
				$organiser=$array['event_organizer'];
				$detail=$array['event_detailed'];
				$venue=$array['event_venue'];
				$startdate=$array['event_startdate'];
				$enddate=$array['event_enddate'];
				$websiteurl=$array['event_website_url'];
				$price=$array['event_ticket_price'];
				$mobile1=$array['contact_no1'];
				$mobile2=$array['contact_no2'];
				$seat=$array['Seats'];
				$url=$array['booking_url'];
				$terms=$array['terms_conditions'];
			 $banner=$array['event_banner'];
		 }
	$sql2 = "SELECT * FROM users WHERE id = '$userid' ";
      $result2 = $conn->query($sql2);
       while($array2=mysqli_fetch_array($result2))
         {
			 $uname=$array2['username'];
				$lname=$array2['lastname'];
				$email=$array2['email'];
				$num=$array2['mobile'];
				$address=$array2['Address'];
		 }
	?>
	
  <div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
		<form method="post" action="">
		
		<div class="row margin">
          <div class="input-field col s6">
            <input id="ticket" type="text" name="ticket">
            <label for="ticket" class="center-align">Number Of Tickets:</label>
          </div>
        </div>
		
        <br />
            <input type="submit" name="submit" value="Submit" />
		  </form>
	</div>
 </div>
	
	<?php 
	echo "Summary:";
	echo "<br />";
	if (isset($_POST['submit'])) {
	$tnum=$_POST['ticket'];
	$Total = $price * $tnum;
	$sql = mysqli_query($conn,"INSERT INTO event_booking (event_id,user_id,no_tickets,total_price) VALUES ($eventid,$userid,$tnum,$Total)");
$sql = mysqli_query($conn,"UPDATE event_details SET Seats=Seats-$tnum where event_id=$eventid");
	echo "Yor tickets are reserved.Thank you for Booking!<br />";
	echo "Total Price is";
	echo $Total;
		}
	
	?>
</body>
</html>

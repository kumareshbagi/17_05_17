<!DOCTYPE html>
<html>
<head>
	<title>Book</title>
	<body class="pink">
	<h1>BOOK TICKET</h1>
	<?php 
	// Start the session
   session_start();
	require('conn.php');//connect to config file
	$userid= $_SESSION["ID"] ;
	$eventid=$_SESSION["EID"];
	$sql1 = "SELECT * FROM EVENTS WHERE ID = '$eventid' ";
      $result = $conn->query($sql1);
       while($array=mysqli_fetch_array($result))
         {
			 $title=$array['ENAME'];
				$organiser=$array['EORGANIZER'];
				$detail=$array['EDESCRIPTION'];
				$venue=$array['EVENUE'];
				$startdate=$array['ESTARTDATE'];
				$enddate=$array['EENDDATE'];
				$websiteurl=$array['EURL'];
				$price=$array['ETICKETPRICE'];
				$mobile1=$array['CONTACTNUMBER'];
				$seat=$array['NOOFSEATS'];
				 $banner=$array['EVENTBANNER'];
				$terms=$array['TERMSANDCONDITIONS'];
			
		 }
	$sql2 = "SELECT * FROM MEMBERS WHERE ID = '$userid' ";
      $result2 = $conn->query($sql2);
       while($array2=mysqli_fetch_array($result2))
         {
			 $uname=$array2['USERNAME'];
				$lname=$array2['LASTNAME'];
				$email=$array2['EMAIL'];
				$num=$array2['PHONENUMBER'];
				$address=$array2['ADDRESS'];
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
	$sql = mysqli_query($conn,"INSERT INTO BOOKING (event_id,user_id,no_tickets,total_price) VALUES ($eventid,$userid,$tnum,$Total)");
$sql = mysqli_query($conn,"UPDATE event_details SET Seats=Seats-$tnum where event_id=$eventid");
	echo "Yor tickets are reserved.Thank you for Booking!<br />";
	echo "Total Price is";
	echo $Total;
		}
	
	?>
</body>
</html>

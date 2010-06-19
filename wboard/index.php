<html>  
  <head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0">  
    <link href="../css/main.css" rel="stylesheet" media="screen"/> 
    <link href="../css/wboard.css" rel="stylesheet" media="screen"/>
    <script src="../js/jquery-1.4.1.min.js" type="text/javascript"></script><!-- don't remove -->
    <script src="../js/jquery.dataTables.min.js" type="text/javascript"></script><!-- don't remove -->
    <script src="../js/css_selector.js" type="text/javascript"></script><!-- don't remove -->

	<script> 
	$(document).ready(function(){
	
		var currentTime = new Date();
		var month = currentTime.getMonth() + 1;
		var day = currentTime.getDate();
		var year = currentTime.getFullYear();
		var fulldate = month + "/" + day + "/" + year;
		$('.dateHere').text(fulldate);
		
		$("strong:contains('ACTIVE')").removeClass('blue').addClass("green");
		$("strong:contains('STANDBY')").removeClass('blue').addClass("yellow");
		$("strong:contains('CANCELED')").removeClass('blue').addClass("red");
				      		
	});
	</script>
	
	<?php
	
		$dbname='../data/flights.sqlite';
		$mytable ="schedule";

		$base= new SQLiteDatabase($dbname, 0666, $err);
		if ($err)  exit($err);

		//CREATING TABLE
/*
		$query = "CREATE TABLE $mytable(
		            id INTEGER PRIMARY KEY NOT NULL,
		            status VARCHAR(20) NOT NULL, 
		            date VARCHAR NOT NULL,
		            route VARCHAR(255) NOT NULL,
		            pax INTEGER NOT NULL,
		            tail VARCHAR(10) NOT NULL,
		            pilot VARCHAR(255) NOT NULL,
		            client VARCHAR(255) NOT NULL,
		            leaves VARCHAR(20) NOT NULL,
		            returns VARCHAR(20) NOT NULL,
		            fuel VARCHAR(10) NOT NULL,
		            notes VARCHAR(255)        
		            )";
		            
			$results = $base->queryexec($query);
*/
	?>
	
  </head>  
  <body>  
    <h1><div class="leftButton" onclick="location.href='../index.php'">Back</div>AEROTOUR INTRANET<div class="rightButton" onclick="location.href='add.php'"> + </div></h1>  
    <h2>Flights Board, today is <span class="dateHere"></span></h2>  
    <ul>
      <li class="single" style="background-color: grey;">
	<table cellpadding="0" cellspacing="1" border="0" id="tblFlights" width="100%"> 
	  <thead> 
	    <tr> 
	      <th>Status</th> 
	      <th>Date</th> 
	      <th>Route</th> 
	      <th>Pax</th> 
	      <th>Tail</th>
	      <th>Pilot</th>
	      <th>Client</th>
	      <th>Leave</th>
	      <th>Return</th>
	      <th>Fuel</th>
	      <th>Notes</th>
	    </tr> 
	  </thead> 
	  <tbody> 
	    <?php

	      $date = date("m/d/Y");
      
	      //read data from database
	      $query = "SELECT status, date, route, pax, tail, pilot, client, leaves, returns, fuel, notes FROM $mytable WHERE date >= '$date' ORDER BY date ASC, leaves ASC";
	      $results = $base->arrayQuery($query, SQLITE_ASSOC);
	      $size = count($results);
	      
	      for($i = 0; i < $size; $i++)
	      {
		$arr = $results[$i];
		if(count($arr) == 0) break;

		      $status = $arr['status'];
		      $date = $arr['date']; 
		      $route = $arr['route'];
		      $pax = $arr['pax'];
		      $tail = $arr['tail'];
		      $pilot = $arr['pilot'];
		      $client = $arr['client']; 
		      $leaves = $arr['leaves'];
		      $returns = $arr['returns'];
		      $fuel = $arr['fuel'];
		      $notes = $arr['notes'];

		print("<tr>" .
		"<td> <span class='board list blue glow caps status'><span><span class='strikethrough'></span><strong>$status</strong></span></span> </td>" .
		"<td> <span class='board list blue'><span><span class='strikethrough'></span><strong style='font-weight:normal !important;'>$date</strong></span></span> </td>".
		"<td> <span class='board list green glow caps'><span><span class='strikethrough'></span><strong style='font-weight:normal !important;'>$route</strong></span></span> </td>".
		"<td> <span class='board list blue'><span><span class='strikethrough'></span><strong style='font-weight:normal !important;'>$pax</strong></span></span> </td>".
		"<td> <span class='board list red glow caps'><span><span class='strikethrough'></span><strong style='font-weight:normal !important;'>$tail</strong></span></span> </td>".
		"<td> <span class='board list blue'><span><span class='strikethrough'></span><strong style='font-weight:normal !important;'>$pilot</strong></span></span> </td>".
		"<td> <span class='board list blue'><span><span class='strikethrough'></span><strong style='font-weight:normal !important;'>$client</strong></span></span> </td>".
		"<td> <span class='board list yellow glow'><span><span class='strikethrough'></span><strong style='font-weight:normal !important;'>$leaves</strong></span></span> </td>".
		"<td> <span class='board list blue'><span><span class='strikethrough'></span><strong style='font-weight:normal !important;'>$returns</strong></span></span> </td>".
		"<td> <span class='board list blue caps'><span><span class='strikethrough'></span><strong style='font-weight:normal !important;'>$fuel</strong></span></span> </td>".
		"<td> $notes </td>".
		"</tr>");
	      }
	     
	    ?>
	  </tbody> 
	</table>
      </li>
    </ul>  
  </body>  
</html>

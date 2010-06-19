<html>  
  <head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
    <link href="css/main.css" rel="stylesheet" media="screen"/> 
    <link href="css/plan.css" rel="stylesheet" media="screen"/> 
    <script src="js/jquery-1.4.1.min.js" type="text/javascript"></script><!-- don't remove --> 
    <script src="js/jquery-ui.js" type="text/javascript"></script><!-- don't remove --> 
    <script src="js/css_selector.js" type="text/javascript"></script><!-- don't remove --> 
    <script src="js/ui.iTabs.js" type="text/javascript"></script><!-- don't remove --> 
    
	<script type="text/javascript">/* <![CDATA[ */
	$(function(){
	
	 //Make Tabs
	 $(".tabbar").iTabs();
	   		  
	});

	function radarToggle() {
		//check if selected	
		if ($('#displayRadar').is(':checked')) {
		  $('#radarImage').removeClass("hidden");
		} else {
			$('#radarImage').addClass("hidden");
		}
	};

	function loadData() {
	
	      //Parameter for point
	      point = $('#startPoint').val();
	      
	      //Get METAR
	      $("#metar").load("php/proxywx.php?url=http://aviationweather.gov/adds/metars/index.php?station_ids=" + point);
	      
	      //Get TAF
	      $("#taf").load("php/proxy.php?url=http://aviationweather.gov/adds/tafs/index.php?station_ids=" + point);
	
	      //Get MRPV NOTAM
			$.ajax({
			type: "POST",
			url: "php/proxyNotam.php?url=https://www.notams.jcs.mil/dinsQueryWeb/queryRetrievalMapAction.do",
			data: {'retrieveLocId': point},
			success: function(data) {
				$('#notam').html(data);
				}
			});
						
	}
	/* ]]> */
	</script>

	<script language="JavaScript"> 
	<!-- //TIME FUNCTION
	 
	function getGMT() {
	  date = new Date();
	  gmt = date.toGMTString();
	  loc = date.toLocaleString();
	  //exp = gmt.substring(0,25);
	  exp = gmt.substring();
	  //ext = loc.substring(0,25);
	  ext = loc.substring();
	  
	  offTime = date.getTimezoneOffset();
	 $("#zuluTime").html(exp);
	 $("#localTime").html(ext);
	 //document.form1.offTime.value = "Offset " + (offTime / 60) + " hours";
	 
	 setTimeout("getGMT()", 1000);
	 }
	 
	//-->
	</script>

	<style type="text/css">
	font {
		font: 1.8em "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif;
		display: block !important;	
	}
	font:before {
		content: " | ";
	}
	pre {
		font: 1.2em "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif;
		display: block !important;
	}
	pre:before {
		content: " | ";
	}

	.tabbar {
		position:relative;
		top:0px;
	}
	.list p{
		padding:16px;
	}
	.labelize {
	background-image: -webkit-gradient(
	    linear,
	    left bottom,
	    left top,
	    color-stop(0, rgb(205,245,250)),
	    color-stop(0.55, rgb(255,255,255)),
	    color-stop(1, rgb(205,245,250))
	);
	color: #0062b8;
	text-shadow: 1px 1px 2px #0f304d;
	}

	</style>

  </head>  
  
  <body onLoad="getGMT();">  
    <h1><div class="leftButton" onclick="history.back();return false">Back</div>AEROTOUR INTRANET</h1>  
    <h2>METAR / TAF / NOTAMS / <span id="localTime"></span></h2>  
    <ul>  
      <li class="single">
      <label for="startPoint">ICAO Code:</label>
      <input type="text" name="startPoint" id="startPoint" class="corners labelize" style="padding-left: 13px; font-size: 1.5em;" onchange="loadData();" value=""/>
      &nbsp;&bull;
      <label id="zuluTime" value="test"></label>
      <!--&nbsp;&bull;
      <label for="displayRadar">Display Radar:</label>
      <input type="checkbox" name="displayRadar" id="displayRadar" onchange="radarToggle();" />-->
      <p class="disclamer">You can request multiple using + to combine values (ie: MRPV+MROC+MRLB)</p>
      </li>
    </ul>
    <ul>  
      <li><strong>METAR</strong><div id="metar" class="disclamer"></div></li>
      <li><strong>TAF</strong><div id="taf" class="disclamer"></div></li>
      <li><strong>NOTAMS</strong><div id="notam" class="disclamer"></div></li>
    </ul> 
    
    <div class="page-break"></div>
    
    <!--<ul>  
      <li class="single hidden" id="radarImage">
			<ul class="tabbar itabsui"> 
				<li><a class="iicon" href="#mrpvwx" title="MRPV WX"><em class="ii-radar"></em>MRPV WX</a></li> 
				<li><a class="iicon" href="#tower" title="MRPV Tower"><em class="ii-flag"></em>MRPV Tower</a></li> 
				<li><a class="iicon" href="#weather" title="Weather Satelite"><em class="ii-cloud"></em>Weather Satelite</a></li>
				<li><a class="iicon" href="#infrared" title="Infrared Satelite"><em class="ii-weather"></em>Infrared Satelite</a></li>
				<li><a class="iicon" href="#noaa" title="Noaa Satelite"><em class="ii-brightness"></em>NOAA Satelite</a></li>
			</ul> 
			<div style="clear:both !important;"></div>
	    <div id="mrpvwx" title="MRPV WX"> 
			<p style="text-align:center;"> 
				<img src="http://www.imn.ac.cr/especial/QNHPAVAS.png" width="600px"/> 
			</p
	    </div> 
	    <div id="tower" title="MRPV Tower"> 
				<img src="http://www.imn.ac.cr/especial/PavasRed.png" width="100%"/> 
	    </div> 
	    <div id="weather" title="Weather Satelite">
	        <img src="http://www.imn.ac.cr/especial/SATVIS.GIF" width="100%"/> 
	    </div> 
	    <div id="infrared" title="Infrared Satelite"> 
	        <img src="http://www.imn.ac.cr/especial/SATELITE.GIF" width="100%"/> 
	    </div> 
	    <div id="noaa" title="NOAA Satelite"> 
	        <img src="http://cimss.ssec.wisc.edu/goes/burn/data/rtloopregional/centamer/latest_centamer.gif" width="100%"/> 
	    </div> 
      </li>
    </ul>-->
  </body>  
</html>

<?php
include("admin/vedlikehold/functions.php");
//include("tempfunc.php");
require_once "phpuploader/include_phpuploader.php";

igeir_session_start();
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8" />	
	<title> <?php echo $title ?> </title>
	<link rel="shortcut icon" href="http://andersborglarsen.com/pro1000/favicon.ico" type="image/x-icon" />
	<!--favicon henter ikonet som dukker opp vedsiden av title-->
		<link rel="stylesheet" type="text/css" href="http://andersborglarsen.com/pro1000/style/reset.css" />
	<link rel="stylesheet" type="text/css" href="http://andersborglarsen.com/pro1000/style/style.css" />

    <link href="style/map.css" rel="stylesheet">
   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&region=ES"></script>
  <!--  <script>

var geocoder;
var map;
var query = '<?php// echo hentAdresse($igeirKode) ?>';
function initialize() {
  geocoder = new google.maps.Geocoder();
  var mapOptions = {
    zoom:8,
    panControl: false,
    zoomControl: true,
    scaleControl: false,
    mapTypeControl: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  codeAddress();
}

function codeAddress() {
  var address = query;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
//      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-41050034-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>    <!-- Her legge til google analytic slik at vi kan ha en bedre oversikt over side vår. -->
	
</head>

<body>

	<header>
		<div class="wrapper"> <!--definerer den vertikale boksen rundt objektene i header-->
			<a href="http://andersborglarsen.com/pro1000">
				<img class="iGeirLogo" <?php $img_path="http://andersborglarsen.com/pro1000/img/"?> 
				src="<?php print $img_path; ?>logo.png" alt="iGeir logo" title="iGeir - til startsiden!" />
				<!--logoen blir hentet på denne måten for å fungere typere inn i mappestrukturen-->
			</a>
				<?php if($_SESSION['innlogget'] == true) { 
				echo "<span id='usernav'>".$_SESSION['brukernavn'];
				echo " | <a class='headerButtons' href='http://andersborglarsen.com/pro1000/logout.php'>Logg ut</a>";
				echo " | <a class='regHeaderButton' href='http://andersborglarsen.com/pro1000/myprofile.php'>min profil</a>";
			 	}else{
				echo "<span id='usernav'><a class='headerButtons' href='http://andersborglarsen.com/pro1000/login.php'>Logg inn</a> | <a class='regHeaderButton' href='http://andersborglarsen.com/pro1000/registrer.php'>Registrer deg</a>";
				}?>
		</div> <!--avslutter div class wrapper-->
		
	</header> <!--avslutter header-->
	<nav>
		<ul id="n" class="clearfix">
		
			  
      </div> <!--AVSLUTTER menuLeftFolder-->
							<?php if($_SESSION['innlogget'] == true) { 
			echo "<div id='setInButton' ><a href='http://andersborglarsen.com/pro1000/myprofile.php'>Sett inn annonse</a></div>	";	
			}?>
		
      <form class='searchbox' name='searchform' method='GET' action='http://andersborglarsen.com/pro1000/search-results.php'>
      <input type='text' class='searchbox_input' name='search' size='20' TABINDEX='1' />
      <input type='submit' class='searchbox_submit' value='Søk ' />
      </form>
		</ul>
	</nav><!-- avslutter menyen-->
	
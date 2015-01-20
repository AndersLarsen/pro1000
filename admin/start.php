<?php
include("vedlikehold/functions.php");				// INKLUDERER ALLE FUNKSJONENE SOM ER SKREVET
sec_session_start();								// STARTER SESSION FOR AT BRUKERENE SKAL KUNNE LOGGE INN
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="no-NO">
<head>
<title> <?php echo $title ?> </title>
<link rel="shortcut icon" href="http://is.hive.no/pro10005/1/applikasjon/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="stylesheets/skjema.css" type="text/css" />
<link rel="stylesheet" href="stylesheets/vedlikehold.css" type="text/css" title="default" />
<link rel="stylesheet" href="stylesheets/404.css" />
<link rel="stylesheet" href="stylesheets/meny.css" />
<link href="https://www.assembla.com/spaces/pro1000/stream.rss" rel=alternate" title="RSS" type=" application/rss+xml" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>

<body>
<header>
  <img src="img/igeirCmsLogo.png">
  		<?php 
		if($_SESSION['innlogget'] == true) {
		?>
	    <form id="searchForm" action="vedlikehold/sok.php">  
      <input type="text" id="searchInput" name="search" placeholder="Søk i admin" required="required"/>
      <input type="submit" id="searchSubmit" value="Søk">
    </form>
    <?php }
    ?>
  </header>
<?php
include("functions.php");								// INKLUDERER ALLE FUNKSJONENE VIA FUNCTIONS FILA
sec_session_start();									// STARTER SESSION FOR Å KONTROLLERE OM EN BRUKER ER LOGGET INN
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="no-NO">
<head>
<title> <?php echo $title ?> </title>
<link rel="stylesheet" href="../stylesheets/skjema.css" type="text/css" />
<link rel="stylesheet" href="../stylesheets/vedlikehold.css" type="text/css" title="default" />
<link rel="stylesheet" href="../stylesheets/404.css" />
<link rel="stylesheet" href="../stylesheets/meny.css" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>
<body>
	<header>
		<img src="../img/igeirCmsLogo.png" width="150" />
		<?php 
		if($_SESSION['innlogget'] == true) {
		?>
	    <form id="searchForm" action="sok.php">  
      <input type="text" id="searchInput" name="search" placeholder="Søk i admin" required="required"/>
      <input type="submit" id="searchSubmit" value="Søk">
    </form>
    <?php }
    ?>
		
	</header>
<?php 	
include("../meny.php"); 								// INKLUDERER MENYEN
?>
	
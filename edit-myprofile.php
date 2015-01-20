<?php
/**
 * endrer personlig informasjon på min profil
 *
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URL:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can beskrivelse you a copy immediately.
 *
 * @author		Original Author <andersborglarsen@gbeskrivelse.com>
 * @author		Original Author <haavard@ringshaug.net>
 * @author		Original Author <gjermundwedvik@gmail.com>
 * @copyright 	2013-2018
 * @license		http://www.php.net/license/3_01.txt
 * @link		http://student.hive.no/pro10005/1
 *
 */

$title = '..REDIGER MIN PROFIL ..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("header.php"); 

sjekklogin();								//INKLUDERER HEADER OG SJKKER AT MAN ER LOGGET INN ?>




<?php 
/****************************** Endre Bruker ****************************************/

$brukerId=$_SESSION['id'];																// HENTER ID PÃ… SESSION

$modifySubmit=$_POST["modifySubmit"];				// HENTER INN EN INPUT KNAPP FRA SKJEMAET
$igeirkode = $_POST["igeirkode"];							// LAGRER BRUKERID FRA SKJEMAET

kobleTil();													//KOBLER TIL DATABASEN
	$sqlSetning="
	SELECT bruker.BrukerId, bruker.BrukerMail, bruker.BrukerFornavn,
	bruker.BrukerEtternavn, bruker.BrukerAdresse, bruker.BrukerPostnr, bruker.BrukerTlf, bruker.BrukerMob,
	poststed.Poststed
	FROM bruker
	join poststed on bruker.BrukerPostnr=poststed.Postnr where BrukerId='$brukerId';"; // SQL SPÃ˜RRINGEN

	$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
	$antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
	kobleFra();

	for ($r=1;$r<=$antallRader;$r++){
		$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPï¿½RRINGSRESULTATET

		$brukerId = $rad[0];
		$brukerMail= $rad[1];
		$brukerFornavn= $rad[2];
		$brukerEtternavn= $rad[3];
		$brukerAdresse= $rad[4];
		$brukerPostnr= $rad[5];
		$brukerTlf= $rad[6];
		$brukerMob= $rad[7];
		$poststed= $rad[8];
		//echoER UT INFO


		echo "
		<div id='content' class='clearfix'>
		<section id='start'>
		<div id='torgetStartpage' class='clearfix'>
		<div class='head_edit_myprofile'>
		<h1>Rediger Personlig informasjon </h1>
		</div><ul>
		<li>
		 <form class='edit_myprofile_form' name='updateuser' action='' method='post'>
	<input type='hidden' edit_input name='userId' value='$brukerId'>

	<p id='ur_user_id'>Bruker id: $brukerId</p>
	<label>Fornavn</label>  <input type='text' class='edit_input' name='fornavn' id='fornavn' value='$brukerFornavn'  required><br>
	<label>Etternavn</label>  <input type='text' class='edit_input' name='etternavn' id='etternavn' value='$brukerEtternavn' required><br>
	<label>Adresse</label>  <input type='text' class='edit_input' name='adresse' id='adresse' value='$brukerAdresse' required><br>
	<label>Postnr</label>  <input type='text' class='edit_input' name='postnr' id='postnr' value='$brukerPostnr' required><br> 
	<input type='hidden' name='poststed' id='poststed' value='$poststed' required><br>
	<label>E-post</label>  <input type='text' class='edit_input' name='email' id='email' value='$brukerMail' required><br>
	<label>Tlf</label>  <input type='text' class='edit_input' name='tlf' id='tlf' value='$brukerTlf' required><br>
	<label>Mobil</label>  <input type='text' class='edit_input' name='mob' id='mob' value='$brukerMob' required><br>
  <label>Profilbilde</label><input type='file' class='edit_input' id='fil' name='fil'>
 <input type='hidden' name='oldUsername' id='oldUsername' value='$brukerId'> 
	<input type='submit' class='submitbuttons value='Lagre endringer' name='regUpdate'>
</form>";
echo "
		<form method='post' action='myprofile.php'>
		<input type='submit' class='submitbuttons' value='Avbryt' id='back' name='back'>
		</form>
		
		</div>
		</div>
		</section>";



	}
$regUpdate = $_POST["regUpdate"];					//HENTER INN SUBMITKNAPPEN

if ($regUpdate) {									// LYTTER TIL SUBMITKNAPPEN
$brukerId =			$_POST["userId"];				// LAGRER DATA I EN LOKAL VARIABEL FRA EN RAD I SQL ARRAYET
$brukerMail = 		$_POST["email"];			// LAGRER DATA I EN LOKAL VARIABEL FRA EN RAD I SQL ARRAYET
$brukerFornavn= 	$_POST["fornavn"];	// LAGRER DATA I EN LOKAL VARIABEL FRA EN RAD I SQL ARRAYET
$brukerEtternavn= 	$_POST["etternavn"];		// LAGRER DATA I EN LOKAL VARIABEL FRA EN RAD I SQL ARRAYET
$brukerAdresse= 	$_POST["adresse"];		// LAGRER DATA I EN LOKAL VARIABEL FRA EN RAD I SQL ARRAYET
$brukerPostnr= 		$_POST["postnr"];			// LAGRER DATA I EN LOKAL VARIABEL FRA EN RAD I SQL ARRAYET
$brukerTlf= 		$_POST["tlf"];		// LAGRER DATA I EN LOKAL VARIABEL FRA EN RAD I SQL ARRAYET
$brukerMob= 		$_POST["mob"];			// LAGRER DATA I EN LOKAL VARIABEL FRA EN RAD I SQL ARRAYET
//$Poststed= 			$_POST["poststed"];			// LAGRER DATA I EN LOKAL VARIABEL FRA EN RAD I SQL ARRAYET


kobleTil();										// KOBLER TIL DATABASE
$sql="UPDATE bruker SET
BrukerFornavn='$brukerFornavn',
BrukerEtternavn='$brukerEtternavn',
BrukerAdresse='$brukerAdresse',
BrukerPostnr='$brukerPostnr',
BrukerMail='$brukerMail',
BrukerTlf='$brukerTlf',
BrukerMob='$brukerMob'
WHERE
BrukerId='$brukerId';";						//SQL SPØRRING SOM OPPDARER BRUKER
$result=mysql_query($sql) or die ("<script>alert('ikke mulig å oppdatere Bruker i databasen')</script>");	//LAGRER SVARET FRA SQL SPØRRINGEN
print("<script>alert('Brukeren med brukernavn $brukerMail er oppdatert.'); window.location = 'myprofile.php';</script>"); // BEKREFTELSE TIL BRUKEREN AT DATAENE ER LAGRET
	
kobleFra();
			/* Leser fila som admin laster opp */
			$filnavn = $_FILES["fil"]["name"]; // To-dim array
			$filtype = $_FILES["fil"]["type"];
			$filstorrelse = $_FILES["fil"]["size"];
			$tmpnavn = $_FILES["fil"]["tmp_name"];
			$filkode = createBildeNavn();
			
			/* Splitter ut fildefinisjonen(type) og legger den til bak filnavnet */
			$splittFilnavn = explode(".",$filnavn);
			$definertFilnavn = ".$splittFilnavn[1]";
			
			/* Setter filnavn til brukernavn+filtypen */
			$nyttnavn 	= "img/".$filkode.$definertFilnavn;
			$nyFil 		= "img/".$filkode.$definertFilnavn;
			
			kobleTil();																// KOBLER TIL DATABASEN
			$sqlSetning= "INSERT INTO profil (BrukerId,Navn,Filnavn,Beskrivelse)
			VALUES ('$brukerId','$filkode','$nyttnavn','$beskrivelse');";															// SQLSETNINGEN SOM SKAL KJØRES I DATABASEN
			mysql_query ($sqlSetning) or die (mysql_error());						// KJØRER SQLSETNINGEN I DATABASEN
			kobleFra();																// KOBLER FRA DATABASEN
			
			/**
			 * Last opp bilde
			*/
			if($filnavn != NULL) {													// SJEKER AT IKKE FILNAVNET ER LIK NULL
				if($filtype != "image/gif" && $filtype != "image/jpg" && $filtype != "image/jpeg" && $filtype != "image/png"){	// SJEKKER FILFORMATET
					echo"<script> alert('<h2>Kun tillatt å laste opp bilder</h2>')</script>";				// SKRIVER UT FEILMELDING
				} else if($filstorrelse > 5000000) {								// SJEKKER AT IKKE FILEN ER FOR STOR
					echo"<script> alert('<h2>Filen er for stor til å laste opp</h2>')</script>";			// SKRIVER UT FEILMELDING
				} else {
					move_uploaded_file($tmpnavn, $nyFil) or die(error());			// LASTER OPP FILEN TIL SERVEREN
					echo"<script> alert('Fil lastet opp..')<script>";								// SKRIVER UT BEKREFTELSE PÅ AT FILEN ER LASTET OPP
				}
			}
			
			echo "<script> alert('Oppdateringen var vellykket')</script>";						// SKRIVER UT BEKREFTELSE PÅ AT REGISTRERINGEN VAR VELLYKKET
			
			
		
		}

		

include("footer.php")
?>
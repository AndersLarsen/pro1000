<?php
/**
 * endrer produkt , beskrivelse og laste opp flere bilder.
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
$title = '..Oppdater produktet ditt..'; // 	LEGGER TIL TITEL PÅ SIDEN.
include("header.php");
sjekklogin();								//INKLUDERER HEADER OG SJKKER AT MAN ER LOGGET INN ?>

<div id="content2" class="clearfix">
	<div id="fontstyle">



		<?php 
		/****************************** Endre Vareinfo ****************************************/

		$brukerId=$_SESSION['id'];																// HENTER ID PA… SESSION

		$modifySubmit=$_POST["modifySubmit"];				// HENTER INN EN INPUT KNAPP FRA SKJEMAET
		$igeirkode = $_POST["igeirkode"];							// LAGRER BRUKERID FRA SKJEMAET

		kobleTil();
		$sqlSetning="
		SELECT igeir.IgeirKode, igeir.Bud, igeir.BildeId, igeir.Header, igeir.Pris, igeir.BrukerId, igeir.Beskrivelse,
		bilde.Filnavn, bilde.Beskrivelse,bilde.BildeId,
		bruker.BrukerFornavn, bruker.BrukerEtternavn, bruker.BrukerMail
		From igeir  JOIN bilde ON igeir.IgeirKode=bilde.IgeirKode JOIN bruker ON bruker.BrukerId=igeir.BrukerID
		Where igeir.IgeirKode ='$igeirkode';"; // SQL SPoRRINGEN

		$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
		$antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
		kobleFra();

		for ($r=1;$r<=$antallRader;$r++){
			$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPoRRINGSRESULTATET

			$igeirkode = $rad[0];
			$bud= $rad[1];
			$bildeId= $rad[2];
			$header= $rad[3];
			$pris= $rad[4];
			$brukerid= $rad[5];
			$beskrivelse= $rad[6];
			$bildefilnavn= $rad[7];
			$bildebeskrivelse= $rad[8];
			$bildeId=$rad[9];

			//echoER UT INFO

			echo"<h2>Redigerer vare info for Igeirkode: $igeirkode</h2>";

			echo "<div id='userEditForms' class='clearfix'>";
			echo "  <form class='' name='updateuser' action='' method='post'>";
			echo "	<input type='hidden' name='brukerid' value='$brukerId'>";
			echo " <input type='hidden' name='igeirkode' value='$igeirkode'>";
			kobleTil(); typeList(); torgetList(); kobleFra();											// Henter inn listebokser
			echo "	<p>Overskrift</p>  <input type='text' name='header' id='overskrift' value='$header'  required><br>";
			echo "	<p>Beskrivelse</p><textarea row='20' cols='50' id='beskrivelse' name='beskrivelse' required>$beskrivelse</textarea> <br>";
			echo "	<p>Minste bud</p>  <input type='text' name='bud' id='bud' value='$bud' required><br>";
			echo "	<p>Pris</p>  <input type='text' name='pris' id='pris' value='$pris' required><br>";
			echo "<img src='$bildefilnavn' alt='$header' height='260' width='260'>";
			echo "<input type='file'  id='fil' name='fil'> <br />";
			echo" <div id='radioButtons'>

					<input type='hidden' name='active' value='1'>
					<input type='hidden' name='private' value='1'>

				
					
					</div>";
			salgsTilstand($status);
				
			echo "	<input type='submit' value='Lagre endringer' name='regUpdate'>";
			echo "</form>";
			echo ("
					<form method='post' action='myprofile.php'>
					<input type='submit' value='Tilbake' id='back' name='back'>
					</form>
					");

			echo "</div>";


		}
		$regUpdate = $_POST["regUpdate"];					//HENTER INN SUBMITKNAPPEN

		if ($regUpdate) {
			$igeirKode=$_POST["igeirkode"];                                             // HENTER UT EN NY IGEIRKODE
			$header=mysql_real_escape_string($_POST["header"]);                 // HENTER INPUT FRA SKJEMAET
			$bud=$_POST["bud"];                                                 // HENTER INPUT FRA SKJEMAET
			$pris=mysql_real_escape_string($_POST["pris"]);                     // HENTER INPUT FRA SKJEMAET
			$brukerId=$_POST["brukerid"];                                       // HENTER INPUT FRA SKJEMAET
			$beskrivelse=mysql_real_escape_string($_POST ["beskrivelse"]);      // HENTER INPUT FRA SKJEMAET

			$active=$_POST["active"];                                           // HENTER INPUT FRA SKJEMAET
			$private=$_POST["private"];                                         // HENTER INPUT FRA SKJEMAET
			$status = $_POST["status"];											// HENTER INPUT FRA SKJEMAET
				
			$typeId=$_POST["type"];												 // HENTER INPUT FRA SKJEMAET
			$torgetId=$_POST["torgKategori"];									 // HENTER INPUT FRA SKJEMAET



			if (!$header||!$bud||!$pris || !$beskrivelse|| !$typeId||!$torgetId) {        // SJEKKER AT ALLE FELTENE ER FYLT UT
				echo ("Annonsen er ikke fullstendig, vennligst sjekk at alt er fylt ut og at bilde er lastet opp!");   // SKRIVER UT FEILMELDING
			} else {
				kobleTil();
				// KOBLE TIL DATABASEN
				$sqlSetning="
					
					
				UPDATE igeir SET
			 Bud='$bud',
			 Beskrivelse='$beskrivelse',
			 Header='$header',
			 Pris='$pris',
			 Aktiv='$active',
			 Status='$status',
			 Privat='$private'
			 WHERE Igeirkode='$igeirkode';";    // SQLSETNINGEN SOM SKAL KJØRES I DATABASEN
				$sqlRestultat=mysql_query($sqlSetning) or die(mysql_error());  												 // KJØRER SQLSETNINGEN I DATABASEN
					
					
				$sqlSetning2="UPDATE  underkategori SET
				TypeId='$typeId',
				TorgetId='$torgetId'
				WHERE IgeirKode='$igeirKode';";
				$sqlRestultat2=mysql_query($sqlSetning2) or die(mysql_error());
				kobleFra();                                                     // KOBLER FRA DATABASEN

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
					
					
				/**
				 * Last opp bilde
				*/
				if($filnavn != NULL) {													// SJEKER AT IKKE FILNAVNET ER LIK NULL
			if($filtype != "image/gif" && $filtype != "image/jpg" && $filtype != "image/jpeg" && $filtype != "image/png"){	// SJEKKER FILFORMATET
				print("<h2>Kun tillatt å laste opp bilder</h2>");				// SKRIVER UT FEILMELDING
			} else if($filstorrelse > 5000000) {								// SJEKKER AT IKKE FILEN ER FOR STOR
				print("<h2>Filen er for stor til å laste opp</h2>");			// SKRIVER UT FEILMELDING
			} else {
				move_uploaded_file($tmpnavn, $nyFil) or die(error());			// LASTER OPP FILEN TIL SERVEREN
				print("<h2>Fil lastet opp..</h2>");								// SKRIVER UT BEKREFTELSE PÅ AT FILEN ER LASTET OPP
					
				kobleTil();																// KOBLER TIL DATABASEN
				$sqlSetning= "
				UPDATE bilde SET Filnavn='$nyttnavn',Beskrivelse='$header' WHERE IgeirKode='$igeirKode';";												// SQLSETNINGEN SOM SKAL KJØRES I DATABASEN
				mysql_query ($sqlSetning) or die (mysql_error());						// KJØRER SQLSETNINGEN I DATABASEN
				kobleFra();																// KOBLER FRA DATABASEN
				}
			}
			echo "<script> alert('Annonsen med id: $igeirKode er nå Oppdatert')</script>";							// ALERTBOX PÅ AT VAREN  ER OPPDATERT
			// SKRIVER UT BEKREFTELSESMELDING PÅ AT DATAENE ER LAGRET
			}
		}
		?>
	</div>
	<!-- avslutter fontstyle -->
</div>
<!-- avslutter content2 -->

<?php include("footer.php")?>
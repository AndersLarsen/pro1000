<?php 
/**
 * Reg-reklame
 * 
 * Her får man anledning til å legge til en reklame aktør med
 * bilde og link, alle feltene må fylles ut og blir validert av 
 * HTML5, dette er reklamen som vil bli vist på IGeir.
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URL:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @author		Original Author <andersborglarsen@gmail.com>
 * @author		Original Author <haavard@ringshaug.net>
 * @copyright 	2013-2018
 * @license		http://www.php.net/license/3_01.txt
 * @link		http://student.hive.no/pro10005/1
 *
 */
$title = '..REGISTRER REKLAME..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");												// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();														// SJEKKER OM EN PERSON ER LOGGET INN
?>

<br />

<form class="igeir_skjema" action="reg-reklame.php"
	enctype="multipart/form-data" method="post" name="igeir_skjema"
	id="igeir_skjema">
	<ul>
		<li>
			<h2>Legg til reklame</h2> <span class="required_notification">Alle felt
				må fylles ut</span>
		</li>
		<li><label for='Firma'>Firma:</label> <input type="text"
			placeholder="Firma" id="firma" name="firma" size="45" required />
		</li>
		<li><label for='Link'>Link:</label> <input type="text"
			placeholder="Link" id="link" name="link" size="45" required />
			<span class="form_hint">Skrives slik: http://adresse.no</span>
		</li>
		<li><label for='Alternativ'>Alternativ:</label> <input type="text"
			placeholder="Alternativ" id="alternativ" name="alternativ" size="45" required />
		</li>
		<li><label for='Bildefil'>Bildefil:</label> <input type="file"
			placeholder="Bildefil" id="fil" name="fil" size="30" required />
		</li>
		<li><label for='Beskrivelse'>Beskrivelse:</label> <input type="text"
			placeholder="Beskrivelse" id="beskrivelse" name="beskrivelse" size="30" required />
		</li>
		<li><input type="submit" value="Legg til Reklame" id="RegistrerReklame"
			name="RegistrerReklame" class="submit" />
		</li>
	</ul>
</form>

<?php 
$RegistrerReklame=$_POST ["RegistrerReklame"];									// HENTER INN SUBMITKNAPPEN

if ($RegistrerReklame){															// LYTTER TIL OM SUBMITKNAPPEN BLIR TRYKKET
	$firma =mysql_real_escape_string(strtolower($_POST["firma"]));				// HENTER INPUT FRA SKJEMAET ,SETTER ALLE BOKSTAVENE TIL SMÅ BOKSTAVER OG FJERNER SPESIALTEGN
	$link=mysql_real_escape_string(strtolower($_POST["link"]));					// HENTER INPUT FRA SKJEMAET ,SETTER ALLE BOKSTAVENE TIL SMÅ BOKSTAVER OG FJERNER SPESIALTEGN
	$alternativ=mysql_real_escape_string(strtolower($_POST["alternativ"]));		// HENTER INPUT FRA SKJEMAET ,SETTER ALLE BOKSTAVENE TIL SMÅ BOKSTAVER OG FJERNER SPESIALTEGN
	$beskrivelse=mysql_real_escape_string(strtolower($_POST["beskrivelse"]));	// HENTER INPUT FRA SKJEMAET ,SETTER ALLE BOKSTAVENE TIL SMÅ BOKSTAVER OG FJERNER SPESIALTEGN
	$adminId=$_SESSION["adminId"];												// HENTER ADMIN ID FRA SESSION
	$laget=date("Y-m-d h:i:s");													// HENTER UT DATAOEN OG KLOKKA FOR NÅR DATAENE BLIR LAGET
	$firmaStr=str_replace(' ', '',$firma);										// FJERNER WHITESPACE(MELLOMROM) I FIRMANAVNET
	
	/* Leser fila som admin laster opp */
	$filnavn = $_FILES["fil"]["name"]; // To-dim array
	$filtype = $_FILES["fil"]["type"];
	$filstorrelse = $_FILES["fil"]["size"];
	$tmpnavn = $_FILES["fil"]["tmp_name"];
	
	/* Splitter ut fildefinisjonen(type) og legger den til bak filnavnet */
	$splittFilnavn = explode(".",$filnavn);
	$definertFilnavn = ".$splittFilnavn[1]";
	
	/* Setter filnavn til brukernavn+filtypen */
	$nyttnavn = "img/ads/".$firmaStr.$definertFilnavn;
	$nyFil = "../img/ads/".$firmaStr.$definertFilnavn;
	
	
	if (!$firma||!$link||!$alternativ||!$beskrivelse){							// SJEKKER AT ALLE DATAENE FRA SKJEMAET ER UTFYLT
		print ("Alle feltene må fylles ut<br />");								// SKRIVER UT FEILMELDING
	} else {
		
		kobleTil();																// KOBLER TIL DATABASEN
		$sqlSetning= "CALL leggTilReklame(
		'$firma',
		'$nyttnavn',
		'$link',
		'$alternativ',
		'$beskrivelse',
		'$adminId',
		'$laget');";															// SQLSETNINGEN SOM SKAL KJØRES I DATABASEN

		mysql_query ($sqlSetning) or die (mysql_error());						// KJØRER SQLSETNINGEN I DATABASEN
		kobleFra();																// KOBLER FRA DATABASEN
		
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
			}
		}

		print ("<h2>Registreringen var vellykket</h2>");						// SKRIVER UT BEKREFTELSE PÅ AT REGISTRERINGEN VAR VELLYKKET
	}
}
include("../slutt.html");																	// INKLUDERER SISTE DEL AV DESIGNET
?>
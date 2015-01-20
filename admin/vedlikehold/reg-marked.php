<?php
/**
 * Behandle Markedsplass
 * Fjerne og legge til kategorier
 * Sortere treff etter krev
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
$title = '..REGISTRER MARKEDSKATEGORIER..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include 'start.php';											// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN
?>

<br/>
<form method="post" name="legtilmarked" id="leggtilmarked" action="reg-marked.php">
Torget <input type="text" id="marked" name="marked">
<input type="submit" value="legg til Ny Marked Kategori" id="leggTilMarked" name="leggTilMarked" class="input" /> 
<input type="reset" value="Nullstill" id="nullstill" name="nullstill" class="input" />
</form>


<?php 
$leggtMarked=$_POST ["leggTilMarked"];							// HENTER INPUT FRA SUBMITKNAPPEN

if ($RegTilMarked){												// LYTTER TIL OM SUBMITKNAPPEN BLIR TRYKKET
	$marked=$_POST["marked"];									// HENTER INPUT FRA SKJEMAET

	if (!$marked){												// SJEKKER AT DET ER KOMMET INPUT FRA SKJEMAET
		print (" Feltet må fylles ut");							// SKRIVER UT FEILMELDING
	} else {
		kobleTil();											// KOBLER TIL DENATABAS

		$sqlSetning= "CALL adminRegistrerTorgKategori('$marked');";		// SQL SETNING SOM SKAL KJØRES I DATABASEN
		$sqlRestultat=mysql_query($sqlSetning) or die(mysql_error());	// KJØRER SQL SETNINGEN I DATABASEN
		kobleFra();											// KOBLER FRA DATABASEN

		print ("Dataene er nå registert");				// SKRIVER UT BEKREFTELSE PÅ AT DATAENE ER REGISTRERT
		}
	}
include("../slutt.html");																	// INKLUDERER SISTE DEL AV DESIGNET
?>
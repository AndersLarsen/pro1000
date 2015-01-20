<?php

/**
 * Hvorfor oss
*
* Gir mulighet for registrering av informasjon som blr vist i registrering frontend.
* Gir muligheten til å legge til en textbox front end.
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
* @link			http://student.hive.no/pro10005/1
*
*/
$title = '..INFO BOKSER..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");											// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN
?>
<br />
<form class='igeir_skjema' action=''
	enctype='multipart/form-data' method='post' name='igeir_skjema'
	id='igeir_skjema'>
	<ul>
		<li>
			<h2>Legg til ny informasjonsbox</h2> <span class="required_notification">Alle felt
				må fylles ut</span>
		</li>
		<li><label for='overskrift'>Overskrift:</label> <input type="text"
			placeholder="Overskrift" id="Overskrift" name="Overskrift" min="1" maxlength="45" required />
		</li>
		
		<li><label for='hovedtekst'>Hovedtekst:</label> <textarea rows="20"
				cols="50" id="Hovedtekst" name="Hovedtekst" placeholder="Hovedtekst"
				 min="1" required></textarea>
		</li>
		<li><input type="submit" value="Legg til Ny info" id="leggTilHvorfor"
			name="leggTilHvorfor" class="submit" />
		</li>
	</ul>
</form>

<br />
<?php 
$RegTilHvorfor=$_POST ["leggTilHvorfor"];						// HENTER INPUT FRA SUBMITKNAPPEN

if ($RegTilHvorfor){											// LYTTER TIL OM SUBMITKNAPPEN BLI TRYKKET
	$Overskrift		= $_POST["Overskrift"];						// HENTER INN INPUT FRA SKJEMAET OG LAGRER I EN VARIABEL
	$Hovedtekst		= $_POST["Hovedtekst"];						// HENTER INN INPUT FRA SKJEMAET OG LAGRER I EN VARIABEL
	
	if (!$Overskrift||!$Hovedtekst){							// SJEKKER AT FELTENE FRA SKJEMAET ER UTFYLT
		print ("Alle feltene  må fylles ut");					// SKRIVER UT FEILMELDING HVIS IKKE FELTENE ER UTFYLT
	} else {
		kobleTil();												// KOBLER TIL DATABASEN
		$sqlSetning= "INSERT INTO hvorfoross (`header`, `content`) VALUES ('$Overskrift','$Hovedtekst');"; 	// SQL SETNING
		$sqlRestultat=mysql_query($sqlSetning) or die(mysql_error());										// KJØRER SQL SETNING I DATABASEN
		kobleFra();												// KOBLER FRA DATABASEN
			
		echo "<script> alert('Da er informasjonsboksen lagret ') </script>";	// GIR TILBAKEMELDING TIL BRUKEREN OM AT ROMMET ER BLITT LAGT TIL
				}
	}
include("../slutt.html");																	// INKLUDERER SISTE DEL AV DESIGNET
?>
<?php 
/**
 * Reg-nyhet
 *
 * Gir mulighet for registrering av nyheter.
 * Man må være admin for å få tilgang til denne siden,
 * dersom man har tilgang så får man anledning til å legge
 * ut nyheter på fremsiden av IGeir CMS og de samme nyhetene
 * skal bli brukt til IGeir ved asynkront tilbakekall..
 * Sidene er mobiltilpasset og HTML5 validert.
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
$title = '..REGISTRER EN NYHET..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");											// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN
?>
<br />
<form class='igeir_skjema' action='reg-nyhet.php'
	enctype='multipart/form-data' method='post' name='igeir_skjema'
	id='igeir_skjema'>
	<ul>
		<li>
			<h2>Legg til nyhet</h2> <span class="required_notification">Alle felt
				må fylles ut</span>
		</li>
		<li><label for='overskrift'>Overskrift:</label> <input type="text"
			placeholder="Overskrift" id="Overskrift" name="Overskrift" min="1" maxlength="45" required />
		</li>
		<li><label for='ingress'>Ingress:</label> <textarea rows="10"
				cols="50" id="Ingress" name="Ingress" placeholder="Ingress" min="1" maxlength="255" required></textarea>
		</li>
		<li><label for='hovedtekst'>Hovedtekst:</label> <textarea rows="20"
				cols="50" id="Hovedtekst" name="Hovedtekst" placeholder="Hovedtekst"
				 min="1" required></textarea>
		</li>
		<li><input type="submit" value="Legg til Nyhet" id="leggTilNyhet"
			name="leggTilNyhet" class="submit" />
		</li>
	</ul>
</form>

<br />
<?php 
$RegistrerNyhet=$_POST ["leggTilNyhet"];						// HENTER INN SUBMITKNAPPEN

if ($RegistrerNyhet){											// LYTTER TIL OM SUBMITKNAPPEN BLIR TRYKKET
	$Overskrift		=  mysql_real_escape_string($_POST["Overskrift"]);						// HENTER INN INPUT FRA SKJEMAET OG LAGRER I EN LOKAL VARIABEL
	$Ingress		=  mysql_real_escape_string($_POST["Ingress"]);						// HENTER INN INPUT FRA SKJEMAET OG LAGRER I EN LOKAL VARIABEL
	$Hovedtekst		=  mysql_real_escape_string($_POST["Hovedtekst"]);						// HENTER INN INPUT FRA SKJEMAET OG LAGRER I EN LOKAL VARIABEL
	$AdminId		= $_SESSION['adminId'];						// HENTER INN INPUT FRA SKJEMAET OG LAGRER I EN LOKAL VARIABEL
	$Laget			= date("Y-m-d h:i:s");						// SETTER DATOEN FOR NÅR EN NYHET BLIR LAGET

	
	if (!$Overskrift||!$Ingress||!$Hovedtekst){					// SJEKKER AT ALLE FELT ER UTFYLT
		print ("Alle feltene  må fylles ut");					// SKRIVER UT FEILMELDING
	} else {
			kobleTil();											// KOBLER TIL DATABASEN
			$sqlSetning= "CALL leggTilNyhet('$Overskrift','$Ingress','$Hovedtekst','$AdminId','$Laget');";	// SQL SETNING
			$sqlRestultat=mysql_query($sqlSetning) or die(mysql_error());									// KJØRER SQL SETNING I DATABASEN
			kobleFra();											// KOBLER FRA DATABASEN
			
			print ("Dataene er nå registert");					// SKRIVER UT MELDING OM AT DATAENE ER BLITT REGISTRERT
	}
}
include("../slutt.html");										// INKLUDERER SISTE DEL AV DESIGNET
?>
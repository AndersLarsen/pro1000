<?php 
/**
 * Reg-admin
 * 
 * Her er det anledning for andre admins å legge til en ny admin for
 * Igeir. Dette gjøres ved å fylle ut alle input feltene som kommer
 * frem på siden. Alle felt må fylles ut, dette sjekkes ved HTML5
 * validering, så dersom ikke alle feltene er fylt ut så vil ikke 
 * registreringen bli fullført.
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
$title = '..REGISTRER ADMIN..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");												// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();														// SJEKKER OM EN PERSON ER LOGGET INN
?>

<br />

<form class="igeir_skjema" action="reg-admin.php"
	enctype="multipart/form-data" method="post" name="igeir_skjema"
	id="igeir_skjema">
	<ul>
		<li>
			<h2>Legg til admin</h2> <span class="required_notification">Alle felt
				må fylles ut</span>
		</li>
		<li><label for='Fornavn'>Fornavn:</label> <input type="text"
			placeholder="Fornavn" id="fornavn" name="fornavn" size="45" required />
		</li>
		<li><label for='Etternavn'>Etternavn:</label> <input type="text"
			placeholder="Etternavn" id="etternavn" name="etternavn" size="45" required />
		</li>
		<li><label for='Mail'>Mail:</label> <input type="email"
			placeholder="Mail" id="mail" name="mail" size="50" required />
		</li>
		<li><label for='Adresse'>Adresse:</label> <input type="text"
			placeholder="Adresse" id="adresse" name="adresse" size="45" required />
		</li>
		<li><label for='Tlf'>Tlf:</label> <input type="text"
			placeholder="Tlf" id="tlf" name="tlf" size="30" required />
		</li>
		<li><label for='Mob'>Mob:</label> <input type="text"
			placeholder="Mob" id="mob" name="mob" size="30" required />
		</li>
		<li><label for='PostNr'>Post nr:</label> <input type="text"
			placeholder="Post nummer" id="postNr" name="postNr" size="4" min="0000" max="9999" required />
		</li>
		<li><label for='Brukernavn'>Brukernavn:</label> <input type="text"
			placeholder="Brukernavn" id="brukernavn" name="brukernavn" size="25" required />
		</li>
		<li><label for='Passord'>Passord:</label> <input type="password"
			placeholder="Passord" id="passord" name="passord" size="25" required />
		</li>
		<li><input type="submit" value="Legg til Admin" id="RegistrerAdmin"
			name="RegistrerAdmin" class="submit" />
		</li>
	</ul>
</form>
<br />
<?php
/**
 *  Registrer admin koden
 *  Tar inn alle dataene som skal registreres og legger disse
 *  i hver sin database.
 *
 *  Gjeldene databaser; admin
 *
 */
$RegistrerAdmin=$_POST["RegistrerAdmin"];

if ($RegistrerAdmin){
	$fornavn	= ucfirst(strtolower(mysql_real_escape_string($_POST["fornavn"])));		// HENTER INN INPUT FRA SKJEMA ,SETTER ALLE BOKSTAVENE TIL SMÅ, SETTER STOR FORBOKSTAV OG FJERNER SPESIALTEGN
	$etternavn	= ucfirst(strtolower(mysql_real_escape_string($_POST["etternavn"])));	// HENTER INN INPUT FRA SKJEMA ,SETTER ALLE BOKSTAVENE TIL SMÅ, SETTER STOR FORBOKSTAV OG FJERNER SPESIALTEGN
	$mail		= strtolower(mysql_real_escape_string($_POST["mail"]));					// HENTER INN INPUT FRA SKJEMA ,SETTER ALLE BOKSTAVENE TIL SMÅ, OG FJERNER SPESIALTEGN
	$adresse	= ucfirst(strtolower(mysql_real_escape_string($_POST["adresse"])));		// HENTER INN INPUT FRA SKJEMA ,SETTER ALLE BOKSTAVENE TIL SMÅ, SETTER STOR FORBOKSTAV OG FJERNER SPESIALTEGN
	$tlf		= mysql_real_escape_string($_POST["tlf"]);								// HENTER INN INPUT FRA SKJEMA OG FJERNER SPESIALTEGN
	$mob		= mysql_real_escape_string($_POST["mob"]);								// HENTER INN INPUT FRA SKJEMA OG FJERNER SPESIALTEGN
	$postNr		= mysql_real_escape_string($_POST["postNr"]);							// HENTER INN INPUT FRA SKJEMA OG FJERNER SPESIALTEGN
	$brukernavn	= mysql_real_escape_string(strtolower($_POST["brukernavn"]));			// HENTER INN INPUT FRA SKJEMA ,SETTER ALLE BOKSTAVENE TIL SMÅ OG FJERNER SPESIALTEGN
	$passord	= mysql_real_escape_string(krypterPassord($_POST['passord']));							// HENTER INN INPUT FRA SKJEMA OG FJERNER SPESIALTEGN

	if (!$fornavn||!$etternavn||!$mail||!$adresse||						
			!$tlf||!$mob||!$postNr||!$brukernavn||!$passord){							// SJEKKER OM ALLE FELT ER FYLT UT
		print ("Alle feltene må fylles ut<br />");										// FEILMELDING HVIS IKKE ALLE FELT ER UTFYLT
	} else {
		$id			= createAdminRef();													// HENTER EN UNIK ADMIN ID
		kobleTil();																		// KOBLER TIL DATABASEN
		
		$sqlSetning="CALL adminLeggTilAdmin(
		'$id',
		'$fornavn',
		'$etternavn',
		'$mail',
		'$adresse',
		'$tlf',
		'$mob',
		'$postNr',
		'$brukernavn',
		'$passord');";																	// LAGER SQL SPØRRING
		
		mysql_query($sqlSetning) or die ("Noe gikk galt med spørringen");				// KJØRER SQL SPØRRINGEN I DATABASEN
		kobleFra();																		// KOBLER FRA DATABASEN
		
		print ("<h2>Registreringen var vellykket</h2>");								// GIR BESKJED TIL BRUKEREN AT REGISTRERINGEN VAR VELLYKKET
	}	
}
include "../slutt.html";																// INKLUDERER SISTE DEL AV DESIGNET
?>
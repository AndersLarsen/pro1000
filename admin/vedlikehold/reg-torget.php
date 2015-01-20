<?php
/**
 * Behandle Torget
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
$title = '..REGISTRER TORGKATEGORI..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include 'start.php';											// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN
?>

<br/>
<br/>

<form class="igeir_skjema" action=""
	enctype="multipart/form-data" method="post" name="igeir_skjema"
	id="igeir_skjema">
	<ul>
		<li>
			<h2>Legg til ny Torgkategori</h2> <span class="required_notification">Alle felt
				må fylles ut</span>
		</li>
		<li><label for="torget">Torget</label> <input type="text" id="torget" name="torget"
			placeholder="Torget" size="45" required />
		</li>
		
		
		<li><input type="submit" value="Legg til Kategori" id="RegisterTorget"
			name="RegisterTorget" class="submit" />
		</li>
	</ul>
</form>

<br>
<br>
<?php 
$RegisterTorget=$_POST["RegisterTorget"];								// HENTER INN SUBMITKNAPPEN

if 	($RegistrerTorget){													// SJEKKER OM SUBMITKNAPPEN BLIR TRYKKET
	$torget=$_POST["torget"];											// HENTER INN INPUT FRA SKJEMAET
	if (!$torget) {														// SJEKKER AT DET ER KOMMET DATA FRA SKJEMAET
		echo ("Fyll inn feltet");										// SKRIVER UT FEILMELDING
	} else	{
		kobleTil();															// KOBLER TIL DATABASEN
		$sqlSetning="CALL adminRegistrerTorgKategori('$torget');";			// SQLSETNING SOM SKAL KJØRES I DATABASEN
		$sqlRestultat=mysql_query($sqlSetning) or die(mysql_error());		// KJØRER SQLSETNING I DATABASEN
		kobleFra();															// KOBLER FRA DATABASEN
		print ("Dataene er nå registert");									// SKRIVER UT BEKREFTELSE PÅ AT DATAENE ER REGISTRERT
		}
	}
include ("../slutt.html");												// INKLUDERER FOOTEREN
?>
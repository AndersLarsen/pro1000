<?php 
/**
 * VISER ALLE MARKED
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
 * @copyright 	2012-2017
 * @license		http://www.php.net/license/3_01.txt
 * @link		http://is.hive.no/andlar/pro10005/
 * @link		http://is.hive.no/haolse/pro10005/
 *							
 */
$title = '..VISER ALLE MARKEDSKATEGORIER..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");											// INKLUDERER F�RSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN												
ob_start();														// STARTPUNKT FOR TEKSTFJERNING
kobleTil();														// KOBLER TIL DATABASEN
$sqlSetning="CALL velgAltFraMarked;";							// SQL-SETNINGEN
$sqlResultat=mysql_query($sqlSetning) or header('Location: 404.php');  // KJØRER SQL-SETNINGEN, RETURNERER ERROR VED FEIL
kobleFra();														// KOBLER FRA DATABASEN
/*
 * Starter og lager tabel-strukturen på det som skal vises
* Definerer thead,tbody og tfooter
*/
print ("<h5>Registrerte Kategorier under Marked </h5>");   		// SKRIVER UT OVERSKRIFT
print ("<table width='100%' class='bottomBorder'>");  			// STARTEN PÅ TABELLEN SOM SKAL VISES

/*
 * <Thead> Hodet på tabellen v�r, her st�r overskriften til tabellen
*/
print ("<thead>
		<tr>
		<th align=left>MarkedsplassId</th>
		<th align=left>Hovedkategori</a></th>

		<th align=left></th>
		<th align=left></th>
		
		</tr>
		</thead>");
echo("<form method='post' action=''>");

$antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET

for ($r=1;$r<=$antallRader;$r++){
	$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SP�RRINGSRESULTATET
	/*
	* <Tbody> Kroppen p� tabellen, her returneres like mange linjer som
	* det finnes i database-tabellen
	*/
	print ("<tbody>
			<tr>
			<td> $rad[0] </td>
			<td> $rad[1] </td>

				
				
			<td><center><input type='checkbox' id='brukerInfo' name='brukerInfo[]' value='$rad[0] $rad[1] $rad[2] $rad[3] $rad[4] $rad[5] $rad[6]'></center> </td>
			<td><center><input type='radio' id='radioInfo' name='radioInfo[]' value='$rad[0]|$rad[1]|$rad[2]'></center> </td>
			</tr>
			</tbody>");
}

/*
 * <Tfoot> Foten av tabellen v�res, her har vi kun slette og endre knappene.
*/
print ("<tfoot align='center'>
		<tr>
		<th align=left></th>
		<th align=left></th>

		<th align=center><input type='submit' id='sletteKnapp' name='sletteKnapp' value='Slett' class='input'></th>
		<th align=center><input type='submit' id='endreKnapp' name='endreKnapp' value='Endre' class='input'></form></th>
		</tr>
		</tfoot>");

print ("</table><br />");  											// SLUTTEN P� TABELLEN


/**
 *  STARTEN PÅ SLETTE FUNKSJONEN MOT DATABASEN
 *
 *  Denne funksjonen sletter alle merkede rader.
 *  Disse må merkes med checkboxen som er laget i skjemaet.
 *  Det blir gitt et valideringsspørsmål på hvorvidt brukeren virkelig
 *  vil slette eller ikke.
 *  Denne funksjonen kan ikke angres.
 *
*/

$sletteKnapp = $_POST["sletteKnapp"];								// DEFINERER SLETTEKNAPPEN
if($sletteKnapp){													// SJEKKER OM SLETTEKNAPPEN ER BLITT TRYKKET
	$brukerInfo=$_POST["brukerInfo"];								// LESER ALL INFORMASJON SOM BLIR SENDT VIA SLETTEKNAPPEN
	$antall=count($brukerInfo);										// TELLER OPP ANTALL LINJER INFORMASJONEN  INNEHOLDER

	if($antall == 0){												// SJEKKER AT DET ER VALGT NOEN TABELL-RADER
		print("Ingen kategori er valgt <br />");					// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLTIT VALGT
	} else {
		kobleTil();
		for($i=0; $i<$antall; $i++){								// BEHANDLER INFORMASJONEN DERSOM DET ER VALGT 1+ STUDENT(ER)
			$del = explode(" ", $brukerInfo[$i]);					// SPLITTER OPP INFORMASJONS STRENGEN I DELER
			$MarkedsplassId = $del[0];
			$Hovedkategori =$del[1];
			
			$sqlSetning = "CALL slettMarked('$MarkedsplassId');";	// SLETTER DEN VALGTE KLASSEKODEN FRA DATABASEN KLASSE
			$sqlResultat = mysql_query($sqlSetning) or die(mysql_error());	// KJØRER SQLSETNINGEN OG RETURNERER ERROR VED FEIL
		}
		kobleFra();

		$self=$_SERVER['PHP_SELF'];										// OPPDATERINGSKNAPP FOR Å KUNNE SE ENDRINGEN GJORT I TABELLEN

		print("<center>
				De valgte dataene er nå slettet <br />
				<form method='post' action='$self' id='egetKall' name='egetKall'>
				<input type='submit' value='Se oppdatering' id='oppdater' name='oppdater' class='input' />
				</form>
				</center><br />
				");
	}
}

																		/* SLUTTEN PÅ SLETTE FUNKSJONEN MOT DATABASEN */

/**
 * STARTEN P� ENDRE FUNKSJONEN MOT DATABASEN
 *
 * Denne funksjonen tar h�yde for at det ved senere utvikling kan endres p̴ flere
 * brukere samtidig. Den har muligheten til � bytte ut radioInfo[] med brukerInfo[]
 * s̴ vil man kunne endre samtidlige torgeter samtidig.
 *
 * Det som mangler er en behandlingsfunksjon som skriver alle brukerene som blir endret
 * til databasen.
 *
 */


$endreKnapp = $_POST["endreKnapp"];														// DEFINERER ENDRE KNAPPEN
if($endreKnapp){																		// SJEKKER OM ENDRE KNAPPEN BLIR TRYKKET
	ob_end_clean();																		// FJERNER ALL TIDLIGERE TEKST
	$radioInfo=$_POST ["radioInfo"];  													// VARIABLER GITT FRA VERDIENE I HTML-SKJEMA
	$antall=count($radioInfo);															// TELLER ANTALL RADER FRA HTML SKJEMA

	if ($antall==0){																	// SJEKKER AT DET ER VALGT NOEN TABELL-RADER
		print ("Ingen ting er valgt til endring<br />");								// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLTIT VALGT
	} else {
		/* Starten p� endre torget skjema */

		for($i=0; $i<$antall; $i++){
			$del = explode("|", $radioInfo[$i]);										// SPLITTER OPP INFORMASJONS STRENGEN I DELER
			$MarkedsplassId = $del[0];
			$Hovedkategori = $del[1];
			

				
		}

		print ("
					
				<form class='igeir_skjema' action='vis-marked.php'
				enctype='multipart/form-data' method='post' name='igeir_skjema'
				id='igeir_skjema'>
				<ul>
				<li>
				<h2>Endre Marked Kategori</h2> <span class='required_notification'>Alle felt
				må fylles ut</span>
				</li>
				<li><label for='MarkedsplassId'>Markedsplass Id:</label> <input type='text'
				value='$MarkedsplassId' id='MarkedsplassId' name='MarkedsplassId' required />
				</li><li>
				<label for='Hovedkategori'>Hovedkategori:</label> <input type='text'
				value='$Hovedkategori' id='Hovedkategori' name='Hovedkategori' required />
				</li><br>
				
				<li><input type='submit' value='Endre Marked Kategori' id='endremarkedKnapp'
				name='endremarkedKnapp' class='submit' />
				</li>
				</ul>
				</form>
				<br />");

			
																									/* SLUTTEN AV ENDRE SKJEMAET */

	}
}

$endremarkedKnapp = $_POST["endremarkedKnapp"];														// DEFINERER ENDRE KNAPP FOR torget
if($endremarkedKnapp){																				// SJEKKER OM ENDRE KNAPPEN FOR marked ER TRYKKET
	$MarkedsplassId=$_POST["MarkedsplassId"];
	$Hovedkategori=$_POST["Hovedkategori"];
	


	kobleTil();																						// KOBLER TIL DATABASEN
	$sqlSetning=" CALL oppdaterMarked ('$MarkedsplassId','$Hovedkategori');"; 						// OPPDATERER DE ANGITTE VARIABLENE I DATABASEN TILH�RENDE DET BESTEMTE
	$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());  									// KJ�RER SQLSETNINGEN OG RETURNERER ERROR VED FEIL																							// KJØRER SQLSETNINGEN OG RETURNERER ERROR VED FEIL
	kobleFra();																						// KOBLER FRA DATABASEN

	

	$self=$_SERVER['PHP_SELF'];																		// OPPDATERINGS KNAPP FOR Å KUNNE OPPDATERE INFORMASJONEN SOM ER SKREVET
 	print("<meta http-equiv='refresh' content='0'> ");
}

/* SLUTTEN P� ENDRE FUNKSJONEN MOT DATABASEN */
include("../slutt.html");																			// INKLUDERER FOOTEREN
?>
				
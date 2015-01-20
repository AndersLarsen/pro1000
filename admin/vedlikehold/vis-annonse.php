<?php 
/**
 * Vis-admins
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
 * @copyright 	2013-2018
 * @license		http://www.php.net/license/3_01.txt
 * @link		http://student.hive.no/pro10005/1
 *
 */
$title = '..VISER ALLE ANNONSER..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");											// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN
ob_start();														// SETTER ET STARTPUNKT PÅ HVOR VI KAN FLUSHE VEKK TEKST
$sqlResultat = execute("SELECT * FROM igeir ORDER by Teller;");		// KJØRER SQL-SETNINGEN PÅ SERVEREN

// kobleTil();														// KOBLER TIL DATABASEN
// $sqlSetning="SELECT * FROM igeir ORDER by Id;";					// SQL-SETNINGEN SOM SKAL KJØRES PÅ SERVER
// $sqlResultat=mysql_query($sqlSetning) or header('Location: 404.php');  // KJØRER SQL-SETNINGEN PÅ SERVEREN
// kobleFra();														// KOBLER FRA DATABASEN

print ("<center><table width='80%' class='bottomBorder'>");  	// STARTEN PÅ TABELLEN SOM SKAL VISES


/*
 * <Thead> Hodet på tabellen vår, her står overskriften til tabellen
*/
print ("<thead>
		<tr>
		<h2>Registrerte Annonser </h2>
		<th align=left>Igerikode</th>
		<th align=left>Overskrift</th>
		<th align=left>Beskrivelse </th>
		<th align=left>BrukerId</th>
		<th align=left></th>
		<th align=left></th>
		</tr>
		</thead>");
echo("<form method='post' action='' >"); // JAVASCRIPT FOR VALIDERING


$antallRader=mysql_num_rows($sqlResultat);						// ANTALL RADER I RESULTATET AV MYSQL KALLET

for ($r=1;$r<=$antallRader;$r++){
	$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPØRRINGSRESULTATET
	/*
	 * <Tbody> Kroppen på tabellen, her returneres like mange linjer som
	* det finnes i database-tabellen
	*/

	print ("<tbody>
			<tr>
			<td> $rad[1] </td>
			<td> $rad[5] </td>
			<td> $rad[3] </td>
			<td> $rad[6] </td>
			<td><center><input type='checkbox' id='annonseInfo' name='annonseInfo[]' value='$rad[1]'></center> </td>
			<td><center><input type='radio' id='radioInfo' name='radioInfo[]' value='$rad[1]'></center> </td>
			</tr>
			</tbody>");  /* ny rad skrevet */
}
/*
 * <Tfoot> Foten av tabellen våres, her har vi kun slette og endre knappene.
*/
print ("<tfoot align='center'>
		<tr>
		<th align=left></th>
		<th align=left></th>
		<th align=left></th>
		<th align=left></th>

		<th align=center><input type='submit' id='sletteKnapp' name='sletteKnapp' value='Slett' class='input'></th>
		<th align=center><input type='submit' id='endreKnapp' name='endreKnapp' value='Endre' class='input'></form></th>
		</tr>
		</tfoot>");

print ("</table></center><br />");  												// SLUTTEN PÅ TABELLEN

/**
 *  STARTEN PÅ SLETTE FUNKSJONEN MOT DATABASEN
 *
 *  Denne funksjonen sletter alle merkede admins.
 *  Disse må merkes med checkboxen som er laget i skjemaet.
 *  Denne funksjonen kan ikke angres.
 *
*/

$sletteKnapp = $_POST["sletteKnapp"];								// DEFINERER SLETTEKNAPPEN
if($sletteKnapp){													// SJEKKER OM SLETTEKNAPPEN ER BLITT TRYKKET
	$annonseInfo=$_POST["annonseInfo"];								// LESER ALL INFORMASJON SOM BLIR SENDT VIA SLETTEKNAPPEN
	$antall=count($annonseInfo);									// TELLER OPP ANTALL LINJER INFORMASJONEN  INNEHOLDER

	if($antall == 0){												// SJEKKER AT DET ER VALGT NOEN TABELL-RADER
		print("Ingen rader(s) er valgt <br />");					// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLITT VALGT
	} else {
		kobleTil();													// KOBLER TIL DATABASEN
		for($i=0; $i<$antall; $i++){								// BEHANDLER INFORMASJONEN DERSOM DET ER VALGT 1+ ANNONSER(ER)
			$del = explode(" ", $annonseInfo[$i]);					// SPLITTER OPP INFORMASJONS STRENGEN I DELER
			$uniqueId = $del[0];									// HENTER UT UNIKID OG LAGRER DEN I LOKAL VARIABEL
			$sqlSetning = "CALL slettAnnonse('$uniqueId');";	// SLETTER DEN VALGTE KLASSEKODEN FRA DATABASEN KLASSE
			$sqlResultat = mysql_query($sqlSetning) or die(mysql_error());	// KJØRER SQLSETNINGEN OG RETURNERER ERROR VED FEIL
		}
		kobleFra();													// KOBLER FRA DATABASEN
		$self=$_SERVER['PHP_SELF'];									// OPPDATERINGSKNAPP FOR Å KUNNE SE ENDRINGEN GJORT I TABELLEN

 	print("<meta http-equiv='refresh' content='0'> ");
		
	}
}

/* SLUTTEN PÅ SLETTE FUNKSJONEN MOT DATABASEN */

/**
 * STARTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN
 *
 * Denne funksjonen tar høyde for at det ved senere utvikling kan endres på flere
 * brukere samtidig. Den har muligheten til å bytte ut radioInfo[] med annonseInfo[]
 * så vil man kunne endre samtidlige admins samtidig.
 *
 * Det som mangler er en behandlingsfunksjon som skriver alle brukerene som blir endret
 * til databasen.
 *
 */
$endreKnapp = $_POST["endreKnapp"];									// DEFINERER ENDRE KNAPPEN
if($endreKnapp){													// SJEKKER OM ENDRE KNAPPEN BLIR TRYKKET
	ob_end_clean();													// FJERNER ALL TEKST SOM HAR STÅTT TIDLIGERE
	$radioInfo=$_POST ["radioInfo"];  								// VARIABLER GITT FRA VERDIENE I HTML-SKJEMA
	$antall=count($radioInfo);										// TELLER ANTALL RADER FRA HTML SKJEMA

	if ($antall==0){												// SJEKKER AT DET ER VALGT NOEN TABELL-RADER
		print ("Ingen nyhet er valgt for endring<br />");			// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLTIT VALGT
	} else {
// 		print ("<center><form method='post' action='' id='endreSkjema' name='endreSkjema'>");

		for($i=0; $i<$antall; $i++){
			$del = explode(" ", $radioInfo[$i]);					// SPLITTER OPP INFORMASJONS STRENGEN I DELER
			$igeirKode = $del[0];
			kobleTil();												// KOBLER TIL DATABASEN
			$sqlSetning="SELECT 
			IgeirKode,
			Bud,
			Beskrivelse,
			BildeId,
			Header,
			Pris,
			Aktiv,
			Privat,
			Status 
			FROM 
			igeir 
			WHERE 
			IgeirKode='$igeirKode';"; 								// SQL-SETNINGEN SOM SKAL KJØRES
			$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());  // SQL-SETNING, KJØRER SELVE SPØRRINGEN OG RETURNERER ERROR VED FEIL
			$rad=mysql_fetch_array($sqlResultat);  					// NY RAD HENTET FRA SPØRRINGSRESULTATET
			kobleFra();												// KOBLER FRA DATABASEN
			
			$igeirKode = $rad[0];									// HENTER IGEIRKODE FRA SQL-ARRAYET
			$bud = $rad[1];											// HENTER BUD FRA SQL-ARRAYET
			$beskrivelse = $rad[2];									// HENTER BESKRIVELSE FRA SQL-ARRAYET
			$bildeId = $rad[3];										// HENTER BILDEID FRA SQL-ARRAYET
			$header = $rad[4];										// HENTER HEADER FRA SQL-ARRAYET
			$pris = $rad[5];										// HENTER PRIS FRA SQL-ARRAYET
			$aktiv = $rad[6];										// HENTER AKTIV FRA SQL-ARRAYET
			$privat = $rad[7];										// HENTER PRIVAT FRA SQL-ARRAYET
			$status = $rad[8];										// HENTER PRIVAT FRA SQL-ARRAYET
			print ("
					<br />
					<form class='igeir_skjema' action=''
					enctype='multipart/form-data' method='post' name='igeir_skjema'
					id='igeir_skjema'>
					<ul>
					<li>
					<h2>Rediger Annonse ($igeirKode)</h2> <span class='required_notification'>Alle felt
					må fylles ut</span>
					</li>
					<li><label for='bud'>Bud:</label> <input type='text'
					value='$bud' id='bud' name='bud' required />
					</li>
					</li>
					<li><label for='header'>Overskrift:</label> <input type='text'
					value='$header' id='header' name='header' required />
					</li>
					<li><label for='fornavn'>Beskrivelse:</label> <textarea rows='20' cols='30' name='beskrivelse' required>$beskrivelse</textarea>
					</li>
					<li><label for='pris'>Pris:</label> <input type='text'
					value='$pris' id='pris' name='pris' required />
					</li>
					<li><label for='status'>Status:</label> ");
					salgsTilstand($status); 
			print ("
					</li>			
					<li><input type='submit' value='Endre' id='endreKnappen'
					name='endreKnappen' class='submit' />
					</li>
					</ul>
					</form>
					<br />
					");					
		}
	}
}

$endreKnappen = $_POST["endreKnappen"];							// DEFINERER ENDRE KNAPP FOR KLASSE
if($endreKnappen){												// SJEKKER OM ENDRE KNAPPEN FOR STUDENT ER TRYKKET

	$bud = $_POST["bud"];										// HENTER INN BUD FRA SKJEMAET
	$igeirKode = $_POST["igeirKode"];							// HENTER INN IGEIRKODE FRA SKJEMAET
	$beskrivelse = $_POST["beskrivelse"];						// HENTER INN BESKRIVELSE FRA SKJEMAET
	$header = $_POST["header"];									// HENTER INN HEADER FRA SKJEMAET
	$pris = $_POST["pris"];										// HENTER INN PRIS FRA SKJEMAET
	$status = $_POST["status"];

	/* variable gitt verdier fra feltene i HTML-skjemaet */
	kobleTil();													// KOBLER TIL DATABASEN
	$sqlSetning="UPDATE Igeir SET Bud='$bud',Beskrivelse='$beskrivelse',Header='$header',Pris='$pris', Status='$status' WHERE IgeirKode='$igeirKode';"; // SQL-SETNINGEN
	mysql_query($sqlSetning) or die(mysql_error());				// KJØRER SQL-SETNINGEN OG RETURNERER ERROR VED FEIL
	kobleFra();													// KOBLER FRA DATABASEN

	$self=$_SERVER['PHP_SELF'];									// OPPDATERINGS KNAPP FOR Å KUNNE OPPDATERE INFORMASJONEN SOM ER SKREVET
 	print("<meta http-equiv='refresh' content='0'> ");
}

/* SLUTTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN */
include("../slutt.html");										// INKLUDERER SISTE DEL AV DESIGNET
?>
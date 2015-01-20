<?php 
/**
 * Vis-reklame-aktorer
 * 
 * Denne fila lister ut alle reklame aktørene som er på siden.
 * Her finner man diverse info som skal brukes for å vise en
 * reklame banner på IGeir sidene.
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
$title = '..VISER ALLE REKLAMEAKTØRER..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");											// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN
ob_start();														// STARTPUNKT FOR TEKSTFJERNING

kobleTil();														// KOBLER TIL DATABASEN
$sqlSetning="CALL adminReklameOversikt();";						// SQL-SETNING
$sqlResultat=mysql_query($sqlSetning) or header('Location: .../404.php');  // KJØRER SQL-SETNINGEN I DATABASEN
kobleFra();														// KOBLER FRA DATABASEN

/*
 * Starter og lager tabel-strukturen på det som skal vises
 * Definerer thead,tbody og tfooter
 */
print ("<h5>Registrerte reklame aktører </h5>");						// SKRIVER UT OVERSKRIFTEN
print ("<center><table width='80%' class='bottomBorder'>");  			// STARTEN PÅ TABELLEN SOM SKAL VISES

/*
 * <Thead> Hodet på tabellen vår, her står overskriften til tabellen
 */
print ("<thead>
		<tr>
		<th align=left>Id</th>
		<th align=left>Firma</th>
		<th align=left>Link</th>
		<th align=left>Bilde</th>
		<th align=left></th>
		<th align=left></th>
		</tr>
		</thead>");
echo("<form method='post' action='' >");

$antallRader=mysql_num_rows($sqlResultat);						// ANTALL RADER I RESULTATET AV MYSQL KALLET

for ($r=1;$r<=$antallRader;$r++){
	$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPØRRINGSRESULTATET
	/*
	 * <Tbody> Kroppen på tabellen, her returneres like mange linjer som
	 * det finnes i database-tabellen
	 */
	print ("<tbody>
			<tr>
			<td> $rad[0] </td>
			<td> $rad[1] </td>
			<td><a href='$rad[2]' target='_blank'> $rad[2] </a></td>
			<td><img src='../$rad[5]' height='50px' width='50px'></td>
			<td><center><input type='checkbox' id='brukerInfo' name='brukerInfo[]' value='$rad[0] $rad[5]'></center> </td>
			<td><center><input type='radio' id='radioInfo' name='radioInfo[]' value='$rad[0]'></center> </td>
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

print ("</table></center><br />");  								// SLUTTEN PÅ TABELLEN

/**
 *  STARTEN PÅ SLETTE FUNKSJONEN MOT DATABASEN 
 *  
 *  Denne funksjonen sletter alle merkede ID'er.
 *  Disse må merkes med checkboxen som er laget i skjemaet.
 *  Denne funksjonen kan ikke angres.
 *  
 */

$sletteKnapp = $_POST["sletteKnapp"];								// DEFINERER SLETTEKNAPPEN
if($sletteKnapp){													// SJEKKER OM SLETTEKNAPPEN ER BLITT TRYKKET
	$brukerInfo=$_POST["brukerInfo"];								// LESER ALL INFORMASJON SOM BLIR SENDT VIA SLETTEKNAPPEN
	$antall=count($brukerInfo);										// TELLER OPP ANTALL LINJER INFORMASJONEN  INNEHOLDER
	
	if($antall == 0){												// SJEKKER AT DET ER VALGT NOEN TABELL-RADER
		print("Ingen reklame aktør(er) er valgt <br />");			// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLTIT VALGT
	} else {
		kobleTil();													// KOBLER TIL DATABASEN
		for($i=0; $i<$antall; $i++){								// BEHANDLER INFORMASJONEN DERSOM DET ER VALGT
			$del = explode(" ", $brukerInfo[$i]);					// SPLITTER OPP INFORMASJONS STRENGEN I DELER
			$reklameId = $del[0];									// HENTER REKLAMEID FRA SQL-RESULTATET
			$fil = $del[1];											// HENTER INN FILNAVN FRA SQL-RESULTATET
			$path = "../";

			unlink($path.$fil);										// SLETTER FILEN FRA SERVEREN
			$sqlSetning = "CALL adminslettReklameAktor('$reklameId');";		// SLETTER DEN VALGTE KLASSEKODEN FRA DATABASEN KLASSE
			$sqlResultat = mysql_query($sqlSetning) or die(mysql_error());	// KJØRER SQLSETNINGEN OG RETURNERER ERROR VED FEIL
		}
		kobleFra();													// KOBLER FRA DATABASEN

		
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
 * STARTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN
 *
 * Denne funksjonen tar høyde for at det ved senere utvikling kan endres på flere
 * brukere samtidig. Den har muligheten til å bytte ut radioInfo[] med brukerInfo[]
 * så vil man kunne endre samtidlige studenter samtidig.
 *
 * Det som mangler er en behandlingsfunksjon som skriver alle brukerene som blir endret
 * til databasen.
 *
 */
$endreKnapp = $_POST["endreKnapp"];									// DEFINERER ENDRE KNAPPEN
if($endreKnapp){													// SJEKKER OM ENDRE KNAPPEN BLIR TRYKKET
	ob_end_clean();													// FJERNER ALL TIDLIGERE TEKST
	$radioInfo=$_POST["radioInfo"];  								// VARIABLER GITT FRA VERDIENE I HTML-SKJEMA
	$antall=count($radioInfo);										// TELLER ANTALL RADER FRA HTML SKJEMA

	if ($antall==0){												// SJEKKER AT DET ER VALGT NOEN TABELL-RADER
		print ("Ingen reklame er valgt for endring<br />");			// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLITT VALGT
	} else {
		
		kobleTil();														// KOBLER TIL DATABASEN
		$sqlSetning="SELECT ReklameId,Firma,Link,Alternativ,Beskrivelse,Filnavn FROM reklame WHERE ReklameId='$radioInfo[0]';";
		$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());					// EXECUTER SQL SETNINGEN PÅ DATABASEN
		kobleFra();														// KOBLER FRA DATABASEN
		
		for($i=0; $i<$antall; $i++){
			$rad=mysql_fetch_array($sqlResultat);					// HENTER RADEN VI TRAFF I DATABASEN
					
			$reklameId = $rad[0];									// HENTER REKLAMEID FRA SQL-ARRAYET
			$firma = $rad[1];										// HENTER INN FIRMA NAVN FRA SQL-ARRAYET
			$link = $rad[2];										// HENTER INN LINK FRA SQL-ARRAYET
			$alternativ = $rad[3];									// HENTER INN ALTERNATIV LINK FRA SQL-ARRAYET
			$beskrivelse = $rad[4];									// HENTER INN BESKRIVELSE FRA SQL-ARRAYET
			$fil = $rad[5];											// HENTER INN FILNAVN FRA SQL-RESULTATET
					
		}
			print("
					<form class='igeir_skjema' action='vis-reklame-aktorer.php'
					enctype='multipart/form-data' method='post' name='igeir_skjema'
					id='igeir_skjema'>
					<input type='text' value='$reklameId' name='reklameId' id='reklameId' hidden='true'>;
					<ul>
					<li>
					<h2>Endre reklame aktør</h2> <span class='required_notification'>Alle felt
					må fylles ut</span>
					</li>
					<li><label for='firma'>Firma:</label> <input type='text'
					value='$firma' id='firma' name='firma' required />
					</li>
					</li>
					<li><label for='link'>Link:</label> <input type='text'
					value='$link' id='link' name='link' required />
					</li>
					<li><label for='alternativ'>Alternativ:</label> <input type='text'
					value='$alternativ' id='alternativ' name='alternativ' required />
					</li>			
					<li><label for='beskrivelse'>Beskrivelse:</label> <input type='text'
					value='$beskrivelse' id='beskrivelse' name='beskrivelse' required />
					</li>
					<li><label for='Bildefil'>Bildefil:</label> 
					<input type='file' placeholder='Bildefil' id='fil' name='fil' size='30' />
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

$endreKnappen = $_POST["endreKnappen"];												// DEFINERER ENDRE KNAPP FOR KLASSE
if($endreKnappen){																	// SJEKKER OM ENDRE KNAPPEN ER TRYKKET
	$filnavn=mysql_real_escape_string($_POST["fil"]);								// HENTER INN FILNAVN FRA SKJEMA
	$reklameId = $_POST["reklameId"];												// HENTER INN REKLAMEID FRA SKJEMA
	$firma = mysql_real_escape_string($_POST["firma"]);								// HENTER INN FIRMANAVN FRA SKJEMA
	$link = mysql_real_escape_string(strtolower($_POST["link"]));					// HENTER INN LINK FRA SKJEMA
	$alternativ = mysql_real_escape_string(strtolower($_POST["alternativ"]));		// HENTER INN ALTERNATIV FRA SKJEMA
	$beskrivelse = mysql_real_escape_string(strtolower($_POST["beskrivelse"]));		// HENTER INN BESKRIVELSE FRA SKJEMA
	
	if(!$_FILES["fil"]["error"]) { 
		$path = "../";
		unlink($path.$fil);										// SLETTER FILEN FRA SERVEREN
		
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

				kobleTil();														// KOBLER TIL DATABASEN
				$sqlSetning="UPDATE reklame SET Filnavn='$nyttnavn' WHERE ReklameId='$reklameId';";
				$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());	// EXECUTER SQL SETNINGEN PÅ DATABASEN
				kobleFra();														// KOBLER FRA DATABASEN
				
			}
		}
	 }
	/* variable gitt verdier fra feltene i HTML-skjemaet */
	
	kobleTil();														// KOBLER TIL DATABASEN
	$sqlSetning="CALL adminOppdaterReklame('$reklameId','$firma','$link','$alternativ','$beskrivelse');";
	mysql_query($sqlSetning) or die(mysql_error());					// KJØRER SQLSETNINGEN OG RETURNERER ERROR VED FEIL
	kobleFra();														// KOBLER FRA DATABASEN
	
 	print("<meta http-equiv='refresh' content='5'> ");
}

/* SLUTTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN */
include("../slutt.html");																	// INKLUDERER SISTE DEL AV DESIGNET
?>

<?php 
/**
 * Vis-Bruker
 * 
 * Viser en liste som inneholder alle medlemer som er å finne
 * i medlem databasen. Her får man mulighet til å endre eller slette admins
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
 * @author		Original Author <gjermundwedvik@gmail.com>
 * @copyright 	2013-2018
 * @license		http://www.php.net/license/3_01.txt
 * @link		http://student.hive.no/pro10005/1
 *
 */
$title = '..VISER ALLE MEDLEMER..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");											// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN
ob_start();														// SETTER STARTPUNKT FOR TEKSTFJERNING
kobleTil();														// KOBLER TIL DATABASEN
$sqlSetning="SELECT * FROM bruker;";							// SQL-SPØRRING SOM SKAL KJØRES I DATABASEN
$sqlResultat=mysql_query($sqlSetning) or header('Location: ../404.php');  // SQL-SETNING, RETURNERER ERROR VED FEIL
kobleFra();														// KOBLER FRA DATABASEN
/*
 * Starter og lager tabel-strukturen på det som skal vises
 * Definerer thead,tbody og tfooter
 */
echo "<div id='header_cms'>";
print ("<h5>Registrerte Brukere </h5>");						// SKRIVER UT OVERSKRIFTEN
print ("<center><table width='80%' class='bottomBorder'>");  			// STARTEN PÅ TABELLEN SOM SKAL VISES
echo "</div>"; //AVSLUTTER header_cms
/*
 * <Thead> Hodet på tabellen vår, her står overskriften til tabellen
 */
print ("<thead>
		<tr>
		<th align=left>Bruker ID</th>
		<th align=left>Bruker Mail</th>
		<th align=left>Fornavn</th>
		<th align=left>Etternavn</th>
		<th align=left>Adresse</th>
		<th align=left></th>
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
			<td><a href='mailto:$rad[1]'> $rad[1] </a></td>
			<td> $rad[3] </td>
			<td> $rad[4] </td>
			<td> $rad[5] </td>
			<th align=left></th>
			<td><center><input type='checkbox' id='brukerInfo' name='brukerInfo[]' value='$rad[0]'></center> </td>
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
	$brukerInfo=$_POST["brukerInfo"];								// LESER ALL INFORMASJON SOM BLIR SENDT VIA SLETTEKNAPPEN
	$antall=count($brukerInfo);										// TELLER OPP ANTALL LINJER INFORMASJONEN  INNEHOLDER
	
	if($antall == 0){												// SJEKKER AT DET ER VALGT NOEN TABELL-RADER
		print("Ingen bruker(e) er valgt <br />");					// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLTIT VALGT
	} else {
		kobleTil();													// KOBLER TIL DATABASEN
		for($i=0; $i<$antall; $i++){								// BEHANDLER INFORMASJONEN DERSOM DET ER VALGT
			$del = explode(" ", $brukerInfo[$i]);					// SPLITTER OPP INFORMASJONS STRENGEN I DELER
			$brukerid = $del[0];
			$sqlSetning = "CALL slettBruker('$brukerid');";			// SLETTER DEN VALGTE KLASSEKODEN FRA DATABASEN KLASSE
			$sqlResultat = mysql_query($sqlSetning) or die(mysql_error());	// KJØRER SQLSETNINGEN OG RETURNERER ERROR VED FEIL			
		}
		kobleFra();													// KOBLER FRA DATABASEN
		$self=$_SERVER['PHP_SELF'];									// OPPDATERINGSKNAPP FOR Å KUNNE SE ENDRINGEN GJORT I TABELLEN

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

// /**
//  * STARTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN
//  *
//  * Denne funksjonen tar høyde for at det ved senere utvikling kan endres på flere
//  * brukere samtidig. Den har muligheten til å bytte ut radioInfo[] med brukerInfo[]
//  * så vil man kunne endre samtidlige admins samtidig.
//  *
//  * Det som mangler er en behandlingsfunksjon som skriver alle brukerene som blir endret
//  * til databasen.
//  *
//  */
 $endreKnapp = $_POST["endreKnapp"];								// DEFINERER ENDRE KNAPPEN
 if($endreKnapp){													// SJEKKER OM ENDRE KNAPPEN BLIR TRYKKET
	ob_end_clean();													// FJERNER TIDLIGERE TEKST
 	$radioInfo=$_POST ["radioInfo"];  								// VARIABLER GITT FRA VERDIENE I HTML-SKJEMA
	$antall=count($radioInfo);										// TELLER ANTALL RADER FRA HTML SKJEMA

 	if ($antall==0){												// SJEKKER AT DET ER VALGT NOEN TABELL-RADER
 		print ("Ingen medlemer er valgt for endring<br />");		// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLTIT VALGT
 	} else {

 		for($i=0; $i<$antall; $i++){
 			$del = explode(" ", $radioInfo[$i]);					// SPLITTER OPP INFORMASJONS STRENGEN I DELER	
 			$brukerid = $del[0];									// LAGRER BRUKERID I EN LOKAL VARIABEL
			kobleTil();												// KOBLER TIL DATABASEN
 			$sqlSetning="Select * From Bruker where Brukerid='$brukerid';"; // SQL-SETNINGEN SOM SKAL KJØRES PÅ SERVEREN
 			$sqlResultat=mysql_query($sqlSetning) or die(mysql_error()); // KJØRER SQL-SETNINGEN I DATABASEN
			$rad=mysql_fetch_array($sqlResultat);  					// LAGRER SQL-RESULTATET I ET ARRAY
			kobleFra();												// KOBLER FRA DATABASEN
			
			$brukerid =$rad[0];										// LAGRER BRUKERID FRA SQL-ARRAYET
			$mail=$rad[1];											// LAGRER MAIL FRA SQL-ARRAYET
			$fornavn = $rad[3];										// LAGRER FORNAVN FRA SQL-ARRAYET
			$etternavn = $rad[4];									// LAGRER ETTERNAVN FRA SQL-ARRAYET
 			$adresse = $rad[5];										// LAGRER ADRESSE FRA SQL-ARRAYET
 			$postNr = $rad[6];										// LAGRER POSTNR FRA SQL-ARRAYET
 			$tlf = $rad[7];											// LAGRER TLF FRA SQL-ARRAYET
			$mob = $rad[8];											// LAGRER MOB FRA SQL-ARRAYET
 			$url = $rad[9];											// LAGRER URL FRA SQL-ARRAYET
 			$selger = $rad[10];										// LAGRER SELGER FRA SQL-ARRAYET
 			$orgnr = $rad[11];										// LAGRER ORGNR FRA SQL-ARRAYET
 			$betal =$rad[12];										// LAGRER BETALT FRA SQL-ARRAYET
 			$aktiv =$rad[13];										// LAGRER AKTIV FRA SQL-ARRAYET

 			print ("<br />
					<form class='igeir_skjema' action='vis-medlem.php'
					enctype='multipart/form-data' method='post' name='igeir_skjema'
					id='igeir_skjema'>
					<input type='text' value='$brukerid' name='brukerid' id='brukerid' hidden='true'>
					<ul>
					<li>
					<h2>Endre medlem</h2> <span class='required_notification'>Alle felt
					må fylles ut</span>
					</li>
					<li><label for='mail'>Mail:</label> <input type='text'
					value='$mail' id='mail' name='mail' required />
					</li>
					</li>
					<li><label for='fornavn'>Fornavn:</label> <input type='text'
					value='$fornavn' id='fornavn' name='fornavn' required />
					</li>
					<li><label for='etternavn'>Etternavn:</label> <input type='text'
					value='$etternavn' id='etternavn' name='etternavn' required />
					</li>			
					<li><label for='adresse'>Adresse:</label> <input type='text'
					value='$adresse' id='adresse' name='adresse' required />
					</li>				
 					
					<li><label for='postNr'>Postnr:</label> <input type='text'
					value='$postNr' id='postNr' name='postNr' required />
					</li>
					<li><label for='tlf'>Tlf:</label> <input type='text'
					value='$tlf' id='tlf' name='tlf' required />
					</li>			
					<li><label for='mob'>Mob:</label> <input type='text'
					value='$mob' id='mob' name='mob' required />
					</li> 					

					<li><label for='url'>Url:</label> <input type='text'
					value='$url' id='url' name='url' />
					</li>
					<li><label for='selger'>Selger:</label> <input type='text'
					value='$selger' id='selger' name='selger' required />
					</li>			
					<li><label for='orgnr'>Org.nr:</label> <input type='text'
					value='$orgnr' id='orgnr' name='orgnr' />
					</li> 						
					
					<li><label for='betal'>Betalende medlem:</label> <input type='text'
					value='$betal' id='betal' name='betal' required />
					</li>			
					<li><label for='aktiv'>Aktiv:</label> <input type='text'
					value='$aktiv' id='aktiv' name='aktiv' required />
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

 $endreKnappen = $_POST["endreKnappen"];					// DEFINERER ENDRE KNAPP FOR KLASSE
 if($endreKnappen){											// SJEKKER OM ENDRE KNAPPEN ER TRYKKET
    
 			$brukerid =$_POST["brukerid"];					// HENTER INN BRUKERID FRA SKJEMAET
 			$mail=$_POST["mail"];							// HENTER INN MAIL FRA SKJEMAET
			$fornavn =$_POST["fornavn"];					// HENTER INN FORNAVN FRA SKJEMAET
			$etternavn =$_POST["etternavn"];				// HENTER INN ETTERNAVN FRA SKJEMAET
 			$adresse =$_POST["adresse"];					// HENTER INN ADRESSE FRA SKJEMAET
 			$postnr = $_POST["postNr"];						// HENTER INN POSTNR FRA SKJEMAET
 			$tlf = $_POST["tlf"];							// HENTER INN TLF FRA SKJEMAET
			$mob = $_POST["mob"];							// HENTER INN MOB FRA SKJEMAET
			$url = $_POST["url"];							// HENTER INN URL FRA SKJEMAET
			$selger = $_POST["selger"];						// HENTER INN SELGER FRA SKJEMAET
			$orgnr = $_POST["orgnr"];						// HENTER INN ORGNR FRA SKJEMAET
			$betal = $_POST["betal"];						// HENTER INN BETALT FRA SKJEMAET
			$aktiv = $_POST["aktiv"];
			
// 	/* variable gitt verdier fra feltene i HTML-skjemaet */
 	kobleTil();
 	$sqlSetning="CALL oppdaterBruker(
 	'$brukerid', 
 	'$mail',
 	'$fornavn',
 	'$etternavn',
 	'$adresse',
 	'$postnr',
 	'$tlf',
 	'$mob',
	'$url',
	'$selger',
	'$orgnr',
	'$betal',
	'$aktiv');";
 	mysql_query($sqlSetning) or die(mysql_error());					// KJØRER SQLSETNINGEN OG RETURNERER ERROR VED FEIL
 	kobleFra();
	
 	print("<meta http-equiv='refresh' content='0'> ");
 }

// /* SLUTTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN */
 include("../slutt.html");																	// INKLUDERER SISTE DEL AV DESIGNET
?>


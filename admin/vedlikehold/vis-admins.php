<?php 
/**
 * Vis-admins
 * 
 * Viser en liste som inneholder alle admins som er å finne
 * i admin databasen. Her får man mulighet til å endre eller slette admins
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
$title = '..VISER ALLE SOM ER SJEF..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");											// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN
ob_start();														// STARTPUNKT FOR TEKSTFJERNING
// kobleTil();														// KOBLER TIL DATABASEN
// $sqlSetning="CALL adminOversikt();";							// SQL-SETNING
// $sqlResultat=mysql_query($sqlSetning) or header('Location: ../404.php');  // KJØRER SQL-SETNINGEN PÅ SERVEREN, RETURNERER 404 PAGE VED ERROR
// kobleFra();														// KOBLER FRA DATABASEN
$sqlResultat = execute("CALL adminOversikt();");
/*
 * Starter og lager tabel-strukturen på det som skal vises
 * Definerer thead,tbody og tfooter
 */
print ("<h5>Registrerte admins </h5>");							// SKRIVER UT OVERSKRIFTEN
print ("<center><table width='80%' class='bottomBorder'>");  	// STARTEN PÅ TABELLEN SOM SKAL VISES

/*
 * <Thead> Hodet på tabellen vår, her står overskriften til tabellen
 */
print ("<thead>
		<tr>
		<th align=left>Id</th>
		<th align=left>Mail</th>
		<th align=left>Brukernavn</th>
		<th align=left>Tlf</th>
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
			<td> $rad[2] </td>
			<td> $rad[3] </td>
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
		print("Ingen admin(s) er valgt <br />");					// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLTIT VALGT
	} else {
		kobleTil();
		for($i=0; $i<$antall; $i++){								// BEHANDLER INFORMASJONEN DERSOM DET ER VALGT
			$del = explode(" ", $brukerInfo[$i]);					// SPLITTER OPP INFORMASJONS STRENGEN I DELER
			$adminId = $del[0];
			$sqlSetning = "CALL adminSlettAdmin('$adminId');";				// SLETTER DEN VALGTE KLASSEKODEN FRA DATABASEN KLASSE
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

/**
 * STARTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN
 *
 * Denne funksjonen tar høyde for at det ved senere utvikling kan endres på flere
 * brukere samtidig. Den har muligheten til å bytte ut radioInfo[] med brukerInfo[]
 * så vil man kunne endre samtidlige admins samtidig.
 *
 * Det som mangler er en behandlingsfunksjon som skriver alle brukerene som blir endret
 * til databasen.
 *
 */
$endreKnapp = $_POST["endreKnapp"];									// DEFINERER ENDRE KNAPPEN
if($endreKnapp){													// SJEKKER OM ENDRE KNAPPEN BLIR TRYKKET
	ob_end_clean();													// FJERNER ALL TIDLIGERE TEKST
	$radioInfo=$_POST ["radioInfo"];  								// VARIABLER GITT FRA VERDIENE I HTML-SKJEMA
	$antall=count($radioInfo);										// TELLER ANTALL RADER FRA HTML SKJEMA

	if ($antall==0){												// SJEKKER AT DET ER VALGT NOEN TABELL-RADER
		print ("Ingen nyhet er valgt for endring<br />");			// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLTIT VALGT
	} else {

		for($i=0; $i<$antall; $i++){
			$del = explode(" ", $radioInfo[$i]);					// SPLITTER OPP INFORMASJONS STRENGEN I DELER	
			$adminId = $del[0];										// SETTER EN LOKALVARIABEL 
			kobleTil();												// KOBLER TIL DATABASEN
			$sqlSetning="CALL adminHentEnAdmin('$adminId');";		// SQL-SETNING			
			$sqlResultat=mysql_query($sqlSetning) or die(mysql_error()); // KJØRER SQL-SETNINGEN PÅ DB SERVER
			$rad=mysql_fetch_array($sqlResultat);  					// HENTER UT ARRAYET FRA RESULTATET
			kobleFra();												// KOBLER FRA DATBASEN
			
			$fornavn = $rad[0];										// HENTER UT FORNAVN FRA SQL-ARRAYET
			$etternavn = $rad[1];									// HENTER UT ETTERNAVN FRA SQL-ARRAYET
			$mail = $rad[2];										// HENTER UT MAIL FRA SQL-ARRAYET
			$adresse = $rad[3];										// HENTER UT ADRESSE FRA SQL-ARRAYET
			$tlf = $rad[4];											// HENTER UT TLF FRA SQL-ARRAYET
			$mob = $rad[5];											// HENTER UT MOB FRA SQL-ARRAYET
			$postNr = $rad[6];										// HENTER UT POSTNR FRA SQL-ARRAYET
			$brukernavn = $rad[7];									// HENTER UT BRUKERNAVN FRA SQL-ARRAYET

			print ("
					<br />
					<form class='igeir_skjema' action=''
					enctype='multipart/form-data' method='post' name='igeir_skjema'
					id='igeir_skjema'>
					<input type='text' value='$adminId' name='adminId' id='adminId' hidden='true'>
					<ul>
					<li>
					<h2>Endre medlem</h2> <span class='required_notification'>Alle felt
					må fylles ut</span>
					</li>
					<li><label for='brukernavn'>Brukernavn:</label> <input type='text'
					value='$brukernavn' id='brukernavn' name='brukernavn' required />
					</li>
					</li>
					<li><label for='mail'>Mail:</label> <input type='email'
					value='$mail' id='mail' name='mail' required />
					</li>
					<li><label for='fornavn'>Fornavn:</label> <input type='text'
					value='$fornavn' id='fornavn' name='fornavn' required />
					</li>
					<li><label for='etternavn'>Etternavn:</label> <input type='text'
					value='$etternavn' id='etternavn' name='etternavn' required />
					</li>			
					<li><label for='adresse'>Adresse:</label> <input type='text'
					value='$adresse' id='adresse' name='adresse' />
					</li>				
 					
					<li><label for='postNr'>Postnr:</label> <input type='text'
					value='$postNr' id='postNr' name='postNr' required />
					</li>
					<li><label for='tlf'>Tlf:</label> <input type='text'
					value='$tlf' id='tlf' name='tlf' />
					</li>			
					<li><label for='mob'>Mob:</label> <input type='text'
					value='$mob' id='mob' name='mob' required />
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

$endreKnappen = $_POST["endreKnappen"];								// DEFINERER ENDRE KNAPP FOR KLASSE
if($endreKnappen){													// SJEKKER OM ENDRE KNAPPEN ER TRYKKET
    
	$adminId=$_POST["adminId"];										// HENTER INN ADMIN ID FRA SKJEMAET
	$fornavn = $_POST["fornavn"];									// HENTER INN FORNAVN FRA SKJEMAET
	$etternavn = $_POST["etternavn"];								// HENTER INN ETTERNAVN FRA SKJEMAET
	$mail = $_POST["mail"];											// HENTER INN MAIL FRA SKJEMAET
	$adresse = $_POST["adresse"];									// HENTER INN ADRESSE FRA SKJEMAET
	$tlf = $_POST["tlf"];											// HENTER INN TLF FRA SKJEMAET
	$mob = $_POST["mob"];											// HENTER INN MOB FRA SKJEMAET
	$postNr = $_POST["postNr"];										// HENTER INN POSTNR FRA SKJEMAET
	$brukernavn = $_POST["brukernavn"];								// HENTER INN BRUKERNAVN FRA SKJEMAET
	
	/* variable gitt verdier fra feltene i HTML-skjemaet */
	kobleTil();														// KOBLER TIL DATABASEN
	$sqlSetning="CALL adminOppdaterEnAdmin(
	'$adminId',
	'$fornavn',
	'$etternavn',
	'$mail',
	'$adresse',
	'$tlf',
	'$mob',
	'$postNr',
	'$brukernavn'
	);";															// SQL-SETNINGEN
	mysql_query($sqlSetning) or die(mysql_error());					// KJØRER SQL-SETNINGEN OG RETURNERER ERROR VED FEIL
	kobleFra();														// KOBLER FRA DATABASEN
	
	$self=$_SERVER['PHP_SELF'];										// OPPDATERINGS KNAPP FOR Å KUNNE OPPDATERE INFORMASJONEN SOM ER SKREVET
 	print("<meta http-equiv='refresh' content='0'> ");
}

/* SLUTTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN */
include("../slutt.html");																	// INKLUDERER SISTE DEL AV DESIGNET
?>

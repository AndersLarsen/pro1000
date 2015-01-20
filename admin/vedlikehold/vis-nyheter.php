<?php 
/**
 * Vis-nyheter
 * 
 * Viser admin nyheter i en tabell, her får man mulighet til å slette eller endre
 * en nyhet som ligger i databasen
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
$title = '..VISER ALLE NYHETER..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");											// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN
ob_start();														// STARTPUNKT FOR TEKSTFJERNING

kobleTil();														// KOBLER TIL DATABASEN
$sqlSetning="CALL adminNyheterOversikt();";						// SQL-SETNING
$sqlResultat=mysql_query($sqlSetning) or header('Location: .../404.php');  // KJØRER SQL-SETNINGEN I DATABASEN, RETURNERER 404SIDE HVIS DEN FEILER
kobleFra();														// KOBLER FRA DATABASEN
/*
 * Starter og lager tabel-strukturen på det som skal vises
 * Definerer thead,tbody og tfooter
 */
print ("<h5>Registrerte nyheter </h5>");						// SKRIVER UT OVERSKRIFTEN
print ("<center><table width='80%' class='bottomBorder'>");  	// STARTEN PÅ TABELLEN SOM SKAL VISES

/*
 * <Thead> Hodet på tabellen vår, her står overskriften til tabellen
 */
print ("<thead>
		<tr>
		<th align=left>Id</th>
		<th align=left>Overskrift</th>
		<th align=left>Skrevet av</th>
		<th align=left>Lagt ut</th>
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
			<td> $rad[0] </td>
			<td> $rad[1] </td>
			<td> $rad[2] </td>
			<td> $rad[3] </td>
			<td><center><input type='checkbox' id='brukerInfo' name='brukerInfo[]' value='$rad[0]'></center> </td>
			<td><center><input type='radio' id='radioInfo' name='radioInfo[]' value='$rad[0] $rad[1] $rad[2] $rad[3]'></center> </td>
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
 *  Denne funksjonen sletter alle ID'er.
 *  Disse må merkes med checkboxen som er laget i skjemaet.
 *  Denne funksjonen kan ikke angres.
 *  
 */

$sletteKnapp = $_POST["sletteKnapp"];								// DEFINERER SLETTEKNAPPEN
if($sletteKnapp){													// SJEKKER OM SLETTEKNAPPEN ER BLITT TRYKKET
	$brukerInfo=$_POST["brukerInfo"];								// LESER ALL INFORMASJON SOM BLIR SENDT VIA SLETTEKNAPPEN
	$antall=count($brukerInfo);										// TELLER OPP ANTALL LINJER INFORMASJONEN  INNEHOLDER
	
	if($antall == 0){												// SJEKKER AT DET ER VALGT NOEN TABELL-RADER
		print("Ingen nyheter(r) er valgt <br />");					// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLTIT VALGT
	} else {
		kobleTil();													// KOBLER TIL DATABASEN
		for($i=0; $i<$antall; $i++){								// BEHANDLER INFORMASJONEN DERSOM DET ER VALGT
			$del = explode(" ", $brukerInfo[$i]);					// SPLITTER OPP INFORMASJONS STRENGEN I DELER
			$nyhetsId = $del[0];									// HENTER INN NYHETSID
			$sqlSetning = "CALL slettNyhet('$nyhetsId');";	// SLETTER DEN VALGTE KLASSEKODEN FRA DATABASEN KLASSE
			$sqlResultat = mysql_query($sqlSetning) or die(mysql_error());	// KJØRER SQLSETNINGEN OG RETURNERER ERROR VED FEIL

		}
		kobleFra();													// KOBLER FRA DATABASEN
				$self=$_SERVER['PHP_SELF'];							// OPPDATERINGSKNAPP FOR Å KUNNE SE ENDRINGEN GJORT I TABELLEN

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
	$radioInfo=$_POST ["radioInfo"];  								// VARIABLER GITT FRA VERDIENE I HTML-SKJEMA
	$antall=count($radioInfo);										// TELLER ANTALL RADER FRA HTML SKJEMA

	if ($antall==0){												// SJEKKER AT DET ER VALGT NOEN TABELL-RADER
		print ("Ingen nyhet er valgt for endring<br />");			// RETURNERER FEILMELDING HVIS INGEN TABELL-RADER ER BLITT VALGT
	} else {
		kobleTil();													// KOBLER TIL DATABASEN
		for($i=0; $i<$antall; $i++){
			$del = explode(" ", $radioInfo[$i]);					// SPLITTER OPP INFORMASJONS STRENGEN I DELER	
			$nyhetsId = $del[0];
	
			$sqlSetning="CALL hentEnNyhet('$nyhetsId');";					
			$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());  					
			$rad=mysql_fetch_array($sqlResultat);  												
			
			$nyhetsId = $rad[0];
			$overskrift = $rad[1];
			$ingress = $rad[2];
			$hovedtekst = $rad[3];
		}
			print("
<form class='igeir_skjema' action='vis-nyheter.php'
	enctype='multipart/form-data' method='post' name='igeir_skjema'
	id='igeir_skjema'>
					<input type='text' value='$nyhetsId' name='nyhetsId' id='nyhetsId' hidden='true'><br />
	<ul>
		<li>
			<h2>Endre nyheten</h2> <span class='required_notification'>Alle felt
				må fylles ut</span>
		</li>
		<li><label for='overskrift'>Overskrift:</label> <input type='text'
			value='$overskrift' id='overskrift' name='overskrift' required />
		</li>
		<li><label for='ingress'>Ingress:</label> <textarea rows='10'
				cols='50' id='ingress' name='ingress' required />$ingress</textarea>
		</li>
		<li><label for='hovedtekst'>Hovedtekst:</label> <textarea rows='20'
				cols='50' id='hovedtekst' name='hovedtekst'
				required />$hovedtekst</textarea>
		</li>
		<li><input type='submit' value='Endre Nyhet' id='endrenKnapp'
			name='endrenKnapp' class='submit' />
		</li>
	</ul>
</form>
<br />
					");
	
		kobleFra();											// KOBLER FRA DATABASEN
	}
}

$endrenKnapp = $_POST["endrenKnapp"];						// DEFINERER ENDRE KNAPP 
if($endrenKnapp){											// SJEKKER OM ENDRE KNAPPEN ER TRYKKET
    
	$nyhetsId=$_POST["nyhetsId"];							// HENTER INN NYHETSID FRA SKJEMA
	$overskrift=mysql_real_escape_string($_POST["overskrift"]);						// HENTER INN OVERSKRIFT FRA SKJEMA
	$ingress=mysql_real_escape_string($_POST["ingress"]);								// HENTER INN INGRESS FRA SKJEMA
	$hovedtekst=mysql_real_escape_string($_POST["hovedtekst"]);						// HENTER INN HOVEDTEKST FRA SKJEMA
	
	/* variable gitt verdier fra feltene i HTML-skjemaet */
	kobleTil();												// KOBLER TIL DATABASEN
	$sqlSetning="CALL oppdaterNyhet('$nyhetsId','$overskrift','$ingress','$hovedtekst');"; // SQL-SETNING
	mysql_query($sqlSetning) or die(mysql_error());					// KJØRER SQL-SETNINGEN OG RETURNERER ERROR VED FEIL
	kobleFra();												// KOBLER FRA DATABASEN
	
	$self=$_SERVER['PHP_SELF'];										// OPPDATERINGS KNAPP FOR Å KUNNE OPPDATERE INFORMASJONEN SOM ER SKREVET
 	print("<meta http-equiv='refresh' content='0'> ");
}

/* SLUTTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN */
include("../slutt.html");																	// INKLUDERER SISTE DEL AV DESIGNET
?>

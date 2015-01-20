<?php
/**
 * endrer produkt , beskrivelse og laste opp flere bilder.
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
 * @author		Original Author <gjermundwedvik@gmail.com>
 * @copyright 	2013-2018
 * @license		http://www.php.net/license/3_01.txt
 * @link		http://student.hive.no/pro10005/1
 *
 */
$title = '..Oppdater produktet ditt..'; // 	LEGGER TIL TITEL PÅ SIDEN.
include("header.php"); 
sjekklogin();								//INKLUDERER HEADER OG SJKKER AT MAN ER LOGGET INN ?>

<div id="content3" class="clearfix">
	<div id="fontstyle">





<div id='editUserInfo2'class'clearfix'>

<?php 	

$brukerId=$_SESSION['id'];																// HENTER ID PA… SESSION

$showinterest=$_POST["showinterest"];				// HENTER INN EN INPUT KNAPP FRA SKJEMAET
$igeirkode = $_POST["igeirkode"];							// LAGRER BRUKERID FRA SKJEMAET

// VISER ALLE ANONSENE TIL BRUKERE P√Ö SI SIDE
kobleTil();													// KOBLER TIL DATABASEN
$sqlSetning="SELECT  interesserte.IgeirKode,
interesserte.BrukerId,
interesserte.Dato,
bruker.BrukerMail,
bruker.BrukerId
From interesserte
Natural JOIN bruker  Where  interesserte.IgeirKode='$igeirkode' ;";

$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
$antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
kobleFra();														//KOBLER FRA DATABASEN
print ("<h2> Interesserte  </h2><br>");						// SKRIVER UT OVERSKRIFTEN
print ("<table width='100%' class=''>");  			// STARTEN PÅ TABELLEN SOM SKAL VISES
echo "</div>"; //AVSLUTTER header_cms
/*
 * <Thead> Hodet på tabellen vår, her står overskriften til tabellen
*/
print ("<thead>
		<tr>
		<th align=left>Igerikode </th>
		<th align=left>Bruker Mail</th>
		<th align=left>BrukerID</th>
		<th align=left>Dato</th>
		<th align=left></th>
		<th align=left></th>
		<th align=left></th>
		<th align=left></th>

		</tr>
		</thead>");
echo("<form method='post' action='' >");
		for ($r=1;$r<=$antallRader;$r++){
		$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPÔøΩRRINGSRESULTATET

		$intIgeirKode=$rad[0];
		$intBrukerId=$rad[1];
		$intDato=$rad[2];
		$intbrukerMail=$rad[3];
		$intBrukerId=$rad[4];


		print ("<tbody>
				<tr>
				<td> $intIgeirKode </td>
				<td><a href='mailto:$intbrukerMail'>$intbrukerMail  </a></td>
				<td> $intBrukerId </td>
				<td>$intDato  </td>
				<td> </td>
				<th align=left></th>
				<td><center><input type='checkbox' id='brukerInfo' name='brukerInfo[]' value='$rad[0]'></center> </td>
				<td><center> </td>
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
		<th align=center></form></th>
		

		</tr>
		</tfoot>");

 print ("</table><br />");  

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
			$sqlSetning = "DELETE FROM interesserte where IgeirKode='$intIgeirKode';";			// SLETTER DEN VALGTE KLASSEKODEN FRA DATABASEN KLASSE
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
}												// SLUTTEN PÅ TABELLEN
 ?>
</div>



</div> <!-- avslutter fontstyle -->
</div> <!-- avslutter content2 -->

<?php include("footer.php")?>
<?php 
/**
 * Skift Passord
 * 
 * Denne fila tillater at en admin får skiftet andre admins passord.
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
$title = '..ENDRE PASSORD..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");											// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN
ob_start();														// SETTER STARTPUNKT FOR TEKSTFJERNING

echo "<br />"; ?>

		<form class='igeir_skjema' action='' enctype='multipart/form-data' method='post' name='igeir_skjema' id='igeir_skjema'">
<?php 
echo "	<ul>
		<li>
		<h2> Skift Passord </h2>
		<span class='required_notification'>Alle felt må fylles ut</span>
		</li>
		<li>
		<label for='brukernavn'>BrukerID:</label>
        <input type='text' placeholder='BrukerId' id='brukerid' name='brukerid' min='9' max='9' required />
		 ";

for ($r=1;$r<=$antallRader;$r++){								// FOR-LØKKE SOM KJØRER LIKE MANGE GANGER SOM DEN FINNER RADER I DATABASE RESULTATET
	$rad=mysql_fetch_array($sqlResultat); 						// HENTER EN ANGITT RAD FRA DATABASEN
	print("<option name='id' id='id' value='$rad[1]'>$rad[0]</option>");  // LISTER UT EN ANGITT ADMIN FRA DATABASEN
}
 	
echo "</li>";
echo "
        <li>
        	<input type='submit' id='sokKnapp' name='sokKnapp' value='Søk opp bruker' class='submit' />
        </li>
    </ul>
</form><br />
";

$sokKnapp = $_POST["sokKnapp"];									// DEFINERER ENDREKNAPP
if($sokKnapp){														// SJEKKER OM ENDRE KNAPPEN ER TRYKKET
	$brukerID	= $_POST["brukerid"];
	
	kobleTil();														// KOBLER TIL DATABASEN
	$sqlSetning="
			SELECT BrukerId, BrukerMail, BrukerFornavn, BrukerEtternavn, BrukerMob
			FROM bruker
			WHERE ((BrukerId LIKE '%$brukerID%') OR (BrukerMail LIKE '%$brukerID%'))
			";							// LAGRER SQL SPØRRINGEN I EN VARIABEL
	$sqlResultat=mysql_query($sqlSetning) or die ("ikke mulig å hente data fra databasen");  // KJØRER SQLSETNINGEN I DATABASEN
	$antallRader=mysql_num_rows($sqlResultat);						// HENTER ANTALL RADER FRA SVARET
	kobleFra();														// KOBLER FRA DATABASEN
}

if($antallRader != NULL) {
	print ("<h5>Registrerte Brukere </h5>");						// SKRIVER UT OVERSKRIFTEN
	print ("<center><table width='80%' class='bottomBorder'>");  			// STARTEN PÅ TABELLEN SOM SKAL VISES
	
	/*
	 * <Thead> Hodet på tabellen vår, her står overskriften til tabellen
	*/
	print ("<thead>
		<tr>
		<th align=left>BrukerID</th>
		<th align=left>BrukerMail</th>
		<th align=left>Fornavn</th>
		<th align=left>Etternavn</th>
		<th align=left>Mobil</th>
		<th align=left></th>
		<th align=left></th>
		<th align=left></th>
	
		</tr>
		</thead>");
	
	echo("<form method='post' action='' >");	
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
				<td> $rad[4] </td>
				<th align=left></th>
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
		<th align=center><input type='submit' id='endreKnapp' name='endreKnapp' value='Endre' class='input'></form></th>
			
		</tr>
		</tfoot>");
	
	print ("</table></center><br />");  												// SLUTTEN PÅ TABELLEN
	
}

$endreKnapp = $_POST["endreKnapp"];									// DEFINERER ENDREKNAPP
if($endreKnapp){													// SJEKKER OM ENDRE KNAPPEN ER TRYKKET
	ob_end_clean();													// FJERNER TIDLIGERE TEKST
	$radioInfo=$_POST["radioInfo"];  								// VARIABLER GITT FRA VERDIENE I HTML-SKJEMA
	$del = explode(" ", $radioInfo[0]);					// SPLITTER OPP INFORMASJONS STRENGEN I DELER
	$brukerID = $del[0];
	
	echo "<br />
		<p class='counter'>
		Brukeren som skal få endret sitt passord er $brukerID<br />
		</p>";
		?>

		<form class='igeir_skjema' action='' enctype='multipart/form-data' method='post' name='igeir_skjema' id='igeir_skjema' 
		onSubmit="return confirm('Sikker på at du vil endre passord?');">
<?php 
echo "
		<ul>
		<li>
		<h2> Skift Passord </h2>
		<span class='required_notification'>Alle felt må fylles ut</span>
		</li>
		<li>
		<label for='passord'>Passord:</label>
        <input type='text' placeholder='Passord' id='passord' name='passord' required />
		<input type='hidden' value='$brukerID' id='brukerID' name='brukerID' /> 
		";
	echo "</li>";
	echo "
        <li>
        	<input type='submit' id='endrePassord' name='endrePassord' value='Endre Passord' class='submit' />
        </li>
    </ul>
</form><br />
";
}

$endrePassord = $_POST["endrePassord"];
if($endrePassord){
	$passord=$_POST["passord"];										// HENTER PASSORD I KLARTEKST FRA SKJEMAET
	$brukerID=$_POST["brukerID"];
	if(!$passord) {														// HVIS PASSORD FELTET ER TOMT
		echo "<h2>Du må skrive inn et passord</h2>";
	} else {
		$passordClean=$passord;
		$passord=krypterPassord($passord);									// KRYPTERER PASSORDET
		kobleTil();															// KOBLE TIL SQL
		$sqlSetning="UPDATE bruker SET BrukerPassord='$passord' WHERE BrukerId='$brukerID';";			// CALLBACK TIL DATABASEN
		mysql_query($sqlSetning) or die(mysql_error());						// KJØRER SQLSETNINGEN OG RETURNERER ERROR VED FEIL
		kobleFra();															// KOBLE FRA SQL
		echo "<h2>Passordet ditt er blitt endret til '$passordClean'</h2>";
	}
}
/* SLUTTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN */
include("../slutt.html");																	// INKLUDERER SISTE DEL AV DESIGNET
?>

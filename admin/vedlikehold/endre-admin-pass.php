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
	
kobleTil();														// KOBLER TIL DATABASEN
$sqlSetning="CALL adminPrivInfo();";							// LAGRER SQL SPØRRINGEN I EN VARIABEL
$sqlResultat=mysql_query($sqlSetning) or header('Location: ../404.php');  // KJØRER SQL-SETNINGEN PÅ SERVEREN, RETURNERER 404 PAGE VED ERROR
$antallRader=mysql_num_rows($sqlResultat);						// HENTER ANTALL RADER FRA SVARET
kobleFra();														// KOBLER FRA DATABASEN

$minId=$_SESSION['adminId'];									// LAGRER ADMINEN SIN ID I EN VARIABEL

echo "<br />"; ?>

		<form class='igeir_skjema' action='endre-admin-pass.php' enctype='multipart/form-data' method='post' name='igeir_skjema' id='igeir_skjema' 
		onSubmit="return confirm('Sikker på at du vil endre passord?');">
<?php 
echo "	<ul>
		<li>
		<h2> Skift Passord </h2>
		<span class='required_notification'>Alle felt må fylles ut</span>
		</li>
		<li>
		<label for='brukernavn'>Brukernavn:</label>
		<select name='id' id='id'>
		<option></option> ";

for ($r=1;$r<=$antallRader;$r++){								// FOR-LØKKE SOM KJØRER LIKE MANGE GANGER SOM DEN FINNER RADER I DATABASE RESULTATET
	$rad=mysql_fetch_array($sqlResultat); 						// HENTER EN ANGITT RAD FRA DATABASEN
	print("<option name='id' id='id' value='$rad[1]'>$rad[0]</option>");  // LISTER UT EN ANGITT ADMIN FRA DATABASEN
}

echo "</select></li>";
echo "<li>
            <label for='passord'>Passord:</label>
            <input type='password' placeholder='Passord' id='passord' name='passord' required />
        </li>
        <li>
        	<input type='submit' id='endreKnapp' name='endreKnapp' value='Oppdater Passord' class='submit' />
        </li>
    </ul>
</form><br />
";

$endreKnapp = $_POST["endreKnapp"];									// DEFINERER ENDREKNAPP
if($endreKnapp){														// SJEKKER OM ENDRE KNAPPEN ER TRYKKET
	$passord=$_POST["passord"];
	$adminId=$_POST["id"];
	$admin=$_SESSION['adminBruker'];
	

	
	if(!$adminId) {														// HVIS PASSORD FELTET ER TOMT
		echo "<h2>Du må velge en admin</h2>";
	} else {
		kobleTil();														// KOBLER TIL DATABASEN
		$sqlSetning="CALL adminHentMail('$adminId');";					// LAGRER SQL SPØRRINGEN I EN LOKAL VARIABEL
		$sqlResultat=mysql_query($sqlSetning) or die ("ikke mulig å hente data fra databasen");  // KJØRER SQL SPØRRINGEN I DATABASEN
		$rad=mysql_fetch_array($sqlResultat);							// HENTER RAD FRA DATABASEN		
		$too = $rad[0];													// LAGRER HVEM MAN SKAL SENDE MAIL TIL
		kobleFra();														// KOBLER FRA DATABASEN	
		
		$subject = "Endret Passord";									// SKRIVER OVERSKRIFT I MAIL 
		$message = "Hallo! Passordet ditt er nettopp blitt endret til $passord av $admin"; // SKRIVER MAILEN SOM SKAL BLI SENDT
		$from = "doNotRespond@igeir.no";								// BESTEMMER HVEM AVSENDER VI BRUKER
		$headers = "From: " . $from;									// SKRIVER TITTEL PÅ MAILEN
		mail($too,$subject,$message,$headers);							// SENDER AVGÅRDE MAILEN
		
		$passord=krypterPassord($passord);									// KRYPTERER PASSORDET
		kobleTil();															// KOBLE TIL SQL
		$sqlSetning="CALL adminPassord('$adminId','$passord');";			// CALLBACK TIL DATABASEN
		mysql_query($sqlSetning) or die(mysql_error());						// KJØRER SQLSETNINGEN OG RETURNERER ERROR VED FEIL
		kobleFra();															// KOBLE FRA SQL
		echo "<h2>Passordet ditt er blitt endret</h2>";
	}
}

/* SLUTTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN */
include("../slutt.html");																	// INKLUDERER SISTE DEL AV DESIGNET
?>

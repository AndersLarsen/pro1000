<?php 
/**
 * Skift Passord
 * 
 * Denne fila tillater at en admin får skiftet sitt eget passord.
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

$minId=$_SESSION['adminId'];									// LAGRER ADMIN ID I EN LOKAL VARIABEL

echo "<br />"; ?>

		<form class='igeir_skjema' action='' enctype='multipart/form-data' method='post' name='igeir_skjema' id='igeir_skjema' 
		onSubmit="return confirm('Sikker på at du vil endre passord?');">
<?php 
echo "	<ul>
        <li>
             <h2> Skift Passord </h2>
             <span class='required_notification'>Alle felt må fylles ut</span>
        </li>
        <li>
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
if($endreKnapp){													// SJEKKER OM ENDRE KNAPPEN ER TRYKKET
	$passord=$_POST["passord"];										// HENTER PASSORD I KLARTEKST FRA SKJEMAET
	if(!$passord) {														// HVIS PASSORD FELTET ER TOMT
		echo "<h2>Du må skrive inn et passord</h2>";
	} else {
		$passord=krypterPassord($passord);									// KRYPTERER PASSORDET
		kobleTil();															// KOBLE TIL SQL
		$sqlSetning="CALL adminPassord('$minId','$passord');";			// CALLBACK TIL DATABASEN
		mysql_query($sqlSetning) or die(mysql_error());						// KJØRER SQLSETNINGEN OG RETURNERER ERROR VED FEIL
		kobleFra();															// KOBLE FRA SQL
		echo "<h2>Passordet ditt er blitt endret</h2>";
	}
}

/* SLUTTEN PÅ ENDRE FUNKSJONEN MOT DATABASEN */
include("../slutt.html");																	// INKLUDERER SISTE DEL AV DESIGNET
?>

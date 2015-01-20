<?php
/**
 * Nyheter
 * Her skrives ut alle nyheten som er blitt lagret i cms'et slik at
 * brukerene holdes informerte
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
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
if($_SESSION['innlogget'] == true) {							// SJEKKER OM EN BRUKER ER INNLOGGET
// include("downcounter.php");										// INKLUDERER DOWNCOUNTER
kobleTil();														// KOBLER TIL DATABASEN
$sqlSetning="SELECT Overskrift,Ingress,Hovedtekst FROM nyheter ORDER BY NyheterId DESC;"; // SQL SPØRRING
$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());  	// KJØRER SQL SPØRRING I DATABASEN
$antallRader=mysql_num_rows($sqlResultat); 						// ANTALL RADER I RESULTATET AV MYSQL KALLET
kobleFra();														// KOBLER FRA DATABASEN

echo "<br /><div id='nyheter'><form>";							// SKRIVER UT STARTEN PÅ SKJEMAET
for ($r=1;$r<=$antallRader;$r++){								// FOR-LØKKE FOR HVER LINJE FRA NYHETSTABELLEN
	$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPØRRINGSRESULTATET
	echo "<fieldset>";											// SKRIVER UT SKJEMAET
	echo "<legend>$rad[0]</legend>";							// SKRIVER UT SKJEMAET								
	echo "<i>$rad[1]</i>";										// SKRIVER UT SKJEMAET
	echo "<p>$rad[2]</p>";										// SKRIVER UT SKJEMAET
	echo "</fieldset>";											// SKRIVER UT SKJEMAET
}
echo "</form></div>";											// SLUTTEN PÅ SKJEMAET
echo "<br />";													// LAGER ET MELLOMROM ETTER SKJEMAET
}
?>
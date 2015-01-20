<?php
/**
 * Status
 *
 * Server Status, viser hvilke servere som siden er koblet
 * opp imot og hvordan database statusen ser ut. Her kan vi se
 * hvor lenge database serveren har vært oppe, hvor mange admins,
 * brukere,annonser og nyheter som finnes i de respektive databasene.
 * Samt hvor mange tabeller hver database inneholder.
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
$title = '..VISER STATUS..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include ("start.php");																// INKLUDERER HEADER
sjekkLogin();																		// SJEKKER OM EN BRUKER ER LOGGET INN

echo "<br /><div id='nyheter'><form>
			<fieldset>
			<legend>is.hive.no</legend>";

echo "Status: ";
if(statusMainServer()) {															// SJEKKER OM SERVEREN ER ONLINE/OFFLINE
	echo "ONLINE";
} else {
	echo "OFFLINE";
}

$init = uptimeMainServer();															// HENTER UT UPTIME I SEKUNDER
$hours = floor($init / 3600 );														// HENTER UT ANTALL TIMER FRA SEKUNDER
$minutes = floor(($init / 60) % 60);												// HENTER UT ANTALL MINUTTER FRA SEKUNDER
$seconds = $init % 60;																// HENTER UT DE RESTERENDE SEKUNDENE

echo "<br />Uptime: $hours time(r) $minutes minutt(er) $seconds sekund(er) <br />";	// SKRIVER UT TIMER,MINUTTER OG SEKUNDER I LESBAR TEKST

kobleTilMain();																		// KOBLER TIL HOVED DB SERVER
$sql = "SELECT
		(SELECT COUNT(adminId) FROM admin ) AS antAdmins,
		(SELECT COUNT(BrukerId) FROM bruker ) AS antBrukere,
		(SELECT COUNT(Teller) FROM igeir ) AS antAnnonser,
		(SELECT COUNT(NyheterId) FROM nyheter ) AS antNyheter,
		(SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'pro10005' ) AS antTabeller;";	// SQL SETNING SOM SKAL KJØRES PÅ SERVEREN
$resultat = mysql_query($sql); 														// KJØRER SQL SETNINGEN PÅ SERVEREN
$rad=mysql_fetch_row($resultat);													// HENTER UT EN RAD FRA RESULTATET AV SQL KJØRINGEN
kobleFra();																			// KOBLER FRA DATABASEN
if($rad == 0) {
	echo "Ingen rader funnet i databasen";
} else {
echo "	Antall Admins: $rad[0]<br />
		Antall Brukere: $rad[1]<br />
		Antall Annonser: $rad[2]<br />
		Antall Nyheter: $rad[3]<br />
		Antall Tabeller: $rad[4]<br />";
}
echo "	</fieldset>
		</form></div>";

echo "<div id='nyheter'><form>
		<fieldset>
		<legend>backup.marensius.no</legend>";

echo "Status: ";
if(statusBackupServer()) {															// SJEKKER OM BACKUP SERVEREN ER ONLINE/OFFLINE
	echo "ONLINE";
} else {
	echo "OFFLINE";
}

$init = uptimeBackupServer();														// HENTER UT UPTIME I SEKUNDER
$hours = floor($init / 3600 );														// HENTER UT ANTALL TIMER FRA SEKUNDER
$minutes = floor(($init / 60) % 60);												// HENTER UT ANTALL MINUTTER FRA SEKUNDER
$seconds = $init % 60;																// HENTER UT DE RESTERENDE SEKUNDENE

echo "<br />Uptime: $hours time(r) $minutes minutt(er) $seconds sekund(er) <br />";	// SKRIVER UT TIMER,MINUTTER OG SEKUNDER I LESBAR TEKST

kobleTilBackup();																		// KOBLER TIL BACKUP DB SERVER
$sql = "SELECT
		(SELECT COUNT(adminId) FROM admin ) AS antAdmins,
		(SELECT COUNT(BrukerId) FROM bruker ) AS antBrukere,
		(SELECT COUNT(Teller) FROM igeir ) AS antAnnonser,
		(SELECT COUNT(NyheterId) FROM nyheter ) AS antNyheter,
		(SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'pro10005' ) AS antTabeller;"; // SQL SETNING SOM SKAL KJØRES PÅ SERVEREN
$resultat = mysql_query($sql);														// KJØRER SQL SETNINGEN PÅ SERVEREN
$rad=mysql_fetch_row($resultat);													// HENTER UT EN RAD FRA SQL RESULTATET
kobleFra();																			// KOBLER FRA DATABASEN

if($rad == 0) {
	echo "Ingen rader funnet i databasen";
} else {
echo " Antall Admins: $rad[0]<br />
		Antall Brukere: $rad[1]<br />
		Antall Annonser: $rad[2]<br />
		Antall Nyheter: $rad[3]<br />
		Antall Tabeller: $rad[4]<br />";
}
echo "</fieldset>
		</form></div>
		<br />";

include("../slutt.html");															// INKLUDERER FOOTEREN


?>
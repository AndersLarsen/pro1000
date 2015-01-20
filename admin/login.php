<?php 
/**
 * Login biten til backend
 * Her har admins mulighet til å logge inn for å kunne ha kontroll
 * over dataene som ligger på igeir og alle dens brukere
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
$title = '..LOGG INN..'; // 	LEGGER TIL TITEL PÅ SIDEN.

if (isset($_POST['loginKnapp'])) {
	kobleTil();																// KOBLER TIL DATABASEN
	$brukernavn=mysql_real_escape_string($_POST['brukernavn']);				// FJERNER SPESIALTEGN SÅ MAN IKKE KAN LURE SQL OG LAGRER BRUKERNAVNET I EN VARIABEL
	$passord=mysql_real_escape_string(krypterPassord($_POST['passord']));	// FJERNER SPESIALTEGN SÅ MAN IKKE KAN LURE SQL OG LAGRER PASSORDET I EN VARIABEL
	$sql="CALL adminLogin('$brukernavn','$passord');";						// KALLER OPP PROSEDYRE LAGRET I MYSQL FOR Å SJEKKE OM BRUKERNAVN OG PASSORD STEMMER MED DATABASEN
	$sqlResultat=mysql_query($sql) or die(mysql_error());					// EXECUTER SQL SETNINGEN PÅ DATABASEN
	$count=mysql_num_rows($sqlResultat);									// SJEKKER OM VI HAR FÅTT NOEN TREFF I DATABASEN
	kobleFra();																// KOBLER FRA DATABASEN
	if($count==1){															// HVIS VI FINNER 1 TREFF SÅ GÅR VI VIDERE
		$rad=mysql_fetch_array($sqlResultat);								// HENTER RADEN VI TRAFF I DATABASEN
		
		$id = $rad[0];														// LAGRER ID'EN VI TRAFF I EN LOKAL VARIABEL													
		$brukernavn = $rad[1];												// LAGRER BRUKERNAVNET VI TRAFF I EN LOKAL VARIABEL
		
		$_SESSION['innlogget'] = true;										// SKRIVER TIL SESSION AT MAN ER INNLOGGET
		$_SESSION['adminId'] = $id;											// LAGRER ID'EN TIL BRUKEREN I SESSION
		$_SESSION['adminBruker'] = $brukernavn;								// LAGRER BRUKERNAVNET TIL BRUKEREN I SESSION
								
		header('Location: ./index.php');									// SENDER BRUKEREN TIL INDEX
	} else {

		echo "<script> alert('Feil brukernavn/passord, prøv igjen') </script>";	// SKRIVER UT FEILMELDING HVIS BRUKEREN IKKE HAR RIKTIG BRUKERNAVN ELLER PASSORD
		echo "<script> window.location = 'index.php' </script>";			// SENDER BRUKEREN TIL INDEX
	}
}
else if($_SESSION['innlogget'] == false || $brukernavn == NULL) {			// SJEKKER OM BRUKEREN ER INNLOGGET ELLER OM BRUKERNAVN ER FYLT UT, HVIS IKKE SÅ FÅR BRUKEREN LOGIN SKJEMAET
	echo "<table width='300'' border='0'' align='center' cellpadding='0'' cellspacing='1'>
			<tr>
			<form name='form1'' method='post' action=''>
			<td>
			<table width='100%' border='0' cellpadding='3' cellspacing='1'>
			<tr>
			<td colspan='3'><strong></strong></td>
			</tr>
			<tr>
			<td width='78'>Brukernavn</td>
			<td width='6'>:</td>
			<td width='294'><input name='brukernavn' type='text' id='brukernavn'></td>
			</tr>
			<tr>
			<td>Passord</td>
			<td>:</td>
			<td><input name='passord' type='password' id='passord'></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type='submit' name='loginKnapp' value='Login' id='loginKnapp' class='input'></td>
			</tr>
			</table>
			</td>
			</form>
			</tr>
			</table>";
}
?>
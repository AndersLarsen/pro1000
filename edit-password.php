<?php

/**
 * endrer personlig informasjon på min profil
*
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

$title = '..SKIFT PASSORDET DITT  ..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("header.php");
sjekklogin();																			//INKLUDERER HEADER OG SJKKER AT MAN ER LOGGET INN 

$brukerId=$_SESSION['id'];																// HENTER ID PÃ… SESSION

echo "
<div id='content' class='clearfix'>
	<section id='start'>
		<div id='torgetStartpage' class='clearfix'>
			<div class='headPassword'>
			<h1>Endre passord</h1></div>
				<form method='post' action='' name='changeForm' id='changeForm'>
				<ul>
				<li><input type='hidden' name='brukerId' id='brukerId' value='$brukerId' /></li>
				<li><input type='password' name='oldPassword' id='oldPassword' tabindex='1' pattern='.{4,}' autofocus placeholder='Gammelt passord' required /></li>
				<li><input type='password' name='newPassword' id='newPassword' tabindex='2' pattern='.{4,}' placeholder='Nytt passord' required  /></li>
				<li><input type='password' name='newPassword2' id='newPassword2' tabindex='3' pattern='.{4,}' placeholder='Gjenta passord' required  /></li>
				<li><input type='submit' class='password_button' value='Endre' id='changePasswordConfirm' name='changePasswordConfirm' tabindex='4' /></li>
				</ul>
				</form>
				<form method='post' action='myprofile.php'>
				<ul>
				<li><input type='submit' class='password_button' value='Avbryt' id='back' name='back'></li>
				</ul>
				</form>																				
		</div>
	</section>
</div>";
																			//AVBRYTER ENDRING OG DIRIGERER TILBAKE
 	
?>
<?php 
$changePasswordConfirm = $_POST["changePasswordConfirm"];							// henter submitknapp fra skjema

if($changePasswordConfirm){															// sjekker om submitknapp er trykkket på
	
$brukerId = mysql_real_escape_string($_POST["brukerId"]);								// henter brukerref fra skjema
$oldPassword = $_POST["oldPassword"];												// henter gammelt passord fra skjema 
$newPassword = $_POST["newPassword"];												// henter nytt passord fra skjema
$newPassword2 = $_POST["newPassword2"];												// henter nytt passord (bekreft) skjema og fjerner spesialtegn for å ungå missbruk av SQL databasen
	
	
	if  (!$oldPassword || !$newPassword || !$newPassword2) {										// sjekker at alle felter er fylt ut
			echo "<script> alert('Alle felter må fylles ut') </script>";
	} elseif  ($newPassword != $newPassword2){														// sjekker om nytt passord er skrevet likt i begge felt
			echo "<script> alert('Det nye passordet må skrives inn likt to ganger') </script>";		// returnerer feilmelding hvis ikke
	} else {
			
			$oldPassword=mysql_real_escape_string(krypterPassord($oldPassword));						// fjerner spesialtegn for å ungå missbruk av SQL databasen og krypterer passord
			
			kobleTil();
			$sql="SELECT BrukerId FROM bruker WHERE BrukerId='$brukerId' AND BrukerPassord='$oldPassword';";	// sql spøring
			$sqlResultat=mysql_query($sql) or die("ikke mulig å hente bruker fra  fra databasen");	// utfører spøring
			$row=mysql_num_rows($sqlResultat);														// henter resultat
			kobleFra();																			// kobler fra databasen

			if($row==0){																			// sjekker om det er treff på brukerref og passord i databasen
				echo "<script> alert('Du har skrevet inn feil gjeldende passord') </script>"; 		// hvis ikke returneres feilmelding
			} else {																				// går videre hvis det er treff
				$newPassword=mysql_real_escape_string(krypterPassord($newPassword));					// fjerner spesialtegn for å ungå missbruk av SQL databasen og krypterer passord
				
				kobleTil();																			// kobler til databasen
				$sql="UPDATE bruker SET BrukerPassord='$newPassword' WHERE BrukerId='$brukerId';";			// sql spøring
				$result = mysql_query($sql) or die ("<script> alert('ikke mulig å hente Bruker fra databasen') </script>");	// kjører spørring
					
				kobleFra();																		// kobler fra databasen
					
				echo "<script> alert('Ditt passord er nå endret'); window.location = 'myprofile.php';</script>";						// bekreftelse til bruker
					
			}
				
	}
}
INCLUDE 'footer.php'; 															//	LEGGER TIL FOOTER I BUNNEN 

?>




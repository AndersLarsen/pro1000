<?php
/**
 * Her skal bruker kunne registrere seg som nytt medlem
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
* @author   Original Author <andersborglarsen@gbeskrivelse.com>
* @author   Original Author <haavard@ringshaug.net>
* @author   Original Author <gjermunwedvik@gmail.com>
* @copyright  2013-2018
* @license    http://www.php.net/license/3_01.txt
* @link   http://student.hive.no/pro10005/1
*
*
*/
$title = '..OM OSS..'; 																					// 	LEGGER TIL TITEL PÅ SIDEN.

include("header.php");																					// HENTER INN HEADER 
?>

<div id="content2" class="clearfix">
	<section id='aboutfolder'>
    <?php 
    kobleTil();																							// KOBLER TIL DATABASEN
      $sqlSetning="SELECT AdminId, AdminFornavn, AdminEtternavn, AdminMail, AdminAdresse, AdminTlf, AdminMob, AdminPostnr, AdminBrukernavn, AdminPassord
      FROM `admin`;";																		//SQL SPØRRING
      $sqlResultat=mysql_query($sqlSetning) or die(mysql_error());  									// HENTER RESULTAT ELLER DØR
      $antallRader=mysql_num_rows($sqlResultat);      													// ANTALL RADER I RESULTATET AV MYSQL KALLET
    kobleFra();																							//KOBLER FRA DATABASEN
             for ($r=1;$r<=$antallRader;$r++){
             $rad=mysql_fetch_array($sqlResultat);   													 // NY RAD HENTET FRA SPØRRINGSRESULTATET
      echo   "<div id='aboutUs' class='clearfix'>";														// SKRIVER UT HVER SIN INFOBOKS OM ADMINS
      echo			"<div class='pic'>";
			echo			"<a href='#'><img src='img/user-icon.jpg' width='150' height='150' /></a>";
			echo      "</div>";
      echo      "<div class='aboutUsData'>";
      echo         "<h2>$rad[1] $rad[2]</h2>";
      echo         "<p>Mail :<a href='mailto:$rad[3]'>$rad[3]</a></p>";
      echo         "<p>Tlf: $rad[6]</p>";
      echo         "<p>Adresse: $rad[4]</p>";
      echo         "<p>Post nr: $rad[7]</p>";
      echo       "</div>";
      echo   "</div>"; 
  }?>
  </section>
</div>
<?php include("footer.php");																			// HENTER INN FOOTER.
 ?>


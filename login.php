<?php 
/*
 * Her skal bruker kunne registrere seg som nytt medlem
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
* @author   Original Author <gjermundwedvik@gmail.com>
* @copyright  2013-2018
* @license    http://www.php.net/license/3_01.txt
* @link   http://student.hive.no/pro10005/1
*/
$title = '..Logg Inn..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("header.php"); 
?>

<div id="content2" class="clearfix">
	<div id="fontstyle">
		<section id="left">
			<div class="textLogAndReg">
				<h3>Personvern</h3>
				<p>Personvernerklæring
Vi behandler i utgangspunktet bare personopplysninger du oppgir til oss,
 og som er nødvendige for at vi skal kunne gjennomføre våre forpliktelser overfor deg.
Når du registrerer deg og handler hos oss, oppbevarer vi blant annet navn, adresse, 
telefonnummer og e-postadresse. Dette er informasjon vi trenger for å  få levert varene til deg,
 samt for å kontakte deg om forhold i forbindelse med bestillingen. Vi må oppbevare kundeinformasjon 
 i forbindelse med regnskapsføring, avgiftshåndtering og eventuell garanti og retur.
 <br>
Dine personopplysninger kan bli utlevert til andre når:
<br>
du har samtykket i utleveringen, eller
når det er nødvendig for at vi skal få gjennomført avtalen med deg, eller
i lovbestemte tilfelle.
<br>
Dersom du har spørsmål om personopplysninger knyttet til deg, eller ønsker å gjøre bruk av dine rettigheter
 til retting, sperring, sletting, etc. etter personopplysningsloven, kan du kontakte oss på Mail.</p>
			</div>
		</section>

		<section id="right">
			<div id="loginForm">
				<form action="" method="post" autocomplete="on">
					<h2>Logg inn</h2>
					<p>
						<input id="username" name="username" required="required"
							type="text" placeholder="e-mail adresse" />
					</p>
					<p>
						<input id="password" name="password" required="required"
							type="password" placeholder="passord" />
					</p>
					<p class="logRegButton">
						<input type="submit" value="Logg inn" id="loginButton"
							name="loginButton" />
					</p>
					<p class="change_link">
						Ikke medlem? <a
							href="http://is.hive.no/pro10005/1/applikasjon/registrer.php"
							class="to_register">Registrer deg</a>

						<!-- DETTE ER FACEBOOK APP INKLUDERT HER  -->
					
					
					<div class="fb-login-button" data-show-faces="true"
						data-width="200" data-max-rows="4"></div>

					<div id="fb-root"></div>
					<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;1
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=139558956221396";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
					</p>
				</form>
			</div>
		</section>
	</div>
</div>
<?php 
include("footer.php");									//INKLUDERER FOOTER

$loginKnapp = $_POST['loginButton'];					// LYTTER TIL LOGGIN KNAPP
if($loginKnapp) {
kobleTil();												//KOBLER TIL DATABASE

$brukernavn=mysql_real_escape_string($_POST['username']);   // FJERNER SPESIALTEGN SÃ… MAN IKKE KAN LURE SQL
$passord=krypterPassord(mysql_real_escape_string($_POST['password']));      // FJERNER SPESIALTEGN SÃ… MAN IKKE KAN LURE SQL
$sql="CALL login('$brukernavn','$passord');";       // KALLER OPP PROSEDYRE LAGRET I MYSQL
$sqlResultat=mysql_query($sql) or die(mysql_error());		// HENTER RESULTAT ELLER DØR
$count=mysql_num_rows($sqlResultat);						// TELLER RADER

kobleFra();									//KOBLER FRA DATABASEN
if($count==1){
  $rad=mysql_fetch_array($sqlResultat);		//TAR UT ARRAY

  $id = $rad[0];
  $brukernavn = $rad[1];
  $passord = $rad[2];

  $_SESSION['innlogget'] = true;										// SESSION PARAMETER
  $_SESSION['id'] = $id;
  $_SESSION['brukernavn'] = $brukernavn;

  //    header('Location: http://is.hive.no/pro10005/1/applikasjon/pages/myProfile.php');
  echo "<script language=\"javascript\">
							location.href=\"http://is.hive.no/pro10005/1/applikasjon/index.php\";
							</script>";
  exit; // Stops executing page, just stops if JS is disabled
}
else {
echo "<script> alert('Feil passord eller brukernavn ')</script>";							// ALERTBOX pÂ at BRUKER ER SLETTET
	}
}
?>
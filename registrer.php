<?php 
/**
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
 * @author		Original Author <andersborglarsen@gbeskrivelse.com>
 * @author		Original Author <haavard@ringshaug.net>
 * @author		Original Author <gjermundwedvik@gmail.com>
 * @copyright 	2013-2018
 * @license		http://www.php.net/license/3_01.txt
 * @link		http://student.hive.no/pro10005/1
 */
$title = '..REGISTRER DEG ..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("header.php");											// IKNLUDERER HEADER I SIDEN

?>

<div id="content2" class="clearfix">
	<div id="fontstyle">
	
		<?php 

kobleTil();																//KOBLER TIL DATABASEN
$sqlSetning="SELECT header,content FROM hvorfoross ORDER BY id DESC;";	// SQL SETTNINGEN
$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());			// RESULTAT ELL DØR
$antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
kobleFra();														//KOBLER FRA DATABASEN
echo "<section id='left'>";										//STARTER PÅ PRINT AV INNHOLD
for ($r=1;$r<=$antallRader;$r++){
	$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPØRRINGSRESULTATET
	


echo"
		<div class='textLogAndReg'>
			<h2>$rad[0]</h2>
			<p>
				$rad[1]
			</p>
		</div>
	</section>";
}															// SKRIVER UT TEKSTBOKSEN SOM INNHOLDET BLIR HENTET FRA DATABASEN
?>
	<section id="right">
		<div id="registerForm">
				<h2>Registrer deg</h2>
	<br> 
		
 <form class="igeir_skjema" name='igeir_skjema' id='igeir_skjema' enctype='multipart/form-data' method='POST'>  	  
		<input  type='text' name='first_name' maxlength='50' value='' id='first_name' placeholder="Fornavn" required> 
		 <input  type='text' name='last_name' maxlength='50' placeholder="Etternavn" required>	
		  <input  type='email' name='email' maxlength='80' size='30' value='' placeholder="E-post" required> 
		 <input  type='text' name='adress' maxlength='50' value='' placeholder="Adresse"  required>
		 <input  type='text' name='post_code' pattern='[0-9]{4}' value='' placeholder="Postnr"  required> 
		 <input  type='text' name='phone_number' maxlength='8' value='' placeholder="Telefon nr" required> 
		 <input  type='text' name='mobile_number' maxlength='8' value='' placeholder="Mobil nr" required>
		 <input  type='password' name='paswd1' maxlength='12' placeholder="Passord" required> <br>
		 <p class="logRegButton">
		 <input type='submit' value='Registrer' name='submit'>
		</p>
		 </form>
	
		 
		 	
        
				<p class="change_link">
					Allerede et medlem? <a href="http://is.hive.no/pro10005/1/applikasjon/login.php" class="to_register"> Logg inn</a>
				</p>
			</form>
		</div>
	</section>
</div>
</div>

<?php 

$RegistrerBruker=$_POST["submit"];															// HENTET INN VARIABLER FRA SKJEMA

if ($RegistrerBruker){																		// TRYKK PÅ KNAPPEN 
	$fornavn	= ucfirst(strtolower(mysql_real_escape_string($_POST["first_name"])));		// FJERNER SPESIALTEGN SÅ MAN IKKE KAN LURE SQL
	$etternavn	= ucfirst(strtolower(mysql_real_escape_string($_POST["last_name"])));		// FJERNER SPESIALTEGN SÅ MAN IKKE KAN LURE SQL
	$mail		= strtolower(mysql_real_escape_string($_POST["email"]));					// FJERNER SPESIALTEGN SÅ MAN IKKE KAN LURE SQL
	$adresse	= ucfirst(strtolower(mysql_real_escape_string($_POST["adress"])));			// FJERNER SPESIALTEGN SÅ MAN IKKE KAN LURE SQL
	$tlf		= mysql_real_escape_string($_POST["phone_number"]);							// FJERNER SPESIALTEGN SÅ MAN IKKE KAN LURE SQL
	$mob		= mysql_real_escape_string($_POST["mobile_number"]);						// FJERNER SPESIALTEGN SÅ MAN IKKE KAN LURE SQL
	$postNr		= mysql_real_escape_string($_POST["post_code"]);							// FJERNER SPESIALTEGN SÅ MAN IKKE KAN LURE SQL
	$passord	= krypterPassord(mysql_real_escape_string($_POST['paswd1']));			// FJERNER SPESIALTEGN SÅ MAN IKKE KAN LURE SQL OG KRYPTERER PASSORDET
	$userId		=createBrukerRef();
	if (!$fornavn||!$etternavn||!$mail||!$passord){				
echo "tester tester tester";						// SJEKKER AT FORNAVN, ETTERNAVN,EPOST OG PASSORD ER FYLT UT
		print ("<script> alert('Alle feltene må fylles ut') </script>");
	} else {
		kobleTil();																		// KOBLER TIL DATABASEN
																						//SQL SETTNINGEN
		$sql="CALL leggTilBruker(
		'$userId',
		'$mail',
		'$passord',
		'$fornavn',
		'$etternavn',
		'$adresse',
		'$postNr',
		'$tlf',
		'$mob',
		'','1',
		'','0',
		'1');";
		
		mysql_query($sql) or die(mysql_error());				

		kobleFra();																		// KOBLER FRA DATABSEN

		print ("<script> alert('Du er nå registrert med E-post : $mail') </script>");	// SENDER ALERT MELDING AT MAN HAR REGISTRERT SEG
	}
}
include("footer.php"); 																	//INKLUDERER FOOTER
?>															
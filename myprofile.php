<?php
/**
 * Min Profil her skal man kunne behandel sin egen informasjon,
 * legge ut anonnse , slette anonnse og se sine egene anonnser.
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

$title = '..MIN PROFIL..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("header.php"); sjekklogin();								//INKLUDERER HEADER OG SJKKER AT MAN ER LOGGET INN 
?>



<div id="content4" class="wrapper2 clearfix">

	<?php 

	$brukerId=$_SESSION['id'];																// HENTER ID PÃ… SESSION
	profilBilde();
	kobleTil();																				//KOBLER TIL DATABASEN
	$sqlSetning="												
	SELECT bruker.BrukerId, bruker.BrukerMail, bruker.BrukerFornavn,
	bruker.BrukerEtternavn, bruker.BrukerAdresse, bruker.BrukerPostnr, bruker.BrukerTlf, bruker.BrukerMob,
	poststed.Poststed
	FROM bruker
	join poststed on bruker.BrukerPostnr=poststed.Postnr where BrukerId='$brukerId';"; // SQL SPÃ˜RRINGEN

	$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
	$antallRader=mysql_num_rows($sqlResultat); 						// ANTALL RADER I RESULTATET AV MYSQL KALLET
	kobleFra();														//KOBLER FRA 

	for ($r=1;$r<=$antallRader;$r++){
		$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPoRRINGSRESULTATET
		$brukerId = $rad[0];
		$brukerMail= $rad[1];
		$BrukerFornavn= $rad[2];
		$brukerEtternavn= $rad[3];
		$BrukerAdresse= $rad[4];
		$BrukerPostnr= $rad[5];
		$brukerTlf= $rad[6];
		$BrukerMob= $rad[7];
		$Poststed= $rad[8];
		//echoER UT INFO

		echo 		"<section id='userLeft'>";
		echo		"<div id='userStats' class='clearfix'>";
		echo    "<div class='head'><h2>$BrukerFornavn , $brukerEtternavn</h2></div>";
		echo			"<div class='pic'>";
		echo			"<a href='http://is.hive.no/pro10005/1/applikasjon/edit-myprofile.php'><img src='http://is.hive.no/pro10005/1/applikasjon/img/userPic.jpg' class='center' title='Rediger bilde'  /></a></div>";
		echo				"<div class='data'>";
		echo				"<div class='infoLine1'><div class='infoLeft mailLeft'><p>Mail:</p></div><div class='infoRight mailRight'><p>$brukerMail</p></div></div>";
		echo				"<div class='infoLine2'><div class='infoLeft tlf'><p>Telefon nr:</p></div><div class='infoRight tlf'><p>$brukerTlf</p></div></div>";
		echo				"<div class='infoLine1'><div class='infoLeft mob'><p>Mobil nr:</p></div><div class='infoRight mob'><p>$BrukerMob</p></div></div>";
		echo				"<div class='infoLine2'><div class='infoLeft id'><p>Bruker ID:</p></div><div class='infoRight id'><p>$brukerId</p></div></div>";
		echo				"<div class='infoLine1'><div class='infoLeft adr'><p>Adresse:</p></div><div class='infoRight adr'><p>$BrukerAdresse</p></div></div>";
		echo				"<div class='infoLine2'><div class='infoLeft postst'><p>Poststed:</p></div><div class='infoRight postst'><p>$Poststed</p></div></div>";
		echo				"<div class='infoLine1'><div class='infoLeft postnr'><p>Postnr:</p></div><div class='infoRight postnr'><p>$BrukerPostnr</p></div></div>";
		echo			"</div>	</div>";
	}

	?>
	<div id='userStats' class='clearfix'>
		<form class="igeir_skjema" method="post" id="roductUpload" name="roductUpload" enctype="multipart/form-data">
			<h2>Selge, Bytte, Gi bort</h2>
			<?php kobleTil(); typeList(); kobleFra();?>
			<?php kobleTil(); torgetList(); kobleFra();?>
			<p>Hvis man skal bytte eller gi bort noe så må man sette pris og bud til 0 kr</p>
				<input type="text" class="longLine" id="header" name="header" placeholder='Overskrift' value="<?php @print $_POST ["header"]; ?>" required> 
				<input type="text" class="shortLine" id="pris" name="pris" placeholder='Pris' value="<?php @print $_POST ["pris"]; ?>" required> 
				<input type="text" class="shortLine" id="bud" name="bud" placeholder='Bud ønsket' value="<?php @print $_POST ["bud"]; ?>" required> 
				<input type="hidden" id="brukerid" name="brukerid" placeholder="id" value="<?php echo $brukerId; ?>" required> 
				<input type="file" class="upLoadPic" id="fil" name="fil" > 
				<textarea row="20" cols="50" id="beskrivelse" name="beskrivelse" placeholder="beskrivelse" required></textarea>
			<div id='radioButtons'>
							<input type='hidden' name='active' value='1'> 
							<input type='hidden' name='private' value='1'>	
					</div>
			<input type="submit" class="upload" value="Registrer" id="registrerInfoKnapp"
				name="registrerInfoKnapp" class="submit" />
		</form>

	</div>

	<?php
	
	

	if (isset($_POST ["registrerInfoKnapp"])) {                         // LYTTER TIL OM SUBMITKNAPPEN BLIR TRYKKET
		$igeirKode=igeirKode();                                             // HENTER UT EN NY IGEIRKODE
		$header=mysql_real_escape_string($_POST["header"]);                 // HENTER INPUT FRA SKJEMAET
		$bud=$_POST["bud"];                                                 // HENTER INPUT FRA SKJEMAET
		$pris=mysql_real_escape_string($_POST["pris"]);                     // HENTER INPUT FRA SKJEMAET
		$brukerid=$_POST["brukerid"];                                       // HENTER INPUT FRA SKJEMAET
		$beskrivelse=mysql_real_escape_string($_POST ["beskrivelse"]);      // HENTER INPUT FRA SKJEMAET
		$active=$_POST["active"];                                           // HENTER INPUT FRA SKJEMAET
		$private=$_POST["private"];                                         // HENTER INPUT FRA SKJEMAET
		$typeId=$_POST["type"];
		$torgetId=$_POST["torgKategori"];
		
		
		
		if (!$header||!$brukerid || !$beskrivelse|| !$typeId||!$torgetId) {        // SJEKKER AT ALLE FELTENE ER FYLT UT
			echo "<script> alert('Annonsen er ikke fullstendig, vennligst sjekk at alt er fylt ut og at bilde er lastet opp!')</script>";   // SKRIVER UT FEILMELDING
		} else {
			kobleTil();                                                     // KOBLE TIL DATABASEN
			
			$sqlSetning="INSERT INTO `pro10005`.`igeir`
			(`IgeirKode`, `Bud`, `Beskrivelse`, `Header`, `BrukerId`, `Pris`, `Aktiv`, `Privat`)
			VALUES ('$igeirKode', '$bud', '$beskrivelse', '$header', '$brukerid', '$pris', '$active', '$private');";    // SQLSETNINGEN SOM SKAL KJØRES I DATABASEN
			$sqlRestultat=mysql_query($sqlSetning) or die(mysql_error());  												 // KJØRER SQLSETNINGEN I DATABASEN
			
			$sqlSetning2="INSERT INTO `pro10005`.`underkategori`
			(`IgeirKode`, `TypeId`, `TorgetId`) VALUES ('$igeirKode','$typeId','$torgetId');";						// SQL SPØRRING NR 2
			$sqlRestultat2=mysql_query($sqlSetning2) or die(mysql_error());
			kobleFra();                                                     // KOBLER FRA DATABASEN

			
					
			/* Leser fila som admin laster opp */
			$filnavn = $_FILES["fil"]["name"]; // To-dim array
			$filtype = $_FILES["fil"]["type"];
			$filstorrelse = $_FILES["fil"]["size"];
			$tmpnavn = $_FILES["fil"]["tmp_name"];
			$filkode = createBildeNavn();
			
			/* Splitter ut fildefinisjonen(type) og legger den til bak filnavnet */
			$splittFilnavn = explode(".",$filnavn);
			$definertFilnavn = ".$splittFilnavn[1]";
			
			/* Setter filnavn til brukernavn+filtypen */
			$nyttnavn 	= "img/".$filkode.$definertFilnavn;
			$nyFil 		= "img/".$filkode.$definertFilnavn;
			
			kobleTil();																// KOBLER TIL DATABASEN
			$sqlSetning= "INSERT INTO bilde (IgeirKode,Navn,Filnavn,Beskrivelse)
			VALUES ('$igeirKode','$filkode','$nyttnavn','$beskrivelse');";															// SQLSETNINGEN SOM SKAL KJØRES I DATABASEN
			mysql_query ($sqlSetning) or die (mysql_error());						// KJØRER SQLSETNINGEN I DATABASEN
			kobleFra();																// KOBLER FRA DATABASEN
			
			/*** Last opp bilde*/
			
			if($filnavn != NULL) 												// SJEKER AT IKKE FILNAVNET ER LIK NULL
			if($filtype != "image/gif" && $filtype != "image/jpg" && $filtype != "image/jpeg" && $filtype != "image/png"){	// SJEKKER FILFORMATET
					echo"<script> alert('Kun tillatt å laste opp bilder')</script>";				// SKRIVER UT FEILMELDING
				} else if($filstorrelse > 5000000) {								// SJEKKER AT IKKE FILEN ER FOR STOR
					echo"<script> alert('Filen er for stor til å laste opp')</script>";			// SKRIVER UT FEILMELDING
				} else {for($i=0;$i<count($_FILES['fil']['size']);$i++){
					move_uploaded_file($tmpnavn, $nyFil) or die(error());			// LASTER OPP FILEN TIL SERVEREN
					echo"<script> alert('Fil lastet opp..')<script>";								// SKRIVER UT BEKREFTELSE PÅ AT FILEN ER LASTET OPP
				}
			}
			
			
			
			echo "<script> alert('Registreringen var vellykket')</script>";						// SKRIVER UT BEKREFTELSE PÅ AT REGISTRERINGEN VAR VELLYKKET
			
			
			echo "<script> alert('Annonsen med id: $igeirKode er nå Registrert')</script>";							// ALERTBOX pÂ at BRUKER ER SLETTET
			// SKRIVER UT BEKREFTELSESMELDING PÅ AT DATAENE ER LAGRET
		}

		}
			


?>		
	<div id='editUserInfo'class'clearfix'>
	
	
	<?php 
echo"		<h2>Rediger bruker informasjon</h2>


		<form action='edit-myprofile.php' id='editUser' name='editUser' enctype='multipart/form-data' method='POST'>
		<input type='hidden' id='brukerid' name='brukerid' value='$brukerId'>
		<input type='hidden' class='shortLine' name='fornavn' maxlength='50' value='$BrukerFornavn' required>
				 <input type='hidden' class='shortLine' name='etternavn' maxlength='50' value='$brukerEtternavn' required>
				 <input type='hidden' class='longLine' name='epost' maxlength='80' size='30'	value='$brukerMail' required>
				 <input type='hidden' class='shortLine' name='adresse' maxlength='50' value='$BrukerAdresse' required>
				 <input type='hidden' class='shortLine' name='postnr' pattern='[0-9]{4}'value='$BrukerPostnr' required> 			
				<input type='hidden' class='shortLine'name='tlf' maxlength='8' value='$brukerTlf' required>
				<input type='hidden' class='shortLine' name='mob' maxlength='8' value='$BrukerMob' required>
			 <input class='upload' type='submit' value='Oppdater personlig informasjon' id='modifySubmit' name='modifySubmit'>
				
		</form>
		<form action='edit-password.php' id='editUser' name='editUser' enctype='multipart/form-data' method='POST'>
		<input type='hidden' id='brukerid' name='brukerid' value='$brukerId'>
		<input class='upload' type='submit' value='Endre  personlig passord' id='changePassword' name='changePassword'>
		</form>
	</div>";



?> 
	</section>
	
	
	

	<section id='aRight'>
		<?php  														// VISER ALLE ANONSENE TIL BRUKERE P√Ö SI SIDE
		kobleTil();													// KOBLER TIL DATABASEN
		$sqlSetning="SELECT igeir.IgeirKode,
					 igeir.Bud, 
					 igeir.BildeId,
					 igeir.Header, 
					 igeir.Pris, 
					 igeir.BrukerId, 
					 igeir.Beskrivelse,
	 				bilde.Filnavn,
	  				bilde.Beskrivelse
		From igeir  JOIN bilde ON igeir.IgeirKode=bilde.Igeirkode  Where igeir.BrukerId ='$brukerId';";// SQL SPØRRINGEN

		$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
		$antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
		kobleFra();														//KOBLER FRA DATABASEN

		for ($r=1;$r<=$antallRader;$r++){
	$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPÔøΩRRINGSRESULTATET

	$igeirkode = $rad[0];
	$bud = $rad[1];
	$bildeId =$rad[2];
	$header =$rad[3];
	$pris = $rad[4];
	$brukerId = $rad[5];
	$beskrivelse = $rad[6];
	$filnavn =$rad[7];
	$bildebeskrivelse=$rad[8];


	echo		"<a href='#' title='Se annonse'><div class='yourAdvertisings clearfix'>";
	echo			"<div class='head'><h3>$header</h3></div>";
	echo		"<div class='boxy'>";
	echo			"<p>Vare navn:$header</p>";
	echo			"<p>igeir kode:$igeirkode</p>";
	echo			"<div class='beskrivelse'>";
	echo			"<p>Pris:$pris</p>";
	echo			"<p>Bud:$bud</p>";
	echo			"<div class='advertisingPic clearfix'>";
	echo			"<a href=''><img src='$filnavn' alt='$bildebeskrivelse' class='center' /></a></div>";
	echo			"</div>";

	echo 			"<form method='post' action='myprofile.php' name='deleteprodukt' id='deleteprodukt'>
					<input type='hidden' value='$igeirkode' name='ref_users' id='ref_users'>
					<input type='hidden' value='$brukerId' name='username' id='username'>
					<input type='submit' value='Slett' name='deleteSubmit' id='deleteSubmit'></form>";
	
	echo 			"<form method='post' action='category/productpage.php' name='gotoproduct' id='gotoproduct'>
					<input type='hidden' value='$igeirkode' name='igeirkode' id='igeirkode'>
					<input type='hidden' value='$brukerId' name='username' id='username'>
					<input type='submit' value='Gå til produkt' name='goto' id='goto'></form>";
	
	echo 			"<form method='post' action='update-product.php' name='updateproduct' id='updateproduct'>
					<input type='hidden' value='$igeirkode' name='igeirkode' id='igeirkode'>
					<input type='hidden' value='$brukerId' name='username' id='username'>
					<input type='submit' class='submit' value='Endre Produkt/Bilder' name='modifySubmit' id='modifySubmit'></form>";

	echo 			"<form method='post' action='showinterest.php' name='updateproduct' id='updateproduct'>
					<input type='hidden' value='$igeirkode' name='igeirkode' id='igeirkode'>
					<input type='hidden' value='$brukerId' name='username' id='username'>
					<input type='submit' class='submit' value='Hvem er interessert' name='showinterest' id='showinterest'></form>";
						
					
	
	echo			"</div>";
	echo			"</a>";




}
/********************************* Slette Annonsen **************************************/

$deleteSubmit=$_POST['deleteSubmit'];															

if($deleteSubmit){																				// LYTTER TIL SUBMIT KNAPPEN
	$ref_users = $_POST['ref_users'];
	$usename = $_POST['username'];


	kobleTil();
	$sql="DELETE FROM igeir WHERE IgeirKode='$ref_users';";											// SLETTER FRA BOOKING TABELLEN
	$result = mysql_query($sql) or die ("ikke mulig Â slette annonsen fra databasen");						//FEILMELDING SOM RETURNERES VED FEIL MED SPÿRRING
	kobleFra();																							//KOBLER FRASQL DATABASEB
	
	echo "<script> alert('Annonsen er nå slettet')</script>";							// ALERTBOX pÂ at BRUKER ER SLETTET
	
	print("<meta http-equiv='refresh' content='1'> ");
}

?>
	</section>

</div>


<?php
include("footer.php")																// LEGGER TIL FOOTER
?>
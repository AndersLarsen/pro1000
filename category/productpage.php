<?php

/**
 * Min Profil her skal man kunne behandel sin egen informasjon,
 * legge ut anonnse , slette anonnse og se sine egene anonnser.
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
 *
 */
$title = '..VELKOMMEN TIL DITT PRODUKT..';												//SETTER TITTEL PÅ SIDEN I BROWSERFANE
$brukerId=$_SESSION['id'];																// HENTER ID PÅ SESSION
$goto=$_POST["goto"];
$igeirKode=$_POST["igeirkode"];


include("../header.php");																// INKLUDERER HEADER

if(!$igeirKode) {																		// SJEKKER OM DET ER BLITT SENDT NOEN IGEIR KODE
	header('Location: http://is.hive.no/pro10005/1/applikasjon/search-results.php?search=');
}
kobleTil();																				// KOBLER TIL DATABASEN

$sqlSetning="
SELECT igeir.IgeirKode, igeir.Bud, igeir.BildeId, igeir.Header, igeir.Pris, igeir.BrukerId, igeir.Beskrivelse,igeir.Status,
bilde.Filnavn, bilde.Beskrivelse,
bruker.BrukerFornavn, bruker.BrukerEtternavn, bruker.BrukerMail,bruker.BrukerMob
From igeir  JOIN bilde ON igeir.IgeirKode=bilde.Igeirkode
JOIN bruker ON bruker.BrukerId=igeir.BrukerID
AND igeir.Igeirkode='$igeirKode'; ";													//SQL SPØRRING


$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
$antallRader=mysql_num_rows($sqlResultat); 											 // ANTALL RADER I RESULTATET AV MYSQL KALLET
kobleFra();																			// KOBLER FRA DATABASEN

for ($r=1;$r<=$antallRader;$r++){
	$rad=mysql_fetch_array($sqlResultat);  											// NY RAD HENTET FRA SPoRRINGSRESULTATET

	$igeirkode = $rad[0];
	$bud = $rad[1];
	$bildeId =$rad[2];
	$header =$rad[3];
	$pris = $rad[4];
	$brukerId = $rad[5];
	$beskrivelse = $rad[6];
	$status=$rad[7];
	$filnavn =$rad[8];
	$bildebeskrivelse=$rad[9];
	$brukerfornavn =$rad[10];
	$brukeretternavn=$rad[11];
	$brukermail=$rad[12];
	$brukermob=$rad[13];

}
kobleTil();																				//KOBLER TIL DATABASEN

$sqlSetning="
SELECT underkategori.TorgetId, underkategori.TypeId, underkategori.IgeirKode,
typer.TypeKategori,
torget.TorgKategori
from underkategori
Natural Join typer
Natural Join torget
where IgeirKode='$igeirKode';";															//SQL SPØRRING
$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
$antallRader=mysql_num_rows($sqlResultat); 						 						// ANTALL RADER I RESULTATET AV MYSQL KALLET
kobleFra();

for ($r=1;$r<=$antallRader;$r++){
	$rad=mysql_fetch_array($sqlResultat);  												// NY RAD HENTET FRA SPoRRINGSRESULTATET

	$togetid =$rad[0];
	$typeId =$rad[1];
	$underIgeirkode = $rad[2];
	$typekategori =$rad[3];
	$torgkategori =$rad[4];
}

echo "<div id='content4' class='clearfix'>";							//holder bredden p� siden//
echo"  <section id='productpage' class='clearfix'>
		<div id='productPresentation'>";								  // Presentasjon av produktet//
echo"    <div id='prodHeader'> ";									 //Produktets overskrift//
echo"    <h2>$header</h2>
</div> ";														 //avslutter header//
echo" <div id='prodStatus'>
	<p>Staus:</p>
	<h3>$status</h3>";
	if($_SESSION['innlogget'] == true) { 
	echo "<form method='post' action='' name='interesse' id='interesse'>
	<input type='hidden' value='$igeirkode' name='igeirkode' id='igeirkode'>
	<input type='submit' id='interessert' name='interessert' value='Interessert'>
	</form>";
	}
echo "</div> ";
echo"    <div class='upperblocks'>";							  //De tre 0verste boksene med visning av Pris, Siste bud og Product ID//
echo"        <p class='byUserText'>Pris:</p><p class='byUserNr'>$pris,-</p>
	</div>";																		  //avslutter 'Pris' boksen//
echo"       <div class='upperblocks'>
	<p class='byUserText'>Høyeste bud:</p><p class='byUserNr'>$bud,-</p>
	</div> "; 														//avslutter 'Siste bud' boksen//
echo"    <div class='upperblocks'>
	<p class='byUserText'>Product id:</p><p class='byUserNr'>$igeirKode</p>
	</div>";													 //avslutter produkt id boksen og den siste diven i visning av de tre boksene under overskrift//

echo" <div id='slideshow' class'clearfix'>";  //Bildevisning av produkt//
echo" <ul id='css3-slider'>
	<li>
	<input type='radio' id='s1' name='num' checked='true' />
	<label for='s1'>1</label>
	<a href='javascript:void(0);'>
	<img src='../$filnavn' alt='$bildebeskrivelse' />
	<span>$header</span>";							 //tekst som kommer under bilde//
echo"             </a></li></ul></div>";													//avslutter bilde presentasjon


echo"     <div id='map_folder'>
		";
echo "<p>";
echo hentAdresse($igeirKode);
echo "</p>";
echo"			<div id='map-canvas' style='float:left;width:460px; height:266px'></div>"; //<!--avslutter map canvas-->
echo"			"; 									//avslutter mapbuttons
echo"			</div>";									//avslutter map_folder
echo"     <div id='description'>
<h4>Beskrivelse:</h4>
<p>
$beskrivelse
</p>";
echo "</div>";											//avslutter description
echo" <div id='byUser'>"; 												//brukerens bokser - personen som har lagt ut annonsen
echo"	<div id='byUserWho'><p class='profileText'>Lagt ut av:</p></div>
		<div id='byUserRange'><p class='Text'></p></div>
		<div id='byUserOtherProducts'><p class='profileText' style='margin:2px;'>Andre annonser lagt ut av bruker:</p></div>"; //avslutter byUserOtherProducts
//ADVARSEL! disse tre boksene er laget med linjer langs hele 'byUser' og ikke individult i bokser

echo" <div id='byUserName'>
		<div class='profilePicProd clearfix'>
		<a href='#'><img src='http://is.hive.no/pro10005/1/applikasjon/img/userPic.jpg' class='center' /></a>
		</div>"; 																		//avslutter profilePicProd
echo"	<h3>$brukerfornavn $brukeretternavn <br> TLF: $brukermob</h3>
</div>";																		//avslutter byUserName//

echo" <div id='byUserRangeR'>
<h3>Send Mail :<a href='mailto:$brukermail?subject=$header'>$brukerfornavn $brukeretternavn</a><h3>
</div>";																		//avslutter rangeringsboks

echo" <div id='byUserOtherProductsCont'>";									//visning av brukerens andre produkter
kobleTil();																	//KOBLER TIL
$sqlSetning="
SELECT igeir.IgeirKode, igeir.BrukerId, igeir.Beskrivelse,
bilde.Filnavn, bilde.Beskrivelse
From igeir  JOIN bilde ON igeir.IgeirKode=bilde.Igeirkode
Where igeir.BrukerId ='$brukerId' limit 4;";								//SQL SPØRRING

$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
$antallRader=mysql_num_rows($sqlResultat); 								// ANTALL RADER I RESULTATET AV MYSQL KALLET
kobleFra();																// KOLBER FRA DATABSEN

for ($r=1;$r<=$antallRader;$r++){
	$rad=mysql_fetch_array($sqlResultat);  									// NY RAD HENTET FRA SP0RRINGSRESULTATET
	$igeirKode = $rad[0];
	$brukerId = $rad[1];
	$beskrivelse = $rad[2];
	$filnavn= $rad[3];
	$beskrivelse=$rad[4];
	echo"	<div class='otherProducts'>";
	echo"		<form method='post' action='productpage.php' name='gotoproduct' id='gotoproduct'>
	<input type='hidden' value='$igeirKode' name='igeirkode' id='igeirkode'>
	<input type='image' src='../$filnavn' value='Gå til produkt' name='goto' id='goto' class='links'>
	</form>";
	echo"</div>";
}																				//avslutter otherProducts
echo"</div>";																		//avslutter byUserOtherProductsCont

echo" </div>";																			//avslutter brukerens bokser - personen som har lagt ut annonsen
echo" </div>";																			//avslutter productPresentation


echo" <div class='otherSimularProducts'> ";										//Viser andre lignende produkter//
kobleTil();																		// KOBLER TIL DATABASEN
$sqlSetning="
SELECT underkategori.TorgetId, underkategori.TypeId, underkategori.IgeirKode,
typer.TypeKategori,
torget.TorgKategori,
bilde.Filnavn,
igeir.header,
igeir.pris
from underkategori
Natural Join typer
Natural Join torget
Natural Join bilde
JOIN igeir on igeir.IgeirKode =underkategori.IgeirKode
where underkategori.TorgetId='$togetid' LIMIT 5 ;";								//SQL SPØRRING

$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
$antallRader=mysql_num_rows($sqlResultat); 						 //ANTALL RADER I RESULTATET AV MYSQL KALLET
kobleFra();														//KOBLER FRA DATABASEN


for ($r=1;$r<=$antallRader;$r++){
	$rad=mysql_fetch_array($sqlResultat);								//NY RAD HENTET FRA SPoRRINGSRESULTATET

	$TorgetId= $rad[0];
	$IgeirKoder =$rad[2];
	$typerTypekategori=$rad[1];
	$uderkatigeirkode=$rad[3];
	$typerTypekategori= $rad[4];
	$bildeFilnavn=$rad[5];
	$igeirHeader=$rad[6];
	$igeirPris=$rad[7];

	echo" <div id='productBox'>
			<div class='pcontent'>";																// NY RAD HENTET FRA SPoRRINGSRESULTATET
	echo "<div class='productHead'><h5>$igeirHeader</h5></div>"; 	// AVSLUTTER productHead
	echo "<div class='productbox'>";
	echo "<span><form method='post' action='productpage.php' name='gotoproduct' id='gotoproduct'>
	<input type='hidden' value='$IgeirKoder' name='igeirkode' id='igeirkode'>
	<input type='image' src='../$bildeFilnavn' value='Gå til produkt' name='goto' id='goto'>";
	echo "<div class='badgeCount'>";
	echo "<p>Pris: $igeirPris kr</p>";
	echo "<i>$tuperTypeKategori</i>";
	echo "</div>";    // AVSLUTTER badgeCount
	echo "</form>";   // AVSLUTTER bildevisning
	echo "</div>";    // AVSLUTTER productbox
	echo "</div>";    // AVSLUTTER pcontent
	echo "</div>";    //AVSLUTTER  productBox
}
?>
</div>
<!--avslutter otherSimular//  -->
</section>
<!-- //avslutter producktpage// -->
</div>
<!-- //avslutter content4// -->

<?php
$intKnappen = $_POST["interessert"];											// DEFINERER ENDRE KNAPP FOR KLASSE
if($intKnappen){																	// SJEKKER OM ENDRE KNAPPEN FOR STUDENT ER TRYKKET

	$igeirkode=$_POST["igeirkode"];
	$brukerId= $_SESSION["id"];
	$Dato	= date("Y-m-d h:i:s");													// SETTER DATOEN FOR NÅR EN NYHET BLIR LAGET

	leggTilInteresserte($igeirkode,$brukerId,$Dato);
	}

	include("../footer.php");


	?>
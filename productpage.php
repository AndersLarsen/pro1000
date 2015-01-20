<?php

/**
* Her vises selve produktet
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
* @author   Original Author <gjermundwedvik@gmail.com>
* @copyright  2013-2018
* @license    http://www.php.net/license/3_01.txt
* @link   http://student.hive.no/pro10005/1
*
*/

$title = '..ER JEG I BRUK?..';															 // 	LEGGER TIL TITEL PÅ SIDEN.
include("header.php"); 																	// INKLUDERER HEADER
$brukerId=$_SESSION['id'];																// HENTER ID PÃ… SESSION

$goto=$_POST["goto"];
$igeirKode=$_POST["igeirkode"];

kobleTil();

$sqlSetning="

SELECT igeir.IgeirKode, igeir.Bud, igeir.BildeId, igeir.Header, igeir.Pris, igeir.BrukerId, igeir.Beskrivelse,
bilde.Filnavn, bilde.Beskrivelse,
bruker.BrukerFornavn, bruker.BrukerEtternavn, bruker.BrukerMail
From igeir  JOIN bilde ON igeir.IgeirKode=bilde.Igeirkode
			 JOIN bruker ON bruker.BrukerId=igeir.BrukerID 
 Where igeir.BrukerId ='$brukerId' AND igeir.Igeirkode='$igeirKode'; ";
 

$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
$antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
kobleFra();

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
	$brukerfornavn =$rad[9];
	$brukeretternavn=$rad[10];
	$brukermail=$rad[11];

}
kobleTil();

$sqlSetning="
SELECT underkategori.TorgetId, underkategori.TypeId, underkategori.IgeirKode,
typer.TypeKategori,
torget.TorgKategori
from underkategori 
Natural Join typer 
Natural Join torget 
where IgeirKode='$igeirKode';";
$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
$antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
kobleFra();
 
for ($r=1;$r<=$antallRader;$r++){
	$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPÔøΩRRINGSRESULTATET

	$togetid =$rad[0];
	$typeId =$rad[1];
	$underIgeirkode = $rad[2];
	$typekategori =$rad[3];
	$torgkategori =$rad[4];
}

echo "<div id='content4' class='clearfix'>";							//holder bredden p� siden//

echo"    <a href='#' id='buttonBack'><p> forrige </p></a> ";			 //forrige knappen p� venstre side av produktsiden//
echo"    <a href='#' id='buttonNext'><p> neste </p></a>";  				//neste knappen p� h�yre side av produktsiden//

echo"  <section id='productpage' class='clearfix'>
    <div id='productPresentation'>";								  // Presentasjon av produktet//
  echo"    <div id='prodHeader'> ";									 //Produktets overskrift//
    echo"    <h2>$header</h2>
      </div> ";														 //avslutter header//
    echo"    <div class='upperblocks'>";							  //De tre �verste boksene med visning av Pris, Siste bud og Product ID//
  echo"        <p class='byUserText'>Pris:</p><p class='byUserNr'>$pris,-</p>
        </div>";																		  //avslutter 'Pris' boksen//
 echo"       <div class='upperblocks'>
          <p class='byUserText'>Høyeste bud:</p><p class='byUserNr'>$bud,-</p>
        </div> "; 														//avslutter 'Siste bud' boksen//
    echo"    <div class='upperblocks'>
          <p class='byUserText'>Product id:</p><p class='byUserNr'>$igeirKode</p>
        </div>";													 //avslutter produkt id boksen og den siste diven i visning av de tre boksene under overskrift//
          
   echo"       <div id='slideshow' class'clearfix'>";  //Bildevisning av produkt//
  echo"          <ul id='css3-slider'>
              <li>
                <input type='radio' id='s1' name='num' checked='true' />
                <label for='s1'>1</label>
                <a href='javascript:void(0);'>
                  <img src='$filnavn' alt='$bildebeskrivelse' />
                  <span>$header</span>";							 //tekst som kommer under bilde//
   echo"             </a>
              </li>
             
            </ul>
          </div>";//avslutter bilde presentasjon//
		
		
 echo"     <div id='description'>
        <h4>Beskrivelse:</h4>
          <p>
            $beskrivelse 
          </p>
      </div>";																//avslutter description//

 echo " <div id='byUser'>"; 												//brukerens bokser - personen som har lagt ut annonsen//
echo"        <div id='byUserWho'><p class='profileText'>Lagt ut av:</p></div>
        <div id='byUserRange'><p class='Text'></p></div>
        <div id='byUserOtherProducts'><p class='Text'>Andre annonser:</p></div>";
     																		   //ADVARSEL! disse tre boksene er laget med linjer langs hele 'byUser' og ikke individult i bokser//
   echo"     <div id='byUserName'>
          <div class='profilePicProd clearfix'>
            <a href='#'><img src='http://is.hive.no/pro10005/1/applikasjon/img/userPic.jpg' class='center' /></a>
          </div>
            <h3>$brukerfornavn $brukeretternavn</h3>
        </div>";																//avslutter boks med navn og profilbilde//
      echo"  <div id='byUserRangeR'>
          <h3>Send Mail :<a href='mailto:$brukermail'>$brukerfornavn $brukeretternavn</a><h3>
        </div>";																//avslutter rangeringsboks//
      echo  "   <div id='byUserOtherProductsCont'>";										//visning av brukerens andre produkter//
      
      kobleTil();
      
      $sqlSetning="
SELECT igeir.IgeirKode, igeir.BrukerId, igeir.Beskrivelse,
bilde.Filnavn, bilde.Beskrivelse
From igeir  JOIN bilde ON igeir.IgeirKode=bilde.Igeirkode
Where igeir.BrukerId ='$brukerId' limit 4;";
      
      $sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
      $antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
      kobleFra();
      
      
      for ($r=1;$r<=$antallRader;$r++){
      	$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPÔøΩRRINGSRESULTATET
      $igeirKode = $rad[0];
      $brukerId = $rad[1];
      $beskrivelse = $rad[2];
      $filnavn= $rad[3];
      $beskrivelse=$rad[4];
 
      
      echo    "  <div class='otherProducts clearfix'>";
      
      
echo"      <a href='#'><img src='$filnavn'alt='$beskrivelse' /></a>";
    																			//avslutter visning av brukerens produkter//
echo"        </div>";																		 //avslutter andre produkter av bruker bilde.//

      }
      echo"    </div> ";
   echo" </div>";																			 //avslutter brukerens bokser - personen som har lagt ut annonsen//
  echo"  </div> ";																				//avslutter productPresentation//
  
  

  kobleTil();
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
where underkategori.TorgetId='$togetid' LIMIT 5 ;";
  
  $sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
  $antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
  kobleFra();
  
  
  for ($r=1;$r<=$antallRader;$r++){
  	$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPÔøΩRRINGSRESULTATET
  	
  	$TorgetId= $rad[0];
  	$IgeirKoder =$rad[1];
	$typerTypekategori=$rad[2];
  	$uderkatigeirkode=$rad[3];
  	$typerTypekategori= $rad[4];
  	$bildeFilnavn=$rad[5];
  	$igeirHeader=$rad[6];
  	$igeirPris=$rad[7];
  	
  	echo" <div id='otherSimular' class='clearfix'>
    <div class='otherSimularProducts'> "; 											//De tre �verste boksene med visning av Pris, Siste bud og Product ID//
    echo"   
          <div id='productBox'>
          
            <div class='pcontent'>";          // NY RAD HENTET FRA SPØRRINGSRESULTATET
  echo "<div class='productHead'><h5>$igeirHeader</h5></div>";
  echo "<div class='productbox'>";
  echo "<p>Pris: $igeirPris kr</p>";
  echo "<div class='badgeCount'>";
  echo "<a href='#'><img src='$bildeFilnavn'/></a>";
  echo "</div>";
  echo " <span><a href='#' >$typerTypekategori</a></span>";
  echo "            </div>
  </div>
</div>
    </div> "; 																	//avslutter annonsen//
  	  
  }
  
 																//avslutter annonsen//
 ?>   
  </div> <!--avslutter otherSimular//  -->

  </section><!-- //avslutter producktpage// --> 
</div><!-- //avslutter content4// -->

<?php
include("footer.php")
?>
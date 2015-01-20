<?php
/*
 *Torget og alle underkategorier
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
$title = '..TORGET..'; // 	LEGGER TIL TITEL PÅ SIDEN.

 include("header.php");
$tall =randomReklame() ?>
<div id="content" class="clearfix">
  <div id="reklame">
    <?php kobleTil();                     // KOBLER TIL DATABASEN
    $sqlSetning="SELECT ReklameId,Firma,Filnavn,Link,Alternativ FROM reklame Where ReklameId='$tall';"; // SQL SP�RRING
    $sqlResultat=mysql_query($sqlSetning) or die(mysql_error());    // KJoRER SQL SPoRRING I DATABASEN
    $antallRader=mysql_num_rows($sqlResultat);          // ANTALL RADER I RESULTATET AV MYSQL KALLET
    kobleFra();                     // KOBLER FRA DATABASEN

   for ($r=1;$r<=$antallRader;$r++){            // FOR-LOKKE FOR HVER LINJE FRA NYHETSTABELLEN
      $rad=mysql_fetch_array($sqlResultat);           // NY RAD HENTET FRA SPoRRINGSRESULTATET
      echo " <div id='advertisingTop' class='clearfix'>
      <a href='$rad[3]' target='_blank'>";           // SKRIVER UT STARTEN PAA SKJEMAET
      echo "<img class='advertising' id='advertisingTop' src='admin/$rad[2]' alt='$rad[4]' title='$rad[1]' />";         // SKRIVER UT SKJEMAET
    }
    echo "   </a> </div>"; //AVSLUTTER advertisingTop  ?>
  </div> <!--AVSLUTTER reklame-->
  <section id="store">
    <div id="storeSetup" class="clearfix">

      <div class="menuLeftFolder">
        <h2>Torget</h2>
          <ul>
            <a href="http://andersborglarsen.com/pro1000/category/other_stuff.php" class="button1"> Annet</a>  
            <a href="http://andersborglarsen.com/pro1000/category/antique_art.php" class="button1"> Antikk og kunst</a>  
            <a href="http://andersborglarsen.com/pro1000/category/children_parents.php"class="button1"> Barneutstyr</a>  
            <a href="http://andersborglarsen.com/pro1000/category/parts.php"class="button1"> Bil-, mc- og båttilbehør</a>  
            <a href="http://andersborglarsen.com/pro1000/category/books.php"class="button1"> Bøker og blader</a>  
            <a href="http://andersborglarsen.com/pro1000/category/data_tele.php"class="button1"> Data og Tele</a>  
            <a href="http://andersborglarsen.com/pro1000/category/pets_equipment.php"class="button1"> Dyr og utstyr</a>   
            <a href="http://andersborglarsen.com/pro1000/category/business.php"class="button1">For Næringsliv</a>  
            <a href="http://andersborglarsen.com/pro1000/category/health_wellness.php"class="button1"> Helse og velvære</a>  
            <a href="http://andersborglarsen.com/pro1000/category/hobby.php"class="button1"> Fridtid hobby og underholdning</a>
            <a href="http://andersborglarsen.com/pro1000/category/house_garden.php"class="button1"> Hus, Hytte Hage</a>  
            <a href="http://andersborglarsen.com/pro1000/category/white_goods.php"class="button1">  Hvitevarer</a>  
            <a href="http://andersborglarsen.com/pro1000/category/interior_kitchen.php"class="button1"> Interiør og kjøkkenutstyr</a>  
            <a href="http://andersborglarsen.com/pro1000/category/clothing_watches_jewelry.php"class="button1"> Klær, klokker og smykker</a>  
            <a href="http://andersborglarsen.com/pro1000/category/sound_vision.php"class="button1"> Lyd og bilde</a>  
            <a href="http://andersborglarsen.com/pro1000/category/furniture.php"class="button1"> Møbler</a>  
            <a href="http://andersborglarsen.com/pro1000/category/music.php"class="button1"> Musikk</a>  
            <a href="http://andersborglarsen.com/pro1000/category/collectibles.php"class="button1"> Samlerobjekt</a>  
            <a href="http://andersborglarsen.com/pro1000/category/sports_outdoors.php"class="button1"> Sport og friluftsliv</a>
          </ul> <!--AVSLUTTER liste med class='button1'-->
      </div> <!--AVSLUTTER menuLeftFolder-->
      
      <div class='productfolder'>
        <?php 
        kobleTil();
        $sqlSetning="SELECT underkategori.TorgetId, underkategori.TypeId, underkategori.IgeirKode,
        typer.TypeKategori,
        torget.TorgKategori,
        bilde.Filnavn,
        igeir.header,
        igeir.pris,
 		igeir.Teller
        from underkategori 
        Natural Join typer 
        Natural Join torget
        Natural Join bilde 
        JOIN igeir on igeir.IgeirKode =underkategori.IgeirKode ORDER BY igeir.Teller DESC;";
        $sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
        $antallRader=mysql_num_rows($sqlResultat);             // ANTALL RADER I RESULTATET AV MYSQL KALLET
        kobleFra();

        for ($r=1;$r<=$antallRader;$r++){
          $rad=mysql_fetch_array($sqlResultat); 
          $torgetId= $rad[0];
          $TypeId=$rad[1];
          $igeirkode=$rad[2];
          $type=$rad[3];
          $torg=$rad[4];
          $filnavn=$rad[5];
          $header=$rad[6];
          $pris=$rad[7];

          echo" <div id='productBox'>  
                <div class='pcontent'>";          // NY RAD HENTET FRA SPoRRINGSRESULTATET
          echo "<div class='productHead'><h5>$header</h5></div>"; // AVSLUTTER productHead
          echo "<div class='productbox'>";
          echo "<form method='post' action='category/productpage.php' name='gotoproduct' id='gotoproduct'>
          <input type='hidden' value='$igeirkode' name='igeirkode' id='igeirkode' >
          <input type='image' src='$filnavn' value='Gå til produkt' name='goto' id='goto' class'center' title='Gå til produkt'>";
          echo "<div class='badgeCount'>";
          echo "<p>Pris: $pris kr</p>";
          echo "<i>$type</i>";          
          echo "</div>"; // AVSLUTTER badgeCount
          echo "</form>"; // AVSLUTTER bildevisning
          echo "</div>"; // AVSLUTTER productbox
          echo "</div>"; // AVSLUTTER pcontent
          echo "</div>"; //AVSLUTTER  productBox
               } ?>
  </section> <!--AVSLUTTER SECTION id=store-->
</div> <!--AVSLUTTER content & clearfix-->
<?php include("footer.php");?>
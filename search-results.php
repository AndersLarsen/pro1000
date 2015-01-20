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
    $sqlSetning="SELECT ReklameId,Firma,Filnavn,Link,Alternativ FROM pro10005.reklame Where ReklameId='$tall';"; // SQL SP�RRING
    $sqlResultat=mysql_query($sqlSetning) or die(mysql_error());    // KJoRER SQL SPoRRING I DATABASEN
    $antallRader=mysql_num_rows($sqlResultat);          // ANTALL RADER I RESULTATET AV MYSQL KALLET
    kobleFra();                     // KOBLER FRA DATABASEN

    echo " <div id='advertisingTop' class='clearfix'>
              <a href='$rad[3]'>";           // SKRIVER UT STARTEN PAA SKJEMAET
    for ($r=1;$r<=$antallRader;$r++){            // FOR-LOKKE FOR HVER LINJE FRA NYHETSTABELLEN
      $rad=mysql_fetch_array($sqlResultat);           // NY RAD HENTET FRA SPoRRINGSRESULTATET
      echo "<img class='advertising' id='advertisingTop' src='admin/$rad[2]' alt='$rad[4]' title='$rad[1]' />";         // SKRIVER UT SKJEMAET
    }
    echo "   </a> </div>"; //AVSLUTTER advertisingTop  ?>
  </div> <!--AVSLUTTER reklame-->
  <section id="store">
    <div id="storeSetup" class="clearfix">

      <div class="menuLeftFolder">
        <h2>Torget</h2>
          <ul>
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/other_stuff.php" class="button1"> Annet</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/antique_art.php" class="button1"> Antikk og kunst</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/children_parents.php"class="button1"> Barneutstyr</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/parts.php"class="button1"> Bil-, mc- og båttilbehør</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/books.php"class="button1"> Bøker og blader</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/data_tele.php"class="button1"> Data og Tele</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/pets_equipment.php"class="button1"> Dyr og utstyr</a>   
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/business.php"class="button1">For Næringsliv</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/health_wellness.php"class="button1"> Helse og velvære</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/hobby.php"class="button1"> Fridtid hobby og underholdning</a>
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/house_garden.php"class="button1"> Hus, Hytte Hage</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/white_goods.php"class="button1">  Hvitevarer</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/interior_kitchen.php"class="button1"> Interiør og kjøkkenutstyr</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/clothing_watches_jewelry.php"class="button1"> Klær, klokker og smykker</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/sound_vision.php"class="button1"> Lyd og bilde</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/furniture.php"class="button1"> Møbler</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/music.php"class="button1"> Musikk</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/collectibles.php"class="button1"> Samlerobjekt</a>  
            <a href="http://is.hive.no/pro10005/1/applikasjon/category/sports_outdoors.php"class="button1"> Sport og friluftsliv</a>
          </ul> <!--AVSLUTTER liste med class='button1'-->
      </div> <!--AVSLUTTER menuLeftFolder-->
      <div class='productfolder02'>
        <?php   sokfront() 														// henter inn søkefunksjon?>
              
  </section> <!--AVSLUTTER SECTION id=store-->
</div> <!--AVSLUTTER content & clearfix-->
<?php include("footer.php");?>
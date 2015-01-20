<?php
/**
 * Entry point for side
* Menystruktur logg inn , registrer deg o.l
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

$title = '..VELKOMMEN TIL IGEIR..';			//SETTER TITTEL Pa… SIDEN I BROWSERFANE
$brukerId=$_SESSION['id'];																// HENTER ID PÃƒâ€¦ SESSION

include('header.php');																			//INKLUDERER HEADER
?>

<div id="contentStartPage" class="clearfix">
  <section id="start">
    <div id="torgetStartpage" class="clearfix">
      <div class="startButtonBox1">
        <a href="torget.php" class="button3"> <p>Torget</p></a>  
        <a href="#" title="Kommer snart!" class="button3"><p>Bil</p></a>  
        <a href="#"title="Kommer snart!" class="button3"> <p>Mc</p></a>  
      </div>
      <div class="startButtonBox2">
		<a href="#" title="Kommer snart!" class="button3"> <p>Båt</p></a>  
        <a href="#" title="Kommer snart!" class="button3"> <p>Reise</p></a>  
        <a href="#"title="Kommer snart!" class="button3"> <p>Jobb</p></a>     
      </div>
      <div class="startButtonBox3">
		<a href="#" title="Kommer snart!" class="button3"> <p>Eindom</p></a>  
        <a href="#" title="Kommer snart!" class="button3"> <p>Bygg og Anlegg</p></a>  
        <a href="#"title="Kommer snart!" class="button3"> <p>Næringsmarked</p></a> 
      </div>
    </div>
  </section>
  <section id="right">
    <div class="newsFeed">
      <div class="head">
        <h1>Nyheter / info-feed</h1>
      </div>
        <div class='boxy'>
          <?php
            echo "<br /><div id='nyheter'>";						// SKRIVER UT NYHETER ER RESERVERT TIL KUN TRE 
            echo "<table>";
            showNewsIndex();
         
            echo "</table>";
            echo "</div>";
            echo "<br />";
          ?>
        </div>
    </div>
  </section>
</div>
<?php include 'footer.php';											// INKLUDERER FOOTER.
?>
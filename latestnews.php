<?php
/**
 * Skriver ut de siste  5 nyhetene på en side
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
$title = '..NYHETER ..'; 											// 	LEGGER TIL TITEL PÅ SIDEN.

include 'header.php';												// INKLUDERER HEADER

?>
    <div id="content3" class="clearfix">
<?php echo "<br /><div id='nyheter'>";								//SKRIVER UT NYHETEN
echo "<table>";
showNews();															//LEGGER TIL FUNCTION SOM FINNER FREM NYHETER


echo "</table>";
echo "</div>";
echo "<br />";
?>
</div>
<?php 
include 'footer.php';												// INKLUDERER FOOTER
?>
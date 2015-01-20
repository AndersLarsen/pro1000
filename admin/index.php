<?php 
/**
 * Her ligger selve indeksfilen.
 * Dette er filen som bygger hele websiden ved første kall.
 * Det er hit brukerene blir sendt når dem går på URL adressen.
 * Filen i seg selv er uten innhold(tekst), kun referanser(includes)
 * til andre filer.
 * 
 * PHP version 5
 * 
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 * 
 * @author		Original Author <andersborglarsen@gmail.com>
 * @author		Original Author <haavard@ringshaug.net>
 * @author		Original Author <gjermundwedvik@gmail.com>
 * @copyright 	2013-2018
 * @license		http://www.php.net/license/3_01.txt
 * @link		http://student.hive.no/pro10005/1
 * 
 */
$title = '..IGEIR CMS ..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");				// INKLUDERER HEADER
include("meny.php");				// INKLUDERER MENYEN 
include("nyheter.php");				// INKLUDERER NYHETER
include("slutt.html"); 				// INKLUDERER FOOTER

?>

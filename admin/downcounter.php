<?php
/**
 * Counter fil som teller ned til tidsfrister som vi har i
 * PRO1000 slik at vi vet hvor mye tid vi har igjen.
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
 * @author		Original Author <paran.selvanathan@gmail.com>
 * @copyright 	2013-2018
 * @license		http://www.php.net/license/3_01.txt
 * @link		http://student.hive.no/pro10005/1
 *
 */
echo "<p class='counter'>";

// TID TIL FJERDE PRESENTASJON
// $date = strtotime("May 29, 2013 12:30 PM");															// SETTER HVILKEN TID VI TELLER TIL
// $remaining = $date - time();																		// REGNER UT GJENSTÅENDE TID
// $days_remaining = floor($remaining / 86400);														// REGNER UT GJENSTÅENDE DAGER
// $hours_remaining = floor(($remaining % 86400) / 3600);												// REGNER UT GJENSTÅENDE TIMER
// echo "Det er $days_remaining dager og $hours_remaining timer igjen til fjerde presentasjon<br />";	// SKRIVER UT STRENGEN

// FRIST FOR INNLEVERING
$date = strtotime("May 30, 2013 1:00 PM");															// SETTER HVILKEN TID VI TELLER TIL
$remaining = $date - time();																		// REGNER UT GJENSTÅENDE TID
$days_remaining = floor($remaining / 86400);														// REGNER UT GJENSTÅENDE DAGER
$hours_remaining = floor(($remaining % 86400) / 3600);												// REGNER UT GJENSTÅENDE TIMER
echo "Det er $days_remaining dager og $hours_remaining timer igjen til innlevering</p>";			// SKRIVER UT STRENGEN

?>
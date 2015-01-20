<?php

/**
 * Hvorfor oss
*
* Gir mulighet for registrering av informasjon som blr vist i registrering frontend.
* Gir muligheten til å legge til en textbox front end.
*
* PHP version 5
*
* LICENSE: This source file is subject to version 3.01 of the PHP license
* that is available through the world-wide-web at the following URL:
* http://www.php.net/license/3_01.txt.  If you did not receive a copy of
* the PHP License and are unable to obtain it through the web, please
* send a note to license@php.net so we can mail you a copy immediately.
*
* @author		Original Author <andersborglarsen@gmail.com>
* @author		Original Author <haavard@ringshaug.net>
* @copyright 	2013-2018
* @license		http://www.php.net/license/3_01.txt
* @link		http://student.hive.no/pro10005/1
*
*/
$title = '..VISER SØKET..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");											// INKLUDERER BEGYNNESEN AV DESIGNET
// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN

 kobleTil();													// KOBLER TIL DATABASEN

 if(isset($_GET['search']))										/* HENTER SØKER INPUT*/
 {
 	$search = $_GET['search'];
 }
 
 $search = trim($search);
 $search = preg_replace('/\s+/', ' ', $search);					//TAR BORT SPACING
 
 $keywords = explode(" ", $search);								// DELER OPP SØKEORDET 
																// TAR BORT TOMME RADER
 $keywords = array_diff($keywords, array(""));
 
 																//SETTER OPP MYSQL SPØRRINGEN
 if ($search == NULL or $search == '%'){
 } else {
 	for ($i=0; $i<count($keywords); $i++) {
 		$query = "
SELECT BrukerFornavn, BrukerEtternavn, BrukerMail, bruker.BrukerId  FROM bruker
			
 				WHERE BrukerFornavn LIKE '%".$keywords[$i]."%'".
 				" OR BrukerEtternavn LIKE '%".$keywords[$i]."%'" .
 				" OR BrukerMail LIKE '%".$keywords[$i]."%'" .
 				" ORDER BY BrukerId";													//SQL SPØRRINGEN SOM DEFINERER SØKET
 	}
 
 																							//LAGRER RESULTATET OG RETURNER DIE HVIS SQL ERROR
 	$result = mysql_query($query) or die(mysql_error());
 }
 if ($search == NULL or $search == '%'){
 } else {
 																							//TELLER ANTALL RADER
 	$count = mysql_num_rows($result);
 }
 

 echo "<center>";
 echo "<br/><form name='searchform' method='GET' action='sok.php'>";
 echo "<input type='text' name='search' size='20' TABINDEX='1' />";
 echo " <input type='submit' value='Search' />";
 echo "</form>";
echo" Antall rader Skrevet :$count.";														 //HVIS SØKET ER NULL IKKE GJØR NOE HVIS IKKE SØK.
 if ($search == NULL) {
 } else {
 	echo "Du søkte etter : <b><FONT COLOR=\"blue\">";										// PRINTER UT HVA MAN HAR SØKT ETTER
 	foreach($keywords as $value) {
 		print "$value ";
 	}
 	echo "</font></b>";
 }
 echo "<p> </p><br />";
 echo "</center>";
 
 //Hvis man ikke fyller inn noe i boksen.
 if ($search == NULL){
 	echo "<center><b><FONT COLOR=\"red\">Venligst fyll inn felte for å søke</font></b><br /></center>"; // FEILMELDING HVIS MAN IKKE HAR FØRT NOE INN I SØKEFETET
 } elseif ($search == '%'){
 	echo "<center><b><FONT COLOR=\"red\">Venligst fyll inn felte for å søke</font></b><br /></center>";// FEILMELDING HVIS MAN IKKE HAR FØRT NOE INN I SØKEFETET
 } elseif ($count <= 0){
 	echo "<center><b><FONT COLOR=\"red\">Ingen resultater returnert fra databasen</font></b><br /></center>";// FEILMELDING HVIS MAN IKKE HAR FUNNET NOE INN I DATABASEN
 } else {																									
 	echo "<table id='search' width='60%' class='bottomBorder'>";
 	echo "<thead>";
 	echo "<tr>";
 	echo "<th align=left>Bruker Fornavn</th>";
 	echo "<th align=left><b>Bruker etternavn</th>";
 	echo "<th align=left><b>Bruker Mail</th>";
 	echo "<th align=left> Bruker Id</th>";
 	echo "<th align=left></th>";
 	echo "<th align=left></th>";													//SKRIVER UT RESULTATET PÅ DET MAN FINNER
 	
 	echo "<tr>";
 	echo "</thead>";
 
 	$color1 = "#d5d5d5";
 	$color2 = "#e5e5e5";

 	while($row = mysql_fetch_array($result))															
 	{
 		//Row color alternates for each row
 		$row_color = ($row_count % 2) ? $color1 : $color2;
 		//table background color = row_color variable 				skriver ut radene 
 		echo "<tbody>";
 		echo "<tr>";
 		echo "<td>".$row[0]."</td>";
 		echo "<td>".$row[1]."</td>";
 		echo "<td>".$row[2]."</td>";
 		echo "<td>".$row[3]."</td>";
 		echo "<td></td>";
 		echo "<td></td>";
 			
 			
 		echo "</tr>";
 		echo "</tbody>";
 		 	
 		$row_count++;			
 	
 	}
 	
 }
 echo "</table><br />";  											// SLUTTEN P� TABELLEN
 

 if ($search == NULL or $search == '%') {
 } else {
 	//clear memory
 	mysql_free_result($result);
 }


include ("../slutt.html");													// INKLUDERER FOOTEREN
?>  
<?php
/**
 * Behandle Markedsplass
 * Fjerne og legge til kategorier
 * Sortere treff etter krev
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
$title = '..REGISTER NY ANNONSE..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include 'start.php';											// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();													// SJEKKER OM EN PERSON ER LOGGET INN
?>

<form class="igeir_skjema" method="post" id="registrerInfoSkjema"
	name="registrerInfoSkjema" enctype="multipart/form-data">
	<ul><br>
	<h2>Legg inn informasjon</h2>

		<li><label for="header">Overskrift</label> <input type="text"
			id="header" name="header" value="<?php @print $_POST ["header"]; ?>"required>
		</li>
		<li><label for="bud">Bud</label><input type="text" id="bud" name="bud"
			value="<?php @print $_POST ["bud"]; ?>"required></li>
		<li><label for="pris">Pris</label> <input type="text" id="pris"
			name="pris" value="<?php @print $_POST ["pris"]; ?>"required></li>
		<li><label for="brukerid">Brukerid</label><input type="text"
				id="brukerid" name="brukerid"
			value="<?php @print $_POST ["brukerid"]; ?>"required></li>

		<!--   <label for="bilde">Bilde</label> <input type="file" id="bilde" name="bilde"> <br/> -->
		<li><label for="beskrivelse">Beskrivelse</label>
		 <textarea row="20" cols="50"
			id="beskrivelse" name="beskrivelse" placeholder="beskrivelse" required></textarea></li>

		<li><label for="active"> Aktiv?</label>Nei <input
			type="radio" name="active" value="0"> Ja<input type="radio"
			name="active" value="1" >
		</li>
		
		<li>
		</li>
		<li><label for="privat">Privat</label> Nei<input
			type="radio" name="private" value="0"> Ja<input type="radio"
			name="private" value="1" >
		</li>
		<li><input type="submit" value="Registrer" id="registrerInfoKnapp"
			name="registrerInfoKnapp" class="submit" />
		</li>
	</ul>
</form>
<br />

<?php
    if (isset($_POST ["registrerInfoKnapp"])) {								// LYTTER TIL OM SUBMITKNAPPEN BLIR TRYKKET
		$igeirKode=igeirKode();												// HENTER UT EN NY IGEIRKODE
        $header=$_POST ["header"];											// HENTER INPUT FRA SKJEMAET
        $bud=$_POST["bud"];													// HENTER INPUT FRA SKJEMAET
        $pris=$_POST ["pris"];												// HENTER INPUT FRA SKJEMAET
        $brukerid=$_POST["brukerid"];										// HENTER INPUT FRA SKJEMAET
        $beskrivelse=$_POST ["beskrivelse"]; 								// HENTER INPUT FRA SKJEMAET
        $active=$_POST["active"];											// HENTER INPUT FRA SKJEMAET
        $private=$_POST["private"];											// HENTER INPUT FRA SKJEMAET
        
        if (!$header||!$bud||!$pris ||!$brukerid || !$beskrivelse) {		// SJEKKER AT ALLE FELTENE ER FYLT UT
            print ("Annonsen er ikke fullstendig, vennligst sjekk at alt er fylt ut og at bilde er lastet opp!");	// SKRIVER UT FEILMELDING
        } else {
        $sqlResultat = execute("INSERT INTO igeir
 						 (`IgeirKode`, `Bud`, `Beskrivelse`, `Header`, `BrukerId`, `Pris`, `Aktiv`, `Privat`,`Status`) 
 						VALUES ('$igeirKode', '$bud', '$beskrivelse', '$header', '$brukerid', '$pris', '$active', '$private');");	// SQLSETNINGEN SOM SKAL KJØRES I DATABASEN
          
            print ("Annonsen er registrert");              					// SKRIVER UT BEKREFTELSESMELDING PÅ AT DATAENE ER LAGRET
            }
    }
include("../slutt.html"); 													// INKLUDERER FOOTEREN
?>
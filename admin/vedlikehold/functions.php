<?php

function sec_session_start() {
	$session_name = 'sec_session_id'; // Set a custom session name
	$secure = false; // Set to true if using https.
	$httponly = true; // This stops javascript being able to access the session id.

// 	ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies.
	$cookieParams = session_get_cookie_params(); // Gets current cookies params.
	session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
	session_name($session_name); // Sets the session name to the one set above.
	session_start(); // Start the php session
	session_regenerate_id(true); // regenerated the session, delete the old one.
}

function igeir_session_start() {
	$session_name = 'igeir_session_igeir'; // Set a custom session name
	$secure = false; // Set to true if using https.
	$httponly = true; // This stops javascript being able to access the session id.

// 	ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies.
	$cookieParams = session_get_cookie_params(); // Gets current cookies params.
	session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
	session_name($session_name); // Sets the session name to the one set above.
	session_start(); // Start the php session
	session_regenerate_id(true); // regenerated the session, delete the old one.
}

function sjekkLogin() {
	if($_SESSION['innlogget'] == false) {
		header('Location: ../index.php');
	}
}

function krypterPassord($passord){
	$salt='6rounds=4567pro1000';
	$passord=crypt($passord,$salt); 								// KRYPTERER PASSORDET OG BRUKER SALT VARIABEL FOR SHA512
	return $passord;
}

function igeirKode() {
	$unique_ref_length = 8;									// Definerer lengden på hvor lang den unike nøkkelen skal være
	$unique_ref_found = false;								// True/False variabel som lar oss få vite om vi har funnet en unik nøkkel eller ikke
	$possible_chars = "BCDFGHJKMNPQRSTVWXYZ"; 				// Definer mulige chars som skal brukes, her unngår vi å bruke O og null fordi de er ganske like.
	$possible_ints = "23456789";

	while (!$unique_ref_found) {							// Fortsetter å generere nye nøkler til vi finner en unik en som ikke er i bruk
		$unique_ref = "";									// Starter med en blank nøkkel
		$i = 0;												// Teller for å holde kontroll på hvor mange chars vi har lagt til

		while ($i < $unique_ref_length) {					// Legger til randomchars fra $possible_chars til $unique_ref inntil $unique_ref_length er tilfredsstilt

			// Velger random chars fra $possible_chars strengen
			$char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);
			$int = substr($possible_ints, mt_rand(0, strlen($possible_ints)-1), 1);
			if($i > 3)
				$unique_ref .= $int;
			if($i == 3)
				$unique_ref .= "-";
			if($i < 3)
				$unique_ref .= $char;

			$i++;
		}

		// Den unike nøkkelen er generert.
		// Sjekker om den eksisterer i databasen eller ikke.
		kobleTil();	
		$query = "SELECT IgeirKode FROM igeir WHERE IgeirKode='$unique_ref';";
		$result = mysql_query($query) or die(mysql_error().' '.$query);
		$count = mysql_num_rows($result);
		kobleFra();

		if ($count == 0) {
			$unique_ref_found = true;							// Den unike nøkkelen er funnet, setter $unique_ref_found til true og kommer meg ut av løkken
				
		}
		mysql_close();
	}
	return $unique_ref;
}

/*
 * Lager en unik ref for bruker
* Eks; 111-AAAA
*/
function createAdminRef() {
	$unique_ref_length = 7;									// Definerer lengden på hvor lang den unike nøkkelen skal være
	$unique_ref_found = false;								// True/False variabel som lar oss få vite om vi har funnet en unik nøkkel eller ikke
	$possible_chars = "ABCDFGHJKMNPQRSTVWXYZ"; 				// Definer mulige chars som skal brukes, her unngår vi å bruke O fordi den er ganske lik med null.
	$possible_ints = "123456789";							// Definer mulige ints som skal brukes, her unngår vi å bruke null fordi den er ganske lik med O.

	while (!$unique_ref_found) {							// Fortsetter å generere nye nøkler til vi finner en unik en som ikke er i bruk
		$unique_ref = "";									// Starter med en blank nøkkel
		$i = 0;												// Teller for å holde kontroll på hvor mange chars vi har lagt til

		while ($i < $unique_ref_length) {					// Legger til randomchars fra $possible_chars til $unique_ref inntil $unique_ref_length er tilfredsstilt

			// Velger random chars fra $possible_chars strengen
			$char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);
			$int = substr($possible_ints, mt_rand(0, strlen($possible_ints)-1), 1);
			if($i < 3)
				$unique_ref .= $int;
			if($i > 3)
				$unique_ref .= $char;
			if($i == 3)
				$unique_ref .= "-";

			$i++;
		}

		// Den unike nøkkelen er generert.
		// Sjekker om den eksisterer i databasen eller ikke.
		kobleTil();

		$query = "SELECT AdminId FROM admin WHERE AdminId='$unique_ref';";
		$result = mysql_query($query) or die(mysql_error().' '.$query);
		$count = mysql_num_rows($result);

		if ($count == 0) {
			$unique_ref_found = true;							// Den unike nøkkelen er funnet, setter $unique_ref_found til true og kommer meg ut av løkken
		}
		kobleFra();
	}
	return $unique_ref;
}


/*
 * Lager en unik ref for bruker
* Eks; 111-AAAA
*/
function createBrukerRef() {
	$unique_ref_length = 9;									// Definerer lengden på hvor lang den unike nøkkelen skal være
	$unique_ref_found = false;								// True/False variabel som lar oss få vite om vi har funnet en unik nøkkel eller ikke
	$possible_chars = "ABCDFGHJKMNPQRSTVWXYZ"; 				// Definer mulige chars som skal brukes, her unngår vi å bruke O fordi den er ganske lik med null.
	$possible_ints = "123456789";							// Definer mulige ints som skal brukes, her unngår vi å bruke null fordi den er ganske lik med O.

	while (!$unique_ref_found) {							// Fortsetter å generere nye nøkler til vi finner en unik en som ikke er i bruk
		$unique_ref = "";									// Starter med en blank nøkkel
		$i = 0;												// Teller for å holde kontroll på hvor mange chars vi har lagt til

		while ($i < $unique_ref_length) {					// Legger til randomchars fra $possible_chars til $unique_ref inntil $unique_ref_length er tilfredsstilt

			// Velger random chars fra $possible_chars strengen
			$char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);
			$int = substr($possible_ints, mt_rand(0, strlen($possible_ints)-1), 1);
			if($i < 4)
				$unique_ref .= $int;
			if($i > 4)
				$unique_ref .= $char;
			if($i == 4)
				$unique_ref .= "-";

			$i++;
		}

		// Den unike nøkkelen er generert.
		// Sjekker om den eksisterer i databasen eller ikke.
		kobleTil();

		$query = "SELECT BrukerId FROM bruker WHERE BrukerId='$unique_ref';";
		$result = mysql_query($query) or die(mysql_error().' '.$query);
		$count = mysql_num_rows($result);

		if ($count == 0) {
			$unique_ref_found = true;							// Den unike nøkkelen er funnet, setter $unique_ref_found til true og kommer meg ut av løkken

		}
		kobleFra();
	}
	return $unique_ref;
}

/*
 * Lager en unik ref for bruker
* Eks; 123456789
*/
function createBildeNavn() {
	$unique_ref_length = 9;									// Definerer lengden på hvor lang den unike nøkkelen skal være
	$unique_ref_found = false;								// True/False variabel som lar oss få vite om vi har funnet en unik nøkkel eller ikke
	$possible_ints = "123456789";							// Definer mulige ints som skal brukes, her unngår vi å bruke null fordi den er ganske lik med O.

	while (!$unique_ref_found) {							// Fortsetter å generere nye nøkler til vi finner en unik en som ikke er i bruk
		$unique_ref = "";									// Starter med en blank nøkkel
		$i = 0;												// Teller for å holde kontroll på hvor mange chars vi har lagt til

		while ($i < $unique_ref_length) {					// Legger til randomchars fra $possible_chars til $unique_ref inntil $unique_ref_length er tilfredsstilt

			// Velger random chars fra $possible_chars strengen
			$int = substr($possible_ints, mt_rand(0, strlen($possible_ints)-1), 1);
			if($i < $unique_ref_length)
				$unique_ref .= $int;
				$i++;
		}

		// Den unike nøkkelen er generert.
		// Sjekker om den eksisterer i databasen eller ikke.
		kobleTil();

		$query = "SELECT Navn FROM bilde WHERE Navn='$unique_ref';";
		$result = mysql_query($query) or die(mysql_error().' '.$query);
		$count = mysql_num_rows($result);

		if ($count == 0) {
			$unique_ref_found = true;							// Den unike nøkkelen er funnet, setter $unique_ref_found til true og kommer meg ut av løkken
		}
		kobleFra();
	}
	return $unique_ref;
}
/************************ Listeboks Torgkategori ****************************************/

function torgKategoriList(){
	/* Hensikt
	 * 		Henter ut listeboks
	* Parametre
	* 		henter ut fra tabellen torget
	* Returnerer
	* 		skriver ut listeboks med innholde fra torgkategori raden i tabellen
	*/

	$sql = "SELECT Distinct TorgKategori FROM torget;";											// sql setning
	$result = mysql_query($sql) or die ("ikke mulig å hente romtype fra databasen");	// kjører sql spørring
	$numRows = mysql_num_rows($result);													// henter resultat

	// laer dynamisk listeboks basert på rom funnet i databasen
	echo ("<select name='torgKategori' id='torgKategori'>");
	echo ("<option value=''>Alle</option>");

	for($t=1; $t<=$numRows; $t++){
		$row=mysql_fetch_array($result);
		echo "<option value='$row[0]'> $row[0] </option> ";

	}

	echo "</select>";
}


/************************ Listeboks Type ****************************************/

function torgTyperList(){
	/* Hensikt
	 * 		hente ut liste boks
	* Parametre
	* 		henter informasjon fra tabellen typer
	* Returnerer
	* 		returnerer innholde til listeboksen
	*/

	$sql = "SELECT Distinct TypeKategori FROM typer;";											// sql setning
	$result = mysql_query($sql) or die ("ikke mulig å hente romtype fra databasen");	// kjører sql spørring
	$numRows = mysql_num_rows($result);													// henter resultat

	// laer dynamisk listeboks basert på rom funnet i databasen
	echo ("<select name='typeKategori' id='typeKategori'>");
	echo ("<option value=''>Alle</option>");

	for($t=1; $t<=$numRows; $t++){
		$row=mysql_fetch_array($result);
		echo "<option value='$row[0]'> $row[0] </option> ";

	}

	echo "</select>";
}

function kobleTil() {
	$host="andersborglarsen.com.mysql";												// ADRESSE
	$user="andersborglarse";												// BRUKERNAVN
	$password="Bephsen1506";										// PASSORD
	$database="andersborglarse";											// DATABASENAVN
	
	$mainServer = mysql_connect($host,$user,$password);
	mysql_selectdb ($database);				// VELGER DATABASE, RETURNERER ERROR VED FEIL

	if($mainServer == false){
		$host="cs2.slummen.org";
		$user="pro10005";												// BRUKERNAVN
		$password="123Pr010005";										// PASSORD
		$database="pro10005";											// DATABASENAVN

		mysql_connect ($host,$user,$password) or die("Backup Server: " + mysql_error());
		mysql_selectdb ($database) or die(mysql_error());				// VELGER DATABASE, RETURNERER ERROR VED FEIL
	}
}

function kobleFra() {
	mysql_close();
}


/****************************Hente ut kategori varer *********************************/

function underkategoriGruppe ($id){

kobleTil();
$sqlSetning="SELECT * FROM underkategori
NATURAL JOIN typer
NATURAL JOIN torget
NATURAL JOIN markedsplass
NATURAL JOIN igeir
WHERE TorgetId='$id';";
$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
$antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
kobleFra();
}     

function randomReklame() {
	$tabell	= array();											// LAGER EN TOM TABELL
	kobleTil();													// KOBLER TIL DATABASEN
	$sql="SELECT ReklameId FROM reklame;";						// SQL-SETNING
	$resultat=mysql_query($sql) or die(mysql_error());			// KJ�RER SQL-SETNINGEN I DATABASEN
	$antallRader=mysql_num_rows($resultat) or die(mysql_error());	// HENTER UT ANTALL RADER I SVARET
	kobleFra();													// KOBLER FRA DATABASEN
	
	for($i=0; $i<$antallRader; $i++){							// FOR-LøKKE, KJØRER SÅ ANTALL GANGER SOM IV HAR RADER
		$row=mysql_fetch_array($resultat);						// HENTER UT RADENE
		$tabell[$i] = $row[0];									// LEGGER INN VERDIENE I TABELLEN
	}
	
	$randomTall = rand(0, count($tabell)-1);					// VELGER ET RANDOM TALL BLANT ID'ENE FRA REKLAME
	return $tabell[$randomTall];								// RETURNERER EN RANDOM ID
}


function typeList(){
	kobleTil();
	$sql = "SELECT TypeId, Typekategori  FROM typer
			ORDER BY TypeId ASC;";
	$result = mysql_query($sql) or die ("ikke mulig å hente typer fra databasen");
	$numRows = mysql_num_rows($result);
	kobleFra();

	echo ("<select name='type' id='type'>");
	echo ("<option value='$typeId'>Velg kategori</option>");                    /*velger produktets kategori*/

	for($t=1; $t<=$numRows; $t++){
		$row=mysql_fetch_array($result);
		echo "<option value='$row[0]'> $row[1] </option> ";
	}
	echo "</select>";
}
/***********************************Listebokser ***********************************/

function torgetList(){
	kobleTil();
	$sql = "SELECT TorgetId, TorgKategori  FROM torget
			ORDER BY TorgetId ASC;";
	$result = mysql_query($sql) or die ("ikke mulig å hente typer fra databasen");
	$numRows = mysql_num_rows($result);
	kobleFra();

	echo ("<select name='torgKategori' id='torgKategori'>");									/*velger produktets type*/
	echo ("<option value='$torgetId'>Velg produkttype</option>");

	for($t=1; $t<=$numRows; $t++){
		$row=mysql_fetch_array($result);
		echo "<option value='$row[0]'> $row[1] </option> ";
	}
	echo "</select>";
}

/**************************************SØK PÅ VARE FRONTEND**********************************/

Function sokfront(){
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
	
 SELECT igeir.IgeirKode, igeir.Header ,igeir.Beskrivelse ,igeir.Pris,igeir.Bud , bilde.Filnavn FROM igeir
		Join bilde on bilde.IgeirKode=igeir.IgeirKode
 				WHERE Header LIKE '%".$keywords[$i]."%'".
	 				" OR igeir.Beskrivelse LIKE '%".$keywords[$i]."%'" .
	 				" OR igeir.IgeirKode LIKE '%".$keywords[$i]."%'" .
	 				" ORDER BY Pris";													//SQL SPØRRINGEN SOM DEFINERER SØKET
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
	echo"<p> Antall rader Skrevet :$count.</p>";
	echo "<br/><form class='searchbox2' name='searchform' method='GET' action='search-results.php'>";
	echo "<input type='text' class='searchbox_input2' name='search' size='20' TABINDEX='1' />";
			echo " <input type='submit' class='searchbox_submit2' value='Søk' />";
			echo "</form>";
			//HVIS SØKET ER NULL IKKE GJØR NOE HVIS IKKE SØK.
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
	
	
			$color1 = "#d5d5d5";
				$color2 = "#e5e5e5";
	
				while($row = mysql_fetch_array($result))
	
				{
	
				echo" <div id='productBox'>
				<div class='pcontent'>";          // NY RAD HENTET FRA SPoRRINGSRESULTATET
						echo "<div class='productHead'><h5>$row[1]</h5></div>"; // AVSLUTTER productHead
						echo "<div class='productbox'>";
				echo "<form method='post' action='category/productpage.php' name='gotoproduct' id='gotoproduct'>
				<input type='hidden' value='$row[0]' name='igeirkode' id='igeirkode' >
				<input type='image' src='$row[5]' value='Gå til produkt' name='goto' id='goto' class'center' title='Gå til produkt'>";
				echo "<div class='badgeCount'>";
				echo "<p>Pris: $row[3] kr</p>";
				echo "</div>"; // AVSLUTTER badgeCount
          echo "</form>"; // AVSLUTTER bildevisning
	          echo "</div>"; // AVSLUTTER productbox
	          echo "</div>"; // AVSLUTTER pcontent
	          echo "</div>"; //AVSLUTTER  productBox
	          $row_count++;
	
				}
	
				}
			// SLUTTEN P� TABELLEN
	
	
			if ($search == NULL or $search == '%') {
				} else {
				//clear memory
				mysql_free_result($result);
			}
			
}
/***************Hent Profil Bilde*************************************************/
Function profilBilde(){
	kobleTil();												//KOBLER TIL
	$sqlSetning="
	SELECT * from profil where BrukerId='$brukerId';"; // SQL SPÃ˜RRINGEN
	
	$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());
	$antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
	kobleFra();
	$profilId = $rad[0];
	$profilBrukerId= $rad[1];
	$Profilbildenavn= $rad[2];
	$profilFilnavn= $rad[3];
	$profilBeskrivelse= $rad[4];
	kobleFra();												//KOBLER FRA
}


/*
 * Egne funksjoner som kun brukes for å vise status
*/
function kobleTilMain() {
	$host="localhost";												// ADRESSE
	$user="PRO10005";												// BRUKERNAVN
	$password="123Pr010005";										// PASSORD
	$database="pro10005";											// DATABASENAVN
		
	mysql_connect ($host,$user,$password) or die("Main Server: " + mysql_error()); // KOBLER TIL DATABASEN
	mysql_selectdb ($database) or die(mysql_error());				// VELGER DATABASE, RETURNERER ERROR VED FEIL
}

function kobleTilBackup() {
	$host="cs2.slummen.org:3306";									// HOSTNAME TIL SERVEREN
	$user="pro10005";												// BRUKERNAVN
	$password="123Pr010005";										// PASSORD
	$database="pro10005";											// DATABASENAVN

	mysql_connect ($host,$user,$password) or die("Backup Server: " + mysql_error()); // KOBLER TIL DATABASEN
	mysql_selectdb ($database) or die(mysql_error());				// VELGER DATABASE, RETURNERER ERROR VED FEIL
}

function statusMainServer(){
	$host="localhost";												// ADRESSE
	$user="PRO10005";												// BRUKERNAVN
	$password="123Pr010005";										// PASSORD
	$database="pro10005";											// DATABASENAVN
	
	$mainServer = mysql_connect ($host,$user,$password) or die("Main Server: " + mysql_error()); // KOBLER TIL DATABASEN
	kobleFra();														// KOBLER FRA DATABASEN
	return($mainServer);

}

function statusBackupServer(){
	$host="cs2.slummen.org:3306";									// ADRESSE
	$user="pro10005";												// BRUKERNAVN
	$password="123Pr010005";										// PASSORD
	$database="pro10005";											// DATABASENAVN

	$backupServer = mysql_connect ($host,$user,$password) or die("Backup Server: " + mysql_error()); // KOBLER TIL DATABASEN
	kobleFra();														// KOBLER FRA DATABASEN
	return($backupServer);

}

function uptimeMainServer(){
	kobleTilMain();													// KOBLER TIL MAIN DATABASEN
	$sqlSetning="SHOW GLOBAL STATUS LIKE 'uptime';";				// SQL SETNING
	$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());	// KJØRER SQL-SETNINGEN PÅ DB SERVER
	$antallRader=mysql_num_rows($sqlResultat); 						// ANTALL RADER I RESULTATET AV MYSQL KALLET
	$rad=mysql_fetch_array($sqlResultat);  							// NY RAD HENTET FRA SPØRRINGSRESULTATET
	kobleFra();														// KOBLER FRA DATABASEN

	return $rad[1];
}

function uptimeBackupServer(){
	kobleTilBackup();												// KOBLER TIL BACKUP DATABASEN
	$sqlSetning="SHOW GLOBAL STATUS LIKE 'uptime';";				// SQL SETNING
	$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());	// KJØRER SQL-SETGNINGEN PÅ DB SERVEREN
	$antallRader=mysql_num_rows($sqlResultat); 						// ANTALL RADER I RESULTATET AV MYSQL KALLET
	$rad=mysql_fetch_array($sqlResultat);  							// NY RAD HENTET FRA SPØRRINGSRESULTATET
	kobleFra();														// KOBLER FRA DATABASEN

	return $rad[1];
}
function execute($sql){
	kobleTil();														// KOBLER TIL DATABASEN
	$sqlResultat=mysql_query($sql) or die ("ikke mulig å hente data fra databasen");  // KJÃ˜RER SQLSETNINGEN I DATABASEN
	kobleFra();														// KOBLER FRA DATABASEN
	return $sqlResultat;
}
function salgsTilstand($status){									// TAR INN EN VARCHAR OG RETURNERER EN LISTEBOKS MED DE FORSKJELLIGE VALGENE SOM TILBYS
	echo ("<select type='text' id='status' name='status'>");
	echo ("<option value='$status'>$status</option>");				// SKRIVER UT DEN VERDIEN SOM ER ANGITT
	echo "<option value=''>  </option> ";
	echo "<option value='Solgt'> Solgt </option> ";
	echo "<option value='Reservert'> Reservert </option> ";
	echo "</select>";
}
function leggTilInteresserte($igeirkode,$brukerId,$Dato) {
	$sqlResultat = execute("SELECT * FROM interesserte WHERE IgeirKode='$igeirkode' AND BrukerId='$brukerId';");
	$antallRader=mysql_num_rows($sqlResultat);						// ANTALL RADER I RESULTATET AV MYSQL KALLET
	
	if($antallRader != 0) {											// SJEKKER OM VI HAR NOEN TREFF FRA FØR AV I DATABASEN
		echo "<SCRIPT language='JavaScript'> alert('Du har allerede vist din interesse for denne varen.'); </SCRIPT> ";
	} else {
		$sqlResultat = execute("INSERT INTO interesserte(IgeirKode,BrukerId,Dato) VALUES ('$igeirkode','$brukerId','$Dato');");
	}
}
function hentAdresse($igeirkode){
	$sqlResultat = execute("SELECT DISTINCT Adresse,Postnr,Poststed FROM adresse WHERE IgeirKode='$igeirkode';");
	$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPØRRINGSRESULTATET
	$str=$rad[0];
	$str.=", ";
	$str.=$rad[1];
	$str.=" ";
	$str.=$rad[2];
	return $str;
}
/***************************Nyhets oppdatering for news feed*************************************************/
function showNews() {
	kobleTil();														//KOBLER TIL DATABASEN
	$sqlSetning="SELECT Overskrift,Ingress,Hovedtekst FROM nyheter ORDER BY NyheterId DESC LIMIT 5";//SQL SPØRRING
	$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());	// RESULTAT ELLER DØD
	$antallRader=mysql_num_rows($sqlResultat); 						 // ANTALL RADER I RESULTATET AV MYSQL KALLET
	kobleFra();
	for ($r=1;$r<=$antallRader;$r++){
		$rad=mysql_fetch_array($sqlResultat);  						// NY RAD HENTET FRA SPØRRINGSRESULTATET
		echo "<fieldset>";
		echo "<legend>$rad[0]</legend>";
		echo "<i>$rad[1]</i>";
		echo "<p>$rad[2]</p>";
		echo "</fieldset>";
	}
}

/***************************Nyhetsoppdateringer i index.php*****************************************************/

function showNewsIndex(){
	kobleTil();																			//KOBLER TIL DATABASEN
	$sqlSetning="SELECT Overskrift,Ingress,Hovedtekst FROM nyheter ORDER BY NyheterId DESC LIMIT 3;"; //SQL SPØRRINGEN
	$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());   //RESULTAT ELLER DØD
	$antallRader=mysql_num_rows($sqlResultat);             // ANTALL RADER I RESULTATET AV MYSQL KALLET
	kobleFra();												// KOBLER FRA DATABASEN
	for ($r=1;$r<=$antallRader;$r++){
		$rad=mysql_fetch_array($sqlResultat);             // NY RAD HENTET FRA SPoRRINGSRESULTATET
		echo "<fieldset>";
		echo    "<legend>$rad[0]</legend>";
		echo "<i>$rad[1]</i>";
		echo "<p>$rad[2]</p>";
		echo "</fieldset>";
	}
}
/***************************Vising av admins i about.php*****************************************************/

function showAdmins(){
	kobleTil();																							// KOBLER TIL DATABASEN
	$sqlSetning="SELECT AdminId, AdminFornavn, AdminEtternavn, AdminMail,
			AdminAdresse, AdminTlf, AdminMob, AdminPostnr, AdminBrukernavn, AdminPassord
      FROM `pro10005`.`admin`;";																		//SQL SPØRRING
	$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());  									// HENTER RESULTAT ELLER DØR
	$antallRader=mysql_num_rows($sqlResultat);      													// ANTALL RADER I RESULTATET AV MYSQL KALLET
	kobleFra();																							//KOBLER FRA DATABASEN
	for ($r=1;$r<=$antallRader;$r++){
		$rad=mysql_fetch_array($sqlResultat);   													 // NY RAD HENTET FRA SPØRRINGSRESULTATET
		echo   "<div id='aboutUs' class='clearfix'>";														// SKRIVER UT HVER SIN INFOBOKS OM ADMINS
		echo			"<div class='pic'>";
		echo			"<a href='#'><img src='img/user-icon.jpg' width='150' height='150' /></a>";
		echo      "</div>";
		echo      "<div class='aboutUsData'>";
		echo         "<h2>$rad[1] $rad[2]</h2>";
		echo         "<p>Mail :<a href='mailto:$rad[3]' Subject='Hello%20again'>$rad[3]</a> </p>";
		echo         "<p>Tlf: $rad[6]</p>";
		echo         "<p>Adresse: $rad[4]</p>";
		echo         "<p>Post nr: $rad[7]</p>";
		echo       "</div>";
		echo   "</div>";


	}
	}
	/*************************SUPPORT.PHP FRONTEND MAIL************************************************************/

		function sendMailSupport(){




		if(isset($_POST['email'])) {


		$email_to = "andersborglarsen@gmail.com";                     			// epost informasjon og overskrift
		$email_subject = "Igeir support respons";               			        // Setter inn overskriften i e posten

		function died($error) {                             						  // feilmeldinger
			echo "<p class='phpMsg'>Det er noe feil med det du har fylt ut. </p>";
			echo "<p class='phpMsg'>Du finner feilen under.</p><br /><br />";
			echo $error."<br /><br />";
			echo "<p class='phpMsg'>venligst gi tilbakemedling - så retter vi opp feilene.</p><br /><br />";
			die();
		}

		// validering av innkommende data
			if(!isset($_POST['first_name']) ||
			!isset($_POST['last_name']) ||
			!isset($_POST['email']) ||
			!isset($_POST['telephone']) ||
			!isset($_POST['comments'])) {
			died('Vi er lei for det , men det er noe feil med utfyllingen.');   //feil med validering
			}

			$first_name = $_POST['first_name'];                     // mÅ’ fylle ut
			$last_name = $_POST['last_name'];                       // mÅ’ fylle ut
			$email_from = $_POST['email'];                        // mÅ’ fylle ut
			$telephone = $_POST['telephone'];                       // trenger ikke Å’ fylles inn
			$comments = $_POST['comments'];                       // mÅ’ fylle ut

			$error_message = "";
			$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
		if(!preg_match($email_exp,$email_from)) {
		$error_message .= 'Dette ser ikke ut som en epost adresse.<br />';      //epost validering
			}
			$string_exp = "/^[A-Za-z .'-]+$/";
		if(!preg_match($string_exp,$first_name)) {
		$error_message .= 'Dette ser ikke ut som et fornavn.<br />';        // fornavn validering
			}
			if(!preg_match($string_exp,$last_name)) {
			$error_message .= 'Dette ser ikke ut som et etternavn.<br />';        // etternavn validering
			}
			if(strlen($comments) < 2) {
			$error_message .= 'meldingen du skrev ser ikke ut til Å’ vÂ¾re riktig<br />'; // meldingen innholder informasjon
			}
			if(strlen($error_message) > 0) {
			died($error_message);
			}
			$email_message = "Form details below.\n\n";                 // konstruksjon av selve meldingen i eposten

			function clean_string($string) {
			$bad = array("content-type","bcc:","to:","cc:","href");
			return str_replace($bad,"",$string);
			}

			$email_message .= "First Name: ".clean_string($first_name)."\n";		//FORNAVN
			$email_message .= "Last Name: ".clean_string($last_name)."\n";		//ETTERNAVN
			$email_message .= "Email: ".clean_string($email_from)."\n";			// FRA E POST
			$email_message .= "Telephone: ".clean_string($telephone)."\n";		// TELEFON NR
			$email_message .= "Comments: ".clean_string($comments)."\n";			// SELVE MELDINGEN.


			// lager e post overskrift
			$headers = 'From: '.$email_from."\r\n".
					'Reply-To: '.$email_from."\r\n" .
					'X-Mailer: PHP/' . phpversion();
					@mail($email_to, $email_subject, $email_message, $headers);			// SENDER MAILEN

					echo ("<script>alert('Da er mailen sendt.')</script>"); // BEKREFTELSE TIL BRUKEREN AT DATAENE ER LAGRET
		}

}

/*************************VISING AV REKLAMEBANNER ØVERST PÅ SIDER*******************************************/

/*************************VISER PRODUKTER SOM SKAL BYTTES **************************************************/
function byttesVarerSql(){

	kobleTil();
	$sqlSetning="SELECT underkategori.TorgetId, underkategori.TypeId, underkategori.IgeirKode,
        typer.TypeKategori,
        torget.TorgKategori,
        bilde.Filnavn,
        igeir.header,
        igeir.pris
        from underkategori
        Natural Join typer
        Natural Join torget
        Natural Join bilde
        JOIN igeir on igeir.IgeirKode =underkategori.IgeirKode AND TypeId='2';";			//SQL SPØRRING
	$sqlResultat=mysql_query($sqlSetning) or die(mysql_error());						// ANTALLRADER ELLER DØD
	$antallRader=mysql_num_rows($sqlResultat);             // ANTALL RADER I RESULTATET AV MYSQL KALLET
	kobleFra();																			//KOBLER FRA DATABASEN

}
?>
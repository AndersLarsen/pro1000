<?php
// --- Database Tilkobliner --//
function kobleTil() {
	$host="sandnes.marensius.no";										// ADRESSE
	$user="andlar";												// BRUKERNAVN
	$password="andlar";											// PASSORD
	$database="pro10005";											// DATABASENAVN

	mysql_connect ($host,$user,$password) or die(mysql_error()); 	// KOBLER TIL DATABASEN,RETURNERER ERROR VED FEIL
	mysql_selectdb ($database) or die(mysql_error());				// VELGER DATABASE, RETURNERER ERROR VED FEIL
}

function lukk() {
	mysql_close();
}
function kobleFra() {
	mysql_close();
}


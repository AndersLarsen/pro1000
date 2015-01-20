<?php
/**
 * Meny
 * Lager en navigeringsmeny for brukerene som er innlogget
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

if($_SESSION['innlogget'] == true) {													// SJEKKER OM EN BRUKER ER INNLOGGET

	$path				=	"http://andersborglarsen.com/pro1000/admin/";			// LAGRER EN ABSOLUTT ADRESSE FOR MENYEN
	$hjem				=	"index.php";												// LAGRER LOKALVARIABEL
	$regNyhet			=	"vedlikehold/reg-nyhet.php";								// LAGRER LOKALVARIABEL
	$regReklame			=	"vedlikehold/reg-reklame.php";								// LAGRER LOKALVARIABEL
	$visNyheter			=	"vedlikehold/vis-nyheter.php";								// LAGRER LOKALVARIABEL
	$visReklameAktorer	=	"vedlikehold/vis-reklame-aktorer.php";						// LAGRER LOKALVARIABEL
	$visTorget			=	"vedlikehold/vis-torget.php";								// LAGRER LOKALVARIABEL
	$visMarked			=	"vedlikehold/vis-marked.php";								// LAGRER LOKALVARIABEL
	$sendMail 			= 	"vedlikehold/send_mail.php";								// LAGRER LOKALVARIABEL
	$regtorget			=	"vedlikehold/reg-torget.php";								// LAGRER LOKALVARIABEL
	$logout 			= 	"logout.php";												// LAGRER LOKALVARIABEL
	$vismedlem			=	"vedlikehold/vis-medlem.php";								// LAGRER LOKALVARIABEL
	$visAdmins			=	"vedlikehold/vis-admins.php";								// LAGRER LOKALVARIABEL
	$regAdmin			=	"vedlikehold/reg-admin.php";								// LAGRER LOKALVARIABEL
	$anonnser			=	"vedlikehold/registrering-av-annonse.php";					// LAGRER LOKALVARIABEL
	$visannonser		= 	"vedlikehold/vis-annonse.php";								// LAGRER LOKALVARIABEL
	$mittPass			=	"vedlikehold/endre-mitt-pass.php";							// LAGRER LOKALVARIABEL
	$brukerPass			=	"vedlikehold/endre-bruker-pass.php";							// LAGRER LOKALVARIABEL
	$adminPass			=	"vedlikehold/endre-admin-pass.php";							// LAGRER LOKALVARIABEL
	$status				=	"vedlikehold/status.php";									// LAGRER LOKALVARIABEL
	$hvorfoross			=	"vedlikehold/reg-hvorfor-oss.php";							// LAGRER LOKALVARIABEL
	$cssbackend			=	"vedlikehold/redigere-css.php";								// LAGRER LOKALVARIABEL
	$cssfrontend			=	"vedlikehold/redigere-css-frontend.php";					// LAGRER LOKALVARIABEL
	
	echo "
	<div class='meny'>
	<ul class='nav'>
	<li><a href='$path$hjem'>Forside</a></li>
	<li><a href='#'>Registrer</a>
	<ul class='subs'>
	<li><a href='$path$regNyhet'>Registrer Nyhet</a></li>
	<li><a href='$path$regReklame'>Registrer Reklame</a></li>
	<li><a href='$path$regAdmin'>Registrer Admin</a></li>
	<li><a href='$path$anonnser'>Registrer Annonser</a></li>
	<li><a href='$path$regtorget'>Registrer Torg</a></li>
	<li><a href='$path$hvorfoross'>Registreringsinfobox</a></li>
	</ul></li>

	<li><a href='#'>Vis</a>
	<ul class='subs'>
	<li><a href='$path$vismedlem'>Vis Medlemmer </a></li>
	<li><a href='$path$visReklameAktorer'>Vis  Reklame</a></li>
	<li><a href='$path$visNyheter'>Vis alle Nyheter</a></li>
	<li><a href='$path$visAdmins'>Vis Admins</a></li>
	<li><a href='$path$visTorget'>Vis Torget</a></li>
	<li><a href='$path$visMarked'>Vis Marked</a></li>
	<li><a href='$path$visannonser'>Vis Annonse</a></li>
	</ul></li>

	<li><a href='#'>Skift Passord</a>
	<ul class='subs'>
	<li><a href='$path$mittPass'>Mitt Passord</a></li>
	<li><a href='$path$brukerPass'>Bruker Passord</a></li>
	<li><a href='$path$adminPass'>Admin Passord</a></li>
	</ul></li>

	<li><a href='#'>Rediger Css</a>
	<ul class='subs'>
	<li><a href='$path$cssbackend'>Rediger Css Backend</a></li>
	<li><a href='$path$cssfrontend'>Rediger Css Frontend</a></li>
	</ul></li>
	
	<li><a href='$path$status'>Status</a></li>
	<li><a href='$path$sendMail'> Mail Oss</a></li>
	<li><a href='$path$logout'>Logg ut</a></li>
	</ul>
	<div style='clear:both'></div>
	</div>";

} else {																			// HVIS BRUKEREN IKKE ER LOGGETINN
	include("login.php");															// SENDER BRUKEREN TIL LOGIN
}
?>
<?php
/*
 * Logger ut en bruker av Igeir
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
include("header.php");							//INKLUDERER HEADER

	$_SESSION = array();						// LEGGER INN ET TOMT ARRAY I SESSION 
	$params = session_get_cookie_params();		// HENTER COOKIES PARAMETERENE
	setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);// NULLER UT COOKIE TIDEN
	session_destroy();// ØDELEGGER SESSIONEN
	header('Location: index.php');//SENDER BRUKER TIL INDEX.PHP
	
include("footer.php");						// INKLUDERER FOOTER
?>

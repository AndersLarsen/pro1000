
<?php
/**
 * Skift Passord
 *
 * Denne fila tillater at en admin å redigere css filen.
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
$title = '..REDIGER CSS..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");
// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();							// SJEKKER AT MAN ER LOGGET INN
?>
<div
	style="float: left; width: 200px; padding: 40px; text-align: center;">
	<h2>Advarsel</h2>
	<p>Ved forandring på denne siden kan man gjøre kritiske feil som kan
		være vansklige å rette opp. Vær forsiktig</p>
</div>
<?php 



$fn = "../stylesheets/vedlikehold.css";								// VELGER VILKEN FIL MAN SKAL ÅPNE



if (isset($_POST['content']))										// DEFINERER INNHOLDET

{

	$content = stripslashes($_POST['content']);							// TAR VEKK BACKSLASH

	$fp = fopen($fn,"w") or die ("Error opening file in write mode!");	// ÅPNER FILEN Å GJØRE DET MULIG Å SKRIVE TIL DEN

	fputs($fp,$content);												//

	fclose($fp) or die ("Error closing file!");							// LUKKER FILEN

}

?>



<form
	action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">

	<textarea rows="30" cols="60" name="content">
		<?php readfile($fn); ?>
	</textarea>
	<!--  HER LIGGER SELVE INNHOLDE AV FILEN -->

	<input type="submit" value="Lagre endringer">
	<!-- LAGRINGSKNAPP -->

</form>
<?php 
include '../slutt.html';												// LEGGER TIL FOOTER
?>
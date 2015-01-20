
<?php
/**
 * Her kan man sende mail til dem som har leget dette cms`et.
*
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
* @copyright 	2012-2017
* @license		http://www.php.net/license/3_01.txt
* @link		http://student.hive.no/pro10005/1
*
*/
$title = '..SEND OSS EN MAIL..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include("start.php");															// INKLUDERER FØRSTE DEL AV DESIGNET
sjekkLogin();																	// SJEKKER OM EN PERSON ER LOGGET INN

?>
<br />
<form class='igeir_skjema' action='send_mail.php'
	enctype='multipart/form-data' method='post' name='igeir_skjema'
	id='igeir_skjema'>
	<ul>
		<li>
			<h2>Send mail</h2> <span class='required_notification'>Alle felt
				må fylles ut</span>
		</li>
		<li><label for='first_name'>Fornavn:</label> <input type='text'
			placeholder='Fornavn' id='first_name' name='first_name' maxlength='50' size='30' required />
		</li>
		<li><label for='last_name'>Etternavn:</label> <input type='text'
			placeholder='Etternavn' id='last_name' name='last_name' maxlength='50' size='30' required />
		</li>
		<li><label for='email'>Epost:</label> <input type='email'
			placeholder='Epost' id='email' name='email' maxlength='80' size='30' required />
		</li>
		<li><label for='telephone'>Telefon:</label> <input type='tel'
			placeholder='Telefon' id='telephone' name='telephone' maxlength='30' size='30' required />
		</li>
		<li><label for='comments'>Melding:</label> <textarea  maxlength='1000' cols='25' 
		rows='6' id='comments' name='comments' required /></textarea>
		</li>
		<li><input type='submit' value='Send Mail' id='endrenKnapp'
			name='endrenKnapp' class='submit' />
		</li>
	</ul>
</form>
<br />
	<?php



if(isset($_POST['email'])) {


	$email_to = "andersborglarsen@gmail.com";											// epost informasjon og overskrift
	$email_subject = "Igeir ADMIN respons";												// Setter inn overskriften i e posten

	function died($error) {																// feilmeldinger
		echo "Det er noe feil med det du har fylt ut. ";
		echo "Du finner feilen under.<br /><br />";
		echo $error."<br /><br />";
		echo "venligst gå tilbake å rett opp feilene.<br /><br />";
		die();
	}

																					// validering av innkommende data
	if(!isset($_POST['first_name']) ||
			!isset($_POST['last_name']) ||
			!isset($_POST['email']) ||
			!isset($_POST['telephone']) ||
			!isset($_POST['comments'])) {
		died('Vi er lei for det , men det er noe feil med utfyllingen.');		//feil med validering
	}

	$first_name = $_POST['first_name']; 										// mŒ fylle ut
	$last_name = $_POST['last_name']; 											// mŒ fylle ut
	$email_from = $_POST['email']; 												// mŒ fylle ut
	$telephone = $_POST['telephone']; 											// trenger ikke Œ fylles inn
	$comments = $_POST['comments']; 											// mŒ fylle ut

	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	if(!preg_match($email_exp,$email_from)) {
		$error_message .= 'Dette ser ikke ut som en epost adresse.<br />';			//epost validering
	}
	$string_exp = "/^[A-Za-z .'-]+$/";
	if(!preg_match($string_exp,$first_name)) {
		$error_message .= 'Dette ser ikke ut som et fornavn.<br />';				// fornavn validering
	}
	if(!preg_match($string_exp,$last_name)) {
		$error_message .= 'Dette ser ikke ut som et etternavn.<br />';				// etternavn validering
	}
	if(strlen($comments) < 2) {
		$error_message .= 'meldingen du skrev ser ikke ut til Œ v¾re riktig<br />'; // meldingen innholder informasjon
	}
	if(strlen($error_message) > 0) {
		died($error_message);
	}
	$email_message = "Form details below.\n\n";									// konstruksjon av selve meldingen i eposten

	function clean_string($string) {
		$bad = array("content-type","bcc:","to:","cc:","href");
		return str_replace($bad,"",$string);
	}

	$email_message .= "First Name: ".clean_string($first_name)."\n";
	$email_message .= "Last Name: ".clean_string($last_name)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Telephone: ".clean_string($telephone)."\n";
	$email_message .= "Comments: ".clean_string($comments)."\n";


	// lager e post overskrift
	$headers = 'From: '.$email_from."\r\n".
			'Reply-To: '.$email_from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
	@mail($email_to, $email_subject, $email_message, $headers);

	echo "Da er medingen sendt. takk for det";
}

include("../slutt.html");											// INKLUDERER FØRSTE DEL AV DESIGNET

?>
	


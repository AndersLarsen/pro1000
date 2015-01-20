<?php
														
/*
* Her skal man kunne spørre og få hjelp som bruker av Igeir
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
$title = '..SUPPORT..'; // 	LEGGER TIL TITEL PÅ SIDEN.

include 'header.php';	//INKLUDERER HEADER 

?>

<div id="content2" class="clearfix">
  <div id="suportBox" class="clearfix">
    <section id="supportLeft">
      <div class="textSuport">
        <h3>Din tilbakemelding er viktig for oss!</h3>
        <p>
          Her kan du sende alt av spørsmål! Er det noe du føler du savner, lurer på eller syns er litt dårlig - send oss en melding :)
          Vi ønsker å bli så flinke som mulig og trenger din tilbakemelding for å kunne utvikkle oss i riktig rettning. Du kan også finne tidligere spørsmål og svar på vår offisieller facebookside.
        </p>
        <img id="suportPicture" <?php $img_path="http://andersborglarsen.com/pro1000/img/"				//HENTER INN BILDE?> 
        src="<?php print $img_path; ?>logo.png" alt="iGeir logo"/>
      </div>
        <div class="faqBox">
          <h3>Vanlige spørsmål om iGeir torget:</h3>
          <articel>
          <h4> Hvor mye koster det å legge ut anonnser?</h4>
           <p style='padding:4px;'>Det er gratis å legge ut annonser<br> på Igeir sin markesplass.</p>
          <h4> Hvor lenge kan en vare ligge ute til salgs?</h4>
           <p style='padding:4px;'> Alle varer som blir lagt ut blir automatisk fjernet etter 30 dager, <br>det er viktig at du sletter solgte varer.</p>
         
          </articel>
        </div>
    </section>  
 
    <section id="supportRight">
      <div id="suportForm">
      <form class='igeir_skjema' action='support.php' enctype='multipart/form-data' method='post' name='igeir_skjema' id='igeir_skjema'>
        <p>
        <h2>Send oss et Spørsmål:</h2> <span class='required_notification'><p>Alle felt må fylles ut!</p></span>
        </p>
        <p>
        <input type='text' placeholder='Fornavn' id='first_name' name='first_name' maxlength='50' size='30' required />
        </p>
        <p>
        <input type='text' placeholder='Etternavn' id='last_name' name='last_name' maxlength='50' size='30' required />
        </p>
        <p>
        <input type='email' placeholder='Epost' id='email' name='email' maxlength='80' size='30' required />
        </p>
        <p>
        <input type='tel' placeholder='Telefon' id='telephone' name='telephone' maxlength='30' size='30' required />
        </p>
        <p>
        <textarea  maxlength='1000' cols='25' rows='6' id='comments' placeholder='Melding' name='comments' required /></textarea>
        </p>
        <p class='logRegButton'>
        <input type='submit' value='Send Mail' id='endrenKnapp' name='endrenKnapp'/>
        </p>
      </form>
    </div>
    </section>
  </div>
</div>
<?php
sendMailSupport();														// HENTER INN MAILSENDE FUNKSJONEN
include 'footer.php';													// INKLUDERER FOOTER I DESIGNET
?>												
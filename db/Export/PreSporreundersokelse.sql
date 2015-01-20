-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2013 at 01:23 PM
-- Server version: 5.1.66-cll
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `marensiu_pro1000`
--

-- --------------------------------------------------------

--
-- Table structure for table `PreSporreundersokelse`
--

CREATE TABLE IF NOT EXISTS `PreSporreundersokelse` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `SP01` char(8) NOT NULL COMMENT 'Hva onsker du å selge/selger du mest av på nettet?',
  `SP02` char(8) NOT NULL COMMENT 'Hva onsker du å kjope på nett?',
  `SP03` char(1) NOT NULL COMMENT 'Hvor ofte bruker du finn.no?',
  `SP04` char(1) NOT NULL COMMENT 'Hvor ofte er du på bytte/kjope/salgs-grupper på facebook?',
  `SP05` varchar(200) NOT NULL COMMENT 'Hvilken nettbutikk bruker du mest?',
  `SP06` char(1) NOT NULL COMMENT 'Hvor viktig er det for deg å kunne gi bort ting på finn.no?',
  `SP07` char(1) NOT NULL COMMENT 'Hvor viktig er deg ville det vært å bytte ting for deg på finn.no?',
  `SP08` char(1) NOT NULL COMMENT 'Hvor viktig er det for deg å kunne auksjonere bort ting på finn.no?',
  `SP09` char(1) NOT NULL COMMENT 'Hvor viktig er det for deg hvis annonsen din ble postet på FB?',
  `SP10` char(1) NOT NULL COMMENT 'Hvor mye ville du stolt på en privatperson med opptil flere positive tilbakemeldinger?',
  `SP11` varchar(200) NOT NULL COMMENT 'Hva irriterer deg ved finn.no?',
  `SP12` varchar(200) NOT NULL COMMENT 'Hva liker du ved finn.no?',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `PreSporreundersokelse`
--

INSERT INTO `PreSporreundersokelse` (`id`, `SP01`, `SP02`, `SP03`, `SP04`, `SP05`, `SP06`, `SP07`, `SP08`, `SP09`, `SP10`, `SP11`, `SP12`) VALUES
(1, '4', '47', '1', '1', 'Komplett.no', '4', '4', '3', '4', '5', 'Manglende funksjoner ved mobilsÃ¸k', 'Enkelt Ã¥ sÃ¸ke\r\nEnkelt Ã¥ navigere\r\nBrukervennlig side'),
(2, '357', '347', '3', '1', '', '1', '3', '4', '5', '3', 'At det koster penger Ã¥ legge ting ut for salg, nÃ¥r det er gratis pÃ¥ for eksempel Facebook.', 'Enkelt Ã¥ sÃ¸ke, oversiktlig side. '),
(3, '', '356', '3', '3', 'Nfoto.no, hm.com, Nelly.com, finn.no', '4', '1', '1', '1', '3', 'Ikke noe jeg kan komme pÃ¥. ', 'Oversiktlig. Lett Ã¥ finne fram til det man leter etter ved Ã¥ kunne sÃ¸ke. '),
(4, '3', '147', '1', '5', 'elkjÃ¸p', '6', '5', '2', '4', '4', 'ikke sÃ¥ mye', 'mulighet til Ã¥ finne brukte ting og turer.'),
(5, '3', '16', '1', '4', 'bcb.no\r\nstreetperformance.se\r\nsuperkul.no\r\ncdon.com', '5', '3', '1', '3', '4', 'PrisÃ¸kningen. GjÃ¸r at folk legger ting i feil kategori fÃ¥r Ã¥ spare penger, spesielt leasingbiler!\r\nMen ogsÃ¥ andre ting.', 'enkelt Ã¥ fÃ¥ tak i det man trenger.'),
(6, '14', '47', '4', '2', 'www.komplett.no', '1', '4', '4', '4', '5', 'Mye reklame.\r\n', 'Gode muligheter ved sÃ¸k/filtrering.'),
(7, '47', '14', '1', '4', 'Finn', '4', '4', '4', '6', '6', '', ''),
(8, '234', '2357', '2', '1', 'oj vanskelig. bruker flere jevnlig. Iherb.com, bodyshop.no, veromoda.com.', '4', '6', '1', '6', '4', 'ingenting jeg kommer pÃ¥ ', 'mulighetene for gjenbruk, billige varp. miljÃ¸vennlig satsing mot den voksende kjÃ¸pekulturen'),
(9, '148', '134', '2', '3', 'Finn.no', '3', '3', '1', '4', '4', 'Reklame', 'Brukervennlighet'),
(10, '3', '3', '3', '1', 'ebay', '5', '5', '1', '2', '4', 'Deras sÃ¶kfunktioner med bilar fÃ¶r exempel och deras viderare sÃ¶k Ã¤r vÃ¤ldigt dumt, kunde ha vart gjort mycket mer flexibelt och med stÃ¶rre valmÃ¶jligheter', 'att man hittar allt mellan himmel och jord dÃ¤r'),
(12, '4', '14', '1', '2', 'Komplett.no', '3', '3', '3', '3', '3', 'useriÃ¸se selgere', 'Kjapt og enkelt.'),
(13, '247', '246', '4', '5', 'mpx.no/komplett.no', '3', '2', '2', '2', '5', 'Ikke noe spesielt, skulle kanskje vÃ¦rt litt enklere og mer utbredte muligheter for sikker betaling, og evt. bedre screening av svindlere o.l. ', 'Veldig bra at de har klart Ã¥ skaffe seg stor markedsandel, slik at man finner alt pÃ¥ ett sted. De har vÃ¦rt flinke til Ã¥ forbedre boligseksjonen sin. \r\n'),
(14, '2345678', '12345678', '4', '4', 'Komplett.no', '3', '5', '5', '6', '5', 'mye reklame, ', 'mulighetene'),
(15, '24', '134', '4', '4', 'komplett.no', '1', '1', '1', '5', '5', 'At forhandlere ikke merker annonsen med forhandlerstatus, og at sidene er uoversiktlige.', 'Mange potensielle kjÃ¸pere.'),
(16, '1', '135', '1', '1', 'Ellos.no\r\nFinn.no\r\n', '5', '6', '5', '6', '3', 'At folk legger ut sÃ¥ mye dritt.\r\nAt man ikke kan sÃ¸ke mer eksakt pÃ¥ bil feks.\r\n\r\n', 'Jeg liker at man har muligeten til Ã¥ gÃ¥ inn og se pÃ¥ reiser. Og at det er gode sÃ¸kemuligheter innefor de forskjellige kategoriene.'),
(17, '3', '136', '4', '5', 'Komplett', '1', '1', '1', '1', '4', 'DÃ¥rlig sorteringsfunksjoner og sÃ¸kefunksjoner', 'Ofte man finner pent brukte ting til rimelig pris'),
(18, '1', '147', '2', '1', 'Ebay og netthandelen', '3', '3', '2', '2', '3', 'Mye sÃ¸ppel, dÃ¥rlig oversikt', 'Reklamen... Finn dÃ¥tt N. O'),
(19, '4', '47', '4', '5', 'komplett.no\r\n', '1', '3', '2', '1', '3', '', ''),
(20, '', '457', '4', '5', 'ebay.com\r\nakademika.no\r\nblivakker.no\r\n', '4', '2', '2', '4', '5', 'Ã… ikke kunne sÃ¸ke pÃ¥ byer i sÃ¸keomrÃ¥det', 'At man kan justere prisen, ut ifra det en Ã¸nsker Ã¥ kjÃ¸pe. \r\nGod oversikt over alle markedskategoriene! \r\nEnkelt Ã¥ finne frem \r\nMorsom katt'),
(21, '12347', '137', '4', '5', 'komplett.no', '6', '1', '2', '3', '4', 'at folk ikke mÃ¸ter opp selv om avtalt salg', 'at det til slutt mÃ¸ter opp noen'),
(22, '147', '147', '4', '5', 'Cdon og netthandel', '3', '4', '4', '5', '4', ' Ingen ting.', 'Oversikt.'),
(23, '4', '3457', '4', '4', 'Adlibris', '6', '6', '4', '2', '3', '', 'Egen profil, lagrede sÃ¸k m/ varslingsmail om nye treff'),
(25, '', '7', '4', '3', '', '3', '3', '3', '3', '4', '', ''),
(26, '34', '4', '4', '5', 'MPX, Komplett, Netshop (prioritert)', '3', '3', '2', '4', '5', 'Mangler lett tilgjengelig sÃ¸k fra forsiden, mÃ¥ bla seg ned i kategori fÃ¸rst. Mange klikk fÃ¸r man kommer frem til dit man skal.', 'Mange som bruker det -> mye tilgjengelig.\r\n\r\nMulig Ã¥ "abonnere" pÃ¥ sÃ¸k, fÃ¥r e-post e.l. med nye annonser pÃ¥ gitte tidsintervaller.'),
(29, '4', '5', '4', '5', 'Amazon.com', '1', '1', '1', '1', '6', '', ''),
(30, '1', '12', '1', '4', 'Bruker det svÃ¦rt lite, men bruker finn.no', '1', '1', '1', '1', '5', '', 'Gode sÃ¸kepreferanser og veldig oversiktlig. Aldri noe tull med nettsidene. '),
(31, '13', '17', '4', '4', 'Ebay', '5', '3', '3', '4', '5', '', 'at man kan finne det meste man trenger!'),
(32, '4', '4', '4', '4', 'komplett.no', '6', '6', '3', '6', '6', 'Ikke sÃ¸kefelt pÃ¥ forsiden', 'HÃ¸y bruk'),
(33, '347', '34', '1', '3', '', '3', '4', '5', '4', '5', 'At ting som er solgt fortsatt stÃ¥r til salgs.', ''),
(34, '4', '47', '4', '5', '', '1', '1', '3', '1', '4', '', ''),
(35, '1', '1', '2', '5', 'game-on', '3', '1', '5', '6', '3', 'dyrt Ã¥ legge inn salg.', 'enkelt.'),
(36, '14', '1347', '3', '1', 'finn.no', '1', '3', '1', '5', '4', 'mobil appen er for tungvindt Ã¥ bruke.\r\nden bÃ¸r ligne meir pÃ¥ nett varianten.', 'det som selges der.'),
(37, '35', '1', '4', '5', 'HM.no', '1', '2', '1', '1', '2', 'At annonsene koster penger Ã¥ poste', 'At det er et stort utvalg, lett Ã¥ sÃ¸ke opp'),
(38, '457', '467', '2', '4', 'eBay', '6', '4', '4', '4', '6', 'Ingenting', 'Alt'),
(39, '', '4', '4', '4', 'Jeg kjÃ¸per veldig sjeldent ting pÃ¥ nett. Har kun kjÃ¸pt en PC og en mobil eller to, og da har det gÃ¥tt gjennom mobiloperatÃ¸ren min sÃ¥ jeg husker ikke hva nettbutikken heter.', '4', '4', '4', '', '6', 'Ehm... Litt komplisert system av og til, ikke alltid like lett Ã¥ vite hva man skal gjÃ¸re.', 'At det er sÃ¥ mange som bruker det, at det er ofte veldig attraktivt Ã¥ bÃ¥de se etter bolig, jobb og ting man trenger.'),
(40, '457', '45', '4', '5', 'www.nelly.com\r\nwww.komplett.no\r\n', '3', '4', '2', '5', '5', 'Ingenting spesielt', 'Oversiktlig og lett Ã¥ finne fram. Gode muligheter for Ã¥ avgrense sÃ¸ket ditt.'),
(41, '3', '4', '2', '4', 'Mpx.no', '4', '2', '2', '4', '5', '', 'Stort utvalg med annonser.'),
(42, '4', '1', '2', '3', 'Komplett.no', '1', '1', '3', '3', '3', 'Ingenting', 'Bra sortering :)'),
(43, '3467', '367', '3', '1', 'Motehus.no, ellos.no, sparkjop.no, ludostore.no.', '4', '6', '4', '6', '6', 'Hender seg det er mye useriÃ¸se folk.', 'De har alt :)'),
(44, '47', '457', '1', '1', 'Jeg handler fra mange forskjellige.', '4', '5', '5', '4', '5', 'Kommer ikke pÃ¥ noe jeg vet om.', 'Enkelt brukergrensesnitt.'),
(45, '1247', '1247', '4', '5', 'gitarhuset.no', '3', '3', '3', '3', '4', 'ikkeno', 'Jeg liker at det er sÃ¥ Ã¥pent og fritt og du kan fÃ¥ ting mye billigere enn andre steder.'),
(46, '', '', '4', '4', 'Handler sÃ¥ Ã¥ si aldri i nettbutikker.\r\nBruker Supersaver.no e.l nÃ¥r jeg skal kjÃ¸pe flybiletter.', '2', '2', '1', '3', '4', 'Ikke noe, men det er alltid en hvis risiko for Ã¥ bli lurt.', 'Oversiktlig, mangfoldig, folkelig, meget praktisk nÃ¥r man skal skaffe seg noe rimelig. Gjenbruk, vinn-vinn'),
(47, '35', '57', '4', '3', 'korsetten.se, Illusion.no', '2', '3', '4', '2', '5', 'DÃ¥rlig sÃ¸kemotor, om man sÃ¸ker pÃ¥ bil, kan man fÃ¥ opp en sofa liksom..  ', 'Man kan selge alt, eller.. prÃ¸ve Ã¥ selge. Er jo lov Ã¥ hÃ¥pe at noen kjÃ¸per Ã¸delagte ting liksom.. '),
(48, '5', '3', '3', '5', 'finn.no', '2', '4', '4', '5', '5', '', ''),
(49, '7', '5', '3', '2', 'Freepeople.com , etsy.com ', '3', '5', '5', '4', '2', 'NÃ¥r folk skal gi bort ting og ombestemmer seg nÃ¥r de fÃ¥r henvendelser. ', 'At du kan kuppe ting.GRATIS!'),
(50, '357', '3457', '4', '1', 'www.eyeslipsface.com\r\nwww.coolstuff.no', '1', '1', '1', '3', '5', 'Ingen ting', 'Ingen ting'),
(51, '457', '1', '2', '5', 'bruker sjeldent nettbutikker', '4', '2', '3', '3', '3', 'egentlig ingenting', 'at folk kikker ofte her og man fÃ¥r som regel solgt det man har lagt ut.'),
(52, '37', '257', '4', '5', '', '4', '4', '4', '4', '4', '', ''),
(53, '4', '7', '4', '4', 'finn', '2', '4', '4', '1', '4', 'at jeg har for lite penger Ã¥ bruke der.', 'oversiktlig'),
(54, '47', '1234578', '4', '5', 'Dx.com', '3', '3', '3', '1', '5', 'Mye dritt.', 'Mye dritt.'),
(55, '347', '7', '2', '4', 'Bygghjemme.no', '3', '2', '3', '5', '5', 'Utseendet.', 'Filtrerings mulighetene.'),
(56, '26', '2356', '4', '3', 'Antikkgruppe pÃ¥ Facebook ', '5', '5', '2', '2', '4', 'Usikkerhet pÃ¥ seriÃ¸sitet ved annonser som selger/gir bort dyr', 'Oversiktlig'),
(57, '3', '2347', '4', '5', 'komplett.no', '4', '1', '3', '3', '5', 'Annonser med flere salgsgjenstander i en annonse. Vanskelig Ã¥ identifisere gode kjÃ¸p nÃ¥r man mÃ¥ inn pÃ¥ annonsen fremfor Ã¥ bare se i lista. ', 'Filtermulighetene'),
(58, '3', '37', '3', '4', 'usikker.', '6', '5', '5', '5', '4', 'lite', 'det meste!! gjenbruk er veldig bra. miljÃ¸tiltak! -og bra for folk med dÃ¥rlig rÃ¥d.'),
(59, '24', '24', '3', '5', 'Komplett', '2', '3', '1', '4', '5', 'Ofte lite sÃ¸kevalg', 'Det er den stÃ¸rste plassen som har alt'),
(60, '7', '7', '4', '5', 'billettservice.no', '1', '1', '3', '3', '5', '', ''),
(61, '3', '247', '4', '5', 'abebooks.co.uk og amazon.com', '6', '1', '3', '4', '4', 'ingenting, bra side', 'sÃ¸kefunksjon i kart er supert!'),
(62, '15', '145', '4', '4', 'www.komplett.no\r\nwww.sagaouterwear.com', '1', '1', '1', '2', '4', '', ''),
(63, '6', '6', '2', '4', 'Finn.no (kanskje)', '3', '3', '3', '3', '3', 'Ikke noe ', 'Det meste'),
(64, '', '2457', '4', '5', 'komplett.no', '5', '3', '5', '4', '4', 'Artikler uten bilder/useriÃ¸se artikler', 'oversiktlig\r\n"Gir bort"\r\n'),
(65, '7', '7', '4', '5', 'eBay', '4', '3', '5', '2', '5', 'DÃ¥rlige bilder / illustrasjoner i annonser, og at gamle annonser ofte ligger ute.', 'Mangfoldet.'),
(67, '37', '1234578', '4', '5', 'amazon.com', '5', '3', '3', '1', '3', '', 'Flotte bolig, bil og bÃ¥tside'),
(68, '', '', '4', '5', '', '1', '2', '2', '2', '3', 'husker ikke', 'god side sammenlignet med andre'),
(69, '4', '245', '4', '5', 'Ebay', '4', '5', '1', '4', '5', 'Ingenting egentlig.', 'Mye utvalg. '),
(70, '35', '356', '3', '5', '', '2', '3', '3', '3', '4', '', ''),
(71, '3', '5', '2', '4', '', '3', '3', '5', '4', '4', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

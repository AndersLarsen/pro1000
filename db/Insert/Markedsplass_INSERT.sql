
#Markedsplass:

#egg Hovedkategori i Markedsplassen
INSERT INTO `Markedsplass`(`Hovedkategori`) VALUES ('Bil');
INSERT INTO `Markedsplass`(`Hovedkategori`) VALUES ('Eiendom');
INSERT INTO `Markedsplass`(`Hovedkategori`) VALUES ('MC');
INSERT INTO `Markedsplass`(`Hovedkategori`) VALUES ('Reise');
INSERT INTO `Markedsplass`(`Hovedkategori`) VALUES ('Båt');
INSERT INTO `Markedsplass`(`Hovedkategori`) VALUES ('Jobb');
INSERT INTO `Markedsplass`(`Hovedkategori`) VALUES ('Torget'); 
INSERT INTO `Markedsplass`(`Hovedkategori`) VALUES ('Bygg og Anlegg');
INSERT INTO `Markedsplass`(`Hovedkategori`) VALUES ('Næringsmarked');

#Torget:
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Andre');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Antikk og kunst');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Barneutstyr');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Bil-, mc- og båttilbehør');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Bøker og blader');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Data og Tele');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Dyr og utstyr');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','For Næringsliv');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Helse og velvære');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Fridtid hobby og underholdning');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Hus, Hytte Hage');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Hvitevarer');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Interiør og kjøkkenutstyr');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Klær, klokker og smykker');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Lyd og bilde');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Møbler');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Musikk');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Samlerobjekt');
INSERT INTO `Torget`(`MarkedsplassId`,`TorgKategori`) VALUES ('07','Sport og friluftsliv');

#
# ALT OVER HER ER DOBBELTSJEKKET OG GJORT KLART
#


/*
#Underkategori
#Bilutstyr:
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1` ) VALUES ('','','','Deler');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Bilstereo');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Styling');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Takstativ og boks');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','GPS');

#Sport og Friluftsliv(meny nivå 2):
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) VALUES ('','','','Jakt og fiske','Utstyr','Klær');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) VALUES ('','','','Treningsutstyr','','');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) VALUES ('','','','Sommersport','Vannsport','Sykkelsport');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) VALUES ('','','','Vintersport','Langren','Snowboard');

#Møbler og Interiør:
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Bord og Stoler');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Sofa og Lenestoler');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Senger og madrasser');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Hyller, kommoder og skap');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Belysning');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Nips');

#Elektronikk:
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Data');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Lyd og Bildet');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Spill og konsoll');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Telefoner og tilbehør');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Foto og video');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) VALUES ('','','','Div');

#Klær (meny nivå 2):
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) VALUES ('','','','Menn','Overdel','Underdel');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) VALUES ('','','','Kvinner','Overdel','Underdel');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) VALUES ('','','','Barn','Overdel','Underdel');

#Fridtid hobby og underholdning:
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Brettspill');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Bøker og blader');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Modeller og byggesett');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Musikk og film');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Samlerobjekter');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Instrumenter');

#Kjøkken:
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Kjøkkenmaskiner');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Porselen, bestikk og glass');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Hvitevarer');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Innredning');

#Barneutstyr (meny nivå 2):
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) VALUES ('','','','Barn','Jenter','Gutter');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Møbler');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Sikkerhetsutstyr');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Leker');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Barnevogn');
INSERT INTO `Underkategori`(`UnderkategoriId`, `TorgetId`, `Igeri-Kode`, `Nivå1`) VALUES ('','','','Barnesete');
*/

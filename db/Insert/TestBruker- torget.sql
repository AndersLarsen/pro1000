INSERT INTO `bruker`(`BrukerMail`, `BrukerPassord`, `BrukerFornavn`, `BrukerEtternavn`, `BrukerAdresse`, `BrukerPostnr`, `BrukerTlf`, `BrukerMob`, `BrukerUrl`, `Selgerhenvendelser`,`Betmedlem`, `Aktiv`) 
VALUES ('Paran.se@hotmail.com','123456##','Paran','Selvanathan','Holmenkollen','0597','22435687','98467584','','0','1','1')


INSERT INTO `igeir`(`Beskrivelse`,`Header`, `BrukerId`, `Pris`, `Aktiv`, `Privat`) /*x30 spørringer eller mer*/
VALUES ('Test','Test','2','5000','1','1')




#Underkategori
#Bilutstyr:

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`, `Nivå2`,`Nivå3`) 
VALUES ('04','3','1','Deler','','');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`,`Nivå2`,`Nivå3`) 
VALUES ('04','3','2','Bilstereo','','');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`, `Nivå2`,`Nivå3`) 
VALUES ('04','3','3','Styling','','');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`, `Nivå2`,`Nivå3`) 
VALUES ('04','3','4','Takstativ og boks','','');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`, `Nivå2`,`Nivå3`) 
VALUES ('04','3','5','GPS','','');


#Sport og Friluftsliv(meny nivå 2):


INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`)
VALUES ('19','3','6','Jakt og fiske','Utstyr','Klær');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) 
VALUES ('19','3','7','Treningsutstyr','','');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) 
VALUES ('19','3','8','Sommersport','Vannsport','Sykkelsport');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) 
VALUES ('19','3','9','Vintersport','Langren','Snowboard');


#Møbler og Interiør:
INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('16','3','10','Bord og Stoler');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('16','3','11','Sofa og Lenestoler');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('16','3','12','Senger og madrasser');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('16','3','12','Hyller, kommoder og skap');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('16','3','13','Belysning');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('16','3','14','Nips');


#Elektronikk:
INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('6','3','15','Data');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('6','3','16','Lyd og Bildet');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('6','3','17','Spill og konsoll');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('6','3','18','Telefoner og tilbehør');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('6','3','19','Foto og video');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('6','3','20','Div');


#Klær (meny nivå 2):

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) 
VALUES ('14','3','20','Menn','Overdel','Underdel');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) 
VALUES ('14','3','21','Kvinner','Overdel','Underdel');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`, `Nivå2`, `Nivå3`) 
VALUES ('14','3','22','Barn','Overdel','Underdel');


#Fridtid hobby og underholdning:

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('13','','','Brettspill');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`,`Igeri-Kode`, `Nivå1`) 
VALUES ('13','','','Bøker og blader');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('13','','','Modeller og byggesett');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`,`Igeri-Kode`, `Nivå1`) 
VALUES ('13','','','Musikk og film');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('13','','','Samlerobjekter');

INSERT INTO `Underkategori`(`TorgetId`, `TypeId`, `Igeri-Kode`, `Nivå1`) 
VALUES ('13','','','Instrumenter');

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


DROP PROCEDURE IF EXISTS hentNyhet;
DROP PROCEDURE IF EXISTS hentReklame;

DROP PROCEDURE IF EXISTS leggTilBruker;
DROP PROCEDURE IF EXISTS leggTilNyhet;
DROP PROCEDURE IF EXISTS leggTilReklame;
DROP PROCEDURE IF EXISTS slettBruker;
DROP PROCEDURE IF EXISTS adminLogin;

DROP PROCEDURE IF EXISTS adminNyheterOversikt;
DROP PROCEDURE IF EXISTS slettNyhet;
DROP PROCEDURE IF EXISTS hentEnNyhet;
DROP PROCEDURE IF EXISTS oppdaterNyhet;
DROP PROCEDURE IF EXISTS velgReklameBilde;
DROP PROCEDURE IF EXISTS oppdaterBilde;

DROP PROCEDURE IF EXISTS adminReklameOversikt;
DROP PROCEDURE IF EXISTS adminSlettReklameAktor;
DROP PROCEDURE IF EXISTS adminOppdaterReklame;
DROP PROCEDURE IF EXISTS adminRegistrerTorgKategori;
DROP PROCEDURE IF EXISTS adminOppdaterFilnavn;
DROP PROCEDURE IF EXISTS adminHentReklame;
DROP PROCEDURE IF EXISTS adminOversikt;
DROP PROCEDURE IF EXISTS adminHentEnAdmin;
DROP PROCEDURE IF EXISTS adminOppdaterEnAdmin;
DROP PROCEDURE IF EXISTS adminLeggTilAdmin;
DROP PROCEDURE IF EXISTS adminPassord;
DROP PROCEDURE IF EXISTS adminHentMail;
DROP PROCEDURE IF EXISTS adminPrivInfo;
DROP PROCEDURE IF EXISTS adminSlettAdmin;

DROP PROCEDURE IF EXISTS registrerAnnonse;
DROP PROCEDURE IF EXISTS hentAltFraTorget;

DROP PROCEDURE IF EXISTS velgBruker;
DROP PROCEDURE IF EXISTS oppdaterBruker;
DROP PROCEDURE IF EXISTS velgAltFraTorgetSortert;
DROP PROCEDURE IF EXISTS velgAltFraTorget;
DROP PROCEDURE IF EXISTS velgAltFraMarkedSortert;
DROP PROCEDURE IF EXISTS velgAltFraMarked;

DROP PROCEDURE IF EXISTS oppdaterTorget;
DROP PROCEDURE IF EXISTS oppdaterMarked;

DROP PROCEDURE IF EXISTS sjekkIgeirRef;
DROP PROCEDURE IF EXISTS velgAlleIgeir;

DELIMITER //

CREATE PROCEDURE hentNyhet(
IN  varId          INT
)

BEGIN
SELECT Overskrift,Igress,Hovedtekst
FROM nyheter
WHERE NyheterId=varId; 
END //

CREATE PROCEDURE hentReklame(
IN  varId          INT
)
BEGIN
SELECT Filnavn,Beskrivelse FROM reklame WHERE ReklameId=varId; 
END //

CREATE PROCEDURE leggTilBruker(
IN  varBrukerMail          VARCHAR(45) ,
IN  varBrukerPassord       VARCHAR(128) ,
IN  varBrukerFornavn       VARCHAR(45) ,
IN  varBrukerEtternavn     VARCHAR(45) ,
IN  varBrukerAdresse       VARCHAR(45) ,
IN  varBrukerPostnr        CHAR(4)     ,
IN  varBrukerTlf           CHAR(8)     ,
IN  varBrukerMob           CHAR(8)     ,
IN  varBrukerUrl           VARCHAR(45) ,
IN  varSelgerhenvendelser  TINYINT(1)  ,
IN  varOrgnr               CHAR(9) 	, 
IN  varBetmedlem           TINYINT(1)  ,
IN  varAktiv               TINYINT(1)  
)

BEGIN 

INSERT INTO bruker(
BrukerMail              ,
BrukerPassord           ,
BrukerFornavn           ,
BrukerEtternavn         ,
BrukerAdresse           ,
BrukerPostnr            ,
BrukerTlf               ,
BrukerMob               ,
BrukerUrl               ,
Selgerhenvendelser      ,
Orgnr                   ,
Betmedlem               ,
Aktiv
) VALUES (
varBrukerMail              ,
varBrukerPassord           ,
varBrukerFornavn           ,
varBrukerEtternavn         ,
varBrukerAdresse           ,
varBrukerPostnr            ,
varBrukerTlf               ,
varBrukerMob               ,
varBrukerUrl               ,
varSelgerhenvendelser      ,
varOrgnr                   ,
varBetmedlem               ,
varAktiv
) ;
END //

CREATE PROCEDURE leggTilNyhet(
IN  varOverskrift       VARCHAR(45) ,
IN  varIngress           TINYTEXT    ,
IN  varHovedtekst       TEXT        ,
IN  varAdminId          INT         ,
IN  varLaget            DATETIME    
)

BEGIN

INSERT INTO nyheter(
Overskrift      ,
Ingress          ,
Hovedtekst      ,
AdminId         ,
Laget
) VALUES (
varOverskrift   ,
varIngress       ,
varHovedtekst   ,
varAdminId      ,
varLaget
) ;

END //

CREATE PROCEDURE leggTilReklame(
IN  varFirma            VARCHAR(45) ,
IN  varFilnavn          VARCHAR(45) ,
IN  varLink             VARCHAR(45) ,
IN  varAlternativ       VARCHAR(45) ,
IN  varBeskrivelse      TEXT        ,
IN  varAdminId          INT         ,
IN  varLaget            DATETIME
)
BEGIN

INSERT INTO reklame(
Firma       ,
Filnavn     ,
Link        ,
Alternativ  ,
Beskrivelse ,
AdminId     ,
Laget
) VALUES (
varFirma        ,
varFilnavn      ,
varLink         ,
varAlternativ   ,
varBeskrivelse  ,
varAdminId      ,
varLaget
) ;

END //

CREATE PROCEDURE slettBruker(
IN  varId INT
)

BEGIN

INSERT INTO slettedebrukere SELECT * FROM bruker WHERE Bruker.BrukerId=varId;
DELETE FROM bruker WHERE BrukerId=varId;

END //

CREATE PROCEDURE adminLogin(
in varBrukernavn    VARCHAR(25) ,
in varPassord       VARCHAR(128) 
)
BEGIN

SELECT AdminId,AdminBrukernavn,AdminPassord
FROM admin WHERE AdminBrukernavn=varBrukernavn AND AdminPassord=varPassord;

END //

CREATE PROCEDURE adminNyheterOversikt(
)

BEGIN

SELECT NyheterId,Overskrift,AdminBrukernavn,Laget 
FROM nyheter Natural JOIN admin ORDER BY NyheterID DESC;

END //

CREATE PROCEDURE slettNyhet(
IN varId    INT
)

BEGIN

DELETE FROM nyheter WHERE NyheterId=varId;

END //

CREATE PROCEDURE hentEnNyhet(
IN varId    INT
)

BEGIN

SELECT NyheterId,Overskrift,Ingress,Hovedtekst FROM nyheter WHERE NyheterId=varId;

END //

CREATE PROCEDURE oppdaterNyhet(
IN  varId               INT         ,
IN  varOverskrift       VARCHAR(45) ,
IN  varIngress          TINYTEXT    ,
IN  varHovedtekst       TEXT        
)
BEGIN
UPDATE nyheter
SET Overskrift=varOverskrift,Ingress=varIngress,Hovedtekst=varHovedtekst 
WHERE NyheterId=varId;
END //

CREATE PROCEDURE velgReklameBilde(
IN varFirma     VARCHAR(45)
)
BEGIN
SELECT ReklameId FROM reklame WHERE Firma=varFirma;
END //

CREATE PROCEDURE oppdaterBilde(
IN  varReklameId    INT             ,
IN  varFilnavn      VARCHAR(45)     ,
IN  varBeskrivelse  TEXT    
)
BEGIN
UPDATE reklame SET Filnavn=varFilnavn, Beskrivelse=varBeskrivelse WHERE ReklameId=varReklameId;
END //

CREATE PROCEDURE adminReklameOversikt(
)
BEGIN
SELECT ReklameId,Firma,Link,Alternativ,Beskrivelse,Filnavn 
FROM reklame 
;
 
END //

CREATE PROCEDURE adminSlettReklameAktor(
IN varId    INT
)
BEGIN
DELETE FROM reklame WHERE ReklameId=varId;
END //

CREATE PROCEDURE adminOppdaterReklame(
IN  varReklameId    INT         ,
IN  varFirma        VARCHAR(45) ,
IN  varLink         VARCHAR(45) ,
IN  varAlternativ   VARCHAR(45) ,
IN  varBeskrivelse  TEXT        
)
BEGIN
UPDATE reklame 
SET Firma=varFirma, Link=varLink, Alternativ=varAlternativ, Beskrivelse=varBeskrivelse 
WHERE ReklameId=varReklameId;
END //

CREATE PROCEDURE adminRegistrerTorgKategori(
IN  varData     VARCHAR(45)
)
BEGIN
INSERT INTO torget(TorgKategori) VALUES (varData);
END //

CREATE PROCEDURE adminOppdaterFilnavn(
IN varReklameId INT         ,
IN varFilnavn   VARCHAR(45)
)
BEGIN
UPDATE reklame SET Flinavn=varFilnavn WHERE ReklameId=varReklameId;
END //

CREATE PROCEDURE adminHentReklame(
IN varReklameId INT
)
BEGIN
SELECT ReklameId,Firma,Link,Alternativ,Beskrivelse From reklame WHERE ReklameId=varReklameId;
END //

CREATE PROCEDURE registrerAnnonse(
IN varHeader    VARCHAR(45) ,
IN varPris      INT(10)     ,
IN varBilde     INT         ,
IN varBeskrivelse   TEXT
)
BEGIN
INSERT INTO bruker (
Header      ,
Pris        ,
Bilde       ,
Beskrivelse
) VALUES (
varHeader   ,
varPris     ,
varBilde    ,
varBeskrivelse
);
END //

CREATE PROCEDURE adminOversikt()
BEGIN
SELECT AdminId,AdminMail,AdminBrukernavn,AdminMob
FROM admin;
END //

CREATE PROCEDURE hentAltFraTorget()
BEGIN
SELECT * FROM torget ORDER BY TorgetId;
END //

CREATE PROCEDURE adminHentEnAdmin(
IN varId    INT
)
BEGIN
SELECT AdminFornavn,AdminEtternavn,AdminMail,AdminAdresse,AdminTlf,AdminMob,AdminPostnr,AdminBrukernavn 
FROM admin WHERE AdminId=varId;
END //

CREATE PROCEDURE adminOppdaterEnAdmin(
IN  varId           INT         ,
IN  varFornavn      VARCHAR(45) ,
IN  varEtternavn    VARCHAR(45) ,
IN  varMail         VARCHAR(50) ,
IN  varAdresse      VARCHAR(45) ,
IN  varTlf          CHAR(8)     ,
IN  varMob          CHAR(8)     ,
IN  varPostnr       CHAR(4)     ,
IN  varBrukernavn   VARCHAR(25)
)
BEGIN
UPDATE admin SET AdminFornavn=varFornavn,AdminEtternavn=varEtternavn,AdminMail=varMail,AdminAdresse=varAdresse,AdminTlf=varTlf,
AdminMob=varMob,AdminPostnr=varPostnr,AdminBrukernavn=varBrukernavn WHERE AdminId=varId;
END //

CREATE PROCEDURE velgBruker(
)
BEGIN
SELECT * FROM bruker ORDER BY BrukerId;
END //

CREATE PROCEDURE oppdaterBruker(
IN  varId           INT         ,
IN  varFornavn      VARCHAR(45) ,
IN  varEtternavn    VARCHAR(45) ,
IN  varAdresse      VARCHAR(45) ,
IN  varPostnr       CHAR(4)     ,
IN  varTlf          CHAR(8)     ,
IN  varMob          CHAR(8)     ,
IN  varMail         VARCHAR(50) ,
IN  varPassord      VARCHAR(110)
)
BEGIN
UPDATE bruker SET 
BrukerFornavn=varFornavn, 
BrukerEtternavn=varEtternavn, 
BrukerAdresse=varAdresse, 
BrukerPostnr=varPostnr, 
BrukerTlf=varTlf, 
BrukerMob=varMob, 
BrukerMail=varMail, 
BrukerPassord=varPassord 
WHERE 
BrukerId=varId;
END //

CREATE PROCEDURE adminLeggTilAdmin(
IN	varId			CHAR(7)		,
IN  varFornavn      VARCHAR(45) ,
IN  varEtternavn    VARCHAR(45) ,
IN  varMail         VARCHAR(50) ,
IN  varAdresse      VARCHAR(45) ,
IN  varTlf          CHAR(8)     ,
IN  varMob          CHAR(8)     ,
IN  varPostnr       CHAR(4)     ,
IN  varBrukernavn   VARCHAR(45) ,
IN  varPassord      VARCHAR(110)
)
BEGIN
INSERT INTO admin(
AdminId			,
AdminFornavn    ,
AdminEtternavn  ,
AdminMail       ,
AdminAdresse    ,
AdminTlf        ,
AdminMob        ,
AdminPostnr     ,
AdminBrukernavn ,
AdminPassord
) VALUES (
varId			,
varFornavn      ,
varEtternavn    ,
varMail         ,
varAdresse      ,
varTlf          ,
varMob          ,
varPostnr       ,
varBrukernavn   ,
varPassord
);
END //

CREATE PROCEDURE velgAltFraTorgetSortert(
)
BEGIN
SELECT * FROM torget ORDER BY TorgetId;
END //

CREATE PROCEDURE velgAltFraTorget(
)
BEGIN
SELECT * FROM torget;
END //

CREATE PROCEDURE velgAltFraMarkedSortert(
)
BEGIN
SELECT * FROM markedsplass ORDER BY MarkedsplassId;
END //

CREATE PROCEDURE velgAltFraMarked(
)
BEGIN
SELECT * FROM markedsplass;
END //

CREATE PROCEDURE adminPassord(
IN varId        INT             ,
IN varPassord   VARCHAR(110)
)
BEGIN
UPDATE admin SET AdminPassord=varPassord WHERE AdminId=varId;
END //

CREATE PROCEDURE adminHentMail(
IN varId        INT
)
BEGIN
SELECT AdminMail FROM admin WHERE AdminId=varId;
END //

CREATE PROCEDURE adminPrivInfo(
)
BEGIN
SELECT AdminBrukernavn,AdminId,AdminMail FROM admin ORDER BY AdminBrukernavn;
END //

CREATE PROCEDURE adminSlettAdmin(
IN  varId INT
)

BEGIN

DELETE FROM admin WHERE AdminId=varId;

END //

CREATE PROCEDURE oppdaterTorget(
IN 	varTorgetId			INT(2)		,
IN	varMarkedsplassId	INT(2)		,
IN	varTorgkategori		VARCHAR(45)
)
BEGIN
UPDATE torget
SET MarkedsplassId=varMarkedsplassId,TorgKategori=varTorgkategori WHERE TorgetId=varTorgetId;
END //

CREATE PROCEDURE oppdaterMarked(
IN varMarkedsplassId	INT(2)		,
IN	varHovedkategori	VARCHAR(45)
)
BEGIN
UPDATE markedsplass
SET Hovedkategori=varHovedkategori WHERE MarkedsplassId=varMarkedsplassId;
END //

CREATE PROCEDURE sjekkIgeirRef(
varRef CHAR(8)
)
BEGIN
SELECT IgeirKode FROM igeir WHERE IgeirKode=varRef;
END //

CREATE PROCEDURE velgAlleIgeir(
)
BEGIN
SELECT * FROM igeir ORDER BY IgeirKode;
END //

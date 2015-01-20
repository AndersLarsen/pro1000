/*
Lager et view for undersøkelse 1 spørsmål 6
som gir tilbake hvor mange personer som har 
svart hvilket svaralternativ
*/

DROP VIEW IF EXISTS U01SP06;


CREATE VIEW U01SP06 AS

SELECT count(*) AS SP06
FROM PreSporreundersokelse
WHERE SP06 LIKE "%1%"

UNION 

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP06 LIKE "%2%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP06 LIKE "%3%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP06 LIKE "%4%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP06 LIKE "%5%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP06 LIKE "%6%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP06 LIKE "%8%";

 SELECT * FROM U01SP06;
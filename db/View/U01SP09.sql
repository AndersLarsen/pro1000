/*
Lager et view for undersøkelse 1 spørsmål 9
som gir tilbake hvor mange personer som har 
svart hvilket svaralternativ
*/

DROP VIEW IF EXISTS U01SP09;


CREATE VIEW U01SP09 AS

SELECT count(*) AS SP09
FROM PreSporreundersokelse
WHERE SP09 LIKE "%1%"

UNION 

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP09 LIKE "%2%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP09 LIKE "%3%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP09 LIKE "%4%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP09 LIKE "%5%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP09 LIKE "%6%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP09 LIKE "%8%";

 SELECT * FROM U01SP09;
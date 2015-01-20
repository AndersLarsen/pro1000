/*
Lager et view for undersøkelse 1 spørsmål 8
som gir tilbake hvor mange personer som har 
svart hvilket svaralternativ
*/

DROP VIEW IF EXISTS U01SP08;


CREATE VIEW U01SP08 AS

SELECT count(*) AS SP08
FROM PreSporreundersokelse
WHERE SP08 LIKE "%1%"

UNION 

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP08 LIKE "%2%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP08 LIKE "%3%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP08 LIKE "%4%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP08 LIKE "%5%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP08 LIKE "%6%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP08 LIKE "%8%";

 SELECT * FROM U01SP08;
/*
Lager et view for undersøkelse 1 spørsmål 7
som gir tilbake hvor mange personer som har 
svart hvilket svaralternativ
*/

DROP VIEW IF EXISTS U01SP07;


CREATE VIEW U01SP07 AS

SELECT count(*) AS SP07
FROM PreSporreundersokelse
WHERE SP07 LIKE "%1%"

UNION 

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP07 LIKE "%2%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP07 LIKE "%3%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP07 LIKE "%4%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP07 LIKE "%5%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP07 LIKE "%6%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP07 LIKE "%8%";

 SELECT * FROM U01SP07;
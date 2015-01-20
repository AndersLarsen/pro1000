/*
Lager et view for undersøkelse 1 spørsmål 3
som gir tilbake hvor mange personer som har 
svart hvilket svaralternativ
*/

DROP VIEW IF EXISTS U01SP03;


CREATE VIEW U01SP03 AS

SELECT count(*) AS SP03
FROM PreSporreundersokelse
WHERE SP03 LIKE "%1%"

UNION 

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP03 LIKE "%2%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP03 LIKE "%3%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP03 LIKE "%4%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP03 LIKE "%5%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP03 LIKE "%6%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP03 LIKE "%8%";

 SELECT * FROM U01SP03;
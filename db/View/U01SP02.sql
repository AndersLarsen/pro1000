/*
Lager et view for undersøkelse 1 spørsmål 2
som gir tilbake hvor mange personer som har 
svart hvilket svaralternativ
*/

DROP VIEW IF EXISTS U01SP02;


CREATE VIEW U01SP02 AS

SELECT count(*) AS SP02
FROM PreSporreundersokelse
WHERE SP02 LIKE "%1%"

UNION 

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP02 LIKE "%2%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP02 LIKE "%3%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP02 LIKE "%4%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP02 LIKE "%5%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP02 LIKE "%6%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP02 LIKE "%8%";

 SELECT * FROM U01SP02;
/*
Lager et view for undersøkelse 1 spørsmål 1 
som gir tilbake hvor mange personer som har 
svart hvilket svaralternativ
*/

DROP VIEW IF EXISTS U01SP01;


CREATE VIEW U01SP01 AS

SELECT count(*) AS SP01
FROM PreSporreundersokelse
WHERE SP01 LIKE "%1%"

UNION 

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP01 LIKE "%2%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP01 LIKE "%3%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP01 LIKE "%4%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP01 LIKE "%5%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP01 LIKE "%6%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP01 LIKE "%8%";

 SELECT * FROM U01SP01;
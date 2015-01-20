/*
Lager et view for undersøkelse 1 spørsmål 10
som gir tilbake hvor mange personer som har 
svart hvilket svaralternativ
*/

DROP VIEW IF EXISTS U01SP10;


CREATE VIEW U01SP10 AS

SELECT count(*) AS SP10
FROM PreSporreundersokelse
WHERE SP10 LIKE "%1%"

UNION 

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP10 LIKE "%2%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP10 LIKE "%3%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP10 LIKE "%4%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP10 LIKE "%5%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP10 LIKE "%6%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP10 LIKE "%8%";

 SELECT * FROM U01SP10;
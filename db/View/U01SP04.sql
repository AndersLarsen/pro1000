/*
Lager et view for undersøkelse 1 spørsmål 4
som gir tilbake hvor mange personer som har 
svart hvilket svaralternativ
*/

DROP VIEW IF EXISTS U01SP04;


CREATE VIEW U01SP04 AS

SELECT count(*) AS SP04
FROM PreSporreundersokelse
WHERE SP04 LIKE "%1%"

UNION 

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP04 LIKE "%2%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP04 LIKE "%3%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP04 LIKE "%4%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP04 LIKE "%5%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP04 LIKE "%6%"

UNION

SELECT count(*)
FROM PreSporreundersokelse
WHERE SP04 LIKE "%8%";

 SELECT * FROM U01SP04;
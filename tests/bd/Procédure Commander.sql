-- marche
EXEC Commander(28, 1, 'Rue de la vie', 'Toulouse', 31000);
-- reglement non-existant
EXEC Commander(28, 999, 'Rue de la vie', 'Toulouse', 31000);
-- client non-existant
EXEC Commander(999, 101, 'Rue de la vie', 'Toulouse', 31000);

-- reset
DELETE FROM QUANTITE WHERE IDCOMMANDE > 100;
DELETE FROM COMMANDE WHERE IDCOMMANDE > 100;

INSERT INTO PANIER
VALUES(28, 21, 28);

UPDATE PRODUIT
set stock = 5
where idproduit = 21;

DROP SEQUENCE seq_commande;
CREATE SEQUENCE seq_commande
    START WITH 101;

rollback;
COMMIT;

-- affichage
SELECT * FROM PANIER WHERE IDCLIENT = 28;
SELECT * FROM COMMANDE WHERE IDCLIENT = 28;
select idproduit, stock from produit where idproduit = 21;
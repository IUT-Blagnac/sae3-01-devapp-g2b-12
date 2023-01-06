CREATE OR REPLACE PROCEDURE Commander
(
    p_idclient CLIENT.IDCLIENT%TYPE,
    p_idreglement REGLEMENT.IDREGLEMENT%TYPE,
    p_adresse COMMANDE.ADRESSE%TYPE,
    p_ville COMMANDE.VILLE%TYPE,
    p_codepostal COMMANDE.CODEPOSTAL%TYPE
)
IS
    -- panier
    CURSOR C_client_panier IS
        SELECT IDPRODUIT, QUANTITE
        FROM PANIER
        WHERE IDCLIENT = p_idclient;

    -- info commande
    idcommande COMMANDE.IDCOMMANDE%TYPE;
    prixunitaire PRODUIT.PRIX%TYPE;

    -- vérifications
    v_idclient CLIENT.IDCLIENT%TYPE;
    v_idreglement REGLEMENT.IDREGLEMENT%TYPE;
BEGIN
    -- vérifications
    -- le client existe
    SELECT IDCLIENT INTO v_idclient FROM CLIENT WHERE IDCLIENT = p_idclient;
    -- le reglement existe
    SELECT IDREGLEMENT INTO v_idreglement FROM REGLEMENT WHERE IDREGLEMENT = p_idreglement;

    -- créer la commande
    idcommande := seq_commande.nextval;
    INSERT INTO COMMANDE
    VALUES(idcommande, p_idclient, p_idreglement, p_adresse, p_ville, p_codepostal);

    FOR elementpanier IN C_client_panier LOOP
        -- récupère le prix unitaire
        SELECT PRIX INTO prixunitaire FROM PRODUIT WHERE IDPRODUIT = elementpanier.idproduit;
        -- ajoute le produit à la commande
        INSERT INTO QUANTITE
        VALUES(elementpanier.idproduit, idcommande, elementpanier.quantite, prixunitaire);
        -- retire le produit du panier
        DELETE FROM PANIER WHERE IDCLIENT = p_idclient AND IDPRODUIT = elementpanier.idproduit;
    END LOOP;

    COMMIT;
END;
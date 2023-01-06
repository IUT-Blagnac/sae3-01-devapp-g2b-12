DROP TABLE QUANTITE;

DROP TABLE COMMANDE;

DROP TABLE PAYPAL;

DROP TABLE CARTEBANCAIRE;

DROP TABLE REGLEMENT;

DROP TABLE PANIER;

DROP TABLE PRODUIT;

DROP TABLE CATEGORIE;

DROP TABLE CLIENT;


DROP SEQUENCE SEQ_CLIENT;

DROP SEQUENCE SEQ_CATEGORIE;

DROP SEQUENCE SEQ_PRODUIT;

DROP SEQUENCE SEQ_REGLEMENT;

DROP SEQUENCE SEQ_COMMANDE;


CREATE TABLE CLIENT
(
    IDCLIENT NUMBER(10) NOT NULL,
    NOM VARCHAR2(128) NOT NULL,
    PRENOM VARCHAR2(128) NOT NULL,
    MAIL VARCHAR2(128) NOT NULL,
    MDP VARCHAR2(128) NOT NULL,
    AGRICULTEUR NUMBER(1),
    CONSTRAINT PK_CLIENT PRIMARY KEY (IDCLIENT),
    CONSTRAINT CK_CLIENT_IDCLIENT CHECK (IDCLIENT > 0),
    CONSTRAINT CK_CLIENT_AGRICULTEUR CHECK (AGRICULTEUR = 0 OR AGRICULTEUR = 1)
);

CREATE SEQUENCE SEQ_CLIENT
START WITH 1
INCREMENT BY 1;


CREATE TABLE CATEGORIE
(
    IDCATEGORIE NUMBER(10) NOT NULL,
    IDCATEGORIEPARENT NUMBER(10),
    NOM VARCHAR2(128) NOT NULL,
    CONSTRAINT PK_CATEGORIE PRIMARY KEY (IDCATEGORIE),
    CONSTRAINT FK_CATEGORIE_CATEGORIE FOREIGN KEY (IDCATEGORIEPARENT) REFERENCES CATEGORIE (IDCATEGORIE),
    CONSTRAINT CK_CATEGORIE_IDCATEGORIE CHECK (IDCATEGORIE > 0),
    CONSTRAINT CK_CATEGORIE_IDCATEGORIEPARENT CHECK (IDCATEGORIEPARENT = NULL OR IDCATEGORIEPARENT <> IDCATEGORIE)
);

CREATE SEQUENCE SEQ_CATEGORIE
START WITH 1
INCREMENT BY 1;


CREATE TABLE PRODUIT
(
    IDPRODUIT NUMBER(10) NOT NULL,
    IDCATEGORIE NUMBER(10) NOT NULL,
    NOM VARCHAR2(128) NOT NULL,
    DESCRIPTION VARCHAR2(2048),
    POIDS NUMBER(5,2) NOT NULL,
    PRIX NUMBER(10,2) NOT NULL,
    STOCK NUMBER(10) NOT NULL,
    REGION VARCHAR2(128) NOT NULL,
    CONSTRAINT PK_PRODUIT PRIMARY KEY (IDPRODUIT),
    CONSTRAINT FK_PRODUIT_CATEGORIE FOREIGN KEY (IDCATEGORIE) REFERENCES CATEGORIE (IDCATEGORIE),
    CONSTRAINT CK_PRODUIT_IDPRODUIT CHECK (IDPRODUIT > 0),
    CONSTRAINT CK_PRODUIT_POIDS CHECK (POIDS > 0),
    CONSTRAINT CK_PRODUIT_PRIX CHECK (PRIX > 0),
    CONSTRAINT CK_PRODUIT_STOCK CHECK (STOCK = 0 OR STOCK > 0)
);

CREATE SEQUENCE SEQ_PRODUIT
START WITH 1
INCREMENT BY 1;


CREATE TABLE PANIER
(
    IDCLIENT NUMBER(10) NOT NULL,
    IDPRODUIT NUMBER(10) NOT NULL,
    QUANTITE NUMBER(10) NOT NULL,
    CONSTRAINT PK_PANIER PRIMARY KEY (IDCLIENT, IDPRODUIT),
    CONSTRAINT FK_PANIER_CLIENT FOREIGN KEY (IDCLIENT) REFERENCES CLIENT (IDCLIENT),
    CONSTRAINT FK_PANIER_PRODUIT FOREIGN KEY (IDPRODUIT) REFERENCES PRODUIT (IDPRODUIT),
    CONSTRAINT CK_PANIER_QUANTITE CHECK (QUANTITE > 0)
);


CREATE TABLE REGLEMENT
(
    IDREGLEMENT NUMBER(10) NOT NULL,
    CONSTRAINT PK_REGLEMENT PRIMARY KEY (IDREGLEMENT),
    CONSTRAINT CK_REGLEMENT_IDREGLEMENT CHECK (IDREGLEMENT > 0)
);

CREATE SEQUENCE SEQ_REGLEMENT
START WITH 1
INCREMENT BY 1;


CREATE TABLE CARTEBANCAIRE
(
    IDREGLEMENT NUMBER(10) NOT NULL,
    NUMCB NUMBER(16) NOT NULL,
    CRYPTOGRAMME NUMBER(3) NOT NULL,
    MOISEXPIRATION NUMBER(2) NOT NULL,
    ANNEEEXPIRATION NUMBER(4) NOT NULL,
    CONSTRAINT PK_CARTEBANCAIRE PRIMARY KEY (IDREGLEMENT),
    CONSTRAINT FK_CARTEBANCAIRE_REGLEMENT FOREIGN KEY (IDREGLEMENT) REFERENCES REGLEMENT (IDREGLEMENT),
    CONSTRAINT CK_CARTEBANCAIRE_NUMCB CHECK (NUMCB > 0),
    CONSTRAINT CK_CARTEBANCAIRE_CRYPTOGRAMME CHECK (CRYPTOGRAMME > 0),
    CONSTRAINT CK_CB_MOISEXPIRATION CHECK (MOISEXPIRATION > 0),
    CONSTRAINT CK_CB_ANNEEEXPIRATION CHECK (ANNEEEXPIRATION > 0)
);


CREATE TABLE PAYPAL
(
    IDREGLEMENT NUMBER(10) NOT NULL,
    CONSTRAINT PK_PAYPAL PRIMARY KEY (IDREGLEMENT),
    CONSTRAINT FK_PAYPAL_REGLEMENT FOREIGN KEY (IDREGLEMENT) REFERENCES REGLEMENT (IDREGLEMENT)
);


CREATE TABLE COMMANDE
(
    IDCOMMANDE NUMBER(10) NOT NULL,
    IDCLIENT NUMBER(10) NOT NULL,
    IDREGLEMENT NUMBER(10) NOT NULL,
    ADRESSE VARCHAR2(128) NOT NULL,
    VILLE VARCHAR2(128) NOT NULL,
    CODEPOSTAL NUMBER(6) NOT NULL,
    CONSTRAINT PK_COMMANDE PRIMARY KEY (IDCOMMANDE),
    CONSTRAINT FK_COMMANDE_CLIENT FOREIGN KEY (IDCLIENT) REFERENCES CLIENT (IDCLIENT),
    CONSTRAINT FK_COMMANDE_REGLEMENT FOREIGN KEY (IDREGLEMENT) REFERENCES REGLEMENT (IDREGLEMENT),
    CONSTRAINT CK_COMMANDE_IDCOMMANDE CHECK (IDCOMMANDE > 0),
    CONSTRAINT CK_COMMANDE_CODEPOSTAL CHECK (CODEPOSTAL > 0)
);

CREATE SEQUENCE SEQ_COMMANDE
START WITH 1
INCREMENT BY 1;


CREATE TABLE QUANTITE
(
    IDPRODUIT NUMBER(10) NOT NULL,
    IDCOMMANDE NUMBER(10) NOT NULL,
    QUANTITE NUMBER(10) NOT NULL,
    PRIXUNITAIRE NUMBER(10,2) NOT NULL,
    CONSTRAINT PK_QUANTITE PRIMARY KEY (IDPRODUIT, IDCOMMANDE),
    CONSTRAINT FK_QUANTITE_PRODUIT FOREIGN KEY (IDPRODUIT) REFERENCES PRODUIT (IDPRODUIT),
    CONSTRAINT FK_QUANTITE_COMMANDE FOREIGN KEY (IDCOMMANDE) REFERENCES COMMANDE (IDCOMMANDE),
    CONSTRAINT CK_QUANTITE_QUANTITE CHECK (QUANTITE >= 0),
    CONSTRAINT CK_QUANTITE_PRIXUNITAIRE CHECK (PRIXUNITAIRE > 0)
);

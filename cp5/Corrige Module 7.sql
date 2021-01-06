-- Module 7

BEGIN 

-- Pas de transaction dans MySQL pour le LDD

-- Copie de la table categorie avec tous ses enregistrements :

SELECT * INTO categories_2 FROM categories

-- Pour MySQL

CREATE TABLE categories_2 SELECT * FROM categories

-- Vérification :

SELECT * FROM categories_2

-- Copie de la table produits  avec tous ses enregistrements :

SELECT * INTO produits_2 FROM produits

-- Pour MySQL

CREATE TABLE produits_2 SELECT * FROM produits

-- Vérification :

SELECT * FROM produits_2

-- ROLLBACK
COMMIT

-- Inutile dans MySQL

-- Pas de contrainte avec CHECK dans MySQL

BEGIN TRAN

ALTER TABLE employes ADD CONSTRAINT CHK_DATE_NAISSANCE CHECK (DATE_NAISSANCE BETWEEN '1900-01-01' AND GETDATE())

ALTER TABLE employes ADD CONSTRAINT CHK_DATE_EMBAUCHE CHECK (DATE_EMBAUCHE BETWEEN '1900-01-01' AND GETDATE())

ALTER TABLE employes DROP CHECK CHK_DATE_NAISSANCE

pour Oracle => getdate remplacer par sysdate
et pour Mysql et PostGreSQL => getdate remplacer par now
-- ROLLBACK
COMMIT

BEGIN TRAN
GO

CREATE VIEW v_employes_managers AS
SELECT e.nom, e.prenom, m.nom AS responsable, DATEDIFF(yyyy, e.date_naissance, GETDATE()) as age FROM employes e JOIN employes m
ON e.rend_compte = m.no_employe
WHERE 40 > DATEDIFF(yyyy,e.date_naissance, GETDATE())

-- adapter les fonction pour oracle et Mysql => sysdate et now et date1- date2 pour le datediff

-- Vérification :

SELECT * FROM v_employes_managers

-- ROLLBACK
COMMIT
 
-- Créez une vue qui affiche le nom de la société, ladresse, le téléphone et la ville des clients
-- qui habitent à Toulouse, à Strasbourg, à Nantes ou à Marseille

BEGIN TRAN
GO

CREATE VIEW v_clients_province AS
SELECT societe, adresse, telephone, ville
FROM clients
WHERE ville IN ('Toulouse', 'Strasbourg', 'Nantes', 'Marseille')

-- Vérification :

SELECT * FROM v_clients_province

-- ROLLBACK
COMMIT 
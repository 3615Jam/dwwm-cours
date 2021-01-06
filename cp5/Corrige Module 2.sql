-- Module 2
-- Atelier 2.1

select * from employes
select * from categories
select NOM , PRENOM , DATE_NAISSANCE, nvl(commission,0)  from employes

-- OU POUR MYSQL

select NOM , PRENOM , DATE_NAISSANCE, ifnull(commission,0)  from employes

-- OU POUR POSTGRESQL

select NOM , PRENOM , DATE_NAISSANCE, coalesce(commission,0)  from employes

select distinct fonction from employes
select distinct pays from clients
select distinct ville from clients

-- Atelier 2.2

 select NOM_PRODUIT , PRIX_UNITAIRE*UNITES_STOCK "stock"
 from produits

 select NOM, PRENOM, NOW() - date_naissance "age",
 NOW() - date_embauche "ancienneté"
 from employes
 
 -- OU Pour MySQL
 
 select NOM, PRENOM, TO_DAYS(NOW()) - TO_DAYS(date_naissance) "age",
 TO_DAYS(NOW()) - TO_DAYS(date_embauche) "ancienneté"
 from employes
 

 select NOM "Employé" , 'gagne' "a un" , SALAIRE "gain annuel",
 'par an.       '  "sur 12 mois"
 from employes
 
 -- Corrigé DM
 
SELECT NOM "Employé",  'gagne' AS  "a un", SALAIRE "gain annuel",  'par an.       ' AS  "sur 12 mois"
FROM employes

-- Atelier 2.3

SELECT
  SOCIETE,
  PAYS
FROM
  clients
WHERE
  (VILLE Like 'Toulouse')
  
  SELECT
  NOM,
  PRENOM,
  FONCTION
FROM
  employes
WHERE
  (REND_COMPTE = 2)
  
  
  SELECT
  NOM,
  PRENOM,
  FONCTION
FROM
  employes
WHERE
  (FONCTION NOT LIKE 'Représentant(e)')
  
  
SELECT
  NOM,
  PRENOM,
  FONCTION
FROM
  employes
WHERE
  (SALAIRE < 3500)
  
SELECT
  SOCIETE,
  VILLE,
  PAYS
FROM
  clients
WHERE
  (FAX IS NULL)
  
SELECT
  NOM,
  PRENOM,
  FONCTION
FROM
  employes
WHERE
  (REND_COMPTE IS NULL)
  
-- Atelier 2.4

SELECT
  NOM,
  PRENOM 
FROM
  employes
ORDER BY
  1 DESC

SELECT
  SOCIETE, 
  ADRESSE,  
  VILLE,
  PAYS 
FROM
  clients
ORDER BY
  PAYS
  
SELECT
  SOCIETE, 
  ADRESSE,  
  VILLE,
  PAYS 
FROM
  clients
ORDER BY
  PAYS, VILLE

  
-- Atelier 2.5

SELECT
 NOM,
 PRENOM,
 FONCTION,
 SALAIRE
FROM
  employes
WHERE
  (SALAIRE BETWEEN 2500 AND 3500)
  
select nom_produit, societe , nom_categorie, unites_stock
from produits prod , fournisseurs four, categories cat
where prod.code_categorie not in ( 1,3,5,7)
and prod.NO_FOURNISSEUR = four.NO_FOURNISSEUR
and prod.CODE_CATEGORIE = cat.CODE_CATEGORIE
  
SELECT
  NOM_PRODUIT,
  societe,
  nom_categorie,
  QUANTITE,
  UNITES_STOCK
FROM
  produits prod, fournisseurs four, categories cat
WHERE
 ( (prod.NO_FOURNISSEUR BETWEEN 1 AND 3) OR
  (prod.CODE_CATEGORIE BETWEEN 1 AND 3)) AND
  ((prod.QUANTITE LIKE '%boîtes%') OR
  (prod.QUANTITE LIKE '%cartons%'))
	and prod.NO_FOURNISSEUR = four.NO_FOURNISSEUR
	and prod.CODE_CATEGORIE = cat.CODE_CATEGORIE

  
select nom ,prenom
from employes emp, commandes cmde , clients cli
where cli.VILLE = "Paris"
and emp.NO_EMPLOYE = cmde.NO_EMPLOYE
and cmde.CODE_CLIENT = cli.CODE_CLIENT

select nom_produit , societe
from produits prod, fournisseurs four
where prod.CODE_CATEGORIE in (1,4,7)
and prod.NO_FOURNISSEUR = four.NO_FOURNISSEUR

select a.nom "employé",
b.nom "Supérieur"
from employes a join employes b
on (a.rend_compte = b.no_employe )

ou 
select emp.NOM "salarié", chef.NOM "chef"
from employes emp, employes chef
where emp.REND_COMPTE = chef.NO_EMPLOYE

ou

select emp.NOM "salarié", chef.NOM "chef"
from employes emp left outer join employes chef
on emp.REND_COMPTE = chef.NO_EMPLOYE
order by 2
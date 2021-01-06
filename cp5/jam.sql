SELECT nom_produit, societe from produits, fournisseurs where produits.NO_FOURNISSEUR = fournisseurs.NO_FOURNISSEUR;
SELECT nom_produit, societe from produits inner join fournisseurs on (produits.no_fournisseur = fournisseurs.NO_FOURNISSEUR);
SELECT nom_produit, societe from produits inner join fournisseurs using (no_fournisseur);
SELECT nom_produit, societe from produits natural join fournisseurs;

select nom, prenom, fonction, salaire from employes where salaire between 2500 and 3500;

-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

SELECT 
    nom_produit, societe, nom_categorie, quantite
FROM
    produits,
    fournisseurs,
    categories
WHERE
    fournisseurs.no_fournisseur = produits.NO_FOURNISSEUR
        AND 
			categories.CODE_CATEGORIE = produits.CODE_CATEGORIE
				AND 
					categories.code_categorie NOT IN (1 , 3, 5, 7);

-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

SELECT 
    nom_produit, societe, nom_categorie, quantite
FROM
    produits
        JOIN
    fournisseurs USING (no_fournisseur)
        JOIN
    categories USING (code_categorie)
    where 
    categories.code_categorie NOT IN (1 , 3, 5, 7);
    
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    
SELECT 
    nom_produit, societe, nom_categorie, quantite
FROM
    produits
        JOIN
    fournisseurs USING (no_fournisseur)
        JOIN
    categories USING (code_categorie)
WHERE
	fournisseurs.no_fournisseur between 1 and 3 
	or 
    categories.code_categorie between 1 and 3
		and produits.quantite like '%boîte%' or '%carton%'
    ;

-- corrigé : 

SELECT 
    nom_produit, societe, nom_categorie, quantite
FROM
    produits
        JOIN
    fournisseurs USING (no_fournisseur)
        JOIN
    categories USING (code_categorie)
WHERE
	((produits.no_fournisseur between 1 and 3) 
	or 
    (produits.code_categorie between 1 and 3))
		and ((produits.quantite like '%boîte%') or (produits.quantite like '%carton%'))
    ;
    
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

select 
	nom 
from 
	employes 
		join
	commandes using (no_employe)
		join 
	clients using (code_client)
where
	clients.ville = "Paris" -- ici, "clients." avant "ville" n'est pas nécessaire car il n'apparait que dans une seule table
;

-- retourne 4 lignes 
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

select
	nom_produit,
	societe
from
	produits
		join
	fournisseurs using (no_fournisseur)
where 
	produits.code_categorie IN (1, 4, 7) 
;
-- retourne 27  lignes 
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

select 
	nom

from 
	employes a
join
	employes b using (rend_compte)
;


-- corrigé : 

select 
	a.nom as "employé",
    "rend compte à",
    b.nom as "N+1"
from 
	employes a
left join
	employes b on (a.rend_compte = b.no_employe)
order by b.nom
;

-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

-- TP 3-1 

-- 1) 
select 
	nom,
	ceil(salaire / 20) as "salaire journalier"
from 
	employes
;

-- 2) 
select 
	nom,
	(round(salaire * 12) + commission) as "revenu annuel"
from 
	employes
;



-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

-- TP 3-2 

-- 1) 

SELECT
	sum(salaire) + sum(commission)
FROM
	employes
;

-- 2)

SELECT
	avg(salaire),
	avg(commission)
FROM
	employes
;

-- 3)

SELECT
	max(salaire),
	min(commission)
FROM
	employes
;

-- 4)

SELECT
	count(fonction)
FROM
	employes
;

-- 5)

SELECT
	fonction
	sum(salaire), 
FROM
	employes
GROUP BY 
	fonction
;

-- 6)

SELECT
	no_commande,
	sum(prix_unitaire * quantite)
FROM
	details_commandes
GROUP BY
HAVING 






-- 7) 

SELECT
	sum(prix_unitaire),

FROM
	produits
GROUP BY 
	
;








-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

-- TP 4

-- 1) 

SELECT societe, adresse, ville FROM clients

UNION 

SELECT societe, adresse, ville FROM fournisseurs;
	

-- 2) 

SELECT FROM


SELECT FROM



-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

-- TP 5

-- 1) 





-- 2) 

select 
	a.code_client,
	a.no_commande
from 
	commandes a
where 
	port > (select 
				avg(port) 
			from 
				commandes b
			where 
				a.code_client = b.code_client)
;


-- 3) 

select 
	nom_produit
from 
	produits 
where 
unites_stock > (select max(unites_stock) from produits where code_categorie = 3);

-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

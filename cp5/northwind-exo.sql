-- challenge 1 :

select 
	concat(titre, ' ', nom, ' ', prenom) as "Employé", 
    floor(datediff(NOW(), date_naissance) / 365.25) as "Age", 
    salaire + coalesce(commission, 0) as "Salaire (avec comm)"
from 
	employes
;



-- challenge 2 :

select 
	nom_produit, prix_unitaire, unites_stock
from 
	produits
    where 
		(no_fournisseur not in (1, 3, 5) and (quantite like '%carton%' or quantite like '%bouteille%')) 
		or
        ((mod(code_categorie, 2) = 0) and (indisponible = 0))
;



-- challenge 3 :

SELECT 
    *
FROM
    produits
WHERE
    (prix_unitaire < 50)
        AND (quantite LIKE '%bouteille%')
;



-- challenge 4 : 

SELECT 
    p.nom_produit, c.nom_categorie, f.societe
FROM
    produits p 
    JOIN 
		categories c 
			ON c.code_categorie = p.code_categorie 
    JOIN 
		fournisseurs f 
			ON f.no_fournisseur = p.no_fournisseur
WHERE
    p.prix_unitaire > 25 
    AND 
    f.pays IN ('Italie' , 'France', 'Allemagne')
;



-- challenge 5 : 

select 
	distinct cl.societe

from 
	clients cl 
    join commandes co 			on co.code_client = cl.code_client
    join details_commandes dc 	on dc.no_commande = co.no_commande 
    join produits pr 			on pr.ref_produit = dc.ref_produit
    join fournisseurs fo 		on fo.no_fournisseur = pr.no_fournisseur

where 
	fo.pays in ('Japon', 'Norvège', 'Brésil') 
;

-- challenge 6 : 

select 
	e.prenom, 
    e.nom,
    sum((d.prix_unitaire * d.quantite) * (1 - d.remise)) as CA
	
from 
	employes e 
    join commandes co 			on e.no_employe = co.no_employe
    join details_commandes d 	on co.no_commande = d.no_commande
    
where 
	year(co.date_commande)  = 2019
    
group by 
	e.prenom, e.nom

order by 
	CA desc
    
limit 1
;

-- challenge 7 : 

select 
	cl.societe, 
    co.no_commande,
    sum((d.prix_unitaire * d.quantite) * (1 - d.remise)) + avg(co.port) as big

from 
	clients cl 
    join commandes co 			on cl.code_client = co.code_client 
    join details_commandes d 	on d.no_commande = co.no_commande 

group by 
	cl.societe, 
    co.no_commande 

order by 
	big desc
    
limit 1
;

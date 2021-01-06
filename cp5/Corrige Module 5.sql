-- Module 5

-- Atelier 5

--Affichez tous les produits pour lesquels la quantité en stock est inférieur à la moyenne

select nom_produit
from produits
where unites_stock < 
			( select avg( unites_stock)
				from produits
				)
				
	

-- Affichez tous les clients pour lesquels les frais de ports par commandes dépassent la moyenne des frais de port par commande pour ce client.

SELECT c.code_client , no_commande
FROM clients c , commandes cmd
WHERE c.code_client = cmd.code_client
AND port > 
		( SELECT AVG(port)
		  FROM clients cli, commandes cmd
			WHERE cli.code_client = cmd.code_client 
			AND cli.code_client = c.code_client )
	
-- Affichez les produits pour lesquels la quantité en stock est supérieure à tous les produits de catégorie 3
 
select ref_produit
from produits 
where unites_stock > 
			( select max( unites_stock)
				from produits
				where code_categorie = 3)
				
-- Affichez les produits, fournisseurs et unités en stock pour les produits qui ont 
-- un stock inférieur à la moyenne des produits pour le même fournisseur

select ref_produit , f.no_fournisseur , unites_stock
from produits p , fournisseurs f 
where p.no_fournisseur = f.no_fournisseur 
and unites_stock < 
			( select avg( unites_stock)
				from produits prod
				where prod.no_fournisseur = f.no_fournisseur )

-- Affichez les employés avec leur salaire et le % correspondant par rapport au total de la masse salariale par fonction

select nom , salaire , round( 100 * salaire / statemp.som_salaire , 2) pourcentage
from employes emp , 
				( select sum(salaire) som_salaire , fonction
					from employes
					group by fonction
					) statemp
where emp.fonction = statemp.fonction
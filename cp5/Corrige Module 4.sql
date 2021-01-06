-- module 4

-- Atelier 4.1

select fonction , sum( salaire)
from employes
group by fonction

select no_commande,
sum( prix_unitaire * quantite )
from details_commandes
group by no_commande
having count(no_commande) > 5

select no_fournisseur, sum( prix_unitaire * unites_stock),
sum(prix_unitaire * unites_commandees)
from produits
where no_fournisseur BETWEEN 3 and 6
group by no_fournisseur
having count( distinct code_categorie ) >= 3

-- Atelier 4.2

select societe, adresse , ville
from clients
union
select societe, adresse , ville
from fournisseurs

select no_commande
from details_commandes a join produits b
on ( a.ref_produit = b.ref_produit )
and code_categorie = 1
and no_fournisseur = 1
INTERSECT
select no_commande
from details_commandes a join produits b
on ( a.ref_produit = b.ref_produit )
and code_categorie = 2
and no_fournisseur = 2

--pour Mysql 

select distinct no_commande
from details_commandes dcm, produits prod
where dcm.ref_produit = prod.ref_produit
and code_categorie =1 and no_fournisseur =1
and EXISTS
(
select distinct no_commande
from details_commandes dcm2 , produits prod
where dcm2.ref_produit = prod.ref_produit
and code_categorie =2 and no_fournisseur =2
and dcm2.NO_COMMANDE = dcm.NO_COMMANDE
)

select d.ref_produit
from details_commandes d
minus
select ref_produit
from details_commandes a join commandes b
on ( a.no_commande = b.no_commande )
join clients c
on ( b.code_client = c.code_client)
and c.ville = 'Paris' 

--pour SQLServer et PostgreSQL

select distinct p.ref_produit
from details_commandes p
Except
select ref_produit
from details_commandes a ,commandes b,clients c
where a.no_commande = b.no_commande 
and b.code_client = c.code_client
and c.ville = 'Paris'

--pour MySQL

select distinct  d.ref_produit
from details_commandes d
where not exists (
select a.ref_produit
from details_commandes a join commandes b
on ( a.no_commande = b.no_commande )
join clients c
on ( b.code_client = c.code_client)
where c.ville = 'Paris'
and d.ref_produit = a.ref_produit  ) 
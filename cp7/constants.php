<?php

// accès BDD : 
const HOST = 'localhost';
const USER = 'root';
const PASS = 'greta';
const DB = 'northwind';

// accès inbox gmail : 
const MB_HOST = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
const MB_USER = 'daronscodeurs@gmail.com';
const MB_PASS = 'LeslYLodiN6428';

// codes erreurs

// C1 = USER - création user ok 
const C1 = '<div class="text-center my-5 alert alert-success alert-dismissible fade show" role="alert"><strong>Super !</strong> L\'utilisateur a été crée avec succès.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
// C2 = USER - pb mail ou mot de passe 
const C2 = '<div class="text-center my-5 alert alert-danger alert-dismissible fade show" role="alert"><strong>Oups !</strong> Le mail ou le mot de passe est erroné.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
// C3 : USER - doit se connecter 
const C3 = '<div class="text-center my-5 alert alert-warning alert-dismissible fade show" role="alert"><strong>Attention !</strong> Vous devez vous connecter pour accéder à cette page<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
// C4 = USER - déco succès 
const C4 = '<div class="text-center my-5 alert alert-success alert-dismissible fade show" role="alert"><strong>Super !</strong> Vous êtes bien déconnecté<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

// C5 = BDD - aucune données à afficher (tables BDD)
const C5 = '<div class="text-center"><div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Oups !</strong> Il n\'y a rien à afficher ici.</div><a class="justify-content-center btn btn-info" href="bo.php">Retour au back-office</a></div>';
// C6 = BDD - table mise à jour succès 
const C6 = '<div class="text-center my-5 alert alert-success alert-dismissible fade show" role="alert"><strong>Super !</strong> La table a bien été mise à jour<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
// C7 = BDD - table mise à jour succès 
const C7 = '<div class="text-center my-5 alert alert-success alert-dismissible fade show" role="alert"><strong>Super !</strong> La table a bien été mise à jour<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

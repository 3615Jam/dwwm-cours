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
// C1 = création user ok 
const C1 = '<div class="text-center my-5 alert alert-success alert-dismissible fade show" role="alert"><strong>Super !</strong> L\'utilisateur a été crée avec succès.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
// C2 = pb mail ou mot de passe 
const C2 = '<div class="text-center my-5 alert alert-danger alert-dismissible fade show" role="alert"><strong>Oups !</strong> Le mail ou le mot de passe est erroné.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
// C3 : doit se connecter 
const C3 = '<div class="text-center my-5 alert alert-warning alert-dismissible fade show" role="alert"><strong>Attention !</strong> Vous devez vous connecter pour accéder à cette page<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
// C4 = déco succès 
const C4 = '<div class="text-center my-5 alert alert-success alert-dismissible fade show" role="alert"><strong>Super !</strong> Vous êtes bien déconnecté<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

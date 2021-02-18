<?php

// démarre ou restaure une session 
session_start();

// destruction des variables de session 
session_unset();    // équivalent à 'unset($_SESSION);'

// destruction de la session 
session_destroy();

// routage vers page d'acceuil avec message 
header('location:index1.php?c=4');

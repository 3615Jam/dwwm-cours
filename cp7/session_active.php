<?php
// vérification si user est connecté ou pas, sinon redirige vers index1.php avec message pour éviter un accès manuel aux autres pages du site
session_start();
if (!isset($_SESSION['connected']) || !$_SESSION['connected']) {
    header('location:index1.php?c=2');
    exit();
}

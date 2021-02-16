<?php
include_once('constants.php');

try {
    // verif $_POST 
    if (isset($_POST['mail']) && !empty($_POST['mail'])) {
    }








    // connexion BDD via PDO 
    $cnn = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASS);
    $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // query select count * = 1 







    // si user connu --> bo.php
    if ("user existe") {
        header('location:bo.php');
    }
    // sinon --> index.php?user=ko 
    else {
        header('location:index.php?user=ko');
    }
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}

<?php
include_once('constants.php');

try {
    $cnn = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASS);
    $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}

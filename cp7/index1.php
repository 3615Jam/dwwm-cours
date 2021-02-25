<?php

// appels des constantes 
include_once('constants.php');

// démarrage ou récup session 
session_start();
$connected = false;
if (isset($_SESSION['connected']) && ($_SESSION['connected'])) {
    $connected = $_SESSION['connected'];
}

// connexion à la BDD via MYSQLI (avec verif) 
$cnn = mysqli_connect('localhost', 'root', 'greta', 'northwind');
if (mysqli_connect_errno()) {
    printf("Erreur de connexion : %s", mysqli_connect_error());
    exit();
}
// on récupère la liste des catégories de la BDD 'Northwind'
$res = mysqli_query($cnn, "SELECT table_name, table_rows FROM information_schema.tables WHERE table_schema = 'northwind'");
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darons Codeurs | Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</head>

<body class="container">
    <div class="jumbotron mt-3 mb-5">
        <h1 class="display-4">Darons Codeurs</h1>

        <?php

        include_once('team.php');
        define("FNAME", $members[12][0]);
        $diff = (strtotime(date('Y-m-d')) - strtotime('2020/11/02')) / 60 / 60 / 24;
        echo '<p class="lead">Projet réalisé par ' . FNAME . ', Daron Codeur depuis ' . $diff . ' jours.</p>';

        ?>

        <hr class="my-5">



        <!-- boutons 'enregistrement' / 'connexion' / 'deconnexion'  -->
        <?php
        if ($connected) {
            echo '
            <div class="text-center d-flex justify-content-around">
                <a class="btn btn-info btn-lg" href="bo.php" role="button">Back-Office</a>
                <div>
                    <a class="btn btn-danger btn-lg" href="logout.php" role="button">Déconnexion</a>
                </div>
            </div>
            ';
        } else {
            echo '
            <p class="mb-5 lead">Vous devez vous connecter pour accéder au back-office des Darons Codeurs</p>
            <div class="text-center d-flex justify-content-around">
                <div>
                    <h5>Nouvel utilisateur ?</h5>
                    <a class="btn btn-success btn-lg" href="#" role="button" data-toggle="modal" data-target="#register">Inscription</a>
                </div>
                <div>
                    <h5>Déjà inscrit ?</h5>
                    <a class="btn btn-info btn-lg" href="#" role="button" data-toggle="modal" data-target="#login">Connexion</a>
                </div>
            </div>
            ';
        }
        ?>

        <!-- 
            ancien code pour gérer les boutons enregistrement / connexion / deconnexion
            et leur affichage en fonction de la valeur de $connected (si on est connecté ou pas)
            mais j'ai finalement opté pour un if/else (voir ci-dessus)

            <div class="text-center d-flex justify-content-around">
            <div class="<?php // echo (!$connected ? '' : 'd-none') 
                        ?>">
                <h5>Nouvel utilisateur ?</h5>
            <a class="btn btn-success btn-lg" href="#" role="button" data-toggle="modal" data-target="#register">Inscription</a>
            </div>
            <div class="<?php // echo (!$connected ? '' : 'd-none') 
                        ?>">
            <h5>Déjà inscrit ?</h5>
            <a class="btn btn-info btn-lg" href="#" role="button" data-toggle="modal" data-target="#login">Connexion</a>
            </div>
            <div class="<?php // echo ($connected ? '' : 'd-none') 
                        ?>">
            <a class="btn btn-danger btn-lg" href="logout.php" role="button">Déconnexion</a>
            </div>
            </div> 
        -->

    </div>


    <?php
    // bandeaux d'alertes et codes erreurs 

    /*
    // au départ, on fonctionnait avec un if / elseif, finalement transformé plus bas en switch 
    if (isset($_GET['c']) && !empty($_GET['c'])) {
        // creation user ok 
        if ($_GET['c'] === '1') {
            echo C1;
        }
        // pb mail / mot de passe  
        elseif ($_GET['c'] === '2') {
            echo C2;
        }
        // doit se connecter
        elseif ($_GET['c'] === '3') {
            echo C3;
        }
        // deco succès 
        elseif ($_GET['c'] === '4') {
            echo C4;
        }
    }
    */

    if (isset($_GET['c']) && !empty($_GET['c'])) {
        switch ($_GET['c']) {
            case '1':
                echo C1;
                break;
            case '2':
                echo C2;
                break;
            case '3':
                echo C3;
                break;
            case '4':
                echo C4;
            default:
                echo 'Rien à signaler';
        }
    }
    ?>

    <h2>Notre équipe</h2>

    <section id="team" class="mb-5 d-flex flex-wrap justify-content-between">

        <?php
        // include_once('team.php');
        // la ligne ci-dessus n'est plus utile car on l'utilise finalement plus haut dans le code (ligne 18)
        $html = "";
        for ($i = 0; $i < count($members); $i++) {
            $html .= '<div class="card mb-3 ' . ($members[$i][2] === "F" ? "girl" : "boy") . '" style="width: 18rem;">';
            $html .= '
                <div class="row no-gutters">
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <img src="img/user-' . ($members[$i][2] === "F" ? "f" : "m") . '.png" width="64 px" alt="logo user">
                    </div>
            ';
            $html .= '<div class="card-body">';
            $html .= '<h5 class="card-title">' . $members[$i][0] . '</h5>';
            $html .= '<p class="card-text">' . $members[$i][1] . ' ans</p>';
            // $html .= '<p class="card-text"> marié(e) : '. $members[$i][3] .'</p>';
            // la ligne précédente renvoie "1" pour les personnes mariées 
            // ('true' dans le tableau '$members' du fichier 'team.php')
            // mais reste vide quand 'false' ; 
            // je décide donc de rajouter la fonction 'str_replace()' (qui prend 3 paramètres : ce qu'on cherche, par quoi on remplace, et où on cherche)
            // $html .= '<p class="card-text"> marié(e) : '. str_replace(true, "oui", $members[$i][3]) .'</p>';
            // cela fonctionne bien pour le 'true' mais pas pour le 'false' car 'true' renvoie '1' et false '' 
            // je décide finalement de faire un if else : 

            /*
            if ($members[$i][3]) {
                $html .= '<p class="card-text"> marié(e) : oui</p>';
            } else {
                $html .= '<p class="card-text"> Célibataire</p>';
            };
            */
            /*
            // variante de mon if en mode 'ternaire' pour gérer "marié" ou "mariéE" :
            if($members[$i][3]) {
                $html .= ($members[$i][2] === "F" ? '<p class="card-text"> Mariée</p>' : '<p class="card-text"> Marié</p>' );
            } else {
                $html .= '<p class="card-text"> Célibataire</p>';
            };
            */
            // variante de mon if en mode 'ternaire' dans un 'ternaire' pour éliminer le 'if' :
            $html .= '<p class="card-text"> ' . ($members[$i][3] ? ($members[$i][2] === "F" ? "Mariée" : "Marié") : "Célibataire") . '</p>';

            $html .= '</div></div></div>';
        }
        echo $html;

        ?>

    </section>

    <h2>Nos références</h2>

    <section class="mb-5" id="projects">

        <?php
        include_once('projects.php');
        ?>

    </section>

    <!-- MODAL Inscription -->
    <div class="modal fade" id="register" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Inscription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="register.php" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="fname">Prénom : </label>
                            <input class="form-control" type="text" name="fname" id="fname" pattern="[A-Za-z\U00C0-\U00FF\-']" required>
                        </div>
                        <div class="form-group">
                            <label for="mail">Email : </label>
                            <input class="form-control" type="email" name="mail" id="mail" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Mot de passe : </label>
                            <input class="form-control" type="password" name="pass" id="pass" pattern="[A-Za-z0-9@$*!?]{8,}" required>
                        </div>
                        <div class="form-group">
                            <label for="check">Vérification du mot de passe : </label>
                            <input class="form-control" type="password" name="check" id="check" pattern="[A-Za-z0-9@$*!?]{8,}" required>
                        </div>

                        <div class="form-group">
                            <label for="land">Pays :</label>
                            <select name="land" id="land" class="form-control">
                                <?php
                                $json = file_get_contents('https://restcountries.eu/rest/v2/lang/fr?fields=name;alpha2Code;translations');
                                $obj = json_decode($json);
                                $html = "";

                                foreach ($obj as $val) {
                                    $html .= '<option value="' . $val->alph2code . '">' . $val->translations->fr . '</option>';
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="submit" class="btn btn-primary" value="S'inscrire">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL Connexion -->
    <div class="modal fade" id="login" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Connexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="login.php" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="mail">Email : </label>
                            <input class="form-control" type="email" name="mail" id="mail" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Mot de passe : </label>
                            <input class="form-control" type="password" name="pass" id="pass" pattern="[A-Za-z0-9@$*!?]{8,}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="submit" class="btn btn-primary" value="Se connecter">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="index1.js"></script>

</body>

</html>
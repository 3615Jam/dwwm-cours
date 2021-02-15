<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders | Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</head>

<body class="container">

    <h1>Accès inbox gmail</h1>

    <table class="table table-striped">

        <thead>
            <th>De</th>
            <th>Objet</th>
            <th>Reçu le</th>
            <th>Taille</th>
        </thead>

        <tbody>
            <?php
            include_once('constants.php');
            $inbox = imap_open(MB_HOST, MB_USER, MB_PASS) or die('<div class="alert alert-danger">Connexion au serveur de messagerie impossible : ' . imap_last_error() . '</div>');
            $emails = imap_search($inbox, 'ALL');
            if ($emails) {
                // on trie les mails en ordre inverse de date de réception (le + récent d'abord)
                rsort($emails);
                // on parcours le tableau '$emails'
                $html = "";
                foreach ($emails as $id) {
                    $email = imap_fetch_overview($inbox, $id);
                    // on définit des variables pour la mise en forme : 
                    // si mail non lu, on l'affiche en gras ('<th>') sinon non ('<td>')
                    $t1 = $email[0]->seen ? '<td>' : '<th>';
                    $t2 = $email[0]->seen ? '</td>' : '</th>';
                    // chaine vide qu'on va remplir au fur et à mesure 
                    $html .= '<tr>';
                    $html .= $t1 . imap_utf8($email[0]->from) . $t2;
                    $html .= $t1 . '<a href="gmail_read.php?id=' . $id . '" target="_blank">' . imap_utf8($email[0]->subject) . '</a>' . $t2;
                    $html .= $t1 . date('d-m-Y', ($email[0]->udate)) . ' à ' . date('H:i:s', ($email[0]->udate)) . $t2;
                    $html .= $t1 . round(($email[0]->size) / 1024, 1) . ' Ko' . $t2;

                    $html .= '</tr>';
                }
                echo $html;
            }
            // on ferme la connexion à 'inbox' 
            imap_close($inbox);
            ?>
        </tbody>

    </table>

</body>

</html>
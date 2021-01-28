<?php

/** 
 * 
 * fonction "calculAge" :
 *  
 * renvoie l'âge en années entre 2 dates passées en paramètres 
 * 
 * @param   string  $date1  une 1ere date
 * @param   string  $date2  une 2eme date
 * @return  int             l'âge en années 
 * 
 * */   

function calculAge($date1, $date2):int {
    // on teste si les paramètres sont bien des dates
    if(!isDate($date1) || !isDate($date2)) {
        trigger_error("l'un des 2 arguments n'est pas une date", E_USER_WARNING);
    }
    // au cas où on aura pas une string, on convertit les dates en string
    $d1 = strtotime($date1);
    $d2 = strtotime($date2);
    // pour toujours obtenir un résultat positif, on vérifie avec un if laquelle des 2 dates est la + grande
    if($d2 > $d1) {
        $diffDate = $d2 - $d1;
    } elseif($d2 < $d1) {
        $diffDate = $d1 - $d2;
    } else {
        // si les dates sont les mêmes 
        $diffDate = 0;
    };
    // $diffDate renvoie une valeur en secondes, on la divise 
    // donc par 60 pour passer en minutes
    // puis par 60 pour passer en heures
    // puis par 24 pour passer en jours
    // puis par 365.25 pour passer en années 
    // puis on 'floor' le tout pour arrondir à l'entier inférieur 
    return floor($diffDate / 60 / 60 / 24 / 365.25);
}


/** 
 * 
 * fonction "isDate" :
 *  
 * vérifie si la date est bien une date 
 * 
 * @param   string  $arg l'élément à tester
 * @return  bool    vrai ou faux : est-ce une date ? 
 * 
 * */

function isDate($arg) : bool {
    return(bool) strtotime($arg);
}


/** 
 * 
 * fonction "calculTtc" :
 *  
 * calculer le montant TTC à partir d'un montant HT 
 * 
 * @param   int|float   $mtht   montant HT, nombre réel positif ou nul 
 * @param   float       $taux   taux de tva utilisé, parmi 3 définis (5.5, 10 et 20%, 20% étant la valeur par défaut)
 * @return  int|float           montant TTC en fonction du taux appliqué 
 * 
 * */

function calculTtc($mtht, $taux = 0.2) {
    $tauxFR = [0.021, 0.055, 0.1, 0.2];
    if(is_string($mtht)) {
        trigger_error("Le montant doit être un nombre", E_USER_WARNING);
    } elseif($mtht < 0) {
        trigger_error("Le montant doit être positif", E_USER_WARNING);
    } elseif(!in_array($taux, $tauxFR)) {
        trigger_error("Le taux ne peut avoir que l'une de ces valeurs : " . implode(', ', $tauxFR), E_USER_WARNING);
    } else {
    return $mtht * (1 + $taux);
    }
}



?>
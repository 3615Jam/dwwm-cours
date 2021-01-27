<?php

/** 
 * 
 * fonction "calculAge" :
 *  
 * renvoie l'âge en années entre 2 dates passées en paramètres 
 * 
 * @param {string} $date1 - date
 * @param {string} $date2 - une autre date
 * @return {int} âge en années 
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
        $diffDate = 0;
    };  
    return floor($diffDate / 60 / 60 / 24 / 365.25);
}


/** 
 * 
 * fonction "isDate" :
 *  
 * vérifie si la date est bien une date 
 * 
 * @param {string} $arg - argument à tester
 * @return {boolean} hjkfldsq
 * 
 * */

function isDate($arg) : bool {
    return(bool) strtotime($arg);
}


/** 
 * 
 * fonction "ttc" :
 *  
 * calculer le montant TTC à partir d'un montant HT 
 * 
 * @param {float} $mt - montant, nombre réel positif ou nul 
 * @param {float} $taux - taux de tva utilisé, parmi 3 définis (5.5, 10 et 20%, 20% étant la valeur par défaut)
 * @return {float} $xxxxx - 
 * 
 * */

function ttc($mt, $taux = 0.2) {
    $tauxFR = [0.021, 0.055, 0.1, 0.2];
    if($mt < 0 && !is_float($mt)) {
        trigger_error("Le montant doit être positif", E_USER_WARNING);
    } elseif(!in_array($taux, $tauxFR, true)) {
        trigger_error("La valeur de la TVA doit être l'une de ces valeurs : " . implode(', ', $tauxFR), E_USER_WARNING);
    } else {
    $ttcMt = $mt * (1 + $taux);
    return $ttcMt;
    }
}



?>
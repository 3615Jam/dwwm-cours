<?php 

require_once('functions.php');

echo '<p>Test de la fonction "calculAge" : </p>';
echo '<p> Test 1 : ' . calculAge("2020/01/27", "2000/01/01") . '</p>';
echo '<p> Test 2 : ' . calculAge(123456, 789456) . '</p>';             
echo '<p> Test 3 : ' . calculAge("Toto", "aime les gateaux") . '</p>';
echo '<hr>';

echo '<p>Test de la fonction "isDate" : </p>';
echo '<p> Test 4 : ' . isDate("12/31/2005") . '</p>';
echo '<p> Test 5 : ' . isDate("Toto aime les gateaux") . '</p>';
echo '<p> Test 6 : ' . isDate(1234323) . '</p>';
echo '<p> Test 7 : ' . isDate("29/02/2021") . '</p>';
echo '<hr>';

echo '<p>Test de la fonction "calculTtc" : </p>'; 
echo '<p> Test 8 : ' . calculTtc(100) . '</p>';
echo '<p> Test 9 : ' . calculTtc(100, 0.021) . '</p>';
echo '<p> Test 10 : ' . calculTtc(100, 0.055) . '</p>';
echo '<p> Test 11 : ' . calculTtc(100, 0.1) . '</p>';
echo '<p> Test 12 : ' . calculTtc(100, 0.123) . '</p>';
echo '<p> Test 13 : ' . calculTtc(-100, 0.055) . '</p>';
echo '<p> Test 14 : ' . calculTtc("100", 0.055) . '</p>';
echo '<p> Test 15 : ' . calculTtc(100, "0.055") . '</p>';
echo '<p> Test 16 : ' . calculTtc("100", "0.055") . '</p>';
echo '<p> Test 17 : ' . calculTtc("yuerioza", 0.055) . '</p>';
echo '<p> Test 18 : ' . calculTtc(100, "huofyzar") . '</p>';
echo '<hr>';

echo '<p>Test de la fonction "pwGen" : </p>';
echo '<p>Test 19 (sans paramètre) : ' . pwGen() . '</p>';
echo '<p>Test 20 (longeur 12) : ' . pwGen(12) . '</p>';
echo '<p>Test 21 (longeur 2 ! Warning) : ' . pwGen(2) . '</p>';
echo '<p>Test 22 (longeur 80 ! Warning) : ' . pwGen(80) . '</p>';
echo '<hr>';

echo '<p>Test de la fonction "arrToSelect" : </p>';
// tableau exemple 1 :
$tabTest[1] = "Mohamed";
$tabTest[2] = "Jérémy";
$tabTest[13] = "JM";
$tabTest[14] = "Nathan";
echo '<p>Test 23 (testTab1) : ' . arrToSelect($tabTest) . '</p>';
// tableau exemple 2 :
$tabTest2 = array("popo", "ouioui", "nonnon", "coucou", 123456);
echo '<p>Test 24 (testTab2) : ' . arrToSelect($tabTest2) . '</p>';
echo '<hr>';

echo '<p>Test de la fonction "average" : </p>';
echo '<p>Test xx : ' . average(10, 20, 30) . '</p>';
echo '<p>Test xx : ' . average('10', '20', 30) . '</p>';
echo '<p>Test xx : ' . average(10, 20, "Toto au ski") . '</p>';
echo '<p>Test xx : ' . average(rand(1, 9), rand(10, 99), rand(100, 999)) . '</p>';
echo '<p>Test xx : ' . average(10, array(20, 30)) . '</p>';
echo '<hr>';

?>

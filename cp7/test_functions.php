<?php 

require_once('functions.php');

// test de la fonction 'calculAge' : 
echo '<p> Test 1 : ' . calculAge("2020/01/27", "2000/01/01");   // 20
echo '<p> Test 2 : ' . calculAge(123456, 789456);               // 51 
echo '<p> Test 3 : ' . calculAge("Toto", "aime les gateaux");   // 0 

// test de la fonction 'isDate' : 
echo '<p> Test 4 : ' . isDate("12/31/2005");
echo '<p> Test 5 : ' . isDate("Toto aime les gateaux");
echo '<p> Test 6 : ' . isDate(1234323);
echo '<p> Test 7 : ' . isDate("29/02/2021");

// test de la fonction 'ttc' : 
echo '<p> Test 8 : ' . ttc(100);
echo '<p> Test 9 : ' . ttc(100, 0.021);
echo '<p> Test 10 : ' . ttc(100, 0.055);
echo '<p> Test 11 : ' . ttc(100, 0.1);
echo '<p> Test 12 : ' . ttc(100, 0.123);
echo '<p> Test 13 : ' . ttc(-100, 0.055);
echo '<p> Test 14 : ' . ttc("100", "0.055");
echo '<p> Test 14 : ' . ttc("yuerioza", 0.055);


?>
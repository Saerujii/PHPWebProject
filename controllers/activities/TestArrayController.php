<?php
include_once '../../model/TestArrays.php';

printArrayCountries($COUNTRIES);
print "<br><br>";
$line = rand(0, count($COUNTRIES));
$country = getCountry($line);
if (count($country)>0){
    printCountry($country);
}else {
    print "NO DATA COUNTRY FOUND";
}



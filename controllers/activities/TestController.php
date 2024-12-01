<?php

include_once '../../model/TestArrays.php';

if (($countryname = filter_input(INPUT_POST, 'country')) != null) {
    
    $country = findCountry($countryname);
    
    if (count($country)>0) {
        printCountry($country);
    }else{
        print "Country not found";
    }

    if (filter_input(INPUT_POST, "showcountries")) {
        print "<br><br>LlISTA DE PAISOS<br>";
        printArrayCountries($COUNTRIES);
    }
} else {
    print "No country selected";
}
print "<p><a href=\"../../views/activities/ArrayAssocView.html\">Volver</a></p>";


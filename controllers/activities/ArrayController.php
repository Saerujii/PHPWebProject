<?php

include_once '../../model/MathFunctions.php';

if (($fillAmount = filter_input(INPUT_POST, "fillAmount"))!= null and
    ($fillFrom = filter_input(INPUT_POST, "fillFrom"))!= null and 
    ($fillTo = filter_input(INPUT_POST, "fillTo"))!= null and
    ($searchValue = filter_input(INPUT_POST, "linSearch"))!= null){
    
    $array = fillArray($fillAmount, $fillFrom, $fillTo);
    
    if (($binSearch = filter_input(INPUT_POST, "binSearch") != null)){
        $sortedArray = arraySort($array, 1);
        $foundValue = binSearch($sortedArray, $searchValue, 1);
    }else{
        $foundValue = linSearch($array, $searchValue);
    }
    
    if ((filter_input(INPUT_POST, "arraySort") != null)){
        $sortType = filter_input(INPUT_POST, "arraySort");
        arraySort($array, $sortType);
    }
    
    foreach ($array as $key){
        print "$key, ";
    }
    print "<br>$foundValue";
}else{
    echo "LOS 4 CAMPOS DE NUMERO SON REQUERIDOS, RELLENELOS POR FAVOR";
}
print "  <p><a href=\"../../views/activities/NumbersView.html\">Volver a la página anterior</a></p>\n";

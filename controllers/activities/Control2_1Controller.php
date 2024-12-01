<?php

include_once '../../model/MathFunctions.php';

if (($fillFrom = filter_input(INPUT_POST, "fillFrom")) != null AND
        ($fillTo = filter_input(INPUT_POST, "fillTo")) != null AND
        ($fillSize = filter_input(INPUT_POST, "fillSize")) != null) {
    //Apartat generar l'Array
    $array = fillArray($fillSize, $fillFrom, $fillTo);
    $arraySize = count($array);
    print "Els $fillSize valors generats: <br>";
    for ($key = 0; $key < $arraySize; $key++) {
        print $array[$key];
        if ($key != $arraySize - 1) {
            print " - ";
        }
    }
    //Apartat multiples
    if (($multsFrom = filter_input(INPUT_POST, "multsFrom")) != null AND
            ($multsTo = filter_input(INPUT_POST, "multsTo")) != null) {

        $arrayMults = extractMults($array, $multsFrom, $multsTo);
        $arrayMultsSize = count($arrayMults);
        
        if ($arrayMults != []) {
            print "<br>Els $arrayMultsSize multiples de $multsFrom y $multsTo:<br>";
            for ($key = 0; $key < $arrayMultsSize; $key++) {
                print $arrayMults[$key];
                if ($key != $arrayMultsSize - 1) {
                    print " - ";
                }
            }
        }else{print "<br>No tenim valors entre $multsFrom y $multsTo<br>";}
        
    }else{print "<br>No es demana trobar múltiples comuns";}
    
    //Apartat filtrar
    if(($selectFrom = filter_input(INPUT_POST, "selectFrom"))!=null AND
            ($selectTo = filter_input(INPUT_POST, "selectTo"))!=null){
        
        $sort=1;
        
        $arrayFiltered = selectBetween($array, $selectFrom, $selectTo, $sort);
        $arrayFilteredSize = count($arrayFiltered);
        
        if ($arrayFiltered != []) {
            print "<br>Els $arrayFilteredSize valors entre $selectFrom y $selectTo: <br>";
            for ($key = 0; $key < $arrayFilteredSize; $key++) {
                
                print $arrayFiltered[$key];
                if ($key != $arrayFilteredSize - 1) {
                    print " - ";
                }
            }
        }else{print "<br>No s'han trobat valors entre $selectFrom y $selectTo";}
        
    }else{print "<br>No es demana filtrar valors";}
    
} else {
    print "Has de pasar valors positius per crear l'Array";
}
print "  <p><a href=\"../../views/activities/NumbersView.html\">Volver a la página anterior</a></p>\n";






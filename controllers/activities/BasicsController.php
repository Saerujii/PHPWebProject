<?php

include_once '../../model/mathFunctions.php';

if (    ($oper = filter_input(INPUT_POST, 'oper')) != null and
        ($num1 = (int) filter_input(INPUT_POST, 'num1')) != null and
        ($num2 = (int) filter_input(INPUT_POST, 'num2')) != null ) {

    print (basicOperations($num1, $num2, $oper));
} else {
    if ($num2 == null and $oper == "/") {
        print "NO PODEMOS DIVIDIR POR CERO";
    } else {
        print "No has entrado ningun valor u operacion";
    }
}
print "<p><a href=\"../../views/activities/NumbersView.html\">Volver</a></p>";


<?php

include_once '../../model/MathFunctions.php';

if (($value1 = filter_input(INPUT_POST, "num1")) != null AND ($value2 = filter_input(INPUT_POST, "num2")) != null){
    $mcd = mcd($value1, $value2);
    print "El Minim Comu Divisor dels valors ($value1, $value2) es $mcd";
}

print "  <p><a href=\"../../views/activities/NumbersView.html\">Volver a la página anterior</a></p>\n";

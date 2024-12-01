<?php

include_once '../../model/MathFunctions.php';

if (($value = filter_input(INPUT_POST, "num")) != null){
    $fibo = fiboArray($value);
    
    print "La sequencia de Fibonacci de longitud de $value valors: <br>";
    foreach ($fibo as $valorSecuencia){
        
        if ($valorSecuencia === $fibo[count($fibo)-1]){
            print $valorSecuencia;
        }else{
            print "$valorSecuencia, ";
        }
    }
}

print "  <p><a href=\"../../views/activities/NumbersView.html\">Volver a la página anterior</a></p>\n";



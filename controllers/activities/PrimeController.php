<?php

include_once '../../model/MathFunctions.php';

//RECUPERAMOS LOS DATOS QUE HAN SIDO CAPTURADOS CON GET UTILIZANDO
//EL MISMO VALOR DE LAS VARIABLES EN EL FORMULARIO ORIGEN
if (($value = filter_input(INPUT_POST, "num")) != null) {
    $savedivisors = filter_input(INPUT_POST, "viewdivisors");
    
    print "El valor $value ";
    if (isPrime($value)) {
        print "es primer";
    } else {
        print "no es primer";
        if ($savedivisors) {
            print "<br><br>LlISTA DE DIVISORS<br>";
            $divisors = divisors($value);
            for ($i = 0; $i < count($divisors); $i++) {
                print "<br>$divisors[$i]";
            }
        }
    }
}

if (($value1 = filter_input(INPUT_POST, "num1")) != null AND 
    ($value2 = filter_input(INPUT_POST, "num2")) != null){
    
    $output=searchPrime($value1, $value2);
    
    if (count($output)!=0){
        print "Aquests son els valors primers trobats:<br>";
        for ($i=0;$i<count($output);$i++){
            print $output[$i];
            if ($i!=count($output)-1){
                print ", ";
            }
        }
    }else{
        print "No hi han valors primers entre $value1 i $value2";
    }
}

print "  <p><a href=\"../../views/activities/NumbersView.html\">Volver a la página anterior</a></p>\n";
?> 
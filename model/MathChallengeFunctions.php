<?php

declare(strict_types=1);

// FUNCION QUE RETORNA UNA PRUEBA MATEMATICA SIMPLE EN FORMATO STRING 
// Y CARGA EN LA VARIABLE RECIBIDA POR PARAMETRO LA SOLUCION
function newChallenge(int &$solution): string {
    
    // GENERA 2 PEQUEÑOS VALORES ALEATORIOS
    $firstAleatValue = rand(1, 13);
    $secondAleatValue = rand(1, 13);
    $operAleat = "";
    
    // SE GENERA UN CODIGO DE OPERACION ALEATORIO, SE LE ASIGNA SU SIMBOLO Y SE REALIZA EL CALCULO
    switch (rand(0, 3)) {
        case 0: $operAleat = "+";
            $solution = $firstAleatValue + $secondAleatValue;
            break;
        
        case 1: $operAleat = "-";
            $solution = $firstAleatValue - $secondAleatValue;
            break;
        
        case 2: $operAleat = "*";
            $solution = $firstAleatValue * $secondAleatValue;
            break;
        
        case 3: $operAleat = "/";
            $solution = (int)($firstAleatValue / $secondAleatValue);
            break;
    }
    
    // RETORNA LA OPERACION EN FORMATO STRING 
    return $firstAleatValue . " " . $operAleat . " " . $secondAleatValue . " = ";
}

<?php

declare(strict_types=1);


// ARRAY DE STRING QUE CONTIENE LOS COLORES QUE SERAN UTILIZADOS EN LA ACTIVIDAD
$colors = ["amarillo", "marengo", "naranja", "purpura", "turquesa", "marfil", "lavanda", "cian",
    "magenta", "beige", "fucsia", "mostaza", "ocre", "malva", "violeta", "granate", "marron",
    "salmon", "celeste", "ambar", "amatista", "perla", "topacio", "indigo", "zafiro", "cobalto"];


// FUNCION QUE RETORNA UN COLOR ALEATORIO CON EL ORDEN DE SUS LETRAS MODIFICADO ALEATORIAMENTE
//  Y ADEMAS, POR PARAMETRO GUARDA EL COLOR ORIGINAL (LA SOLUCION) A LA QUE HA APLICADO EL SHUFFLE
function hiddenColor(string &$answer): string {
    
    global $colors;  // NO PRECISA LA RECEPCION DE UN ARRAY, TOMA EL DEFINIDO EN ESTE FICHERO
    
    $tam = count($colors) -1;
    $posAleat = rand(0, $tam );
    $answer = $colors[$posAleat];
    
    return str_shuffle($answer);
}
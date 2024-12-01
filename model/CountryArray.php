<?php

// ARRAY DE ARRAYS ASOCIATIVOS CON LOS QUE SE DESARROLLA LA ACTIVIDAD 
$COUNTRIES = [
    ["pais" => "España", "capital" => "Madrid", "poblacio" => 4000000],
    ["pais" => "Francia", "capital" => "Paris", "poblacio" => 6000000],
    ["pais" => "Italia", "capital" => "Roma", "poblacio" => 5000000],
    ["pais" => "Portugal", "capital" => "Lisboa", "poblacio" => 500000],
    ["pais" => "Alemania", "capital" => "Berlin"],
    ["pais" => "Reino Unido", "capital" => "Londres"],
    ["pais" => "Grecia", "capital" => "Atenas"],
    ["pais" => "Suecia", "capital" => "Estocolmo"],
    ["pais" => "Noruega", "capital" => "Oslo"],
    ["pais" => "Finlandia", "capital" => "Helsinki"],
    ["pais" => "Rusia", "capital" => "Moscu"],
    ["pais" => "Ucrania", "capital" => "Kiev"],
    ["pais" => "Austria", "capital" => "Viena"],
    ["pais" => "Hungria", "capital" => "Budapest"],
    ["pais" => "Belgica", "capital" => "Bruselas"],
    ["pais" => "Holanda", "capital" => "Amsterdam"],
    ["pais" => "Rumania", "capital" => "Bucarest"],
    ["pais" => "Bulgaria", "capital" => "Sofia"]
];


// FUNCION QUE RETORNA LOS DATOS DEL PAIS INDICADO POR SU POSICION
function getCountry(int $pos): array {

    global $COUNTRIES;  // NO PRECISA LA RECEPCION DE UN ARRAY, TOMA EL DEFINIDO EN ESTE FICHERO

    if ($pos >= 0 and count($COUNTRIES) > $pos) {
        return $COUNTRIES[$pos];
    }
    return [];
}


// FUNCION QUE RETORNA LOS DATOS DEL PAIS INDICADO POR SU NOMBRE
function findCountry(string $name): array {

    global $COUNTRIES; // NO PRECISA LA RECEPCION DE UN ARRAY, TOMA EL DEFINIDO EN ESTE FICHERO

    foreach ($COUNTRIES as $country) {
        if ($country["pais"] == $name) {
            return $country;
        }
    }
    return [];
}


// FUNCIONES AUXILIARES PARA PRESENTAR DATOS
// 
// PRESENTACION DE LOS DATOS DE UN PAIS
function printCountry(array $country) {
    foreach ($country as $index => $valor) {
        echo "$index: $valor , ";
    }
}


// PRESENTACION DE LOS DATOS DE TODOS LOS PAISES
function printArrayCountries(array $assoc) {
    foreach ($assoc as $dada) {
        printCountry($dada);
        echo "<br>";
    }
}

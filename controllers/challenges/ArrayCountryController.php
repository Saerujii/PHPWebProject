<?php

session_start();    //COMENZAMOS A TRABAJAR CON VARIABLES DE SESION

include_once '../../model/ArrayCountries.php';

$RETO = 5;
$PENALTY = 1;
setcookie("preguntas", $RETO, 0, "/", 'localhost');



function challengeInit(){
    setcookie("intentos", 1, 0, "/", 'localhost');
    setcookie("aciertos", 0, 0, "/", 'localhost');
    setcookie("errores", 0, 0, "/", 'localhost');
    $_SESSION["intentos"] = 1;
    $_SESSION["aciertos"] = 0;
    $_SESSION["errores"] = 0;
}


function newQuestion(){
    $newCountry = getCountry(rand(0, count($COUNTRIES) - 1));
    $countryname = $newCountry["pais"];
    $_SESSION["capital"] = $newCountry["capital"];
    setcookie("pais", $countryname, 0, "/", 'localhost');
}


if (isset($_SESSION["start"]) == null) {
    $_SESSION["start"] = 1;
    newQuestion();
    challengeInit();
}



if (($capitalPropossed = filter_input(INPUT_POST, 'capital')) != null and
        isset($_SESSION["finished"]) == null) {
    if ($_SESSION["capital"] == $capitalPropossed) {
        $_SESSION["aciertos"]++;
        setcookie("response", "CORRECTO", 0, "/", 'localhost');
        setcookie("aciertos", $_SESSION["aciertos"], 0, "/", 'localhost');
    } else {
        $_SESSION["errores"]++;
        setcookie("response", "INCORRECTO", 0, "/", 'localhost');
        setcookie("errores", $_SESSION["errores"], 0, "/", 'localhost');
    }
    if ($_SESSION["intentos"] == $RETO) {
        $_SESSION["finished"] = 1;
        $nota = $RETO - $_SESSION["errores"] - ($PENALTY*$_SESSION["errores"]);
        setcookie("nota", $nota, 0, "/", 'localhost');
    } else {
        newQuestion();
        $_SESSION["intentos"]++;
        setcookie("intentos", $_SESSION["intentos"], 0, "/", 'localhost');
    }
}

//llamo a la vista
header('location: ../../views/challenges/TestCountryView.php');

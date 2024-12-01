<?php

declare(strict_types=1);

session_start();    //COMENZAMOS A TRABAJAR CON VARIABLES DE SESION

include_once '../../model/StringChallengeFunctions.php';


//ARRAY GLOBAL DE REFERENCIA PARA LA GESTION DEL CHALLENGE, NO DEBE ABUSARSE DE ESTE RECURSO
$COLORCHALLENGEPARAMS = [
                        "objective" => 100, 
                        "initialpoints" => 40, 
                        "reward" => 10, 
                        "penalty" => 20
    ];



//FUNCIONES QUE ENGLOBAN ACCIONES DETERMINADAS DE CONTROL DEL CHALLENGE

// FUNCION QUE PREPARA EL INICIO DEL RETO
function startChallenge() {         //valores iniciales para el comienzo del reto
    
    global $COLORCHALLENGEPARAMS;   //LLAMADA A LA VARIABLE GLOBAL UBICADA EN ESTE FICHERO, NO LA PASAMOS POR PARAMETRO

    // INICIALIZAMOS LAS VARIABLES DE SESION PARA UN NUEVO RETO
    $_SESSION["incolorgame"] = 1;
    $_SESSION["currentPoints"] = $COLORCHALLENGEPARAMS["initialpoints"];
    
    //preparamos las cookies para que sean gestionadas Vista
    setInitialCookies();
    setcookie('incolorgame', "1", 0, '/', 'localhost');     //INDICAMOS QUE COMIENZA EL RETO
    setcookie('trueResponse', "-1", 0, '/', 'localhost');   //INDICAMOS QUE AUN NO TENEMOS NINGUNA RESPUESTA A ANALIZAR
    nextStep();                                             //cargamos la primera prueba del reto
}


// FUNCION QUE SE ENCARGA DE INICIALIZAR ESPECÍFICAMENTE LAS COOKIES QUE GUARDAN LAS REGLAS DEL JUEGO
function setInitialCookies() {
    
    global $COLORCHALLENGEPARAMS;   //LLAMADA A LA VARIABLE GLOBAL UBICADA EN ESTE FICHERO, NO LA PASAMOS POR PARAMETRO
    
    // COOKIES QUE CONTIENEN LAS REGLAS DEL RETO
    setcookie('objective', (string) $COLORCHALLENGEPARAMS["objective"], 0, '/', 'localhost');
    setcookie('currentPoints', (string) $_SESSION["currentPoints"], 0, '/', 'localhost');
    setcookie('reward', (string) $COLORCHALLENGEPARAMS["reward"], 0, '/', 'localhost');
    setcookie('penalty', (string) $COLORCHALLENGEPARAMS["penalty"], 0, '/', 'localhost');
}


// FUNCION QUE CARGA UN NUEVO RETO EN LA COOKIE Y LA SOLUCION EN LA VARIABLE DE SESION
function nextStep() {
    $solution = "";

    $color = hiddenColor($solution);        //llamada a la funcion del modelo del reto    

    $_SESSION["colorAleat"] = $solution;    //carggamos en la variable de sesion la solucion 

    setcookie('newColor', $color, 0, '/', 'localhost');
}


// FUNCION QUE GESTIONA LOS RESULTADOS FINALES DEL RETO Y LIMPIA VARIABLES
function finishChallenge() {
    
    global $COLORCHALLENGEPARAMS;

    if ($_SESSION["currentPoints"] >= $COLORCHALLENGEPARAMS["objective"]) { //SI FINALIZA CON EXITO
        if (($level = filter_input(INPUT_COOKIE, 'level')) == 2) {          //subimos de nivel al usuario
            setcookie('level', (string) ($level + 1), 0, '/', 'localhost');
        }
    }
    
    setcookie('incolorgame', "0", 0, '/', 'localhost');     // INDICA EL FIN DEL RETO ACTUAL
    
    unset($_SESSION["incolorgame"]); //damos por finalizado el reto eliminando la cookie i la variable de sesion
}


//ALGORITMO GENERAL DEL CONTROLADOR PARA LA GESTION DEL CHALLENGE

if (isset($_SESSION["incolorgame"]) == null) {    //si aun no ha empezado el juego
    startChallenge();
} else {
    setInitialCookies();        //carga los objetivos del reto al volver al mismo

    if (($posibleColor = filter_input(INPUT_POST, "result")) != null) {  //juego iniciado y el usuario ha enviado una respuesta
        
        if (strcmp($_SESSION["colorAleat"], $posibleColor) == 0) {  //comparamos propuesta con solucion
            $_SESSION["currentPoints"] += $COLORCHALLENGEPARAMS["reward"];  // SUMAMOS PUNTOS
            setcookie('trueResponse', "1", 0, '/', 'localhost');            // INFORMAMOS A LA VISTA VIA COOKIE
        } else {
            $_SESSION["currentPoints"] -= $COLORCHALLENGEPARAMS["penalty"]; // RESTAMOS PUNTOS
            setcookie('trueResponse', "0", 0, '/', 'localhost');            // INFORMAMOS A LA VISTA VIA COOKIE
        }

        // ACTUALIZAMOS COOKIES PARA LA VISTA
        setcookie('currentPoints', (string) $_SESSION["currentPoints"], 0, '/', 'localhost');
        setcookie('points', (string) (filter_input(INPUT_COOKIE, 'points') + $_SESSION["currentPoints"]), 0, '/', 'localhost');

        
        // SE EVALUA SI EL JUEGO DEBE FINALIZARSE O SE DEBE PLANTEAR UN NUEVO RETO
        if ($_SESSION["currentPoints"] <= 0 or $_SESSION["currentPoints"] >= $COLORCHALLENGEPARAMS["objective"]) {                     
            finishChallenge();
        } else {            //AUN QUEDAN PUNTOS PARA CONTINUAR EL RETO
            nextStep();
        }
    }
}


//cargamos la vista
header('location: ../../views/challenges/StringChallengeView.php');

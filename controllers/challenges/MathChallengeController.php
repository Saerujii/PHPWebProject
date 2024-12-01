<?php

declare(strict_types=1);

session_start();    //COMENZAMOS A TRABAJAR CON VARIABLES DE SESION

include_once '../../model/MathChallengeFunctions.php';


// VARIABLE GLOBAL DE REFERENCIA PARA EL CHALLENGE, NO DEBE ABUSARSE DE ESTE RECURSO
$MATHCHALLENGEPARAMS = [
                        "reward" => 1000, 
                        "objective" => 5
 ];


//FUNCIONES QUE CENTRALIZAN ACCIONES DE CONTROL DEL CHALLENGE

// FUNCION QUE COORDINA LA INICIALIZAMOS Y LANZAMIENTO DEL RETO
function startChallenge() {      
    
    // CARGA DE VALORES INICIALES EN LAS VARIABLES DE SESION DEL SERVIDOR
    $_SESSION["inmathgame"] = 1;
    $_SESSION["continuedSuccess"] = 0;
    $_SESSION["attempts"] = 0;
    
    // CARGA DE VALORES EN LAS COOKIES DE LA VISTA
    setcookie('inMathChallenge', "1", 0, '/', 'localhost');
    setcookie('continuedSuccess', "0", 0, '/', 'localhost');
    setcookie('success', '-1', 0, '/', 'localhost');
    // CARGA ESPECÍFICA DE LAS COOKIES QUE CONTIENEN LAS REGLAS DEL RETO
    setInitialCookies();
    
    nextStep();     //cargamos la primera prueba del reto
}


// FUNCION QUE CARGA LA REGLAS DEL RETO EN LAS COOKIES
function setInitialCookies() {
    
    global $MATHCHALLENGEPARAMS;  //LLAMADA A LA VARIABLE GLOBAL UBICADA EN ESTE FICHERO, NO LA PASAMOS POR PARAMETRO
    
    // CARGA DE LAS REGLAS DEL JUEGO PARA SER PRESENTADAS EN LA VISTA
    setcookie('objective', (string) $MATHCHALLENGEPARAMS["objective"], 0, '/', 'localhost');
    setcookie('gamePoints', (string) $MATHCHALLENGEPARAMS["reward"], 0, '/', 'localhost');
}


// FUNCION QUE CONTINUA CON LA SIGUIENTE OPERACION DEL RETO 
function nextStep() {           
    
    $result = 0;
    $challenge = newChallenge($result);     //llamada a la funcion del modelo para generar un nuevo reto y su solucion
    
    $_SESSION["result"] = $result;          //guardamos la solucion en una variable de sesion 
    
    //preparamos las cookies para que sean presentadas en la Vista
    setcookie('newchallenge', $challenge, 0, '/', 'localhost');
    setcookie('attempts', (string) $_SESSION["attempts"], 0, '/', 'localhost');
}


// FUNCION QUE GESTIONA LA ACCION DE FINALIZACIÓN DEL RETO
function finishChallenge() {    
    
    // SE OBTINENE VALORES ENVIADOS POR LA VISTA Y SE ACTUALIZAN SI ES NECESARIO
    $level = filter_input(INPUT_COOKIE, 'level');
    $points = filter_input(INPUT_COOKIE, 'points') + getPoints();
    
    setcookie('points', (string) $points, 0, '/', 'localhost');
    setcookie('score', (string) getPoints(), 0, '/', 'localhost');

    // TRAS ACTUALIZAR PUNTOS TOTAL Y PUNTUACION DEL JUEGO SE REVISA SI SE DEBE AUMENTAR EL NIVEL
    if ($level == 1) {      //SE AUMENTA EL NIVEL SI EL USUARIO AUN TENIA NIVEL INICIAL
        setcookie('level', (string) ($level + 1), 0, '/', 'localhost');
    }
    
    //SE BORRA LA VARIABLE QUE INDICA QUE EL CHALLENGE ESTA ACTIVO, Y  LA COOKIE
    unset($_SESSION["inmathgame"]);       
    setcookie('inMathChallenge', "0", 0, '/', 'localhost');     
}


// FUNCION QUE CALCULA LOS PUNTOS OBTENIDOS TRAS LA EJECUCION DEL RETO
function getPoints(): int {     
    
    global $MATHCHALLENGEPARAMS;    //REFERENCIA EXPLICITA AL USO DE VARIABLE GLOBALES

    if ($_SESSION["continuedSuccess"] == $MATHCHALLENGEPARAMS["objective"]) {
        return (int) ($MATHCHALLENGEPARAMS["reward"] * $MATHCHALLENGEPARAMS["objective"] / $_SESSION["attempts"] );
    } else {
        return 0;   // RETO NO SUPERADO IMPLICA 0 PUNTOS OBTENIDOS
    }
}



// ALGORITMO GENERAL DEL CONTROLADOR PARA LA GESTION DEL CHALLENGE
// 
// COMPROBACION DE SI DEBE PREPARARSE EL INICIO DEL CHALLENGE
if (isset($_SESSION["inmathgame"]) == null or $_SESSION["inmathgame"] == 0) {    
    startChallenge();
} else {            // CHALLENGE INICIADO, DEBE CONTINUARSE
    //carga los objetivos del reto al volver al mismo
    setInitialCookies();   
    
    //SI SE HA RECIDIO UNA PROPUESTA PARA EL CHALLENGE ACTUAL  
    if (($resultPropossed = filter_input(INPUT_POST, "result")) != null) {  
        //comparamos resultado con la respuesta recibida
        if ($resultPropossed == $_SESSION["result"]) {          
            setcookie('success', '1', 0, '/', 'localhost');     //GESTIONAMOS EL ACIERTO
            $_SESSION["continuedSuccess"]++;
        } else {                                                //GESTIONAMOS EL ERROR
            setcookie('success', '0', 0, '/', 'localhost');
            $_SESSION["continuedSuccess"] = 0;
        }
        
        // SE ACTUALIZAN LOS INTENTOS Y LOS ACIERTOS CONSECUTIVOS
        $_SESSION["attempts"]++;                            
        setcookie('continuedSuccess', (string) $_SESSION["continuedSuccess"], 0, '/', 'localhost');

        // SE COMPRUENA SI YA SE HA ALCANZADO EL OBJETIVO DEL CHALLENGE
        if ($_SESSION["continuedSuccess"] == $MATHCHALLENGEPARAMS["objective"]) {      
            finishChallenge();     //OBJETIVO ALCANZADO, GESTIONAMOS PUNTUACION 
        } else {                   //continuamos con el reto si aun no se ha alcanzado tras el ultimo intento
            nextStep();
        }
    }
}


//cargamos la vista
header('location: ../../views/challenges/MathChallengeView.php');

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Aprenentatge per Projectes</title>
        <meta charset="UTF-8">
        <meta name="title" content="Portal del Modul 3">
        <link href="../../css/style.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>       
        <header  class="title">
            <h2> Aprenentatge per Projectes </h2>
            <section id="menu">
                <nav  class="darkstyle">  
                    <div>
                        <a href="../Main.php" class="optmenu"> HOME</a>                       
                    </div>
                </nav>
            </section>
        </header>

        <aside id="leftside">
            <div class="darkstyle">
                <nav>
                    <br><br> <b>REGLES DEL REPTE:</b><br>
                    Encerta el color propossat, superarás el repte quan asoleixis la puntuació demanada però et restarem punts per les errades.
                    <br><br>
                </nav>
            </div>
        </aside>

        <aside id="rightside">
            <div class="darkstyle">
                <h4>Referencies utils:</h4>
                <br>
                <a href="https://www.php.net/manual/es/" class="optmenu"><i>PHP.NET</i></a>  
                <br><br>
                <a href="https://www.w3schools.com/php/default.asp" class="optmenu"><i>W3CSCHOOLS</i></a> 
            </div>
        </aside>

        <section id="central">
            <a name="principal"></a>
            OPERACIONS AMB TEXT
            <article>

                <?php
                //carreguem els valors necesaris per a la interaccio amb l'usuari des de les cookies
                $level = filter_input(INPUT_COOKIE, 'level');
                $user = filter_input(INPUT_COOKIE, 'user');
                $points = filter_input(INPUT_COOKIE, 'points');
                $trueResponse = filter_input(INPUT_COOKIE, 'trueResponse');
                $currentPoints = filter_input(INPUT_COOKIE, 'currentPoints');
                $objective = filter_input(INPUT_COOKIE, 'objective');
                $reward = filter_input(INPUT_COOKIE, 'reward');
                $penalty = filter_input(INPUT_COOKIE, 'penalty');
                $ingame = filter_input(INPUT_COOKIE, 'incolorgame');

                
                if ($currentPoints <= 0) {    //acaba la prova sense superar-la
                    echo "<br>Resposta incorrecta. Lamentablement $user, ha finalitzat la prova sense exit. Esperem que ho tornis a intentar.<br><br>";
                }
                
                if ($currentPoints >= $objective) {    //ha aconseguit superar el repte
                    echo "<br>Felicitats $user. Has superat el repte i assolit el nivell $level aconseguint $points punts. <br><br>";
                }
                
                if ( $ingame == 0 ) {       // prova finalitzada
                    print "<p><a href=\"../main.php\">Tornar al Homepage</a></p>\n";
                } else {
                    if ($trueResponse == -1) {      // primera vegada que es presenta el repte a l'usuari i encara no hi ha resposta
                        print "<br>Comences amb $currentPoints punts inicials.";
                    } else if ($trueResponse == 1) {   //si ha donat una resposta correcta
                        echo "<br>Felicitats $user. Tens acumulats: " . $currentPoints . " punts en aquesta prova<br><br>";
                    } else {                    //en cas contrari
                        echo "<br>Resposta incorrecta. Tens acumulats: " . $currentPoints . " punts en aquesta prova<br>";
                    }
                
                    // missatges generics que es presenten durant la prova mentre no finalitzi
                    print "<br>Supera la prova aconseguint $objective punts (respota correcta = +$reward, incorrecta = -$penalty)";
                    echo "<br><br>Repte Actual. Quin color tenim aqui?:  " . filter_input(INPUT_COOKIE, 'newColor');
                }
                ?>
                
                <div id="formulario">             
                    <form action="../../controllers/challenges/StringChallengeController.php" method="POST">
                        <label>Resultat: </label>
                        <input name="result" placeholder="Introdueix la resposta"/>
                        <input type="submit" value="COMPROVAR" id="enviar" /><br><br>
                    </form>

                </div>
                <br>  
            </article>		
        </section>

        <footer>
            <div class="darkstyle"> 
                <a><b> Autor: Jose Meseguer</b> </a>  
            </div>            		
        </footer>
    </body>
</html>
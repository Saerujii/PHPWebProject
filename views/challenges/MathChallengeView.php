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
            <h1> P H P. Aprenentatge per Projectes </h1>
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
                <br><br><b>REGLES DEL REPTE:</b><br>
                Encerta el resultat de l'operació, es supera el repte aconseguint els encerts consecutius demanats, si falles comences de cero i acumularàs intents que penalitzaran la puntuació final.<br><br>
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
            <br><b>MATH CHALLENGE: Suma, Resta, Multiplica i Divideix (sense decimals, nomes cocient)</b><br><br>
            El repte acava quan assoleixes 5 encerts consecutius<br><br>
            <article>
                <?php
                // carrega del valor de les cookies per presentar-les a l'uuari
                $level = filter_input(INPUT_COOKIE, 'level');
                $user = filter_input(INPUT_COOKIE, 'user');
                $points = filter_input(INPUT_COOKIE, 'points');
                $activeGame = filter_input(INPUT_COOKIE, 'inMathChallenge');
                $challengeObjective = filter_input(INPUT_COOKIE, 'objective');
                $continuedSuccess = filter_input(INPUT_COOKIE, 'continuedSuccess');
                $success = filter_input(INPUT_COOKIE, 'success');

                
                if ($activeGame == 0) {       //repte finalitzat, presentacio de resultats
                    
                    $gamePoints = filter_input(INPUT_COOKIE, 'gamepoints');
                    $score = filter_input(INPUT_COOKIE, 'score');
                    
                    print "<b>CONGRATS! CHALLENGE COMPLETED!</b><br>Has aconsseguit $score punts dels $gamePoints possibles. ";
                    print "Has assolit el nivell $level aconseguint $gamePoints punts en aquesta prova ($points totals). <br>";
                    print "<p><a href=\"../Main.php\">Tornar al Homepage</a></p>\n";
                    print "<<b>" . "GAME FINISHED" . "</b><br>";      
                    
                } else {
                    if ($success != -1) {           // l'usuari ha donat una resposta    
                        
                        if ($success == 1) {        // si ha donat una resposta correcta
                            print "Felicitats $user. Exits aconseguits: " . $continuedSuccess . ". ";
                        } else {                    // resposta incorrecta
                            print "<b>Resultat incorrecte.</b> Tornem a començar de cero. ";
                        }
                        
                        // i en qualsevol cas, compte com intent
                        print "Portes " . filter_input(INPUT_COOKIE, 'attempts') . " intents.<br><br>";
                    }
                    
                    // presentació standard de missatges mentre duri el repte
                    print "Anims $user (nivell:" . $level . "). Et resten " . ($challengeObjective - $continuedSuccess) . " intents per superar-lo.<br><br>";
                    print " Repte Actual:   ";
                    print filter_input(INPUT_COOKIE, 'newchallenge');
                }
                
               
                ?>
                
                <div id="formulario">             
                    <form action = "../../controllers/challenges/MathChallengeController.php" method="POST">
                        <input type="number" name="result" placeholder="Escriu el resultat"/>
                        <input type="submit" value="CHECK" id="check" name="enviar"/>
                    </form>
                </div>
            </article>	
        </section>

        <footer>
            <div class="darkstyle">
                <a><b> Autor: Jose Meseguer</b> </a>  
            </div>		
        </footer>
    </body>
</html>

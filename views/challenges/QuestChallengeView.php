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
                        <a href="../main.php" class="optmenu"> HOME </a>
                        <a href="NumbersView.html" class="optmenu"> NUMBERS & ARRAYS </a>
                        <a href="StringsView.html" class="optmenu"> STRINGS</a>
                    </div>	
                </nav>
            </section>
        </header>

        <aside id="leftside">
            <div class="darkstyle">
                <nav>
                    <br><br><br><br><br><br>
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
            <h4>CHALLENGE</h4>

            <article>
                <div id='formulario'>
                    <form action='../../controllers/challenges/QuestChallengeController.php' method='POST'>
                        <div id="wrap">
                            <button type="submit" name="saveGame" value="true" id="enviar" class="extend center">Guardar la partida</button><br><br><br>
                        </div>
                        <?php
                        $level = filter_input(INPUT_COOKIE, 'level');
                        $user = filter_input(INPUT_COOKIE, 'user');
                        $points = filter_input(INPUT_COOKIE, 'points');
                        $currentPts = filter_input(INPUT_COOKIE, 'currentPts');
                        $activeGame = filter_input(INPUT_COOKIE, 'inQuest');
                        $challengeObjective = filter_input(INPUT_COOKIE, 'objective');
                        $continuedSuccess = filter_input(INPUT_COOKIE, 'streak');
                        $success = filter_input(INPUT_COOKIE, 'success');
                        
                        if ($activeGame == 0){
                            
                            $score = filter_input(INPUT_COOKIE, 'score');
                            
                            if (!$currentPts <= 0 ){
                                print "<b>CONGRATS! CHALLENGE COMPLETED!</b><br>Has aconsseguit $score punts.<br>
                                      Has assolit el nivell $level amb $currentPts punts restants en aquesta prova ($points totals). <br>
                                      <p><a href=\"../Main.php\">Tornar al Homepage</a></p>\n
                                      <b>" . "GAME FINISHED WITH SUCCESS" . "</b><br>";
                            }
                            else{
                                print "<b>FAIL</b><br><br>Ho sentim molt, pero sembla que has fallat. Prova a intentar de nou.<br>
                                      <p><a href=\"../Main.php\">Tornar al Homepage</a></p>
                                      <b>GAME FINISHED WITH FAIL</b><br>";
                            }
                        }
                        else{
                            if ($success != -1) {
                                if ($success == 1) {
                                    print "Felicitats $user. Exits aconseguits: $continuedSuccess. ";
                                } 
                                else{
                                    print "<b>Resultat incorrecte.</b> Tornem a començar de cero.";
                                }
                                
                                print "Portes " . filter_input(INPUT_COOKIE, 'attempts') . " intents.<br><br>";
                            }
                            else{
                                print "User: $user. Exits aconseguits: $continuedSuccess. 
                                       Portes " . filter_input(INPUT_COOKIE, 'attempts') . " intents.<br><br>";
                            }
                            
                            print "Anims $user (Nivell: " . $level . "). Tens " . ($currentPts) . " punts<br><br>
                                   Repte Actual:    " . filter_input(INPUT_COOKIE, 'nextQuest'). '<br>';
                            
                            $answer1 = filter_input(INPUT_COOKIE, 'answer1');
                            $answer2 = filter_input(INPUT_COOKIE, 'answer2');
                            $answer3 = filter_input(INPUT_COOKIE, 'answer3');
                            
                            print "<br><label>".$answer1."</label><input type=radio name='answer' value='$answer1'><br>
                                   <br><label>".$answer2."</label><input type=radio name='answer' value='$answer2'><br>
                                   <br><label>".$answer3."</label><input type=radio name='answer' value='$answer3'><br>";
                        }
                        ?>
                        <input type='submit' value='RESPONDRE' id='enviar'/><br><br>
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


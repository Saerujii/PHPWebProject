<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Aprenentatge per Projectes</title>
        <meta charset="UTF-8">
        <meta name="title" content="Portal del Modul 3">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <header  class="title">
            <h2> Aprenentatge per Projectes </h2>
            <section id="menu">
                <nav  class="darkstyle"> 
                    <div>
                        <a href="activities/NumbersView.html" class="optmenu"> NUMBERS & ARRAYS </a>
                        <a href="activities/StringsView.html" class="optmenu"> STRINGS</a>
                        <a href="activities/ArrayAssocView.html" class="optmenu"> ARRAYS_ASSOC </a>
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
            <h3>PORTAL FONAMENTS PROGRAMACIO PHP</h3>
            <article>
                <?php
                if (($user = filter_input(INPUT_COOKIE, 'user')) != null) {
                    echo "Benvigut, $user. Continua el teu aprenentatge al nostre portal ";
                    $level = filter_input(INPUT_COOKIE, 'level');
                    $points = filter_input(INPUT_COOKIE, 'points');
                    echo "<br><br>Escull un repte en funció del teu nivell actual: $level ($points punts)<br><br>";
                    
                    print "<p><a href=\"../controllers/challenges/MathChallengeController.php\">Supera el repte Matematic</a></p>\n";
                    if ($level > 1) {
                        print "<p><a href=\"../controllers/challenges/StringChallengeController.php\">Superar el repte amb Strings</a></p>\n";
                    }
                    if ($level > 2) {
                        print "<p><a href=\"../controllers/challenges/ArrayCountryController.php\">Superar el repte amb Arrays</a></p>\n";
                    }
                    if ($level > 3) {
                        print "<p><a href=\"../controllers/challenges/QuestChallengeController.php\">Superar el cuestionari</a></p>\n";
                    }
                } else {
                    print "<p><a href=\"../index.html\">Tornar a la pàgina principal</a></p>\n";
                }
                ?> 
            </article>
        </section>

        <footer>
            <div class="darkstyle">  
                <a><b> Autor: Jose Meseguer</b> </a> 
            </div>           		
        </footer>
    </body>
</html>   
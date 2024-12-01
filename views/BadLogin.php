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
            <h1> P H P. Aprenentatge per Projectes </h1>
            <section id="menu">
                <nav  class="darkstyle">
                    <div>
                        <a href="../index.html" class="optmenu"> HOME</a>                       
                    </div>
                </nav>
            </section>
        </header>

        <aside id="leftside">
            <div class="darkstyle">
                <br><br><br><br><br><br>
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
            <h3>Usuari o password no valids</h3>

            <article>
                <?php
                print "LOGIN INCORRECTE<br><br>";

                $intents = filter_input(INPUT_COOKIE, 'loginAttempts');

                print "Portes realitzats: $intents intents<br><br>";
                if ($intents == 5) {
                    print "<br><br>HAS SUPERAT EL NOMBRE MAXIM DE INTENTS. CONTACTA AMB L'ADMINISTRADOR DEL SITE";
                }
                print "<br><br><p><a href=\"../index.html\">Tornar a la pàgina d'autenticació</a></p>\n";
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
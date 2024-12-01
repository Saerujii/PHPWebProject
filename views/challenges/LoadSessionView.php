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
                        <label><b>ALERTA.</b><br>Tens una partida guardada<br><br>Vols cargar la partida guardada o esborrar-la?</label><br><br><br><br>
                        <button type='submit' name="continueGame" value='load' id='enviar'>CARGAR</button><br><br>
                        <button type='submit' name="continueGame" value='delete' id='enviar'>ESBORRAR</button><br><br>
                        <button type='submit' name="continueGame" value='continue' id='enviar'>CONTINUAR SENSE ESBORRAR</button><br><br><br><br><br>
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


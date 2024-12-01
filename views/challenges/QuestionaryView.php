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
            <h4>Q U E S T I O N A R Y</h4>
            <article>
                <?php
                
                ?>
                <form action="../../controllers/challenges/QuestionaryChallengeController.php" method="POST">                    
                    <br><label>Entra la capital del pais:</label><input name="capital" autocomplete="off"/><br>
                    <br><br><input type="submit" value="COMPROBAR" name="enviar" />
                </form>        
            </article>

            <article>


                <br><br>
            </article>	

            <article>
                <br><br>                    
            </article>	

        </section>

        <footer>
            <div class="darkstyle">  
                <a><b> Autor: Jose Meseguer</b> </a> 
            </div>		
        </footer>
    </body>
</html>


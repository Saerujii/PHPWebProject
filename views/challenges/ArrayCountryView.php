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
            <h4>EXEMPLE AMB ARRAYS ASSOCIATIUS</h4>
            <article>
                <?php
                $pais = filter_input(INPUT_COOKIE, "pais");
                $response = filter_input(INPUT_COOKIE, "response");
                $preguntas = filter_input(INPUT_COOKIE, "preguntas");
                
                print "El cuestionario realizara $preguntas preguntas<br><br>";
                
                $intentos = filter_input(INPUT_COOKIE,"intentos");
                $aciertos = filter_input(INPUT_COOKIE,"aciertos");
                $errores = filter_input(INPUT_COOKIE,"errores");
                
                print "Estamos en $intentos ($aciertos aciertos / $errores errores)";
                
                if ($response != null) {
                    print "<br><br>La respuesta es: $response";
                }
                
                if ( ($nota = filter_input(INPUT_COOKIE,"nota")) != null){
                    print "Reto finalizado con la siguiente valoracion: $nota";
                }else{
                    print "<br><br>Te ha tocado el siguiente pais: $pais<br><br>";
                }
                
                ?>
                <form action="../../controllers/challenges/ArrayCountryController.php" method="POST">                    
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


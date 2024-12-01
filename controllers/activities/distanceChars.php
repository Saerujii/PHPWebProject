<?php

include_once '../../model/StringFunctions.php';

if (($string = filter_input(INPUT_POST, "string")) != null){
    
    $char1 = filter_input(INPUT_POST, "char1");
    $char2 = filter_input(INPUT_POST, "char2");
    
    $result = distcar($string, $char1, $char2);
    
    print "Cadena:<br>$string<br>Caràcters:<br>'$char1' i '$char2'<br><br>Distancia entre aquests caracters:<br>$result";
}
else{
    print "Ninguna cadena de caràcters intoduïda.";
}

print "  <p><a href=\"../../views/activities/StringsView.html\">Volver a la página anterior</a></p>\n";

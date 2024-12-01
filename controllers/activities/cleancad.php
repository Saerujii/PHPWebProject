<?php

include_once '../../model/StringFunctions.php';

if (($str = filter_input(INPUT_POST, "string"))!=null){
    
    print "Cadena introduïda: $str<br><br>";
    $strClean = cleancad($str);
    print "Cadena sense separadors: $strClean";
}else{
    print "Ninguna cadena de caràcters intoduïda.";
}

print "  <p><a href=\"../../views/activities/StringsView.html\">Volver a la página anterior</a></p>\n";
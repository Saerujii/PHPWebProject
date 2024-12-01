<?php

include_once '../../model/StringFunctions.php';

if (($strEncrypted = filter_input(INPUT_POST, "text")) != null) {
    $keys = [5, 8, 7, 1, 11, 9, 2, 8]; //[5, 8, 7, 1, 11, 9, 2, 8]

    $str = mydecrypt($strEncrypted, $keys);
    
    print "Cadena de caràcters decriptada:<br>$str";
}else{
    print "No d'ha intrduit cap cadena de caràcters encriptada";
}

print "  <p><a href=\"../../views/activities/StringsView.html\">Volver a la página anterior</a></p>\n";

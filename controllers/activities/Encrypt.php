<?php

include_once '../../model/StringFunctions.php';

if (($str = filter_input(INPUT_POST, "text"))!=null){
    $keys = [5, 8, 7, 1, 11, 9, 2, 8]; //[1,2,3,4,5,6,7,8,9]
    
    $strEncrypted = mycrypt($str, $keys);
    
    if ($strEncrypted!=""){
        print "Cadena de caràcters encriptada:<br>$strEncrypted";
    }else{
        print "No es permeten caràcters especials";
    }
    
}else{
    print "No s'ha introduït ninguna cadena de caràcters.";
}

print "  <p><a href=\"../../views/activities/StringsView.html\">Volver a la página anterior</a></p>\n";

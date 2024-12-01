<?php

include_once '../../model/FileFunctions.php';

if (($filePath = filter_input(INPUT_POST, 'filePath')) != null AND
    ($find = filter_input(INPUT_POST, 'find')) != null AND
    ($replaceWith = filter_input(INPUT_POST, 'replaceWith')) != null){
    
    $replaceAmount = intval(filter_input(INPUT_POST, 'replaceAmount'));
    if ($replaceAmount == 0){
        $replaceAmount = null;
    }
    
    $result = replaceInFile($filePath, $find, $replaceWith, $replaceAmount);
    
    print "Operacio completada amb codi de sortida: $result";
}
else {
    header('Location: ../../views/activities/StringsView.html#replace');
}

print "  <p><a href=\"../../views/activities/StringsView.html#replace\">Volver a la página anterior</a></p>\n";
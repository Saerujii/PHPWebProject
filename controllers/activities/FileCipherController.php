<?php

include_once '../../model/FileFunctions.php';

if (($filePath = filter_input(INPUT_POST, 'filePath')) != null AND
    ($keys = filter_input(INPUT_POST, 'keys')) != null){
    
    $mode = filter_input(INPUT_POST, 'mode');
    $keys = explode(', ', $keys);
    
    switch ($mode){
        case 'cipher':
            $result = cipherFile($filePath, $keys);
            break;
        case 'uncipher':
            $result = uncipherFile($filePath, $keys);
            break;
    }
    
    print "Operacio completada. Durant la operacio s'han escrit $result bytes";
}
else {
    header('Location: ../../views/activities/StringsView.html#cipher');
}

print "  <p><a href=\"../../views/activities/StringsView.html#cipher\">Volver a la página anterior</a></p>\n";
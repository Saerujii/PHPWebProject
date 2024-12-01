<?php
include_once 'StringFunctions.php';

// Canviar el text especificat amb el text especificat al fitxer proporcionat, 
// tantes vegades com especificat (canvia tot si no s'especifica res)
function replaceInFile(string $filePath, string $find, string $replaceWith, int $replaceAmount = null): int{
    $fileContents = file_get_contents($filePath);
    $result = str_replace($find, $replaceWith, $fileContents, $replaceAmount);
    $output = file_put_contents($filePath, $result);
    
    if($output == 0){
        return -1;
    }elseif($output == false){
        return -2;
    }else{
        return 0;
    }
}

// Xifrar el fitxer especificat amb els keys especificats
function cipherFile(string $filePath, array $cipherKeys): int{
    $fileContents = file_get_contents($filePath);
    $result = mycrypt($fileContents, $cipherKeys);
    $output = file_put_contents($filePath, $result);
    
    return $output;
}

// Desxifrar el fitxer especificat anb els keys especificats
function uncipherFile(string $filePath, array $cipherKeys): int{
    $fileContents = file_get_contents($filePath);
    $result = mydecrypt($fileContents, $cipherKeys);
    $output = file_put_contents($filePath, $result);
    
    return $output;
}

// Extreure els usuaris que tenen els temps d'inactivitat superior al especificat (0 si no es especifica)
// i guardar-lo al array proporcionat
function extractUserInactives(string $filePath, array &$outputTo, int $maxInactiveTime = 0): int{
    $fileContents = file_get_contents($filePath);
    // Explode el fitxer (que es string) a partir del End Of Line
    $lines = explode(PHP_EOL, $fileContents);
    $linesSaved = 0;
    
    // Per cada linia explota-la per el ';' i compara els temps inactiu
    foreach ($lines as $line){
        $lineExploded = explode(';', $line);
        if ($lineExploded[3] > $maxInactiveTime){
            $outputTo[] = $line;
            $linesSaved++;
        }
    }
    if ($linesSaved==0){
        return -1;
    }
    else{
        return $linesSaved;
    }
}

// Converteix el fitxer proporcionat a un array (sempre que l'arxiu segeix l'estructura:
// 'data;data;data;data;data', etc...
function fileDataToArray(string $filePath): array{
    $fileContents = file_get_contents($filePath);
    $fileLines = explode(PHP_EOL, $fileContents);
    $result = [];
    
    foreach ($fileLines as $line){
        $lineExploded = explode(';', $line);
        $result[] = $lineExploded;
    }
    return $result;
}

// Guardar els temps d'inactivitat de les sessions als departaments especificats (dels tots si no s'especifica)
// al fitxer proporcionat a partir d'un array
function saveDeptInactivity(string $storage, array $userSessions, string $deptName = '*'): int{
    $linesSaved = 0;
    file_put_contents($storage, ""); // Buidar l'arxiu del storage
    
    foreach ($userSessions as $session){
        // Si el nom del departament especificat no igual a '*'
        if ($deptName != '*'){
            // Si el primer key d'array de sessions (Que hauria de ser el departament) es igual al especificat
            if ($session[1] == $deptName){
                file_put_contents($storage, implode(';', $session)."\n", FILE_APPEND);
                $linesSaved++;
            }
        } // Si no s'ha especificat res, o '*'
        else{
            file_put_contents($storage, implode(';', $session)."\n", FILE_APPEND);
            $linesSaved++;
        }
    }
    return $linesSaved;
}
<?php

function extractUsers(string $filePath, array &$storage, string $filterDept = '*'): int{
    $file = file_get_contents($filePath);
    if ($file == false){
        return -1;
    }
    
    $fileLines = explode(PHP_EOL, $file);
    
    
    if ($filterDept == '*'){
        $storage = $fileLines;
        return count($storage);
    }
    
    $linesSaved = 0;
    foreach ($fileLines as $line){
        $lineArray = explode('-', $line);
        if ($lineArray[1] == $filterDept){
            $storage[] = $line;
            $linesSaved++;
        }
    }
    return $linesSaved;
}


function saveRoles(string $filePath, array $data, string $filterRole = '*', bool $saveNotMatching = false): int{
    $file = fopen($filePath, 'w');
    
    $linesSaved = 0;
    foreach ($data as $user){
        $user = explode('-', $user);
        $inactive = (isset($user[4])) ? '['.intval($user[4]).']' : '';
        $write = $user[0].'.'.$user[1].'('.$user[2].')'.'='.$user[3].$inactive."\n";
        
        if ($filterRole == '*'){
            fwrite($file, $write);
            $linesSaved++;
        }
        elseif (!$saveNotMatching){
            if ($user[2] == $filterRole){
                fwrite($file, $write);
                $linesSaved++;
            }
        }
        else{
            if ($user[2] != $filterRole){
                fwrite($file, $write);
                $linesSaved++;
            }
        }
    }
    fclose($file);
    return $linesSaved;
}
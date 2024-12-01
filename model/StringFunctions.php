<?php

function distcar(string $string, string $char1, string $char2): int{
    if($char1 == null OR $char2 == null){
        return -1;
    }
    
    for ($i=0;$i<strlen($string);$i++){
        if ($string[$i]==$char1){
            $key1=$i;
            break;
        }
    }
    
    for ($i=0;$i<strlen($string);$i++){
        if ($string[$i]==$char2){
            $key2=$i;
            break;
        }
    }
    
    $result = ($key1<$key2) ? $key2 - $key1 - 1 : $key1 - $key2 - 1;
    
    return $result;
}


function cleancad(string $string): string{
    $separators="-.,*?¿¡!'=()[]{}/\&¬%$@|<> ";
    $strClean=$string;
    
    for ($i=0;$i<strlen($separators);$i++){
        for ($j=0;$j<strlen($strClean);$j++){
             if ($separators[$i]==$strClean[$j]){
                 $strClean[$j]="\0";
             }
        }
    }
    
    return $strClean;
}


function mycrypt(string $str, array $keys): string{
    $strEncrypted=$str;
    $currentKey=0;
    
    for ($letter=0;$letter<strlen($strEncrypted);$letter++){
        if ($currentKey==count($keys)){
            $currentKey=0;
        }
        $lletra = $strEncrypted[$letter];
        $key = $keys[$currentKey];
        $letterCode=ord($lletra);
        
        
        $strEncrypted[$letter] = chr($letterCode+$key);
        
        $currentKey++;
    }
    
    return $strEncrypted;
}


function mydecrypt(string $strEncrypted, array $keys): string{
    $str=$strEncrypted;
    $currentKey=0;
    
    for ($letter=0;$letter<strlen($str);$letter++){
        if ($currentKey==count($keys)){
            $currentKey=0;
        }
        $key = $keys[$currentKey];
        $encLetterCode=ord($strEncrypted[$letter]);
        
        
        $str[$letter] = chr($encLetterCode-$key);
        
        $currentKey++;
    }
    
    return $str;
}
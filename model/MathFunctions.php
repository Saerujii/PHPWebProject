<?php

function divisors(int $n): array {
    $divisors = [1];
    $maxdiv = sqrt($n);
    for ($div = 2; $div < $maxdiv; $div++) {
        if ($n % $div == 0) {
            $divisors[] = $div;
            $divisors[] = $n / $div;
        }
    }
    if ($n % $div == 0) {
        $divisors[] = $div;
    }
    sort($divisors);
    return $divisors;
}


function basicOperations(int $n1, int $n2, string $op): float {
    $result = 0.0;
    switch ($op) {
        case "+": $result = $n1 + $n2;
            break;
        case "-": $result = $n1 - $n2;
            break;
        case "*": $result = $n1 * $n2;
            break;
        case "/": $result = $n1 / $n2;
            break;
    }
    return $result;
}


function printArray(array $a, string $sep) {
    for ($i = 0; $i < count($a); $i++) {
        if ($i < count($a) - 1) {
            print $a[$i] . $sep;
        } else {
            print $a[$i];
        }
    }
}


function isPrime(int $num): bool{
    $div=2;
    
    while ($div<=$num/2){
        
        if ($num%$div==0){
            return false;
        }
        
        $div++;
    }
    return true;
}


function isPerfect(int $num): bool{
   $sumDiv=0;
   
   for ($i=1;$i<$num;$i++){
       
       if ($num%$i==0){
           $sumDiv+=$i;
       }
   }
   
   if ($sumDiv==$num){
       return true;
   }else{
       return false;
   }
}


function mcd(int $num1, int $num2): int{
    if ($num1<$num2){ // Definicion min-max. Mover a controllers?
        $min=$num1;
    }else{
        $min=$num2;
    }
    
    while ($min > 0){
        if ($num1%$min==0 && $num2%$min==0){
            break;
        }
        $min--;
    }
    return $min;
}


function mcm(int $num1, int $num2): int{
    if ($num1<$num2){
        $max=$num2;
        $min=$num1;
    }else{
        $max=$num1;
        $min=$num2;
    }
    
    $temp1=0;
    $temp2=0;
    for ($i=0; $i<$max;$i++){
        $temp1=$max*($i+1);
        
        for ($j=0; $j<$max;$j++){
            $temp2=$min*($j+1);
            
            if($temp1===$temp2){
                return $temp1;
            }
        }
    }
}


function fiboArray(int $num): array{
    $result=[];
    $root5=sqrt(5);
    
    for($i=0;$i<$num;$i++){
        //Formula de calcul fibonacci
        $fiboFormula=(pow((1+$root5),$i) - pow((1-$root5),$i)) / (pow(2, $i) * $root5);
        
        $result[]=intval($fiboFormula);
    }
    return $result;
}


function fillArray(int $fillAmount, int $from, int $to): array{
    $arrayGenerated=[];
    
    for ($i=0;$i<$fillAmount;$i++){
        $arrayGenerated[] = rand($from, $to);
    }
    return $arrayGenerated;
}


function arrayStats(array $array, int &$arrayMin, int &$arrayMax, int &$arrayAvg): void{
    $arrayMin=min($array);
    $arrayMax=max($array);
    $arrayAvg=array_sum($array)/count($array);
    return;
}


function arraySort(array &$array, bool $sortType): void{
    for ($i=0;$i<(count($array)-1);$i++){
        for ($key=0;$key<(count($array)-1);$key++){
            // sortType: 0=Asc, 1=Desc
            $sortTypeSwap = ($sortType==1) ? ($array[$key]>$array[$key+1]) : ($array[$key]<$array[$key+1]);
            
            if ($sortTypeSwap){
                $temp = $array[$key];
                $array[$key] = $array[$key+1];
                $array[$key+1] = $temp;
            }
        }
    }
    return;
}


function linSearch(array $array, int $searchValue): int{
    for ($key=0;$key<count($array);$key++){
        if ($array[$key] == $searchValue){
            return $key;
        }
    }
    return -1;
}


function binSearch(array $array, int $searchValue, bool $sortType): int{
    $searchFrom = ($sortType==1) ? 0 : (count($array)-1); // Si $sortType==1, $searchFrom=0, en caso contrario $searchFrom=(count($array)-1)
    $searchTo = ($sortType==1) ? (count($array)-1) : 0;
    
    while (($sortType==1) ? $searchFrom <= $searchTo : $searchFrom >= $searchTo){
        
        $midEquation=(($searchFrom + $searchTo)/2);
        $currentMid = ($sortType==1) ? floor($midEquation) : round($midEquation);
        
        if($array[$currentMid] == $searchValue){
            return $currentMid;
        }
        
        if($searchValue < $array[$currentMid]){
            $searchTo = ($sortType==1) ? $currentMid-1 : $currentMid+1;
        }
        else{
            $searchFrom = ($sortType==1) ? $currentMid+1 : $currentMid-1;
        }
    }
    
    return -1;
}


function linSearchAll(array $array, int $searchValue): array{
    $foundPos=[];
    for ($key=0;$key<count($array);$key++){
        if ($array[$key] == $searchValue){
            $foundPos[]=$key;
        }
    }
    return $foundPos;
}


function binSearchAll(array $array, int $searchValue, bool $sortType): array{
    $searchFrom = ($sortType==1) ? 0 : (count($array)-1); // Si $sortType==1, $searchFrom=0, en caso contrario $searchFrom=(count($array)-1)
    $searchTo = ($sortType==1) ? (count($array)-1) : 0;
    
    $foundPos=[];
    
    while (($sortType==1) ? $searchFrom <= $searchTo : $searchFrom >= $searchTo){
        
        $midEquation=(($searchFrom + $searchTo)/2);
        $currentMid = ($sortType==1) ? floor($midEquation) : round($midEquation);
        
        if($array[$currentMid] == $searchValue){
            $foundPos[]=$currentMid;
        }
        
        if($searchValue < $array[$currentMid]){
            $searchTo = ($sortType==1) ? $currentMid-1 : $currentMid+1;
        }
        else{
            $searchFrom = ($sortType==1) ? $currentMid+1 : $currentMid-1;
        }
    }
    
    return $foundPos;
}


function mcmAll(int $num1, int $num2): array{
    $max = ($num1<$num2) ? $num2 : $num1;
    $min = ($num1<$num2) ? $num1 : $num2;
    
    $save=[];
    
    $temp1=0;
    $temp2=0;
    for ($i=0; $i<$max;$i++){
        $temp1=$max*($i+1);
        
        for ($j=0; $j<$max;$j++){
            $temp2=$min*($j+1);
            
            if($temp1===$temp2){
                $save[]=$temp1;
            }
        }
    }
    return $save;
}


function extractMults(array $array, int $num1, int $num2): array{
    $mults = mcmAll($num1, $num2);
    $multsFound=[];
    
    foreach($mults as $mult){
        $foundPos = linSearch($array, $mult);
        if($foundPos!=-1){
            $multsFound[]=$array[$foundPos];
        }
    }
    return $multsFound;
}


function selectBetween(array $array, int $selectFrom, int $selectTo, bool $sort): array{
    $num1Range = ($selectFrom<$selectTo) ? linSearch($array, $selectFrom) : linSearch($array, $selectTo);
    $num2Range = ($selectFrom<$selectTo) ? linSearch($array, $selectTo) : linSearch($array, $selectFrom);
    $newArray=[];
    
    if ($num1Range==-1 OR $num2Range==-1){
        return $newArray;
    }
    
    for ($i=0;$i<count($array);$i++){
        if ($array[$num1Range]<=$array[$i] AND $array[$i]<=$array[$num2Range]){
            $newArray[]=$array[$i];
        }
    }
    
    if ($sort){
        arraySort($newArray, 1);
    }
    return $newArray;
}


function searchPrime(int $num1, int $num2): array{
    $result=[];
    
    for ($i=$num1+1;$i<$num2;$i++){
        if (isPrime($i)){
            $result[]=$i;
        }
    }
    
    return $result;
}


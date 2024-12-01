<?php

function stringFilter(array $usersDB, string $filterKey, string $filterValue, bool $filterExact): array{
    $found=[];
    if ($filterExact){
        foreach ($usersDB as $user){
            if ($user[$filterKey]==$filterValue){
                $found[]=$user;
            }
        }
    }else{
        foreach ($usersDB as $user){
            if (str_contains($user[$filterKey], $filterValue)){
                $found[]=$user;
            }
        }
    }
    return $found;
}


function intFilter(array $usersDB, string $filterKey, int $filterValue, bool $moreOrEqual): array{
    $found=[];
    if ($moreOrEqual){
        foreach ($usersDB as $user){
            if ($user[$filterKey]>=$filterValue){
                $found[]=$user;
            }
        }
    }else{
        foreach ($usersDB as $user){
            if ($user[$filterKey]<=$filterValue){
                $found[]=$user;
            }
        }
    }
    return $found;
}
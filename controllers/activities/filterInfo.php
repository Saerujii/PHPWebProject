<?php

$nbaTopScorers = [ 
    ["player" => "LeBron James", "position" => "Forward", "champion" => 4, "points" => 38923],   
    ["player" => "Kareem Abdul-Jabbar", "position" => "Center", "champion" => 6, "points" => 38387],
    ["player" => "Karl Malone", "position" => "Forward", "champion" => 0, "points" => 36928],    
    ["player" => "Kobe Bryant", "position" => "Guard", "champion" => 5, "points" => 33643],
    ["player" => "Michael Jordan", "position" => "Guard", "champion" => 6, "points" => 32292],
    ["player" => "Dirk Nowitzki", "position" => "Forward", "champion" => 1, "points" => 31560],
    ["player" => "Wilt Chamberlain", "position" => "Center", "champion" => 2, "points" => 31419],    
    ["player" => "Shaquille O'Neal", "position" => "Center", "champion" => 4, "points" => 28596],
    ["player" => "Carmelo Anthony", "position" => "Forward", "champion" => 0, "points" => 28289]
];

$player = (filter_input(INPUT_POST, "player")!=null) ? filter_input(INPUT_POST, "player") : "";
$position = (filter_input(INPUT_POST, "position")!=null) ? filter_input(INPUT_POST, "position") : "";
$champion = (filter_input(INPUT_POST, "champion")!=null) ? filter_input(INPUT_POST, "champion") : null;
$points = (filter_input(INPUT_POST, "points")!=null) ? filter_input(INPUT_POST, "points") : 0;

if ($player=="" AND $position=="" AND $champion==null AND $points==0){
    print "No has introducit ningun valor per filtrar!";
}else{
    $found=[];
    foreach ($nbaTopScorers as $array){
        if (str_contains($array["player"], $player) AND str_contains($array["position"], $position) AND $array["points"]>=$points){
            if ($champion!=null){
                if ($array["champion"]==$champion){
                    $found[]=$array;
                }
            }else{
                $found[]=$array;
            }
        }
    }
    if (count($found)==0){
        print "No s'han trobat les dades amb aquests filtres.";
    }else{
        print "Jugadors trobats:<br><br>";
        foreach ($found as $array){
            print "Jugador: ".$array["player"]."<br>Posicio: ".$array["position"]."<br>Titols obtinguts: ".$array["champion"]."<br>Punuacio: ".$array["points"]."<br><br><br>";
        }
    }
}

print "  <p><a href=\"../../views/activities/ArrayAssocView.html\">Volver a la página anterior</a></p>\n";